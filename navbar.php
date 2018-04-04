<nav class="navbar navbar-expand-lg bg-primary fixed-top">
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
            <a class="navbar-brand" href="index.php" rel="tooltip" title="Voting platform for PSHS-BRC" data-placement="bottom" >
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
                    <a class="nav-link" href="candidates.php">Candidates</a>
                </li>
                <li class="nav-item">
                    <?php if($VOTING_ENABLED): ?>
                        <a class="nav-link" href="results.php">Partial Results</a>
                    <?php else: ?>
                           <a class="nav-link" href="results.php">Results</a>
                    <?php endif; ?>
                </li>
                <li class="nav-item">
                    <?php if(isset($_COOKIE["id"])): ?>
                    <form id="logout-form" method="post" action="login.php">
                        <input type="number" name="logout" value="1" hidden>
                        <a onclick = "document.getElementById('logout-form').submit()" class="nav-link" href="#">Logout</a>
                    </form>
                <?php endif;?>
                </li>
            </ul>
        </div>
    </div>
</nav>