<?php 
	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);
    $a = $user['id'];
    $temp = mysqli_query($conn,"SELECT * FROM `candidate` WHERE `user`='$a'");
    $temp = mysqli_fetch_assoc($temp);

?>

<br><br>
<div class="container">
	<a href="index.php">Home</a> > <a href="index.php?mode=candidate&action=profile_view">Profile</a> > Edit<br><br>
	<h1>Edit Profile</h1>
	<br>
    <form method="post" action="index.php?mode=candidate&action=profile_view&submit=1">
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6 for="sel1">Position</h6>
                <select name="position" class="form-control" id="sel1" required>
                    
                    <?php
                    foreach ($es["positions"] as $s){?>
                    <option value="<?php echo strtolower($s['name'])?>" <?php if ($temp['position']==strtolower($s['name'])) echo ' selected' ?>><?php echo $s["name"] ?></option>
                    <?php   } ?>

                </select>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6 for="sel2">Party</h6>
                <select name="party" class="form-control" id="sel2" required>
                    
                    <?php foreach ($es["parties"] as $s){?>
                    <option value="<?php echo strtolower($s) ?>" <?php if ($temp['party']==strtolower($s)) echo ' selected' ?>><?php echo $s ?></option>
                    <?php   } ?>

                </select>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6>Bio</h6>
                <textarea name="details" class="form-control" placeholder="Input short bio here" rows="5" required><?php echo $temp['details'] ?></textarea>
            </div>
        </div>
        <br>
        <button class="btn btn-primary">Save</button>
        <a href="index.php?mode=candidate&action=profile_view" class="btn btn-simple">Cancel</a>
    </form>
</div>