<?php 
$cand = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `candidate` WHERE `user`=$_GET[id]"));
?>

<div class="container">
	<h1><?php echo mysqli_fetch_assoc(mysqli_query($conn,"SELECT `name` FROM `user` WHERE `id`=$_GET[id]"))["name"] ?></h1>
	<br>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6 for="sel1">Position</h6>
                <?php echo $cand['position']?>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6 for="sel2">Party</h6>
                <?php echo $cand['party']?>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6>Bio</h6>
                <?php echo $cand['details']?>
            </div>
        </div>
</div>

<!-- todo: picture, vote count, back button -->