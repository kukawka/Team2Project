<?php

$pageTitle = "Overview | Trends";
$currentPage = "trends";
include "header.php";
?>

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

    </body>
</html>