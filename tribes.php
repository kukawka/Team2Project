<?php

?>

<?php
//$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");
session_start();
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

$pageTitle = "Tribes | Trends";
$currentPage = "trends";
include "header.php";

?>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="trends-graphs.php">Tribe Spending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="tribes.php">Guide<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </nav>

        <main class="ml-sm-auto col-md-10 pt-3" role="main">
            <h1 id="overview">Tribe Guide</h1>

            <section class="row">
                <div class="col-md-12">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="border-top: none;"></th>
                            <th style="border-top: none;">Tribe</th>
                            <th style="border-top: none;">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><i class="fa fa-coffee" aria-hidden="true"></i></td>
                            <td>Coffee Drinkers</td>
                            <td>Consumers with multiple Yoyo transactions during the day for £1 – £2 at Mono, Liar, Air Bar, or Pavement Café.</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-book" aria-hidden="true"></i></td>
                            <td>Library User</td>
                            <td>Consumers with a high percentage of Yoyo transactions in the Library or during Reading Week, Easter Break or week 11 onwards.</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-glass" aria-hidden="true"></i></td>
                            <td>Night Owls</td>
                            <td>Consumers who use Yoyo exclusively in Mono, Liar, Air Bar or Floor Five after 11PM.</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-id-badge" aria-hidden="true"></i></td>
                            <td>New Students</td>
                            <td>Consumers new to Yoyo with only a few transactions from the start of the semester.</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-stethoscope" aria-hidden="true"></i></td>
                            <td>Medical Students</td>
                            <td>Consumers with greater than 80% of all Yoyo transactions in Ninewells Medical School Kiosk</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-ticket" aria-hidden="true"></i></td>
                            <td>Event-goers</td>
                            <td>Consumers using Yoyo Wallet only to buy event tickets.</td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-users" aria-hidden="true"></i></td>
                            <td>Everyone Else</td>
                            <td>Non-categorised Consumers.</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-3">
                </div>
            </section>
        </main>

    </div>
</div>

<script>
</script>
</body>
</html>