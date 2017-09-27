<?php
$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");

/**
 * Created by IntelliJ IDEA.
 * User: cmckillop
 * Date: 19/09/2017
 * Time: 09:34
 * editted by: Declan Patullo (Added session save path)
 */
?>

             
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-md navbar-dark fixed-top">
    <a class="navbar-brand" href="#">
        <img src="assets/light_logo.png" width="140" height="30" alt="DUSA Logo">
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="<?php if ($currentPage === "portal"): echo "active"; endif; ?> nav-item">
                <a class="nav-link" href="portal.php">Home<?php if ($currentPage === "portal"): echo "<span class=\"sr-only\">(current)</span>"; endif ?></a>
            </li>
            <li class="<?php if ($currentPage === "graph"): echo "active"; endif; ?> nav-item">
                <a class="nav-link" href="graph-overview.php">Graphs<?php if ($currentPage === "portal"): echo "<span class=\"sr-only\">(current)</span>"; endif ?></a>
            </li>
            <li class="<?php if ($currentPage === "import"): echo "active"; endif; ?> nav-item">
                <a class="nav-link" href="uploadTest.php">Import<?php if ($currentPage === "portal"): echo "<span class=\"sr-only\">(current)</span>"; endif ?></a>
            </li>
            <li class="<?php if ($currentPage === "trends"): echo "active"; endif; ?>  nav-item">
                <a class="nav-link" href="trends-overview.php">Trends<?php if ($currentPage === "portal"): echo "<span class=\"sr-only\">(current)</span>"; endif ?></a>
            </li>
            <li class="<?php if ($currentPage === "help"): echo "active"; endif; ?>  nav-item">
                <a class="nav-link disabled" href="#">Help<?php if ($currentPage === "portal"): echo "<span class=\"sr-only\">(current)</span>"; endif ?></a>
            </li>
        </ul>

        <?php // Change dropdown options based on user role below! ?>
        <ul class="navbar-nav">
            <li class="<?php if ($currentPage === "management"): echo "active"; endif; ?> nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                </a>
                <div class="dropdown-menu dropdown-menu-right" id="account-dropdown" aria-labelledby="navbarDropdownMenuLink">
                    <!--<a class="dropdown-item" href="#">Options</a>-->
                    <a class="dropdown-item" href="team-management.php">Manage Team</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
