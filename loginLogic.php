<?php
include('connectToDatabase.php');
session_start(); // Starting Session
/*
 * 0 - No error
 * 1 - Blank username or password
 * 2 - Wrong username or password
 */
if (!isset($_SESSION['loginError']))
{
    $_SESSION['loginError'] = 0;
}
if (isset($_POST['submit']))
{
    if (empty($_POST['email']) || empty($_POST['password']))
    {
        $_SESSION['loginError'] = 1;
        header("location: login.php");
        exit;
    } else {
        // Define $username and $password
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = hash('sha256', $password);
        $query = "SELECT * FROM ip17team2db.users WHERE password='$hashed_password' AND username='$email';";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1)
        {
            /*
             * 0 - Administrator
             * 1 - Management Level
             * 2 - Standard User
             */
            while($row = mysqli_fetch_assoc($result))
            {
                $role = $row["role"];
                $firstName = $row["first_name"];
                $lastName = $row["last_name"];
                $outlet_id = $row["outlet_id"];
            }
            if (isset($outlet_id))
            {
                $outletQuery = "SELECT DISTINCT outlet FROM ip17team2db.totals WHERE outlet_id = '$outlet_id';";
                $outletResult = mysqli_query($conn, $outletQuery);
                $outletRow = mysqli_fetch_assoc($outletResult);
                $outlet_name = $outletRow["outlet"];
            }
            $_SESSION['userLoggedIn'] = $email; // Initializing Session
            $_SESSION['userRole'] = $role;
            $_SESSION['userOutletID'] = $outlet_id;
            $_SESSION['userOutletName'] = $outlet_name;
            $_SESSION['userFName'] = $firstName;
            $_SESSION['userLName'] = $lastName;
            header("location: portal.php"); // Redirecting To Other Page
            exit;
        } else {
            $_SESSION['loginError'] = 2;
            header("location: login.php");
            exit;
        }
    }
}