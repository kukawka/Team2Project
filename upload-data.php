<?php
$pageTitle = "Import";
$currentPage = "import";
include "header.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.5/require.min.js.map"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.11.4/xlsx.full.min.js"></script>

<div class="container-fluid">
    <div class="row">

        <main class="ml-sm-auto col-md-12 pt-3" role="main">
            <h1 id="overview">Import Data</h1>

            <section class="row">
                <div class="col-md-3">
                    <label class="custom-file label-file-select">
                        <input type="file" id="files" name="files[]" class="custom-file-input" required multiple>
                        <span class="custom-file-control"></span>
                    </label>
                    <button type="button" class="btn btn-block btn-primary btn-upload" id="upload" value="Upload" >Upload</button>
                </div>

                <div class="col-md-9">
                    <div id="drop">
                        <i class="fa fa-cloud-upload fa-4x" aria-hidden="true"></i>
                        <span>Drop file here to upload</span>
                    </div>
                </div>
            </section>
        </main>

    </div>
</div>

    <div id="popups"></div>

    <script>

        $('.custom-file-input').on('change', function() {
            // noinspection JSAnnotator
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-control').addClass("selected").html(fileName);
        });

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