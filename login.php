<?php
include('loginLogic.php');
if (!empty($_SESSION['userLoggedIn'])) {
    header("location: portal.php");
    exit;
}
?>

<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="assets/styles.css" rel="stylesheet">

    <title>Sign in</title>

</head>
<body>

<div id="particles-js"></div>
<div id="overlay">
    <div class="mx-auto" style="width: 22rem;">
        <img class="mx-auto d-block" id="login-logo" src="assets/dark_logo.png" width="200" height="40" alt="DUSA Logo">
        <div class="card card-login">
            <h4 class="card-header text-center">Sign in to Dashboard</h4>
            <div class="card-body">
                <form class="container" action="loginLogic.php" method="post">
                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email" required>
                        <small id="emailHelp" class="form-text text-muted">Use your @dusa email.</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input name="password" type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
                </form>
            </div>
            <div class="card-footer">
                <small class="text-muted"><a class="text-muted" href="#">Forgot password</a>?</small>
            </div>
        </div>

        <div class="alert alert-danger alert-dismissible fade show alert-login" id="alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Wrong username or password!</strong> Please try again.
        </div>

        <div class="alert alert-warning alert-dismissible fade show alert-login" id="alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Blank username or password!</strong> Please try again.
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

<script>
    particlesJS.load('particles-js', 'assets/particles-js.json');
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

<?php
if (isset($_SESSION['loginError']))
{
    if ($_SESSION['loginError'] === 0)
    {
        echo '<script type="text/javascript">$( "#alert-warning" ).hide();</script>';
        echo '<script type="text/javascript">$( "#alert-danger" ).hide();</script>';
    }
    elseif ($_SESSION['loginError'] === 1)
    {
        echo '<script type="text/javascript">$( "#alert-warning" ).show();</script>';
        $_SESSION['loginError'] = 0;
    }
    elseif ($_SESSION['loginError'] === 2)
    {
        echo '<script type="text/javascript">$( "#alert-danger" ).show();</script>';
        $_SESSION['loginError'] = 0;
    }
}
?>

</body>
</html>