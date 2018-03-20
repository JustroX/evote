<br><br>
<div class="container">
	<h1>Election Settings</h1>
	<br><br>
	<form onkeypress="return event.keyCode != 13;">
		<span>
			<b style="font-size: 15pt">Voting is enabled?</b> &nbsp&nbsp
			<input type="checkbox" name="checkbox" class="bootstrap-switch" data-on-label="ON" data-off-label="OFF" />
		</span> <br><br>
		<span>
			<i class="now-ui-icons travel_info  btn-tooltip" data-toggle="tooltip" data-placement="bottom" title="Fuzz displayed election results while voting is enabled" data-container="body" data-animation="true" data-delay="100"></i>&nbsp&nbsp<b style="font-size: 15pt">Fuzziness?  </b>&nbsp&nbsp
			<input type="checkbox" name="checkbox" class="bootstrap-switch" data-on-label="ON" data-off-label="OFF" />
		</span> <br>
		<br><br>
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				<input type="text" name="parties" hidden id="party">
                <h6>Parties</h6>
                <ol id="party_list">
                </ol>
                <input id="new_party" type="text" placeholder="Party" class="form-control"  />
                <button onclick="add_party()" type="button" class="btn btn-primary btn-round">Add Party</button>
            </div>
		</div>
	</form>
</div>
<script type="text/javascript">
var party_list = [];
function display_party()
{
	var str = "";
	for(let i in party_list)
	{
		str+="<li><a href=\"#!\" onclick=\"remove_party("+i+")\"> <i class=\"now-ui-icons ui-1_simple-remove\"></i> </a>"+" "+party_list[i]+" </li>";
	}
	document.getElementById('party').innerHTML += JSON.stringify(party_list);
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
</script>