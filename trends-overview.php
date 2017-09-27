<?php

$pageTitle = "Overview | Trends";
$currentPage = "trends";
include "header.php";
?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="trends-overview.php">Overview<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">User Types</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" href="trends-graphs.php">Graphs</a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Export</a>
                        </li>
                    </ul>
                </nav>

                <main class="ml-sm-auto col-md-10 pt-3" role="main">
                    <h1 id="overview">Trends</h1>

                    <section class="row text-center placeholders year-current">
                        <div class="col-6 col-sm-4 placeholder">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="125" height="125" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                            <h4>Users</h4>
                            <div class="text-muted">⬇5%</div>
                        </div>
                        <div class="col-6 col-sm-4 placeholder">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="125" height="125" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                            <h4>Transactions</h4>
                            <span class="text-muted">⬆3%</span>
                        </div>
                        <div class="col-6 col-sm-4 placeholder">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="125" height="125" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                            <h4>Transactions</h4>
                            <span class="text-muted">0%</span>
                        </div>
                    </section>
                </main>

            </div>
        </div>

    <script>
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    </body>
</html>