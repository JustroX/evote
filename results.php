<?php 
	include("conn.php");
	// get priveledges

	

	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);

	$VOTING_ENABLED = $es["voting"];
	$VOTING_FUZZED = $es["fuzz"];

	//the great sql
	$sql = "SELECT user.name,candidate.party,candidate.id,vote.id,COUNT(vote.candidate) AS vote_count FROM user,candidate,vote WHERE user.id = candidate.user AND candidate.id=vote.candidate GROUP BY user.name ORDER BY vote_count";
	//$sql = "SELECT `user`.`name`,`candidate`.`user`,`vote`.`candidate`,COUNT(`vote`.`candidate`) AS `votes` FROM `vote`,`candidate`,`user` WHERE `user`.`id`=`candidate`.`user` AND `candidate`.`user`=`vote`.`candidate` GROUP BY `user`.`name` ORDER BY `votes`";
	$res = mysqli_query($conn,$sql);
	echo mysqli_error($conn);
	$arr=[];
	while($v=mysqli_fetch_assoc($res))
	{	
		$v["vote_count"] += ($VOTING_FUZZED)? $v["vote_count"]*(rand(0,0.2)-0.1) : 0; 
		$v["vote_count"] = round($v["vote_count"]);
		$arr[$v["name"]] = $v;
	};

	echo json_encode($arr);
	
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
<div class="section"></div>
<div class="section">
	<div class="container text-center">
		<i style="font-size: 45pt" class="now-ui-icons sport_trophy"></i>
		<?php if($VOTING_ENABLED): ?>
		<h2>Partial Results</h2>
		<?php else: ?>
		<h2>Official Tally</h2>
		<?php endif; ?>
		<?php if($VOTING_FUZZED and $VOTING_ENABLED): ?>
        <div class="alert alert-warning" role="alert">
            <div class="container">
                <div class="alert-icon">
                    <i class="now-ui-icons ui-1_bell-53"></i>
                </div>
                <strong>Note: </strong> Displayed partial results are being fuzzed by about 20% to make room for some thrill and excitement. <br>
                						Expect some difference betweeen the sum of votes and the total votes. 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                    </span>
                </button>
            </div>
        </div>
	    <?php endif; ?>
		<!-- <div class="row">
			<div class="col-sm-4">
				<h4>Total Votes</h4>
				<h2>23</h2>
			</div>
			<div class="col-sm-4">
				<h4>Percentage</h4>
				<h2>23</h2>
			</div>
			<div class="col-sm-4">
				<h4>Voters left</h4>
				<h2>23</h2>
			</div>
		</div> -->
		<!-- <br><br> -->
		<i class="text-muted">
			As of 
            <script>
                document.write(new Date().toString())
            </script>
        </i><br>
        <br><br><br><br><br><br>
		<i style="font-size: 45pt" class="text-muted now-ui-icons arrows-1_minimal-down"></i>
        <br><br><br><br><br><br><br>
		<br><br><br><br>
				<?php 

				function cmp($a,$b)
				{
					global $arr;
					$av  = (isset($arr[$a["name"]]) )? $arr[$a["name"]]["vote_count"]:0;
					$bv  = (isset($arr[$b["name"]]) )? $arr[$b["name"]]["vote_count"]:0;
				    if ($av == $bv) {
				        return 0;
				    }
				    return ($av > $bv) ? -1 : 1;
				}


				foreach ($es["positions"] as $pos) {
				?>
				<h2 class="">
					<?php echo $pos["name"] ?>
				</h2>
				<br><br>
				<table class="table table-hover ">
				<thead>
					<tr>
						<th>#</th>
						<th>Candidate</th>
						<th>Party</th>
						<th>Votes</th>
					</tr>
				</thead>
				<tbody>
					

				<?php 
				$cand = mysqli_query($conn,"SELECT user.name,candidate.party,candidate.user  from candidate,user WHERE candidate.user = user.id AND candidate.position = '".strtolower($pos["name"])."' ");
				$pos_count = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(vote.candidate) AS count FROM `vote`,`candidate` WHERE vote.candidate=candidate.id AND candidate.position='".strtolower($pos["name"])."' "));

				$cs = [];
				while ( $a = mysqli_fetch_assoc($cand) ) {
					array_push($cs, $a);
				}
				usort($cs, "cmp");
				$color = 0;
				foreach ($cs as $c) {
				?>

				<tr>
					<td><?php echo $color+1; ?> </td>
					
					<td style="width: 30%">
						<p>
						<img style="width: 16%" src="candidate/fetchimage.php?candidate=<?php echo $c["user"] ?>" class="rounded-circle"> 
						&nbsp&nbsp&nbsp&nbsp
						<?php echo $c["name"] ?>	
						</p>
					</td>
					<td style="width: 10%"><?php echo ucwords($c["party"]) ?></td>
					<td style="width: 60%">
						
						<div class="progress">

						  <div class="progress-bar <?php echo($color<$pos["count"])?"bg-primary":""; ?> progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php if(isset($arr[$c["name"]])) echo $arr[$c["name"]]["vote_count"]/$pos_count["count"]*100; else echo "0";  ?>%">
						    <span ><?php echo $arr[$c["name"]]["vote_count"] ?> </span>
						  </div>
						</div>
									    
					</td>
				</tr>
				<?php $color++; ?>

				<?php
				} ?>

			</tbody>
		</table>
		<br><br><br><br>

				<?php
				} ?>
				

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