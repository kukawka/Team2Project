<?php
require 'portalLogic.php';
$pageTitle = "Dashboard";
$currentPage = "portal";

    if (!isset($_SESSION['notificationDismissed']) || $_SESSION['notificationDismissed'] != true)
    {
        $greeting = "Hello " . (string)$_SESSION['userFName'] . "!";
        $loginMessage = "Welcome to your Dashboard for " . (string)$_SESSION['userOutletName'] . ".";

        ?>
            <div class="alert alert-primary alert-dismissible fade show alert-portal" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong><?php echo $greeting;?></strong> <?php echo $loginMessage;?>
            </div>
        <?php
        $_SESSION['notificationDismissed'] = true;
    }

include "header.php";
?>

        		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>        

<div class="container-fluid">
    <div class="row">

        <main class="col-md-12 pt-3" role="main">
            <h1>Dashboard<small> - <?php echo $_SESSION['userOutletName'];?></small></h1>

            <section class="row text-center">
                <div class="col-md-6">
                    <div class="mx-auto" style="width: 25rem; padding-bottom: 20px;">
                        <div class="card card-portal">

                            <h4 class="card-header text-center">Total Sales</h4>

                            <div class="card-body card-body-portal">
                                <div class="tab-content">

                                    <p class="card-text">28/08/2017 – 03/09/2017</p>
                                    <hr>

                                    <div class="tab-pane fade show active" id="overview-left" role="tabpanel" aria-labelledby="overview-tab" aria-expanded="true">
                                                <div class="circle-widget circle-left" id="totalVal"><span>£1,133</span></div>
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
                                            <!--<tr>
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
                                            <tr>
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
                            <h4 class="card-header text-center">Active Consumers</h4>

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
	
	for (var i = 0; i < labelNames.length; i++) {
        $("tbody").append("<tr><td>"+labelNames[i]+"</td><td>£"+numData[i]+"</td></tr>")
    }
	
	
	
	 var total = (numData.reduce(function(sum, value){return parseInt(sum) + parseInt(value);},0));
     $('#totalVal span').text("£"+total);
	 console.log(total);
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
</body>
</html>