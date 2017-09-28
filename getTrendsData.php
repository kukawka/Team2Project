<?php
//$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");
$checkOption = isset($_POST['checkOption']) ? $_POST['checkOption'] : null;
$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : null;
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : null;
$isTrue = false;
if($checkOption){
    $isTrue = true;
}


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

if(!$checkOption){
    
    $checkOption = "1";
}

$query = "";

if($checkOption === "1"){//coffee
    if($endDate){
        $query = sprintf("(");
    } else{
        $query = sprintf("(Select Count(*),hour(date_time) from ip17team2db.raw_data where (outlet_ref = '236' OR outlet_ref ='241' OR outlet_ref ='242' ) "
                . "and Hour(date_time) >5 and Hour(date_time) <20 and cash_spent> 0.60"
                . " and cash_spent <2.00 and Date(date_time) = '".$startDate."' group by Hour(date_time)) ;");
    }
}else if($checkOption === "2"){    if($endDate){//library
        $query = sprintf("(");
    } else{
        $query = sprintf("(Select Count(*),hour(date_time) from ip17team2db.raw_data where outlet_ref = '238' and Date(date_time) = '".$startDate."' group by Hour(date_time)) ;");
    }

}else if($checkOption === "3"){   if($endDate){//late night
        $query = sprintf("");
    } else{
        $query = sprintf("call countLate('2017-04-04')");
    }

}else if($checkOption === "4"){    if($endDate){//new students
        $query = sprintf("");
    } else{
        $query = sprintf("(Select Count(*),hour(date_time) from ip17team2db.raw_data where (new_user NOT IN (SELECT new_user FROM ip17team2db.raw_data where Date(date_time) < '".$startDate."')) and Date(date_time) = '".$startDate."' group by Hour(date_time)) ;");
    }

}else if($checkOption === "5"){    if($endDate){//medical
        $query = sprintf("");
    } else{
        $query = sprintf("(Select Count(*),hour(date_time) from ip17team2db.raw_data where (new_user NOT IN (SELECT new_user FROM ip17team2db.raw_data where Date(date_time) < '".$startDate."')) and Date(date_time) = '".$startDate."' group by Hour(date_time)) ;");
    }

}else if($checkOption === "6"){    if($endDate){//event
        $query = sprintf("");
    } else{
        $query = sprintf("(Select Count(*),hour(date_time) from ip17team2db.raw_data where (new_user NOT IN (SELECT new_user FROM ip17team2db.raw_data where Date(date_time) < '".$startDate."')) and Date(date_time) = '".$startDate."' group by Hour(date_time)) ;");
    }

}else if($checkOption === "7"){    if($endDate){//other
        $query = sprintf("");
    } else{
        $query = sprintf("(Select Count(*),hour(date_time) from ip17team2db.raw_data where (new_user NOT IN (SELECT new_user FROM ip17team2db.raw_data where Date(date_time) < '".$startDate."')) and Date(date_time) = '".$startDate."' group by Hour(date_time)) ;");
    }

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