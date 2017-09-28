<?php
//$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");
//session_start();
$year = isset($_POST['yearOption']) ? $_POST['yearOption'] : null;
$scale = isset($_POST['scaleOption']) ? $_POST['scaleOption'] : null;
$outlet = isset($_POST['outletOption']) ? $_POST['outletOption'] : null;
$isTrue = false;
if($year || $scale || $outlet){
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


if($outlet == NULL){
        //$outlet = "238";
    $outlet=$_SESSION['userOutletID'];
}

if($year == null){
    $year = "3000";
}

//query to get data from the table


if($year == "3000" || !$year){
    $query = sprintf("SELECT total_transacted,start_date FROM ip17team2db.totals WHERE outlet_id = '".$outlet."' order by start_date asc");
}else{
    $query = sprintf("SELECT total_transacted,start_date FROM ip17team2db.totals WHERE outlet_id = '".$outlet."' AND year(start_date) = '".$year."' order by start_date asc");
}

//execute query
$result = mysqli_query($mysqli, $query);
$_SESSION['data'] = $result;

if($isTrue){
    $totalJS = [];
    while($row = mysqli_fetch_assoc($result)) {
            foreach($row as $r){
                if($r){
                    array_push($totalJS, $r);
                } 
            }
    }

  
    //loop through the returned data


    /*
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            foreach($row as $r){
                if($r){
                echo $r;
                echo "<br>" ;
                }
            }
        }
    } else {
        echo "0 results";
    }
    */


    echo json_encode($totalJS);
}

?>