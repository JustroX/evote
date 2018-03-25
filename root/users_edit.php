<?php 

    if(isset($_GET["submit"]) && isset($_POST["name"]))
    {
        $fullname = addslashes($_POST["name"]);
        $username = addslashes($_POST["uname"]);
        $pword = hash("sha256",addslashes($_POST["pword"]));
        $section = $_POST["section"];
        $voted = (isset($_POST["voted"]))?1:0;
        $priv1 = implode(",", $_POST["priv"]);

        if($voted == 0)
            mysqli_query($conn,"DELETE FROM `vote` WHERE `user`=$_GET[user]");

        if($_POST["pword"] == "")
            mysqli_query($conn,"UPDATE `user` SET `name`='$fullname' , `username`='$username' , `section`='$section' , `priv`='$priv1' , `voted` = '$voted' WHERE `id`=$_GET[user]");
        else
            mysqli_query($conn,"UPDATE `user` SET `password`='$pword',`name`='$fullname' , `username`='$username' , `section`='$section' , `priv`='$priv1' , `voted` = '$voted' WHERE `id`=$_GET[user]");
    }




	$page_user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `user` WHERE `id`=$_GET[user]"));
	$sections = ["Diamond","Emerald","Saphire","Ilang-Ilang","Rosal","Sampaguita","Beryllium","Platinum","Silicon","Electron","Graviton","Photon","Biology11","Chemistry11","Physics11","Biology12","Chemistry12","Physics12","faculty"];

?>
<div class="container">
	<br>
	<a href="index.php">Home</a> > <a href="index.php?mode=root&action=users&grade=<?php echo $_GET["user"] ?>&section=<?php echo $page_user["section"] ?>">Users</a> > Edit <br><br>
	<h1>Edit User Details</h1>
	<br>
	<form method="post" action="index.php?mode=root&action=users&grade=<?php echo $page_user["section"] ?>&sub=edit&user=<?php echo $_GET["user"] ?>&submit=1">
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
            	<h6>Fullname</h6>
                <input name="name" type="text" placeholder="Name" class="form-control" value="<?php echo $page_user["name"] ?>" required />
            </div>
        </div>	
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
            	<h6>Username</h6>
                <input name="uname" type="text" placeholder="Username" class="form-control" value="<?php echo $page_user["username"] ?>" required />
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
            	<h6>Change Password</h6>
                <input name="pword" type="password" class="form-control" value="" />
            </div>
        </div>
        <br>
        <div class="col-sm-6 col-lg-3">
	        <div class="form-group">
			  	<h6 for="sel1">Section</h6>
			 	<select name="section" class="form-control" id="sel1" required>
			    	
			    	<?php foreach ($sections as $s){?>
				    <option <?php echo (strtolower($s)==$page_user["section"])?"selected":""; ?> value="<?php echo strtolower($s) ?>"><?php echo $s ?></option>
			    	<?php 	} ?>

				</select>
			</div>
        </div>
        <br><br>
        <h6>Already Voted</h6>
        <div class="checkbox">
            <input name="voted" <?php echo ($page_user["voted"]==1)?"checked":""; ?> id="checkbox0" type="checkbox">
            <label for="checkbox0">
                VOTED
            </label>
        </div>


        <br><br>
		<h6>Priveledges</h6>

        <?php
            $page_priv = array_map("trim", explode(",",$page_user["priv"]));
          ?>

        <div class="checkbox">
            <input name="priv[]"  value="ROOT" <?php echo (in_array("ROOT",$page_priv))?"checked":""; ?> id="checkbox1" type="checkbox">
            <label for="checkbox1">
                ROOT - GIVE ROOT PRIVILEDGES
            </label>
        </div>
        <div class="checkbox">
            <input name="priv[]"  value="CANDIDATE" <?php echo (in_array("CANDIDATE",$page_priv))?"checked":""; ?> id="checkbox2" type="checkbox">
            <label for="checkbox2">
                CANDIDATE - SET USER AS A CANDIDATE
            </label>
        </div>
        <div class="checkbox">
            <input name="priv[]" value="VOTE"  <?php echo (in_array("VOTE",$page_priv))?"checked":""; ?> id="checkbox3" type="checkbox">
            <label for="checkbox3">
                VOTE - GIVE SUFFRAGE
            </label>
        </div>
        <br>
        <button class="btn btn-primary">Save</button>
        <a href="index.php?mode=root&action=users&grade=<?php echo $_GET["user"] ?>&section=<?php echo $page_user["section"] ?>" class="btn btn-simple">Cancel</a>
	</form>
</div>