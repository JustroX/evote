<?php 
    include("conn.php");
    if(isset($_POST["logout"]))
    {
        setcookie("id", $user["id"], time() - (86400/24*2), "/"); 
        header("LOCATION: login.php");       
    }
    else
    if(isset($_COOKIE["id"]))
    {
        header("LOCATION: index.php");
    }
    if(isset($_GET["auth"]) && isset($_POST["uname"]) && isset($_POST["pword"]))
    {
        $uname = addslashes($_POST["uname"]);
        $pword = hash("sha256", addslashes($_POST["pword"]));
        $res   = mysqli_query($conn,"SELECT * FROM `user` WHERE `username`='$uname' AND `password`='$pword' ");
        echo mysqli_error($conn);
        $user = mysqli_fetch_assoc($res);
        $count =mysqli_num_rows($res);
        if($count>0)
        {
           setcookie("id", $user["id"], time() + (86400/24*2), "/");
           header("LOCATION: index.php");
        }
        else
            $error = true;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes.php"); ?>
</head>

<body class="login-page sidebar-collapse">
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
        <div class="container">
            <div class="dropdown button-dropdown">
                <a href="#!" class="dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
                    <span class="button-bar"></span>
                    <span class="button-bar"></span>
                    <span class="button-bar"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-header">Related Links</a>
                    <a class="dropdown-item" href="#!">E-Clearance</a>
                </div>
            </div>
            <div class="navbar-translate">
                <a class="navbar-brand" href="#!" rel="tooltip" title="Voting platform for PSHS-BRC" data-placement="bottom" target="_blank">
                    PSHS-BRC VOTING PLATFORM
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#!">Candidates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#!">Partial Results</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url(./assets/img/login.jpeg)"></div>
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">
                    <form class="form" method="post" action="login.php?auth=1">
                        <div class="header header-primary text-center">
                            <div style="width: 150px" class="logo-container">
                                <img src="./logo.png" alt="">
                            </div>

                            <?php if(isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <div class="container"> 
                                   Wrong username and password combination
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>


                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </span>
                                <input name="uname" type="text" class="form-control" placeholder="Username" autocomplete="off" required>
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons text_caps-small"></i>
                                </span>
                                <input name="pword" type="password" placeholder="Password" class="form-control" autocomplete="off" required />
                            </div>
                            <div class="footer text-center">
                                <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">Log In</button>
                            </div>
                        </div>
                        <div class="pull-left">
                            <h6>
                                <a href="#!" class="link"  data-toggle="tooltip" data-placement="bottom" title="Please approach Mr. Joaquin to reset your password.">Forgot Password</a>
                            </h6>
                        </div>
                        <div class="pull-right">
                            <h6>
                                <a href="#!" class="link"  data-toggle="tooltip" data-placement="bottom" title="Your login credentials is the same with your e-clearance credentials.">Need Help</a>
                            </h6>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
    </div>
</body>

<?php include("core-js-includes.php"); ?>

</html>