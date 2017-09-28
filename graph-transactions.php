<?php
include('connectToDatabase.php');
session_start();

$au = array();
$date = '2017-07-19';

$query = mysqli_query($conn, "SELECT COUNT(transaction_ID), date_time FROM raw_data WHERE (date_time>='$date 00:00' and date_time<='$date 23:59') GROUP BY HOUR(date_time);");

if (mysqli_num_rows($query) != 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        foreach ($row as $r) {
            if ($r) {
                array_push($au, $r);
            }
        }
    }
}

$pageTitle = "Transactions | Graphs";
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
                    <a class="nav-link" href="graph-consumers.php">Active Consumers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="graph-transactions.php">Daily Transactions<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </nav>

        <main class="ml-sm-auto col-md-10 pt-3" role="main">
            <h1 id="overview">Daily Transactions<small> - <?php echo $_SESSION['userOutletName'];?></small></h1>

            <section class="row">
                <div class="col-md-3">

                    <label for="chooseDate">Select a date:</label>
                    <form>
                        <div class="input-group">
                            <input type="text" id="datepicker" class="form-control date-picker" value="Date">
                            <span class="input-group-btn">
                                <button class="btn btn-default" id="chooseDate" type="button">Go!</button>
                            </span>
                        </div>
                    </form>

                </div>
                <div class="col-md-9">
                    <canvas id="line-chart"></canvas>
                </div>
            </section>
        </main>

    </div>
</div>
<script>

    $( function() {
        $( "#datepicker" ).datepicker(
            {
                dateFormat: 'yy-mm-dd',
                maxDate: "0",
                yearRange: "2015:+nn",
                changeYear: true,
                showButtonPanel: true
            });

    } );

    var myChart;
    var initialData = [];
    initialData =<?php echo json_encode($au);?> ;

    var data = [];
    var labels = [];
    for (var i = 0; i < initialData.length; i++) {
        if (i % 2 == 0) {
            data.push(initialData[i]);
        }
        else {
            labels.push(initialData[i]);
        }
    }

    window.onload = function () {
        //alert('loaded');
        //constructGraph(new Array(), new Array());
        constructGraph(data, labels);
    }

    $("#chooseDate").click(function () {
        //alert('changed!');
        var dateChosen = $("#datepicker").val();
        $.post("outlets_chart_backend.php", {
            date: dateChosen
        }).done(function (data) {
            //constructGraph(JSON.parse(data));
            parseData(JSON.parse(data));

        });
    });

    function parseData(arrayToParse) {
        var data = [];
        var labels = [];
        for (var i = 0; i < arrayToParse.length; i++) {
            if (i % 2 == 0) {
                data.push(arrayToParse[i]);
            }
            else {
                labels.push(arrayToParse[i]);
            }
        }
        updateGraph(data, labels);
    }

    function updateGraph(jArray, labels) {
        myChart.data.labels = labels;
        var newDataset = {
            label: 'Transactions',
            data: jArray,
            borderColor: "#3e95cd",
            fill: true
        }
        // You add the newly created dataset to the list of `data`
        myChart.data.datasets[0] = newDataset;

        // You update the chart to take into account the new dataset
        myChart.update();
    }

    function constructGraph(jArray, labels) {
        //myChart.destroy();
        //var labels=new Array();
        var hArray = new Array();
        for (i = 0; i < jArray.length; i++) {
            hArray[i] = jArray[i] + 100;
        }
        var ctx = document.getElementById("line-chart").getContext('2d');
        var config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    data: jArray,
                    label: "Transactions",
                    borderColor: "#3e95cd",
                    fill: true
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'No. of Transactions'
                        }
                    }]/*
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true
                        }
                    }]*/

                },
                responsive: true
            }
        };
        myChart = new Chart(ctx, config);
        //alert('im here');
    }

</script>
</body>
</html>