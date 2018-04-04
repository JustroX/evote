<?php 
	if(isset($_POST["honeypot"]) && $_POST["honeypot"]=="faoihfoigrgboibroihuqwehqwuib123245" )
	{
		   // 1. Remove all votes from the database <br>
         // 2. Clear all candidates <br>
         // 3. Reset all voter's voting status <br>
		include("../conn.php");
		mysqli_query($conn,"DELETE FROM vote");
		echo mysqli_error($conn);
		mysqli_query($conn,"DELETE FROM candidate ");
		echo mysqli_error($conn);
		mysqli_query($conn,"UPDATE `user` SET `voted` = 0");
echo mysqli_error($conn);


		echo mysqli_error($conn);
		header("location: ../index.php?mode=root&action=settings");
	}
	else
	die("Forbidden");
 ?>