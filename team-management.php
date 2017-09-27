<?php
/**
 * Created by IntelliJ IDEA.
 * User: cmckillop
 * Date: 19/09/2017
 * Time: 09:24
 */
?>

<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="assets/styles.css" rel="stylesheet">

        <title>Overview | Management</title>
    </head>
    <body>
        <?php $currentPage = "management"; include "header.php";?>

        <div class="container-fluid">
            <div class="row">

                <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="team-management.php">Overview<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="team-create.php">Create User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="team-edit.php">Manage User</a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Example</a>
                        </li>
                    </ul>
                </nav>

                <main class="ml-sm-auto col-md-10 pt-3" role="main">
                    <h1 id="overview">Team Overview</h1>
                </main>

            </div>
        </div>
    </body>
</html>