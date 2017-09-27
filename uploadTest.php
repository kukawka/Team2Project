<html lang="en-GB">
   
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="assets/styles.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script lang="javascript" src="sheetJS/dist/xlsx.full.min.js"></script>
        <script lang="javascript" src="require.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>

        <title>Import | Graphs</title>
  

    </head>
    <body>

        <?php $currentPage = "import"; include "header.php";?>
		

        <div class="container-fluid">
            
            <main class="col-md-12 pt-3" role="main">
                    <h1>Import Data</h1>

<style>
  .thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
  }
</style>
<div style="width:800px; margin:0 auto;">
<div> Select a file to add its contents to the database</div>


<!--<input type="file" id="files" name="files[]" multiple />-->
    <input type="file" id="files" name="files[]" class="btn btn-default" multiple/>
    <button type="button" class="btn btn-default" id="upload" value="Upload" >Upload</button>
<!--<input type="button" id="upload" value="Upload" />-->

<output id="list"></output>
<div>Or</div>
<div id="drop">Drop a spreadsheet file here add it the database. If a file is added that has been added before then the database will be unchanged.</div>

</div>
<div id="popups"></div>
</main>
</div>
<style>
#drop{
	border:2px dashed #bbb;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	padding:25px;
	text-align:center;
	font:20pt bold,"Vollkorn";color:#bbb;
        width:80%;
        height: 45%;
}
#b64data{
	width:80%;
        height: 45%;
}
a { text-decoration: none }
</style>
<script>
 /* processing array buffers, only required for readAsArrayBuffer */
function fixdata(data) {
  var o = "", l = 0, w = 10240;
  for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
  o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
  return o;
}

var rABS = true; // true: readAsBinaryString ; false: readAsArrayBuffer
/* set up drag-and-drop event */
function handleDrop(e) {
    console.log("DROPPING");
  e.stopPropagation();
  e.preventDefault();
  var files = e.dataTransfer.files;
  var i,f;
  for (i = 0; i != files.length; ++i) {
    f = files[i];
    var reader = new FileReader();
    var name = f.name;
    reader.onload = function(e) {
      var data = e.target.result;

      var workbook;
      if(rABS) {
        /* if binary string, read with type 'binary' */
        workbook = XLSX.read(data, {type: 'binary'});
      } else {
        /* if array buffer, convert to base64 */
        var arr = fixdata(data);
        workbook = XLSX.read(btoa(arr), {type: 'base64'});
      }

      var trans = workbook["Sheets"]["List of transactions"];
      
      
      var dataArray = [];
        for (var key in trans) {
            dataArray.push(trans[key]["v"]);         // Push the key on the array
        }
      console.log(dataArray);

      var query = "Delete from ip17team2db.temp_data;";
      var arrayOfDates = [];
        for(var i = 0; i<dataArray.length;i++){
            if(dataArray[i]){
                if(typeof dataArray[i] === "string"){
                    if(dataArray[i].indexOf("/") >=0){
                        console.log(dataArray[i] + " " + dataArray[i+1] + " " + dataArray[i+2] + " " + dataArray[i+3] + " " + dataArray[i+4] + " " + dataArray[i+5] + " " + dataArray[i+6] + " " + dataArray[i+7] + " " + dataArray[i+8] + " " +dataArray[i+9] + " " );
                        arrayOfDates.push(dataArray[i]);
                        query = addToTemp(query,dataArray[i],dataArray[i+1],dataArray[i+2],dataArray[i+3],dataArray[i+4],dataArray[i+5],dataArray[i+6],dataArray[i+7],dataArray[i+8],dataArray[i+9]);
                    }
                }
            }
        }
        
        
    console.log(query);
    query = query + "Call parseTempToRaw();";
    $.post("upload.php",{query:query}).done(function(data){
        console.log(data);
        $("<div class=\"alert alert-primary alert-dismissible fade show alert-portal\"\n\
             role=\"alert\" id=\"uploadAlert\"><button type=\"button\" class=\"close\" \n\
                data-dismiss=\"alert\" aria-label=\"Close\">\n\
                    <span aria-hidden=\"true\">&times;</span></button>\n\
                        <strong>File:</strong> \n\ " +
                            f.name +"has been added to the database</div>").hide().appendTo("#popups").fadeIn("slow");

    });
    
    
    console.log(arrayOfDates);
      
      

      /* DO SOMETHING WITH workbook HERE */
    };
    if(rABS) reader.readAsBinaryString(f);
    else reader.readAsArrayBuffer(f);
  }
}
var dropbox;

dropbox = document.getElementById("drop");
dropbox.addEventListener("dragenter", handleDrop, false);
dropbox.addEventListener("dragover", handleDrop, false);
dropbox.addEventListener("drop", handleDrop, false);

function addToTemp(orig,date,dusa_id,outlet_id,dusaWords,outlet_name,user_id,type,value,discount,total){
   orig = orig + "Insert into ip17team2db.temp_data (date_time,retailer_ref,outlet_ref,retailer_name,outlet_name,new_user,transaction_type,cash_spent,discount_amount,total_amount) Values ('"+date+"','"+dusa_id+"','"+outlet_id+"','"+dusaWords+"','"+outlet_name+"','"+user_id+"','"+type+"','"+value+"','"+discount+"','"+total+"');"
   return orig;
}
</script>

