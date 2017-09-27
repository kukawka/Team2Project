<?php
require "connectToDatabase.php";
session_start();

/*
 * Data for Left Widget
 */
//query to get data from the table
$leftChartQuery = sprintf("SELECT total_transacted,outlet FROM ip17team2db.totals WHERE end_date = (Select Max(end_date) from ip17team2db.totals)");
//execute query
$leftChartData= mysqli_query($conn, $leftChartQuery);
$leftChartTotalJS=[];
while($row = mysqli_fetch_assoc($leftChartData)) {
    foreach($row as $r){
        if($r){
            array_push($leftChartTotalJS, $r);
        }
    }
}
$leftChartTotalJS = json_encode($leftChartTotalJS);
?>