<?php 
	
	$host = "localhost";
	$username = "root";
	$password = "";
	$db = "clearance";

	$conn = mysqli_connect($host,$username,$password);
	mysqli_select_db($conn,$db);


	function fetch($res)
	{
		global $conn;
		$arr = [];
		while($row = mysqli_fetch_assoc($res))
		{
			array_push($arr, $row);
		}
		return $arr;
	};

	$users = fetch(mysqli_query($conn,"SELECT * FROM user"))	;
	mysqli_close($conn);

	$db = "election";

	$conn = mysqli_connect($host,$username,$password);
	mysqli_select_db($conn,$db);

	foreach ($users as $user) 
	{
		$username = $user["username"];
		$name = $user["fullname"];
		$section = $user["section"];
		$priv =	"VOTE";
		$voted = 0;
		$password = hash("sha256",addslashes($user["password"]));
		mysqli_query($conn,"INSERT INTO user (username,password,name,section,priv,voted) VALUES ('$username','$password','$name','$section','$priv','$voted')");
		echo mysqli_error($conn);

	}
	echo "DONE";
 ?>