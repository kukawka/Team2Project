<?php
include('connectToDatabase.php');
session_start();

$au = array();
$year = '2017';

$query = mysqli_query($conn, "select count(distinct new_user) as au, MONTH(date_time) as au_month from ip17team2db.raw_data where YEAR(date_time)='2017' GROUP BY MONTH(date_time)");

while ($row = mysqli_fetch_assoc($query)) {
    foreach ($row as $r) {
        if ($r) {
            array_push($au, $r);
        }
    }
}

$pageTitle = "Consumers | Graphs";
$currentPage = "graph";
include "header.php";
?>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="graph-overview.php">Total Sales</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="graph-consumers.php">Active Consumers<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="graph-transactions.php">Transaction Volume</a>
                </li>
            </ul>

            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">Export</a>
                </li>
            </ul>
        </nav>

        <main class="ml-sm-auto col-md-10 pt-3" role="main">
            <h1 id="overview">Active Users<small> - <?php echo $_SESSION['userOutletName'];?></small></h1>

            <section class="row">
                <div class="col-md-3 left">

                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Year</label>
                            <select class="form-control" id="yearSelect">
                                <option>2017</option>
                                <option>2016</option>
                                <option>2015</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect3">Outlet</label>
                            <select class="form-control" id="outletSelect">
                                <option value="All Outlets" selected>All Outlets</option>
                                <option value="Level 2, Reception">Level 2, Reception</option>
                                <option value="Mono">Mono</option>
                                <option value="Liar Bar">Liar Bar</option>
                                <option value="DUSA The Union - Marketplace">DUSA The Union - Marketplace</option>
                                <option value="College Shop">College Shop</option>
                                <option value="Library">Library</option>
                                <option value="Premier Shop">Premier Shop</option>
                                <option value="Ninewells Shop">Ninewells Shop</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" style="float: left;">
                                <input class="form-check-input" id="compare" type="checkbox" value="">
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
<canvas id="myChart" width="400" height="400"></canvas>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>
    var myChart;
    var initialData=[];
    initialData=<?php echo json_encode($au);?> ;

    var data=[];
    var labels=[];
    for (var i=0; i<initialData.length; i++){
        if(i%2==0){
            data.push(initialData[i]);
        }
        else{
            labels.push(initialData[i]);
        }
    }

    window.onload = function () {
        //alert('loaded');
        //constructGraph(new Array(), new Array());
        constructGraph(data,labels);
    }

    $('#compare').change(function() {
        if(this.checked) {
            startComparison();
        }
        else{
            myChart.data.datasets.pop();
            myChart.update();
        }
    });

    $('#compareOption').change(function() {
        //alert('changed');
        if ($("#compare").is(':checked')) {
            //alert('changed');
            updateComparison();
        }
    });

    function startComparison(){
        //var yearOption = $("#yearSelect").val();
        //var scaleOption = $("#timescaleSelect").val();
        var outletOption = $("#outletSelect").val();
        var compareOption = $("#compareOption").val();
        //alert(yearOption+scaleOption+outletOption);
        $.post("consumers_chart_backend.php", {
            year: compareOption,
            //timescale: scaleOption,
            outlet: outletOption
        }).done(function (data) {
            //constructGraph(JSON.parse(data));
            parseComparisonData(JSON.parse(data), false);
            //alert(data);
        });
    }

    function updateComparison(){
        //var yearOption = $("#yearSelect").val();
        //var scaleOption = $("#timescaleSelect").val();
        var outletOption = $("#outletSelect").val();
        var compareOption = $("#compareOption").val();
        //alert(yearOption+scaleOption+outletOption);
        $.post("consumers_chart_backend.php", {
            year: compareOption,
            //timescale: scaleOption,
            outlet: outletOption
        }).done(function (data) {
            //constructGraph(JSON.parse(data));
            parseComparisonData(JSON.parse(data), true);
            //alert(data);
        });
    }

    $("#yearSelect, #outletSelect").change(function () {
        //alert('changed!');
        var yearOption = $("#yearSelect").val();
        //var scaleOption = $("#timescaleSelect").val();
        var outletOption = $("#outletSelect").val();
        //alert(yearOption+scaleOption+outletOption);
        $.post("consumers_chart_backend.php", {
            year: yearOption,
            //timescale: scaleOption,
            outlet: outletOption
        }).done(function (data) {
            //constructGraph(JSON.parse(data));
            parseData(JSON.parse(data));
            //alert(data);
        });
    });

    function parseData(arrayToParse){
        var data=[];
        var labels=[];
        for (var i=0; i<arrayToParse.length; i++){
            if(i%2==0){
                data.push(arrayToParse[i]);
            }
            else{
                labels.push(arrayToParse[i]);
            }
        }
        updateGraph(data,labels);
    }

    function parseComparisonData(arrayToParse, second){
        var data=[];
        var labels=[];
        for (var i=0; i<arrayToParse.length; i++){
            if(i%2==0){
                data.push(arrayToParse[i]);
            }
            else{
                labels.push(arrayToParse[i]);
            }
        }

        var newDataset = {
            data: data,
            label: "Compared Year",
            borderColor: "#ff0000",
            fill: true
        }

        // You add the newly created dataset to the list of `data`
        if(second===true){
            myChart.data.datasets[1]=newDataset;
        }
        else {
            myChart.data.datasets.push(newDataset);
        }

        // You update the chart to take into account the new dataset
        myChart.update();
    }

    /*function labelsToText(arrayToText){

    }*/

    function updateGraph(jArray, labels){
        myChart.data.labels=labels;
        var newDataset = {
            label: 'Chosen Year',
            data: jArray,
            borderColor: "#3e95cd",
            fill: true
        }
        // You add the newly created dataset to the list of `data`
        myChart.data.datasets[0]=newDataset;

        // You update the chart to take into account the new dataset
        myChart.update();
    }

    function constructGraph(jArray, labels) {
        //myChart.destroy();
        //var labels=new Array();
        var hArray=new Array();
        for(i=0; i<jArray.length; i++){
            hArray[i]=jArray[i]+100;
        }
        var ctx = document.getElementById("line-chart").getContext('2d');
        var config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: jArray,
                    label: "Chosen Year",
                    borderColor: "#3e95cd",
                    fill: true
                }]
            },
            options: {
                scales: {
                    /*yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]*/

                }
            }
        };
        myChart = new Chart(ctx, config);
        //alert('im here');
    }

</script>
</body>
</html>