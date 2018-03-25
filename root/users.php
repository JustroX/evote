<?php 

	$sections = 
	[
		"7" => ["Diamond","Emerald","Sapphire"],
		"8" => ["Ilang-Ilang","Rosal","Sampaguita"],
		"9" => ["Beryllium","Silicon","Platinum"],
		"10" => ["Electron","Photon","Graviton"],
		"11" => ["Biology11","Chemistry11","Physics11"],
		"12" => ["Biology12","Chemistry12","Physics12"],
		"Etc" => ["Faculty"],
	];

	if(isset($_GET["grade"]) && isset($_GET["section"]))
	{
		$section  = $_GET["section"];
		$users_rows = mysqli_query($conn,"SELECT * FROM `user` WHERE `section`='$section' ORDER BY `name` ");
	}

	if(isset($_GET["sub"]))
	{
		if($_GET["sub"]=="edit")
			include("users_edit.php");
		else
		if($_GET["sub"]=="add")
			include("users_add.php");
		else
		if($_GET["sub"]=="delete" && $_GET["submit"]==1)
		{
			mysqli_query($conn,"DELETE FROM `user` WHERE `id`=$_GET[user]");
			header("LOCATION: index.php?mode=root&action=users&grade=".$_GET["grade"]."&section=".$_GET["section"]);
		}
	}
	else
	{
 ?>



<div class="container">
	<br>
	<a href="index.php">Home</a> > Users <br><br>
	<h1>User Lists</h1>




	<span class="dropdown">
	    <a href="#!" class="btn btn-simple dropdown-toggle" data-toggle="dropdown" id="navbarDropdownMenuLink1">
	    	<?php if(isset($_GET["grade"])): ?>
	    		<?php if($_GET["grade"]=="etc"): ?>
	    			Etc
	    		<?php else: ?>
	    			Grade <?php echo $_GET["grade"] ?>
	    		<?php endif;?>
	    	<?php else: ?>
	    		Grade -
	    	<?php endif; ?>
	    </a>
	    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
	        <a class="dropdown-item" href="index.php?mode=root&action=users&grade=7">7</a>
	        <a class="dropdown-item" href="index.php?mode=root&action=users&grade=8">8</a>
	        <a class="dropdown-item" href="index.php?mode=root&action=users&grade=9">9</a>
	        <a class="dropdown-item" href="index.php?mode=root&action=users&grade=10">10</a>
	        <a class="dropdown-item" href="index.php?mode=root&action=users&grade=11">11</a>
	        <a class="dropdown-item" href="index.php?mode=root&action=users&grade=12">12</a>
	        <a class="dropdown-item" href="index.php?mode=root&action=users&grade=etc">Etc</a>
	    </ul>
	</span>
	<span class="dropdown">
	    <a href="#!" class="btn btn-simple dropdown-toggle0 <?php if(!isset($_GET["grade"])) echo "disabled"; ?>" data-toggle="dropdown" id="navbarDropdownMenuLink2">
	    	<?php if(isset($_GET["section"])):?>
	    		<?php echo $_GET["section"]; ?>
	    	<?php else: ?>
	    		---
	    	<?php endif;?>
	    </a>
	    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
			<?php 
	    		if(isset($_GET["grade"]) && isset($sections[$_GET["grade"]]))
	    		{
	    			foreach ($sections[$_GET["grade"]] as $sec)
	    			{
	    	?>
	        	<a class="dropdown-item" href="index.php?mode=root&action=users&<?php echo "grade=".$_GET["grade"]."&section=".$sec ?>"><?php echo $sec; ?></a>	
	    	<?php
	    			}
	    		}
	    	 ?>
	    </ul>
	</span>
	<a href="index.php?mode=root&action=users&sub=add" class="btn btn-simple">
		Add users
	</a>
	<br><br>
	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Username</th>
				<th>Section</th>
				<th>Priveledges</th>
				<th>Voted</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if(isset($_GET["grade"]) && isset($_GET["section"]))
				{
					$ctr = 0;
					while($row = mysqli_fetch_assoc($users_rows))
					{
			 ?>
				<tr>
					<td><?php echo ++$ctr; ?></td>
					<td><?php echo $row["name"] ?></td>
					<td><?php echo $row["username"] ?></td>
					<td><?php echo $row["section"] ?></td>
					<td><?php echo $row["priv"] ?></td>
					<td><?php echo ($row["voted"])?"True":"False"; ?></td>
					<td>
						<a href="index.php?mode=root&action=users&grade=<?php echo $_GET["grade"] ?>&sub=edit&user=<?php echo $row["id"] ?>">Edit</a>&nbsp
						<a href="#!"  data-toggle="modal" data-target="#myModal" onclick="update(<?php echo "[".$row["id"].",'".$row["name"]."']" ?>)">Delete</a>
					</td>
				</tr>
			<?php   }
				}
				else
				{
			?>
				<tr>
					<td colspan="7">
						<div class="text-center">
							<br><br><br>
								<h5>Please select Grade and Section</h5>
						</div>
					</td>
				</tr>
			<?php 
				};
			 ?>
		</tbody>
	</table>
</div>



<!-- Modal Core -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Delete User?</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete <b id="modal-body-p" ></b>?
      </div>
      <div class="modal-footer" id="modal-submit">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function update(arr)
{
	document.getElementById('modal-body-p').innerHTML = arr[1];
	var str = "";
	str+="<button type=\"button\" class=\"btn btn-default btn-simple\" data-dismiss=\"modal\">No</button>";
    str+="<a href=\"index.php?mode=root&action=users&grade=<?php echo $_GET["grade"] ?>&sub=delete&user="+arr[0]+"&submit=1&section=<?php echo $_GET["section"] ?>\" class=\"btn btn-info btn-simple\">Yes</a> ";
	document.getElementById('modal-submit').innerHTML = str;
}
</script>
<?php }; ?>