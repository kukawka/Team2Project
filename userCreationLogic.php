<?php

    require "connectToDatabase.php";
    session_start();

    $outletQuery = sprintf("SELECT DISTINCT outlet_id, outlet FROM ip17team2db.totals;");
    $outletResult = mysqli_query($conn, $outletQuery);

    /*
     * 0 - No error
     * 1 - Inserted Successfully
     * 2 - Email Wrong
     * 3 - Password Mismatch
     * 4 - Insertion Failed
     */
    if (!isset($_SESSION['creationStatus'])) {
        $_SESSION['creationStatus'] = 0;
    }

    if(isset($_POST['create']))
    {
        $formValid = true;

        foreach ($_POST as $key => $value) {
            if ($value === '')
            {
                if (!$key == "create")
                {
                    $formValid = false;
                }
            }
        }

        if ($formValid)
        {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];

            $emailValid = true;

            if (strpos($email, '@') !== false) {
                $_SESSION['creationStatus'] = 2;
                $emailValid = false;
                header("location: team-create.php");
                exit;
            }
            else
            {
                $email = $email . "@dusa.co.uk";
            }

            $password = $_POST['password'];
            $passwordConfirm = $_POST['passwordConfirm'];

            if ($password === $passwordConfirm)
            {
                $hashedPassword = hash('sha256', $password);
                $passwordMatch = true;
            }
            else
            {
                $_SESSION['creationStatus'] = 3;
                $passwordMatch = false;
                header("location: team-create.php");
                exit;
            }

            $selectedOutlet = $_POST['newOutlet'];
            $newRole = $_POST['newRole'];

            if ($passwordMatch && $emailValid)
            {
                $insertQuery = "INSERT INTO ip17team2db.users (username, password, role, outlet_id, first_name, last_name) VALUES ('$email', '$hashedPassword', '$newRole', '$selectedOutlet', '$firstName', '$lastName');";
                $successful = mysqli_query($conn, $insertQuery);

                if ($successful)
                {
                    $_SESSION['creationStatus'] = 1;
                    $_SESSION['newUserName'] = $firstName;
                }
                else
                {
                    $_SESSION['creationStatus'] = 4;
                }

                header("location: team-create.php");
                exit;
            }
        }
    }