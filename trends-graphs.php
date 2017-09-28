<?php
//$q=session_save_path("c:\\websites\\2017-projects\\team2\\sess\\");

include 'getTrendsData.php';
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

$pageTitle = "Spending | Trends";
$currentPage = "trends";
include "header.php";
?>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-sm-block bg-light sidebar">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="trends-overview.php">Tribe Spending<span class="sr-only">(current)</span></a>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tribes.php">Guide</a>
                </li>
            </ul>
        </nav>

        <main class="ml-sm-auto col-md-10 pt-3" role="main">
            <h1 id="overview">Spending</h1>

            <section class="row">
                <div class="col-md-3">

                    <form>
                        <div class="form-group">
                            <label for="dateChosen">Date</label>
                            <input class="form-control" name="date" type="text" id="dateChosen">
                        </div>
                        <label for="form-check-label">Tribe</label>
                        <div class="form-group">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="check1" name="Coffee Drinkers" value="1 #C0392B" >
                                Coffee Drinkers
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="check2" name="Library User" value="2 #AF7AC5">
                                Library Use
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="check3" name="Night Owls" value="3 #5499C7">
                                Night Owls
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="check4" name="New Students" value="4 #48C9B0">
                                New Students
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="check5" name="Medical Students" value="5 #F4D03F">
                                Medical Students
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="check6" name="Event-goers" value="6 #DC7633">
                                Event Goers
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="check7" name="Everyone else" value="7 #566573">
                                Everyone Else
                            </label>
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
        $( "#dateChosen" ).datepicker(
                {
                    dateFormat: 'yy-mm-dd',
                    maxDate: "0",
                    yearRange: "2015:+nn",
                    changeYear: true,
                    showButtonPanel: true
               });
                } );
                

                

            var graph;
            var config;
            var totData = <?php echo $totalJS; ?>;
            
            
            
            //Initial graph constuction
            window.onload = function() {
                $("#dateChosen").datepicker("setDate", new Date());
                $("#check1").prop('checked',true);
                getGraphForCheck(1);

            };
              
              
             //Refresh all checked when scale changed
             $(function () {
                    $("#timePeriod").change(function () {
                    var timePeriod = $("#timePeriod").val();                    
                    var checks = [];
                    checks.push($("#check1").val().split(" ")[0]); 
                    checks.push($("#check2").val().split(" ")[0]); 
                    checks.push($("#check3").val().split(" ")[0]); 
                    checks.push($("#check4").val().split(" ")[0]); 
                    checks.push($("#check5").val().split(" ")[0]); 
                    checks.push($("#check6").val().split(" ")[0]); 
                    checks.push($("#check7").val().split(" ")[0]); 

                    for(var i = 0; i<checks.length; i++){
                            
                    }           
                });
          });
        
        
        $(function(){
            $( "#dateChosen" ).change(function (){
                    config.data.datasets.length = 0;
                    getGraphForCheck(1);
                    getGraphForCheck(2);
                    getGraphForCheck(3);
                    getGraphForCheck(4);
                    getGraphForCheck(5);
                    getGraphForCheck(6);
                    getGraphForCheck(7);
        
            });
        });
        
        //Add data for each check, for now this is hard coded with number representing the individual user groups
        $(function () {
            $("#check1").change(function (){
                    getGraphForCheck(1);
            });
        });
        
        $(function () {
            $("#check2").change(function (){
                    getGraphForCheck(2);
            });
        });
        
        $(function () {
            $("#check3").change(function (){
                    getGraphForCheck(3);
            });
        });
        
        $(function () {
            $("#check4").change(function (){
                    getGraphForCheck(4);
            });
        });
        
        $(function () {
            $("#check5").change(function (){
                    getGraphForCheck(5);
            });
        });
        
        $(function () {
            $("#check6").change(function (){
                    getGraphForCheck(6);
            });
        });
        
        $(function () {
            $("#check7").change(function (){
                    getGraphForCheck(7);
            });
        });
        
        function getGraphForCheck(checkNo){
               var checkNum = checkNo.toString();
                if($("#check"+checkNum).is(":checked")){
                    
                    var checkNum = checkNo.toString();
                    var testDate = $( "#dateChosen" ).datepicker("getDate");
                    var realDate;
                    if((testDate.getMonth()+1)>9){
                       realDate =  testDate.toString().substr(11,4)+"-"+(testDate.getMonth()+1)+"-"+testDate.toString().substr(8,2);
                    } else{
                       realDate = testDate.toString().substr(11,4)+"-0"+(testDate.getMonth()+1)+"-"+testDate.toString().substr(8,2);
                     }
                    var startDate = realDate;
                    var endDate = "";
                    $.post("getTrendsData.php", {checkOption:checkNum, startDate:startDate, endDate:endDate}).done(function(data){
                            var newData = JSON.parse(data);
                            var dateData = [];
                            var numData =[];
							var length  = JSON.parse(data).length;
                              for (var i = 0; i < length; i++) {
                                  if(i % 2 === 0) { // index is even
                                      numData.push(newData[i]);
                                  }
                              }
                               for (var i = 0; i < length; i++) {
                                  if(i % 2 === 1) { // index is even
                                      dateData.push(newData[i]);
                                  }
                              }
                            addDataToGraph(numData, dateData, $("#check"+checkNum).attr('name'), $("#check"+checkNum).val().split(" ")[1], startDate, endDate);
                        });
                    } else {
                        $.post("getTrendsData.php", {checkOption:checkNum}).done(function(data){

                            var newData = JSON.parse(data);
                             var dateData = [];
                             var numData =[];
                               for (var i = 0; i < newData.length; i++) {
                                   if(i % 2 === 0) { // index is even
                                       numData.push(newData[i]);
                                   }
                               }

                                for (var i = 0; i < newData.length; i++) {
                                   if(i % 2 === 1) { // index is even
                                       dateData.push(newData[i]);
                                   }
                               }
                            removeDataFromGraph(numData, dateData, $("#check"+checkNum).attr('name'), $("#check"+checkNum).val().split(" ")[1], startDate, endDate);
                        });
                    }
        
        }
        

        
         Date.prototype.addDays = function(days) {
       var dat = new Date(this.valueOf());
       dat.setDate(dat.getDate() + days);
       return dat;
        };

        function getDates(startDate, stopDate) {
           var dateArray = new Array();
           var currentDate = startDate;
           while (currentDate <= stopDate) {
             dateArray.push(currentDate);
             currentDate = currentDate.addDays(1);
           }
           return dateArray;
         }


        //Single Line Graph
        function addDataToGraph(data, dates, title, colour, startDate, endDate){
           // alert(newData);
			var numData = data; 
			//numData = parseData(data);
         
		 /*
         if(endDate){
            var dateArray = getDates(new Date(startDate), (new Date(endDate)).addDays(2));
            for (i = 0; i < dateArray.length; i ++ ) {
               console.log(dateArray[i]);
            }

            var fullData = [];
            var dateCounter = 0;
			
			if(numData.length == 0){
				console.log("No data returned from query");
			}
            for(var i = 0; i<dateArray.length;i++){
                if(Date.parse(dates[dateCounter]) === Date.parse(dateArray[i])){
					console.log(numData[dateCounter]);
                    dateCounter++;
                } else{
                   fullData.push(0);
               }
			   	console.log("part of full data: " +numData[dateCounter]);

           }

           numData = fullData;


            for(var i = 0; i<dateArray.length;i++){
                dateArray[i] = dateArray[i].toString().substr(0,16);
            }
			
         }else*/
             var dateArray = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
             
              var fullData = [];
			  

                var dateCounter = 0;
                for(var i = 0; i<dateArray.length;i++){

				if(parseInt(dates[dateCounter]) === dateArray[i]){
                        fullData.push(numData[dateCounter]);
                        dateCounter++;

						
                    } else{
                       fullData.push(0);

					   }

               }

               numData = fullData;


                for(var i = 0; i<dateArray.length;i++){
                    dateArray[i] = dateArray[i].toString()+":00";
                }
        
         
         if(graph){       
            //add data to graph code here

            var newData = {data: numData,  label: title,  borderColor: colour,fill: false};
            config.data.datasets.push(newData);            
            config.data.labels = [];
            config.data.labels = dateArray;

            graph.update();
            
                     
            }else{
               
            config = {
                type: 'line',
                data: {
                    labels: dateArray,
                    datasets: [{
                        data: numData,
                        label: title,
                        borderColor: colour,
                        fill: false
                    }]
                },
                options: {
                    title: {
                        display: false,
                        text: "User Tribes"
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: "No. of Users"
                            }
                        }]
                    }
                }
            }
            
            graph = new Chart(document.getElementById("line-chart"), config);
        }
    }
		
    
        function removeDataFromGraph(data, dates, title, colour, startDate, endDate){
           // alert(newData);
         var numData = data; 
         //numData = parseData(data);
         
         
         if(graph){      
            //add data to graph code here

            var newData = {data: numData,  label: title,  borderColor: colour,fill: false};
            
            var previousData = [];
            var removedCorrectData = false;
            
            while(!removedCorrectData){
                var data;
                data = config.data.datasets.pop();
                if(data){


				
                   
                    if(data.label === newData.label){

					removedCorrectData = true;
                    }else{
                       previousData.push(data);
                    }
                }else{
                 removedCorrectData = true;   
                }
                
                
            }
            
            
            for(var i = 0; i<previousData.length;i++){
                config.data.datasets.push(previousData[i]);
            }
            
            graph.update();
              
            }
		}
		
	
    </script>


    </body>
</html>
