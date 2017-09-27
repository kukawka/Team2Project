<?php
require "userEditLogic.php";
$pageTitle = "Update | Management";
$currentPage = "management";
include "header.php";
?>

<div class="container-fluid">
    <div class="row">

        <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="team-management.php">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="team-create.php">Create User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="team-edit.php">Manage User<span class="sr-only">(current)</span></a>
                </li>
            </ul>

            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">Example</a>
                </li>
            </ul>
        </nav>

        <main class="ml-sm-auto col-md-10 pt-3" role="main">
            <h1 id="overview">Manage User</h1>

            <section class="row">
                <div class="col-md-4">
                    <div class="container">
                        <form action="userEditLogic.php" method="post">
                            <div class="form-group">
                                <div class="input-group mb-2 mb-sm-0">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                                    <div class="input-group-addon">@dusa.co.uk</div>
                                </div>
                            </div>
                            <button type="submit" name="search" class="btn btn-primary btn-block">Search</button>
                        </form>

                    </div>
                </div>

                <?php

                if ($_SESSION['editStatus'] === 1)
                {
                    $firstName = $_SESSION['userData']["first_name"];
                    $lastName = $_SESSION['userData']["last_name"];
                    $outlet_id = $_SESSION['userData']["outlet_id"];

                    ?>

                    <div class="cold-md-8">
                        <div class="container">
                            <form action="userEditLogic.php" method="post">
                                <div class="form-group row">
                                    <label for="name-form" class="col-md-2 col-form-label">Name</label>
                                    <div class="col-md-5" id="name-form">
                                        <input type="text" class="form-control" name="firstName" id="first-name" value="<?php echo $firstName;?>">
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="lastName" id="last-name" value="<?php echo $lastName;?>">
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
                                                    if ($row["outlet_id"] == $outlet_id)
                                                    {
                                                        echo "<option selected='selected' value='" . (int)$row["outlet_id"] . "'>" . (string)$row["outlet"] . " (" . (string)$row["outlet_id"] . ")" . "</option>";
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='" . (int)$row["outlet_id"] . "'>" . (string)$row["outlet"] . " (" . (string)$row["outlet_id"] . ")" . "</option>";
                                                    }
                                                }

                                                mysqli_free_result($outletResult);
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <button type="submit" name="update" class="btn btn-block btn-primary">Update</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" name="delete" class="btn btn-block btn-danger">Delete</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php

                    $_SESSION['editStatus'] = 0;
                }

                ?>

            </section>
        </main>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</body>
</html>
