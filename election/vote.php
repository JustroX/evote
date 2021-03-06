<?php 
    $json = file_get_contents('settings.json');
    $es = json_decode($json,true);
    echo $VOTING_ENABLED;
    if(!$VOTING_ENABLED)
    {
        header("LOCATION: index.php?mode=election&action=failed&closed=1");
        die();
    }
    else
    if(mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `user` WHERE `id`=$_COOKIE[id]"))["voted"]==1)
       header("LOCATION: index.php?mode=election&action=failed"); 

    if(isset($_POST["submit"]) )
    {
        if(mysqli_fetch_assoc(mysqli_query($conn,"SELECT `voted` FROM `user` WHERE `id`=$_COOKIE[id]"))["voted"]==1)
            die("You already voted. You are not allowed to vote again.");
        if(isset($_POST["results"]))
        {
            $results = $_POST["results"];
            
            ///security check
            foreach ($es["positions"] as $p) 
            {
                if(sizeof($results[$p["name"]]) > $p["count"])
                    die("The integrity of your submission has failed. Your vote is not counted.");
            }


            $str = ""; 
            foreach ($results as $pos)
            {
                foreach ($pos as $cnd) 
                {
                    $str .= "INSERT INTO `vote` (`user`,`candidate`) VALUES ($_COOKIE[id],$cnd) ;"; 
                }
            }
            $str.="UPDATE `user` SET `voted`=1 WHERE `id`=$_COOKIE[id]";
            mysqli_multi_query($conn,$str);
            echo mysqli_error($conn);   
        }
       header("LOCATION: index.php?mode=election&action=success");
    }
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

    <form action="index.php?mode=election&action=vote" method="post">
        
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
                            <input name="results[<?php echo "$p[name]" ?>][]" value="<?php echo $obj["id"]; ?>" onchange="sanitize(<?php echo $pos_ctr.",".$ctr; ?>)" id="checkbox_<?php echo $pos_ctr."_".$ctr ?>" type="checkbox">
                            <label for="checkbox_<?php echo $pos_ctr."_".$ctr ?>">
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

    <input type="text" hidden name="submit" value="1">
        <!-- Modal Core -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Reminder</h4>
              </div>
              <div class="modal-body">
                    Please review your votes before submitting. Once you submitted you can no longer change your vote.
                    <br><br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info btn-simple">Vote</button>
              </div>
            </div>
          </div>
        </div>
                
    <div class="container text-center">

        <button type="button" class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#myModal">Submit Vote</button>
    </div>
    </form>

    <script type="text/javascript">
        var positions  = <?php echo json_encode($es["positions"]) ?>;
        var candidates = <?php echo json_encode($candidates) ?>;
        var value_queue = [];
        function init()
        {
            for(let i in positions)
            {
                value_queue.push([]);
            }
        }
        function sanitize(p,i)
        {
            if(value_queue[p].indexOf(i)==-1)
            {
                value_queue[p].push(i);
                if(value_queue[p].length > positions[p].count)
                {
                    var q = value_queue[p].shift();
                    document.getElementById('checkbox_'+p+'_'+q).checked = false;
                }
            }
            else
            {   
                value_queue[p].splice(value_queue[p].indexOf(i),1);   
            }
            console.log(JSON.stringify(value_queue[p]));
        }
        init();
    </script>










 </div>