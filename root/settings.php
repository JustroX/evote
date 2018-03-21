<?php 
	
	if(isset($_GET["sub"]) && isset($_POST["parties"]))
	{
		$parties = $_POST["parties"];
		$positions = $_POST["positions"];
		$voting = isset($_POST["voting"]);
		$fuzz = isset($_POST["fuzz"]);
		$arr  = ["voting"=>$voting,"fuzz"=>$fuzz,"parties"=>json_decode($parties),"positions"=>json_decode($positions)];

		$fp = fopen('settings.json', 'w');
		fwrite($fp, json_encode($arr));
		fclose($fp);
	}

	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);
 ?>


<br><br>
<div class="container">
	<h1>Election Settings</h1>
	<br><br>
	<form method="post" action="index.php?mode=root&action=settings&sub=1" onkeypress="return event.keyCode != 13;">
		<span>
			<b>Voting is enabled?</b> &nbsp&nbsp
			<input <?php echo ($es["voting"])?"checked":""; ?> type="checkbox" name="voting" class="bootstrap-switch" data-on-label="ON" data-off-label="OFF" />
		</span> <br><br>
		<span>
			&nbsp&nbsp<b>Fuzziness?  </b>&nbsp&nbsp
			<input <?php echo ($es["fuzz"])?"checked":""; ?>  type="checkbox" name="fuzz" class="bootstrap-switch" data-on-label="ON" data-off-label="OFF" />
		</span> 
			<i class="now-ui-icons travel_info  btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Fuzz displayed election results while voting is enabled" data-container="body" data-animation="true" data-delay="100"></i>
		<br><br><br>
		<b>Parties</b><br><br>
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				<input type="text" name="parties" hidden id="party">
                <ol id="party_list">
                </ol>
                <input id="new_party" type="text" placeholder="Party" class="form-control"  />
                <button onclick="add_party()" type="button" class="btn btn-primary btn-simple">Add Party</button>
            </div>
		</div>
		<br><br>
		<h6>Positions</h6><br>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Position</th>
					<th>Number</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="tbody">
			</tbody>
		</table>
		<input type="text" name="positions" hidden id="position">
		<button class="btn btn-primary">Save</button>
		<a href="index.php" class="btn btn-simple">Cancel</a>
	</form>
</div>
<script type="text/javascript">
var party_list = <?php echo json_encode($es["parties"]) ?> || [];
function display_party()
{
	var str = "";
	for(let i in party_list)
	{
		str+="<li><a href=\"#!\" onclick=\"remove_party("+i+")\"> <i class=\"now-ui-icons ui-1_simple-remove\"></i> </a>"+" "+party_list[i]+" </li>";
	}
	document.getElementById('party').value = JSON.stringify(party_list);
	document.getElementById('party_list').innerHTML = str;
}
function add_party()
{
	if(document.getElementById("new_party").value=="") return;
	party_list.push(document.getElementById("new_party").value);
	document.getElementById("new_party").value="";
	display_party();
}
function remove_party(i)
{
	party_list.splice(i,1);
	display_party();
}

display_party();


var positions = <?php echo json_encode($es["positions"]) ?> || [];

function display_position()
{
	var str = "";
	for(let i in positions)
	{
		var o = positions[i];
		str+="<tr>";
		str+="<td>"+(i*1+1)+"</td>";
		str+="<td>"+o.name+"</td>";
		str+="<td>"+o.count+"</td>";
		str+="<td><a href=\"#!\" onclick=\"remove_position("+i+")\">Delete</a></td>";
		str+="</tr>";
	}

	str+="<tr>";
	str+="	<td>";
	str+= positions.length+1;
	str+="	</td>";
	str+="	<td>";
   	str+="		<input id='new_postition' type=\"text\" placeholder=\"Position\" class=\"form-control\"  />";
	str+="	</td>";
	str+="	<td>";
	str+="		<input id='new_postition_count' type=\"number\" placeholder=\"Number\" class=\"form-control\"  />";
	str+="	</td>";
	str+="	<td>";
	str+="		<button onclick='add_position()' type=\"button\" class=\"btn btn-simple btn-primary\">Add new</button>";
	str+="	</td>";
	str+="</tr>";
	document.getElementById("tbody").innerHTML = str;
	document.getElementById("position").value = JSON.stringify(positions);
}

function add_position()
{
	var pos = document.getElementById("new_postition").value;
	var count = document.getElementById("new_postition_count").value;

	if(count<1 || pos=="") return;
	var a = {name:pos,count:count};

	document.getElementById("new_postition").value = "";
	document.getElementById("new_postition_count").value = "";

	positions.push(a);
	display_position();
}

function remove_position(i)
{
	positions.splice(i,1);
	display_position();
}

display_position();
</script>