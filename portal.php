<?php
require 'portalLogic.php';
$pageTitle = "Dashboard";
$currentPage = "portal";
include "header.php";
?>

<?php
//if ($_SESSION['notificationDismissed'] === false)
//{
    $greeting = "Hello " . (string)$_SESSION['userFName'] . "!";
    $loginMessage = "Welcome to your Dashboard for " . (string)$_SESSION['userOutletName'] . ".";
    $_SESSION['notificationDismissed'] = true;
    ?>
    <div class="alert alert-primary alert-dismissible fade show alert-portal" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong><?php echo $greeting;?></strong> <?php echo $loginMessage;?>
    </div>
    <?php
//}
?>
<!DOCTYPE HTML>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="assets/styles.css" rel="stylesheet">

    <title>Home | Main Dashboard</title>

</head>
<body>

<div class="container-fluid">
    <div class="row">

        <main class="col-md-12 pt-3" role="main">
            <h1>Dashboard</h1>

            <section class="row text-center">
                <div class="col-md-6">
                    <div class="mx-auto" style="width: 25rem; padding-bottom: 20px;">
                        <div class="card card-portal">

                            <h4 class="card-header text-center">Total Sales | <strong><?php echo $_SESSION['userOutletName'];?></strong></h4>

                            <div class="card-body card-body-portal">
                                <div class="tab-content">

                                    <p class="card-text">28/08/2017 – 03/09/2017</p>
                                    <hr>

                                    <div class="tab-pane fade show active" id="overview-left" role="tabpanel" aria-labelledby="overview-tab" aria-expanded="true">
                                        <div class="circle-widget circle-left">£1,133</div>
                                        <p class="card-text ticker-widget">⬆5%</p>
                                    </div>
                                    <div class="tab-pane fade" id="chart-left" role="tabpanel" aria-labelledby="chart-tab" aria-expanded="false">
                                        <canvas class="portal-chart" id="myChart"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="list-left" role="tabpanel" aria-labelledby="list-tab" aria-expanded="false">
                                        <table class="table table-widget">
                                            <thead>
                                            <tr>
                                                <th style="border-top: none;">Venue</th>
                                                <th style="border-top: none;">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Mono</td>
                                                <td>£5,329</td>
                                            </tr>
                                            <tr>
                                                <td>Liar</td>
                                                <td>£4,874</td>
                                            </tr>
                                            <tr>
                                                <td>Air Bar</td>
                                                <td>£4,329</td>
                                            </tr>
                                            <tr>
                                                <td>Floor 5</td>
                                                <td>£3,102</td>
                                            </tr>
                                            <tr>
                                                <td>Entertainments</td>
                                                <td>£2,533</td>
                                            </tr>
                                            <tr class="table-primary">
                                                <td>Library</td>
                                                <td>£1,133</td>
                                            </tr>
                                            <tr>
                                                <td>Level 2 Reception</td>
                                                <td>£926</td>
                                            </tr>
                                            <!--<tr>
                                                <td>Entertainments</td>
                                                <td>£2,533</td>
                                            </tr>
                                            <tr>
                                                <td>Entertainments</td>
                                                <td>£2,533</td>
                                            </tr>-->
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <ul class="nav nav-pills card-header-pills nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="overview-tab-left" data-toggle="tab" href="#overview-left" role="tab" aria-controls="overview" aria-expanded="true"><i class="fa fa-eye" aria-hidden="false"></i> Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="chart-tab-left" data-toggle="tab" href="#chart-left" role="tab" aria-controls="chart" aria-expanded="false"><i class="fa fa-pie-chart" aria-hidden="true"></i> Chart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="list-tab-left" data-toggle="tab" href="#list-left" role="tab" aria-controls="list" aria-expanded="false"><i class="fa fa-list" aria-hidden="true"></i> List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mx-auto" style="width: 25rem; padding-bottom: 20px;">
                        <div class="card card-portal">
                            <h4 class="card-header text-center">Active Consumers | <strong><?php echo $_SESSION['userOutletName'];?></strong></h4>

                            <div class="card-body card-body-portal">
                                <div class="tab-content">

                                    <p class="card-text">
                                        28/08/2017 – 03/09/2017</p>
                                    <hr>

                                    <div class="tab-pane fade show active" id="overview-right" role="tabpanel" aria-labelledby="overview-tab" aria-expanded="true">
                                        <div class="circle-widget circle-right">526</div>
                                        <p class="card-text ticker-widget">⬇2%</p>
                                    </div>

                                    <div class="tab-pane fade" id="chart-right" role="tabpanel" aria-labelledby="chart-tab" aria-expanded="false">
                                        <canvas class="portal-chart" id="myChart2"></canvas>
                                    </div>
                                    <div class="tab-pane fade" id="list-right" role="tabpanel" aria-labelledby="list-tab" aria-expanded="false">
                                        <table class="table table-widget">
                                            <thead>
                                            <tr>
                                                <th style="border-top: none;">Venue</th>
                                                <th style="border-top: none;">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Monday</td>
                                                <td>99</td>
                                            </tr>
                                            <tr class="table-primary">
                                                <td>Tuesday</td>
                                                <td>328</td>
                                            </tr>
                                            <tr>
                                                <td>Wednesday</td>
                                                <td>109</td>
                                            </tr>
                                            <tr>
                                                <td>Thursday</td>
                                                <td>106</td>
                                            </tr>
                                            <tr>
                                                <td>Friday</td>
                                                <td>222</td>
                                            </tr>
                                            <tr>
                                                <td>Saturday</td>
                                                <td>236</td>
                                            </tr>
                                            <tr>
                                                <td>Sunday</td>
                                                <td>78</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <ul class="nav nav-pills card-header-pills nav-justified" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="overview-tab-right" data-toggle="tab" href="#overview-right" role="tab" aria-controls="overview" aria-expanded="true"><i class="fa fa-eye" aria-hidden="false"></i> Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="chart-tab-right" data-toggle="tab" href="#chart-right" role="tab" aria-controls="chart" aria-expanded="false"><i class="fa fa-pie-chart" aria-hidden="true"></i> Chart</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="list-tab-right" data-toggle="tab" href="#list-right" role="tab" aria-controls="list" aria-expanded="false"><i class="fa fa-list" aria-hidden="true"></i> List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
        </main>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>

<script>
    var totData = <?php echo $leftChartTotalJS; ?>;
    var numData =[];
    for (var i = 0; i < totData.length; i++) {
        if(i % 2 === 0) { // index is even
            numData.push(totData[i]);
        }
    }
    var labelNames = [];
    for (var i = 0; i < totData.length; i++) {
        if(i % 2 === 1) { // index is odd
            labelNames.push(totData[i]);
        }
    }
    var ctx = document.getElementById('myChart').getContext('2d');
    var mixedChart = new Chart(ctx, {
        type: 'doughnut',
        data:{
            datasets: [{
                data: numData,
                backgroundColor: ['rgb(186, 0, 186)','rgb(174,46,174)','rgb(153, 0, 153)','rgb(190, 92, 190)','rgb(126,0,126)','rgb(186, 0, 186)','rgb(174,46,174)','rgb(153, 0, 153)','rgb(190, 92, 190)','rgb(126,0,126)' ]
            }],
            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: labelNames
        },
        options: {
            cutoutPercentage:0,
            borderWidth:0,
            legend: {
                display: false
            },
            segmentShowStroke: false,
            responsive: true
        }
    });
    var ctx2 = document.getElementById("myChart2").getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Suns"],
            datasets: [{
                backgroundColor: [
                    "#2ecc71",
                    "#3498db",
                    "#95a5a6",
                    "#9b59b6",
                    "#f1c40f",
                    "#e74c3c",
                    "#34495e"
                ],
                data: [20, 9, 3, 10, 3, 13, 9]
            }]
        },
        options: {
            legend: {
                display: false
            },
            animation: false
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</body>
</html>