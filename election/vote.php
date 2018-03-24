<?php 
	
	$json = file_get_contents('settings.json');
	$es = json_decode($json,true);

 ?>
 <div class="container">
	<a href="index.php">Home</a> > Vote <br><br>
	<br>
	<p class="alert-primary alert">
		INSTRUCTIONS: Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat.
	</p>
	<br>

    <?php 

        $candidates = [];

     ?>


    <?php 
        $pos_ctr =0;
        foreach ($es["positions"] as $p)
        {
            array_push($candidates,[]); 
    ?>
    <h5><?php echo $p["name"] ?></h5>
    
    <?php if($p["count"]==1): ?>
    <p>Please vote only once</p>
    <?php else: ?>
    <p>Please vote no more than <?php echo $p["count"] ?> times.</p>
    <?php endif; ?>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Candidate</th>
                    <th>Party</th>          
                </tr>
            </thead>
            <tbody>
                <?php 
                    $res = mysqli_query($conn,"SELECT `user`.`name`,`candidate`.`party`,`candidate`.`id` FROM `candidate` JOIN `user` ON `candidate`.`user`=`user`.`id` WHERE `candidate`.`position`='$p[name]' ORDER BY RAND()");
                    $ctr = 0;
                    while($obj = mysqli_fetch_assoc($res))
                    {
                        array_push($candidates[$pos_ctr], $obj["id"]);
                 ?>
                <tr>
                    <td><?php echo ++$ctr; ?></td>
                    <td>
                        <div class="checkbox">
                            <input id="checkbox_<?php echo $ctr.$p["name"] ?>" type="checkbox">
                            <label for="checkbox_<?php echo $ctr.$p["name"] ?>">
                                <?php echo $obj["name"]; ?>
                            </label>
                        </div>
                    </td>
                    <td><?php echo $obj["party"]; ?></td>
                </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>
    <hr>
    <br><br>
    <?php  
    $pos_ctr++;
    } ?>



 	<div class="container text-center">

	 	<button class="btn btn-primary btn-lg">Submit Vote</button>
 	</div>

    <script type="text/javascript">
        var candidates = <?php echo json_encode($candidates) ?>;
    </script>










 </div>