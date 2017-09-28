<?php
//$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");

require "connectToDatabase.php";
session_start();

/*
 * Data for Left Widget
 */
//query to get data from the table
$activeCustomerQuery = sprintf("Select Count(Distinct(new_user)) from ip17team2db.raw_data where (Date(date_time) between (Select Max(end_date) - interval 7 day from totals) and (Select Max(end_date) from totals));");
$leftChartQuery = sprintf("SELECT total_transacted,outlet FROM ip17team2db.totals WHERE end_date = (Select Max(end_date) from ip17team2db.totals) order by total_transacted desc");
$activeLastYearQuery = sprintf("Select Count(Distinct(new_user)) from ip17team2db.raw_data where (Date(date_time) between (Select Max(end_date) - interval 1 year - interval 7 day from totals) and (Select Max(end_date) - interval 1 year from totals) );");
$leftChartLastYearQuery = sprintf("SELECT Sum(total_transacted) FROM ip17team2db.totals WHERE end_date between (Select Max(end_date)- interval 1 year - interval 7 day from ip17team2db.totals) and (Select Max(end_date)- interval 1 year from ip17team2db.totals) order by total_transacted desc;");
$allUsersQuery = sprintf("Select Count(Distinct(new_user)) as c,outlet_name from ip17team2db.raw_data where (Date(date_time) between (Select Max(end_date) - interval 7 day from totals) and (Select Max(end_date) from totals)) group by outlet_ref  order by c desc;");

//execute query

$allUsersResult = mysqli_query($conn, $allUsersQuery);
$leftChartLastYear = mysqli_query($conn, $leftChartLastYearQuery);
$activeCustomers = mysqli_query($conn, $activeCustomerQuery);
$activeCustomersLastYear = mysqli_query($conn, $activeLastYearQuery);
$leftChartData= mysqli_query($conn, $leftChartQuery);
$leftChartTotalJS=[];
$activeA = [];
$activeLastA = [];
$allUserA = [];
$LCLastA = [];

while($row = mysqli_fetch_assoc($allUsersResult)) {
    foreach($row as $r){
        if($r){
            array_push($allUserA, $r);
        }
    }
}

while($row = mysqli_fetch_assoc($leftChartLastYear)) {
    foreach($row as $r){
        if($r){
            array_push($LCLastA, $r);
        }
    }
}

while($row = mysqli_fetch_assoc($activeCustomersLastYear)) {
    foreach($row as $r){
        if($r){
            array_push($activeLastA, $r);
        }
    }
}

while($row = mysqli_fetch_assoc($leftChartData)) {
    foreach($row as $r){
        if($r){
            array_push($leftChartTotalJS, $r);
        }
    }
}

while($row = mysqli_fetch_assoc($activeCustomers)) {
    foreach($row as $r){
        if($r){
            array_push($activeA, $r);
        }
    }
}

$allUsers = json_encode($allUserA);
$leftLastYear = json_encode($LCLastA);
$activeLast = json_encode($activeLastA);
$active = json_encode($activeA);
$leftChartTotalJS = json_encode($leftChartTotalJS);
?>