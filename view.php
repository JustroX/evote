<?php 
	include("conn.php");
	// get priveledges
	$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `user` WHERE `id`=$_COOKIE[id]"));
	$priv = array_map("trim", explode(",", $user["priv"]));

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<?php include("includes.php") ?>
</head>
<body class="sidebar-collapse">
<?php include("navbar.php") ?>
<br><br>
<div class="section">
	<div class="container">
		<br><br><br>
		<h1>PSHS Voting System</h1>
		<h7>You are logged in as <i><?php echo $user["name"]; ?></i></h7>
	</div>
	<div class="container">
		<?php if(in_array("ROOT", $priv)): ?>
		<h4>Root Operations</h4>
		<ul>
			<li><a href="#!">Users</a></li>
			<li><a href="#!">Election Settings</a></li>
		</ul>	
		<?php endif;?>
	

		<h4>Candidate Options</h4>
		<ul>
			<li><a href="#!">Edit Profile</a></li>
		</ul>
	


		<h4>Election</h4>
		<ul>
			<li><a href="#!">Vote</a></li>
			<li><a href="#!">Candidates</a></li>
			<li><a href="#!">Partial Results</a></li>
		</ul>		
	</div>
</div>
<br><br>
<footer class="footer">
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="about.php">
                        About
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
            &nbsp
            Justine Che T. Romero
        </div>
    </div>
</footer>
<?php include("core-js-includes.php") ?>
</body>
</html>