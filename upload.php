<?php
//$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");


$query = isset($_POST['query']) ? $_POST['query'] : null;
$isTrue = false;
if($query){
    $isTrue = true;
}

//database
define('DB_HOST', 'silva.computing.dundee.ac.uk');
define('DB_USERNAME', 'ip17team2');
define('DB_PASSWORD', '9032.ip17t.2309');
define('DB_NAME', 'ip17team2db');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
    die("Connection didn't work amigo. Error: " . $mysqli->error);
}
//execute query
//leaving result incase needed for confirmation, may add it to session data or echo for ajax
if(mysqli_multi_query($mysqli, $query)){
    echo "All records created";
} else {
    echo "ERROR: " . mysqli_error($mysqli);
}

?>