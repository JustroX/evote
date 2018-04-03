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

<!-- TODO: DESIGN AND CAPITALIZATION -->
