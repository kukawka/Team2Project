<?php
include('connectToDatabase.php');

$au = array();
$months = array();
$date = $_POST['date'];

$query = mysqli_query($conn, "SELECT COUNT(transaction_ID), date_time FROM raw_data WHERE (date_time>='$date 00:00' and date_time<='$date 23:59') GROUP BY HOUR(date_time);");

if(mysqli_num_rows($query)!=0){
    while ($row = mysqli_fetch_assoc($query)) {
        foreach ($row as $r) {
            if ($r) {
                array_push($au, $r);
            }
        }
    }
}
echo json_encode($au);
?>