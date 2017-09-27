<?php
include('connectToDatabase.php');

$au = array();
$months = array();
$year = $_POST['year'];
//$timescale = $_POST['timescale'];
$outlet = $_POST['outlet'];

if ($outlet=="All Outlets") {

    $query = mysqli_query($conn, "select count(distinct new_user) as au, MONTH(date_time) as au_month from ip17team2db.raw_data where YEAR(date_time)='$year' GROUP BY MONTH(date_time)");
}
else{
    $query = mysqli_query($conn, "select count(distinct new_user) as au, MONTH(date_time) as au_month from ip17team2db.raw_data where YEAR(date_time)='$year' AND outlet_name='$outlet' GROUP BY MONTH(date_time)");
}
/*while ($row = mysqli_fetch_assoc($query)) {
    $au[] = $row['au'];
    $months[] = $row['au_month'];
}*/
while ($row = mysqli_fetch_assoc($query)) {
    foreach ($row as $r) {
        if ($r) {
            array_push($au, $r);
        }
    }
}
echo json_encode($au);
//}
?>