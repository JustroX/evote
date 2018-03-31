<?php 
	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);
    $a = $user['id'];

	if(isset($_GET["submit"])){
		$USER=$user['id'];
		$name=addslashes($user['name']);
		$position=$_POST['position'];
		$details=addslashes($_POST['details']);
		$party=$_POST['party'];
		mysqli_query($conn,"UPDATE `candidate` SET user='$USER',position='$position',details='$details',party='$party' WHERE `user`='$a'");
        echo mysqli_error($conn);
	}

    $temp = mysqli_query($conn,"SELECT * FROM `candidate` WHERE `user`='$a'");
    $temp = mysqli_fetch_assoc($temp);
?>

<br><br>
<div class="container">
	<a href="index.php">Home</a> > Profile <br><br>
	<h1>Your Profile</h1>
	<br>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6 for="sel1">Position</h6>
                <?php echo $temp['position']?>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6 for="sel2">Party</h6>
                <?php echo $temp['party']?>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6>Bio</h6>
                <?php echo $temp['details']?>
            </div>
        </div>
        <br>
        <a href="index.php?mode=candidate&action=profile_edit" class="btn btn-primary">Edit</a>
</div>