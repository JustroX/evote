<?php 
	include("conn.php");
	// get priveledges
	if(!isset($_COOKIE["id"]))
		header("LOCATION: login.php");
	$user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `user` WHERE `id`=$_COOKIE[id]"));
	$priv = array_map("trim", explode(",", $user["priv"]));


	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);

	$VOTING_ENABLED = $es["voting"];
	$VOTING_FUZZED = $es["fuzz"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<?php include("includes.php") ?>
</head>
<body class="sidebar-collapse">
<?php include("navbar.php") ?>
<div class="section"></div>
<div class="section">
	<div class="container">
		<h2>About Us</h2>
		<p>
			Philippine Science High School - Bicol Region Campus <br>
			Tagontong, Goa, Camarines Sur <br>
			Goa, Bicol Region 4422 <br>
			Philippines <br>
		</p>

		<h4>	Chryz Than Wolf G. Chavez	</h4>
		<ul>
			<li>ctgchavez@brc.pshs.edu.ph</li>
		</ul>
		
		<h4>	Justine Che T. Romero	</h4>
		<ul>
			<li>jctromero@brc.pshs.edu.ph</li>
		</ul>
	</div>
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
            Justine Che T. Romero & Chryz Than Wolf G. Chavez
        </div>
    </div>
</footer>
<?php include("core-js-includes.php") ?>
</body>
</html>