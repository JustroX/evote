<?php 
	include("conn.php");
	// get priveledges
	if(!isset($_COOKIE["id"]))
		header("LOCATION: login.php");
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
	<?php 
	if(isset($_GET["mode"]) && isset($_GET["action"])): 
		?>


	<?php 
		
		if($_GET["mode"]=="root" && in_array("ROOT", $priv))
		{
			if($_GET["action"]=="users")
				include("root/users.php");
			if($_GET["action"]=="settings")
				include("root/settings.php");
		}
		else
		if($_GET["mode"]=="candidate" && in_array("CANDIDATE", $priv))
		{
			if($_GET["action"]=="profile_view")
				include("candidate/profile_view.php");
			if($_GET["action"]=="profile_edit")
				include("candidate/profile_edit.php");

		}
		else
		if($_GET["mode"]=="election" && in_array("VOTE", $priv))
		{
			if($_GET["action"]=="vote")
				include("election/vote.php");
			if($_GET["action"]=="success")
				include("election/success.php");
			if($_GET["action"]=="failed")
				include("election/failed.php");
			if($_GET["action"]=="candidates")
				include("election/candidates.php");
			if($_GET["action"]=="view")
				include("election/view.php");
		}
		else
			$disp = true;
	 ?>

	 <?php 
	 	else:
	 		$disp = true;
	 	endif;
	  ?>

	<?php if(isset($disp)): ?>
	

		<div class="container">
			<br><br><br>
			<h1>PSHS Voting System</h1>
			<h7>You are logged in as <i><?php echo $user["name"]; ?></i></h7>
		</div>
		<div class="container">
			

			<?php if(in_array("ROOT", $priv)): ?>
			<h4>Root Operations</h4>
			<ul>
				<li><a href="index.php?mode=root&action=users">Users</a></li>
				<li><a href="index.php?mode=root&action=settings">Election Settings</a></li>
			</ul>	
			<?php endif;?>
		
			<?php if(in_array("CANDIDATE", $priv)): ?>
			<h4>Candidate Options</h4>
			<ul>
				<li><a href="index.php?mode=candidate&action=profile_view">View Profile</a></li>
			</ul>
			<?php endif;?>
		


			<?php if(in_array("VOTE", $priv)): ?>
			<h4>Election</h4>
			<ul>
				<li><a href="index.php?mode=election&action=vote">Vote</a></li>
				<li><a href="index.php?mode=election&action=candidates">Candidates</a></li>
				<li><a href="#!">Partial Results</a></li>
			</ul>		
			<?php endif;?>
		</div>
	<?php endif; ?>

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
            Justine Che T. Romero & Chryz Than Wolf G. Chavez
        </div>
    </div>
</footer>
<?php include("core-js-includes.php") ?>
</body>
</html>