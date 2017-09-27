<?php
require "userCreationLogic.php";
$pageTitle = "Create | Management";
$currentPage = "management";
include "header.php";
?>

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

            <div class="alert alert-success alert-dismissible fade show" style="display: none;" id="alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>User created successfully!</strong> <?php if (isset($_SESSION['newUserName'])): echo $_SESSION['newUserName'] . " can now sign into the Dashboard."; endif ?>
            </div>

            <div class="alert alert-warning alert-dismissible fade show" style="display: none;" id="alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Problem with form input!</strong> Please check and try again.
            </div>

            <div class="alert alert-danger alert-dismissible fade show" style="display: none;" id="alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>User creation failed!</strong> Please try again later.
            </div>

            <section class="row">
                <div class="col-md-8">

                    <div class="container">

                        <form action="userCreationLogic.php" method="post">

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
                                        <input type="text" class="form-control<?php if ($_SESSION['creationStatus'] === 2): echo " is-invalid"; endif ?>" name="email" id="email" placeholder="Email" required>
                                        <div class="input-group-addon">@dusa.co.uk</div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name-form" class="col-md-2 col-form-label">Password</label>
                                <div class="col-md-5" id="name-form">
                                    <input type="password" class="form-control<?php if ($_SESSION['creationStatus'] === 3): echo " is-invalid"; endif ?>" name="password" id="password" placeholder="Password" required>
                                    <div class="invalid-feedback">
                                        Password fields do not match.
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <input type="password" class="form-control<?php if ($_SESSION['creationStatus'] === 3): echo " is-invalid"; endif ?>" name="passwordConfirm" id="password-confirm" placeholder="Confirm Password" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="outletSelect" class="col-md-2 col-form-label">Outlet</label>
                                <div class="col-md-10">
                                    <select class="form-control" id="outletSelect" name="newOutlet">
                                        <?php
                                        if ($outletResult)
                                        {
                                            while ($row = mysqli_fetch_assoc($outletResult))
                                            {
                                                echo "<option value='" . (int)$row["outlet_id"] . "'>" . (string)$row["outlet"] . " (" . (string)$row["outlet_id"] . ")" . "</option>";
                                            }

                                            mysqli_free_result($outletResult);
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-legend col-md-2">Role</legend>
                                    <div class="col-md-10">

                                        <?php

                                        if ($_SESSION['userRole'] == 0)
                                        {
                                            ?>

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="newRole" id="roleStandard" value="2" checked>
                                                    Standard User
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="newRole" id="roleManager" value="1">
                                                    Manager
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="newRole" id="roleAdmin" value="0">
                                                    Administrator
                                                </label>
                                            </div>

                                            <?php
                                        }
                                        elseif ($_SESSION['userRole'] == 1)
                                        {
                                            ?>

                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="new-role" id="roleStandard" value="2" checked>
                                                    Standard User
                                                </label>
                                            </div>
                                            <div class="form-check disabled">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="new-role" disabled>
                                                    Manager
                                                </label>
                                            </div>
                                            <div class="form-check disabled">
                                                <label class="form-check-label">
                                                    <input class="form-check-input" type="radio" name="new-role" disabled>
                                                    Administrator
                                                </label>
                                            </div>

                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </fieldset>

                            <?php

                            if (!$_SESSION['userRole'] == 2)
                            {
                                ?>

                                <div class="form-group row">
                                    <div class="col-md-10">
                                        <button type="submit" name="create" id="create" class="btn btn-primary">Create</button>
                                    </div>
                                </div>

                                <?php
                            }

                            ?>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>


<?php

if (isset($_SESSION['creationStatus']))
{
    if ($_SESSION['creationStatus'] === 0)
    {
        echo '<script type="text/javascript">$( "#alert-success" ).hide();</script>';
        echo '<script type="text/javascript">$( "#alert-warning" ).hide();</script>';
        echo '<script type="text/javascript">$( "#alert-danger" ).hide();</script>';
    }
    elseif ($_SESSION['creationStatus'] === 1)
    {
        echo '<script type="text/javascript">$( "#alert-success" ).show();</script>';
        $_SESSION['creationStatus'] = 0;
    }
    elseif ($_SESSION['creationStatus'] === 2 || $_SESSION['creationStatus'] === 3)
    {
        echo '<script type="text/javascript">$( "#alert-warning" ).show();</script>';
        $_SESSION['creationStatus'] = 0;
    }
    elseif ($_SESSION['creationStatus'] === 4)
    {
        echo '<script type="text/javascript">$( "#alert-danger" ).show();</script>';
        $_SESSION['creationStatus'] = 0;
    }
}

?>

</body>
</html>
