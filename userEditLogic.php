<?php

    require "connectToDatabase.php";
    session_start();

    $outletQuery = sprintf("SELECT DISTINCT outlet_id, outlet FROM ip17team2db.totals;");
    $outletResult = mysqli_query($conn, $outletQuery);

    /*
     * 0 - No Search
     * 1 - Found User
     * 2 - Form Error
     * 3 - Not Found
     * 4 - Edit Successful
     * 5 - Edit Failed
     */
    if (!isset($_SESSION['editStatus'])) {
        $_SESSION['editStatus'] = 0;
    }

    if (isset($_POST['search']))
    {
        if(!empty($_POST['email']))
        {
            $username = $_POST['email'] . "@dusa.co.uk";

            $query = "SELECT * FROM ip17team2db.users WHERE username='$username'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);

            if ($rows == 1)
            {

                $_SESSION['userData'] = mysqli_fetch_assoc($result);
                $_SESSION['editStatus'] = 1;
            }
            else
            {
                $_SESSION['editStatus'] = 3;
            }
        }
        header("location: team-edit.php");
        exit;
    }

    if (isset($_POST['update']))
    {
        $username = $_SESSION['userData']['username'];
        $firstNameNew = $_POST['firstName'];
        $lastNameNew = $_POST['lastName'];
        $outletNew = $_POST['newOutlet'];

        $query = "UPDATE ip17team2db.users SET first_name='$firstNameNew', last_name='$lastNameNew', outlet_id='$outletNew' WHERE username='$username';";
        $successful = mysqli_query($conn, $query);

        if ($successful)
        {
            $_SESSION['editStatus'] = 4;
        }
        else
        {
            $_SESSION['editStatus'] = 5;
        }

        header("location: team-edit.php");
        exit;
    }

    if (isset($_POST['delete']))
    {
        $username = $_SESSION['userData']['username'];

        $query = "DELETE FROM ip17team2db.users WHERE username ='$username';";
        $successful = mysqli_query($conn, $query);

        header("location: team-edit.php");
        exit;
    }