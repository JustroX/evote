<?php 
	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "election";

	$conn = mysqli_connect($host,$username,$password);
	mysqli_select_db($conn,$db);
 ?>