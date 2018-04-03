<?php 
	include("../conn.php");
	if(isset($_GET["candidate"]))
	{
		header("content-type:image/jpeg");
		$res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `image`,`imagename` FROM `candidate` WHERE `user`=$_GET[candidate]"));
		if($res["imagename"]=="")
			header("LOCATION: default.png");
		else
		{
			$image_name =	$res["imagename"];
			$image_content =$res["image"];
			echo $image_content;
		}
	}
	else
	die("forbidden");

 ?>