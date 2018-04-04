
<?php if(isset($_GET["closed"])): ?>

<div class="container text-center">
<?php if($VOTING_ENABLED)
		{
			header("LOCATION: index.php?mode=election&action=vote");
		}
 ?>
	<br><br><br><br>
	<h2>Voting is closed.</h2>
	<p>The election has been closed. If you are encountering problems please consider contacting the website administrators. Thank you.</p>
	<a href="index.php">Go Back</a>
</div>


<?php else: ?>

<div class="container text-center">
	<br><br><br><br>
	<h2>You can only vote once.</h2>
	<p>You can not vote at this time. If you are encountering problems please consider contacting the website administrators. Thank you.</p>
	<a href="index.php">Go Back</a>
</div>

<?php endif; ?>