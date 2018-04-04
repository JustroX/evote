<?php 
	include("conn.php");
	
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
<br><br>
<div class="section">
	<?php 
	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);
?>

<div class="container">
	<a href="index.php">Home</a> > Candidates <br><br>
	<h1>Candidates</h1>
	<p>View all Candidates</p>
	<table class="table">
		<thead>
			<tr>
				<th>Position</th>
				<?php foreach ($es["parties"] as $party) 
				{
				?>
				<th><?php echo $party ?></th>
				<?php
				} ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($es["positions"] as $key)
			{
			?>
			<tr>
				<th><?php echo $key["name"] ?></th>
				<?php 
					foreach ($es["parties"] as $party)
					{
						?>
						<td>
							<?php 
								$cand = mysqli_query($conn,"SELECT `user` FROM `candidate` WHERE `party`='$party' AND `position`='$key[name]'");
								while($row = mysqli_fetch_assoc($cand)){
									$u = $row["user"];
									$label = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `user` WHERE `id`='$u'"))["name"];
								?>
								<a href='index.php?mode=election&action=view&id=<?php echo $u ?>'><?php echo $label ?></a><br>
								<?php
								}
							 ?>	
						</td>
						<?php
					}
				 ?>
			</tr>
			<?php
			} ?>
		</tbody>
	</table>
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