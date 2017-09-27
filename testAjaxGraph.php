<?php
$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");

/**
 * Created by IntelliJ IDEA.
 * User: cmckillop
 * Date: 13/09/2017
 * Time: 10:45
 */

include 'getOverviewData.php';
$totalData = [];
$totalData = $_SESSION['data'];
$totalJS=[];

while($row = mysqli_fetch_assoc($totalData)) {
        foreach($row as $r){
            if($r){
                array_push($totalJS, $r);
            } 
        }
}

$totalJS = json_encode($totalJS);

?>

<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="assets/styles.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>

        <title>Overview | Graphs</title>

    </head>
    <body>


        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="graph-overview.php">Overview<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="graph-consumers.php">Consumers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="graph-outlets.php">Outlets</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="graph-transactions.php">Transactions</a>
                        </li>
                    </ul>

                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Export</a>
                        </li>
                    </ul>
                </nav>

                <main class="ml-sm-auto col-md-10 pt-3" role="main">
                    <h1 id="overview">Overview</h1>

                    <section class="row">
                        <div class="col-md-3 left">

                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Year</label>
                                    <select class="form-control" id="yearOption">
                                        <option>2017</option>
                                        <option>2016</option>
                                        <option>2015</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Timescale</label>
                                    <select class="form-control" id="scaleOption">
                                        <option>From the Start of Time</option>
                                        <option>Quarter</option>
                                        <option>Month</option>
                                        <option>Week</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect3">Outlet</label>
                                    <select multiple class="form-control" id="outletOption">
                                        <option>Mono</option>
                                        <option>Liar</option>
                                        <option>Air Bar</option>
                                        <option>Floor 5</option>
                                        <option>Entertainments</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-check-label" style="float: left;">
                                        <input class="form-check-input" type="checkbox" value=""> 
                                       Compare To
                                    </label>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="compareOption">
                                        <option>2017</option>
                                        <option>2016</option>
                                        <option>2015</option>
                                    </select>
                                </div>
                            </form>

                        </div>
                        <div class="col-md-9 right">
                            <canvas id="line-chart"></canvas>
                        </div>
                    </section>
                </main>

            </div>
        </div>

        <script>
            
            
            var totData = <?php echo $totalJS; ?>;
        $('#yearOption').change(function () {
            var yearOption = $(this).find("option:selected").text();
            var scaleOption = $("#scaleOption").val();
            var outletOption = $("#outletOption").val();
            var compareOption = $("#compareOption").val();
            alert(yearOption + " " + scaleOption + " " + outletOption + " " + compareOption);
            
            
          
                
        });

        $('#scaleOption').change(function () {
            var scaleOption = $(this).find("option:selected").text();
            var yearOption = $("#yearOption").val();
            var outletOption = $("#outletOption").val();
            var compareOption = $("#compareOption").val();
            alert(yearOption + " " + scaleOption + " " + outletOption + " " + compareOption);
        });
        
           $('#outletOption').change(function () {
            var $ = jQuery.noConflict();
            var outletOption = $(this).find("option:selected").text();
            var scaleOption = $("#scaleOption").val();
            var yearOption = $("#yearOption").val();
            var compareOption = $("#compareOption").val();
            
            
            $.post("getOverviewData.php",{ yearOption: "year", scaleOption: "scale", outletOption:"2676"}).done(function(data){
                alert(data);
            });
            /*
                $.post('getOverviewData.php', {yearOption:yearOption,scaleOption:scaleOption,outletOption:outletOption}, function (data) {
                    alert('ajax completed. Response:  ' + data);
                    totData = data;
                 });*/
            });
              
        
           $('#compareOption').change(function () {
            var compareOption = $(this).find("option:selected").text();
            var scaleOption = $("#scaleOption").val();
            var outletOption = $("#outletOption").val();
            var yearOption = $("#yearOption").val();
            alert(yearOption + " " + scaleOption + " " + outletOption + " " + compareOption);
        });
        
  

        var numData =[];
        for (var i = 0; i < totData.length; i++) {
            if(i % 2 === 0) { // index is even
                numData.push(totData[i]);

            }
        }
        
        numData.reverse();

        var labelNames = [];
        for (var i = 0; i < totData.length; i++) {
            if(i % 2 === 1) { // index is odd
                labelNames.push(totData[i]);
            }
        }
    
        labelNames.reverse();
             new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: labelNames,
                datasets: [{
                    data: numData,
                    label: "#outletName#",
                    borderColor: "#3e95cd",
                    fill: false
                }]
            },
            options: {
                title: {
                    display: false,
                    text: 'Overall Sales in #outletNameHere#'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Total (£)'
                        }
                    }]
                }
            }
        });
            // ORIGINAL CHART - REMOVED FOR TESTING
            
            /*
        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
                datasets: [{
                    data: [86,114,106,106,107,111,133,221,783,2478],
                    label: "Mono",
                    borderColor: "#3e95cd",
                    fill: false
                }, {
                    data: [282,350,411,502,635,809,947,1402,3700,5267],
                    label: "Liar",
                    borderColor: "#8e5ea2",
                    fill: false
                }, {
                    data: [168,170,178,190,203,276,408,547,675,734],
                    label: "Air Bar",
                    borderColor: "#3cba9f",
                    fill: false
                }, {
                    data: [40,20,10,16,24,38,74,167,508,784],
                    label: "Floor 5",
                    borderColor: "#e8c3b9",
                    fill: false
                }, {
                    data: [6,3,2,2,7,26,82,172,312,433],
                    label: "Entertainments",
                    borderColor: "#c45850",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                    display: false,
                    text: 'World population per region (in millions)'
                },
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Total (£)'
                        }
                    }]
                }
            }
        });
        */

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    </body>
</html>