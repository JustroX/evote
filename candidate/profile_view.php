<?php 
	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);
    $a = $user['id'];

	if(isset($_GET["submit"])){
        //if wala pa

        if(mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS count FROM `candidate` WHERE `user` = $a"))["count"]==0)
        {
            echo mysqli_error($conn);
            mysqli_query($conn,"INSERT INTO `candidate` (`user`) VALUES ($a)");
            echo mysqli_error($conn);
        }


		$USER=$user['id'];
		$name= addslashes($user['name']);
		$position=ucwords($_POST['position']);
		$details=addslashes($_POST['details']);
		$party=$_POST['party'];

        $str = "";

        if($_FILES["profpic"]['tmp_name']!="")
        {
            $imagename=$_FILES["profpic"]["name"]; 
            $imagetmp=addslashes (file_get_contents($_FILES['profpic']['tmp_name']));
    		mysqli_query($conn,"UPDATE `candidate` SET user='$USER',position='$position',details='$details',party='$party',imagename='$imagename',image='$imagetmp' WHERE `user`='$a'");
            echo mysqli_error($conn);
        }
        else
        {
            mysqli_query($conn,"UPDATE `candidate` SET user='$USER',position='$position',details='$details',party='$party' WHERE `user`='$a'");
            echo mysqli_error($conn);   
        }           

       
	}

    $temp = mysqli_query($conn,"SELECT * FROM `candidate` WHERE `user`='$a'");
    $temp = mysqli_fetch_assoc($temp);
?>

<br><br>
<div class="container">
	<a href="index.php">Home</a> > Profile <br><br>
	<h1>Your Profile</h1>
    <p>
        This information will be visible to your voters.
    </p>
        <br>
        <h4>Profile Picture</h4>
        <img src="candidate/fetchimage.php?candidate=<?php echo $a ?>" width=100 height=100 >
        <br><br><br>
        <table class="table">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td><?php echo $user['name'] ?></td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td><?php echo ucwords($temp['position'])?></td>
                </tr>
                <tr>
                    <th>Party</th>
                    <td><?php echo ucwords($temp['party'])?></td>
                </tr>
            </tbody>
        </table>
        <blockquote>
            <h4>Bio</h4>
            <p class="blockquote blockquote-primary">
                " <?php echo $temp['details']?>"
            </p>
        </blockquote>
        <a href="index.php?mode=candidate&action=profile_edit" class="btn btn-primary">Edit</a>
</div>