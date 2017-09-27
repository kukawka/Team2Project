<?php
/**
 * Created by IntelliJ IDEA.
 * User: cmckillop
 * Date: 19/09/2017
 * Time: 11:17
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

    <title>Create | Management</title>
</head>
<body>
<?php $currentPage = "management"; include "header.php";?>

<div class="container-fluid">
    <div class="row">

        <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="team-management.php">Overview<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="team-create.php">Create User</a>
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
            <h1 id="overview">Create User</h1>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>User created successfully!</strong> -NAME- can now sign into the Dashboard.
            </div>

            <section class="row">
                <div class="col-md-8">

                    <div class="container">

                        <form>

                            <div class="form-group row">
                                <label for="name-form" class="col-md-2 col-form-label">Name</label>
                                <div class="col-md-5" id="name-form">
                                    <input type="text" class="form-control" name="firstName" id="first-name" placeholder="First Name" required>
                                </div>

                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="lastName" id="last-name" placeholder="Last Name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-md-2 col-form-label">Email</label>
                                <div class="col-md-10">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                                        <div class="input-group-addon">@dusa.co.uk</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name-form" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-5" id="name-form">
                                    <input type="password" class="form-control" name="passwordConfirm" id="password" placeholder="Password" required>
                                </div>

                                <div class="col-md-5">
                                    <input type="password" class="form-control" name="password" id="password-confirm" placeholder="Confirm Password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="outletSelect" class="col-md-2 col-form-label">Outlet</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="outletSelect" name="outlet">
                                        <option>Air Bar</option>
                                        <option>Liar</option>
                                        <option>Mono</option>
                                        <option>Premier</option>
                                        <option>Campus Shop</option>
                                    </select>
                                </div>
                            </div>

                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-legend col-md-2">Role</legend>
                                    <div class="col-md-10">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="role-standard" id="roleStandard" value="standardUser" checked="">
                                                Standard User
                                            </label>
                                        </div>
                                        <div class="form-check disabled">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="role-manager" id="roleManager" value="manager" disabled>
                                                Manager
                                            </label>
                                        </div>
                                        <div class="form-check disabled">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="role-administrator" id="roleAdmin" value="administrator" disabled="">
                                                Administrator
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="form-group row">
                                <div class="col-md-10">
                                    <button type="submit" name="create" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </section>
        </main>
    </div>

    </div>
</div>
</body>
</html>
