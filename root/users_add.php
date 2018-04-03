<?php 

    if(isset($_GET["submit"]) && isset($_POST["name"]))
    {
        $fullname = addslashes($_POST["name"]);
        $username = addslashes($_POST["uname"]);

        $res = mysqli_query($conn,"SELECT * FROM `user` WHERE `username`='$username'");
        if(mysqli_num_rows($res)>0)
            $error = "Username already exists";
        else
        {
            $pword = hash("sha256",addslashes($_POST["pword"]));
            $section = $_POST["section"];
            $voted = (isset($_POST["voted"]))?1:0;
            $priv = implode(",", $_POST["priv"]);

            mysqli_query($conn,"INSERT INTO `user` (name,username,password,section,voted,priv) VALUES ('$fullname','$username','$pword','$section','$voted','$priv') ");  
            
            if(in_array("CANDIDATE", $_POST["priv"]))
            {
                $last_id = $conn->insert_id;
                mysqli_query($conn,"INSERT INTO `candidate` (`user`) VALUES ($last_id)");    
            }

            $notif="User added successfully";
        }
    }
    $sections = ["Diamond","Emerald","Saphire","Ilang-Ilang","Rosal","Sampaguita","Beryllium","Platinum","Silicon","Electron","Graviton","Photon","Biology11","Chemistry11","Physics11","Biology12","Chemistry12","Physics12","faculty"];

?>
<div class="container">
    <br>
    <?php if(isset($notif)): ?>
        <div class="alert alert-success" role="alert">
            <div class="container"> 
               User successfully added.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                    </span>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <div class="container"> 
               Username already exist
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="now-ui-icons ui-1_simple-remove"></i>
                    </span>
                </button>
            </div>
        </div>
    <?php endif; ?>

    <a href="index.php">Home</a> > <a href="index.php?mode=root&action=users">Users</a> > Add <br><br>
    <h1>Add User</h1>
    <br>
    <form method="post" action="index.php?mode=root&action=users&sub=add&submit=1">
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6>Fullname</h6>
                <input name="name" type="text" placeholder="Name" class="form-control" required  />
            </div>
        </div>  
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6>Username</h6>
                <input name="uname" type="text" placeholder="Username" class="form-control" required />
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6>Password</h6>
                <input name="pword" type="password" class="form-control" value="" required />
            </div>
        </div>
        <br>
        <div class="col-sm-6 col-lg-3">
            <div class="form-group">
                <h6 for="sel1">Section</h6>
                <select name="section" class="form-control" id="sel1" required>
                    
                    <?php foreach ($sections as $s){?>
                    <option value="<?php echo strtolower($s) ?>"><?php echo $s ?></option>
                    <?php   } ?>

                </select>
            </div>
        </div>
        <br><br>
        <h6>Already Voted</h6>
        <div class="checkbox">
            <input name="voted" id="checkbox0" type="checkbox">
            <label for="checkbox0">
                VOTED
            </label>
        </div>


        <br><br>
        <h6>Priveledges</h6>


        <div class="checkbox">
            <input name="priv[]"  value="ROOT" id="checkbox1" type="checkbox">
            <label for="checkbox1">
                ROOT - GIVE ROOT PRIVILEDGES
            </label>
        </div>
        <div class="checkbox">
            <input name="priv[]"  value="CANDIDATE" id="checkbox2" type="checkbox">
            <label for="checkbox2">
                CANDIDATE - SET USER AS A CANDIDATE
            </label>
        </div>
        <div class="checkbox">
            <input name="priv[]" value="VOTE"  id="checkbox3" type="checkbox">
            <label for="checkbox3">
                VOTE - GIVE SUFFRAGE
            </label>
        </div>
        <br>
        <button class="btn btn-primary">Add</button>
        <a href="index.php?mode=root&action=users" class="btn btn-simple">Cancel</a>
    </form>
</div>