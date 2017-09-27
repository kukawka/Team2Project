<style>
  #progress_bar {
    margin: 10px 0;
    padding: 3px;
    border: 1px solid #000;
    font-size: 14px;
    clear: both;
    opacity: 0;
    -moz-transition: opacity 1s linear;
    -o-transition: opacity 1s linear;
    -webkit-transition: opacity 1s linear;
  }
  #progress_bar.loading {
    opacity: 1.0;
  }
  #progress_bar .percent {
    background-color: #99ccff;
    height: auto;
    width: 0;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>     

<input type="file" id="files" name="file" />
<button onclick="abortRead();">Cancel read</button>
<div id="progress_bar"><div class="percent">0%</div></div>
<div>
<input type="button" id="upload" value="Upload" />
</div>


<script>
  var reader;
  var progress = document.querySelector('.percent');

  function abortRead() {
    reader.abort();
  }

  function errorHandler(evt) {
    switch(evt.target.error.code) {
      case evt.target.error.NOT_FOUND_ERR:
        alert('File Not Found!');
        break;
      case evt.target.error.NOT_READABLE_ERR:
        alert('File is not readable');
        break;
      case evt.target.error.ABORT_ERR:
        break; // noop
      default:
        alert('An error occurred reading this file.');
    };
  }

  function updateProgress(evt) {
    // evt is an ProgressEvent.
    if (evt.lengthComputable) {
      var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
      // Increase the progress bar length.
      if (percentLoaded < 100) {
        progress.style.width = percentLoaded + '%';
        progress.textContent = percentLoaded + '%';
      }
    }
  }

  function handleFileSelect(evt) {
    // Reset progress indicator on new file selection.
    progress.style.width = '0%';
    progress.textContent = '0%';

    reader = new FileReader();
    reader.onerror = errorHandler;
    reader.onprogress = updateProgress;
    reader.onabort = function(e) {
      alert('File read cancelled');
    };
    reader.onloadstart = function(e) {
      document.getElementById('progress_bar').className = 'loading';
    };
    reader.onload = function(e) {
      // Ensure that the progress bar displays 100% at the end.
      progress.style.width = '100%';
      progress.textContent = '100%';
      setTimeout("document.getElementById('progress_bar').className='';", 2000);
    }

    // Read in the image file as a binary string.
   var fileRead = reader.readAsBinaryString(evt.target.files[0]);
   parseXLSX(fileRead);
  }
  
  

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
  
  
  function parseXLSX(fileUpload){
          //  console.log("START parsing" + fileUpload.substr(20,20));

            var reader = new FileReader();
            
            reader.onload = function(e) {
                var data = file;
                var workbook = XLSX.read(fileUpload, {
                  type: 'binary'
                });
            console.log("Done parsing" + workbook);
            
            workbook.SheetNames.forEach(function(sheetName) {
            // Here is your object
            var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
            var json_object = JSON.stringify(XL_row_object);
            console.log( "JSON OBJECT: " +json_object);
      
        });
     }
}

function getBase64(file) {
    console.log(file);
   var reader = new FileReader();
   reader.readAsDataURL(file);
   reader.onload = function () {
     console.log(reader.result);
   };
   reader.onerror = function (error) {
     console.log('Error: ', error);
   };
}



</script>

<script>
  function readBlob() {    
   
    var files = document.getElementById('files').files;
    if (!files.length) {
      alert('Please select a file!');
      return;
    }

    var file = files[0];
    var opt_startByte = 0;
    var opt_stopByte = file.size;
    var start = parseInt(opt_startByte) || 0;
    var stop = parseInt(opt_stopByte) || file.size - 1;

    var reader = new FileReader();
    var readFile
 
        readFile = document.getElementById('files').files[0] ;
       console.log("FILE : " + readFile);
       //console.log("STARTS : " + readFile.substr(0,20))
    ///var blob = reader.readAsText(readFile);

    var file64 = getBase64(readFile);
    
    var fileCSV = parseXLSX(readFile);
    console.log("CSV: " +fileCSV);
  }
  
$(function () {
    $("#upload").bind("click", function () {
            readBlob();
  });
});
  
  
</script>