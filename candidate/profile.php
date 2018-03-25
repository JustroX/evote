<?php 
	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);

	if(isset($_GET["submit"])){
		$USER=$user['id'];
		$name=addslashes($user['name']);
		$position=$_POST['position'];
		$details=addslashes($_POST['details']);
		$party=$_POST['party'];
		mysqli_query($conn,"INSERT INTO `candidate` (user,name,position,details,party) VALUES ('$USER','$name','$position','$details','$party') ");
	}
?>

<br><br>
<div class="container">
	<a href="index.php">Home</a> > Profile <br><br>
	<h1>Edit Profile</h1>
	<br>
    <form method="post" action="index.php?mode=candidate&action=profile&submit=1">
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6 for="sel1">Position</h6>
                <select name="position" class="form-control" id="sel1" required>
                    
                    <?php 
                    $ctr=0;
                    foreach ($es["positions"] as $s){?>
                    <option value="<?php echo $ctr++ ?>"><?php echo $s["name"] ?></option>
                    <?php   } ?>

                </select>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6 for="sel2">Party</h6>
                <select name="party" class="form-control" id="sel2" required>
                    
                    <?php foreach ($es["parties"] as $s){?>
                    <option value="<?php echo strtolower($s) ?>"><?php echo $s ?></option>
                    <?php   } ?>

                </select>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6>Bio</h6>
                <textarea name="details" class="form-control" placeholder="Input short bio here" rows="5" required></textarea>
            </div>
        </div>
        <br>
        <button class="btn btn-primary">Save</button>
        <a href="index.php?mode=root&action=users" class="btn btn-simple">Cancel</a>
    </form>
</div>