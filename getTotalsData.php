<?php
$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");

session_start();

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

//query to get data from the table
$query = sprintf("SELECT total_transacted,outlet FROM ip17team2db.totals WHERE end_date = (Select Max(end_date) from ip17team2db.totals)");

//execute query
$result = mysqli_query($mysqli, $query);


$_SESSION['data'] = $result;
?>