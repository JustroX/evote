<?php 
	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);
?>

<div class="container">
	<?php 
	foreach ($es["parties"] as $party) {
		echo "<h1>" . $party . "</h1>";
		foreach ($es["positions"] as $key) {
			$pos = $key["name"];
			echo "<h3>" . $pos . "</h3><ul>";
			$cand = mysqli_query($conn,"SELECT `user` FROM `candidate` WHERE `party`='$party' AND `position`='$pos'");
			while($row = mysqli_fetch_assoc($cand)){
				$u = $row["user"];
				echo "<li><a href='index.php?mode=election&action=view&id=" . $u . "'>" . mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `user` WHERE `id`='$u'"))["name"] . "</a></li>";
			}
			echo "</ul>";
		}
	}
	?>
</div>

<!-- TODO: DESIGN AND CAPITALIZATION -->
