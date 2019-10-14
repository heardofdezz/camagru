<?php
session_start();
//  var_dump($_SESSION['User_id']);
	// if (!isset($_SESSION['User_id']))
	// {  
   
    //  header("Location: " . WEBROOT . "users/login");
    // exit;
  // }

?>


<!DOCTYPE html>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale = 1.1">
  <title>Camagru</title>
  <style>

  body {
    position: relative;
  }
  #main_container{
    display: flex;
    margin-top: 100px;
    margin-left: 50px;
    position: center;
  }
  #video_stream_container {
    position: relative;
    margin-right: 10px;
  }
  #filters{
    border-style: solid;
    text-align: center;
    font-size: 25px;
    height: 700px;
    width: 30%;
    position: static;
    bottom: 10px;
    right: 0px;
    overflow: auto;
  }
  #upload_container{
    display: auto;
  }
  .webcam {
  display: flex;
  width: 100%;
}
  .webcam > .preview {
  border-right: black 2px solid;
}

.results, .preview {
  width: 45%;
}

.live {
  position: relative;
  top: 0;
  left: 0;
  margin-bottom: 450px;
}

.live > #imgFilter, .live > #video {
  position: absolute;
  top: 0;
  left: 16%;
}

.live > #imgFilter {
  z-index: 50;
}

.min {
  width: 10%;
  text-align: right;
}

.min > img {
  width: 75px;
  height: 75px;
}

#canvas-container {
  position: relative;
  top: 0;
  left: 16%;
}

#canvas-container > #canvas {
  position: absolute;
  top: 0;
  left: 0;
}

#canvas-container > #canvasFilter {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 100;
}
 
  </style>
  </head>
  <body>
  
    <div id="main_container">
      <div id="video_stream_container">
      <img id="imgFilter" src="" alt="" >
        <video id="video" autoplay="true"></video><br>
      </div>
      <div id= "filters">
      <p>Pick Your Filter</p>
        <img class="filter" src="/filters/fileret.png" onclick="addFilter(event)" width="300" height="300"><br>
        <img class="filter" src="/filters/filter-cat.png" onclick="addFilter(event)" width="300" height="300"><br>
        <img class="filter" src="/filters/filter-dog.png" onclick="addFilter(event)" width="300" height="300"><br>
        <img class="filter" src="/filters/filter-rose.png" onclick="addFilter(event)" width="300" height="300"><br>
        <img class="filter" src="/filters/filtr2.png" onclick="addFilter(event)" width="300" height="300">
         </div>
    </div>
    
    <div id="upload_container">
      <div class="btn-child">
        <button id="shot" onclick="takepicture()">Prendre une photo</button>
      </div>
      <div class="btn-child" id="upload_img">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <p>OR</p>
        <input class="file-input" type="file" id="import_file" name="resume" accept="image/png"/>
        <p id="file_name2"> No Picture Uploaded</p>
      </div>
      <div class="btn-child">
        <button id="save" onclick="savePicture()">Save</button>
      </div>
      
      <!-- <div class="timeline_post">
        <input class="input" type="text-area" placeholder="legend" name="legend" value="">
				<input type="submit" class="button is-primary" value="publier" id="publish"/>
      </div> -->
    </div>
    
    
    <div class="results">
        <div id="canvas-container">
          <canvas id="canvas"></canvas>
          <canvas id="canvasFilter"></canvas>
        </div>
        <canvas id='blank' style='display: none;'></canvas>
        <img src="" id="result2">
        <input type="hidden" id="result" name="result" value="">
        <input type="hidden" id="resultFilter" name="resultFilter" value="">
    </div>


    
    <script>
    
    function addFilter(event){
var canvas = document.getElementById('canvasFilter');
var ctx = canvas.getContext('2d');
var img = new Image(500, 500);

img.src = event.target.src;
var width = 500;
var height = 500;
canvas.setAttribute('width', width);
canvas.setAttribute('height', height);
canvas.width = width;
canvas.height = height;

img.onload = function(){
  ctx.clearRect(0, 0, 500, canvas.height);
  ctx.drawImage(img, 0, 0, 500, 500, 0, 0, 500, 500);
  document.querySelector('#imgFilter').setAttribute('src', canvas.toDataURL("image/png"));
  document.querySelector('#resultFilter').setAttribute('value', canvas.toDataURL("image/png"));
}
// document.getElementById('shot').disabled = false;
}

(function() {

/// Anonym function that initialize very action
var streaming = false,
video        = document.getElementById('video'), // WEBCAM STREAM
canvas       = document.getElementById('canvas'),
canvasFilter = document.getElementById('canvasFilter'),
startbutton  = document.getElementById('shot'),
savebutton   = document.getElementById('save'),
width = 500,
height = 400;


///// Each Elements
var name = document.getElementById('file_name');
var image = document.getElementById('image');
var blank = document.getElementById('blank');
var result = document.getElementById('result');
var result2 = document.getElementById('result2');
var resultFilter = document.getElementById('resultFilter');

var context = canvas.getContext('2d');
var contextFilter = canvasFilter.getContext('2d');
var constraints = { audio: false, video: { width: 300, height: 300 } };
//  var formRegister = documentgetElementById('formPicture');
var input_file = document.querySelector('#import_file');
var name2 = document.querySelector('#file_name2');



//Get access to the camera
navigator.mediaDevices.getUserMedia(constraints)
.then(function(mediaStream) {
var video = document.querySelector('video');
video.srcObject = mediaStream;
video.onloadedmetadata = function(e) {
  video.play();
};
})

.catch(function(err) {
console.log("Error stream: " + err);
});

video.addEventListener('canplay', function(ev){
if (!streaming) {
height = video.videoHeight / (video.videoWidth/width);
video.setAttribute('width', width);
video.setAttribute('height', height);
canvas.setAttribute('width', width);
canvas.setAttribute('height', height);
streaming = true;
}
}, false);

/// Take a picture now

function takepicture() {
var base64 = canvas.toDataURL();
console.log(base64);
if (canvas.toDataURL() !== blank.toDataURL())
  context.clearRect(0, 0, canvas.width, canvas.height);
canvas.width = width;
canvas.height = height;
context.drawImage(video, 0, 0, width, height);
}

// function takepicture() {
//     canvas.width = width;
//     canvas.height = height;
//     canvas.getContext('2d').drawImage(video, 0, 0, width, height);
//     var data = canvas.toDataURL('image/png');
//     photo.setAttribute('src', data);
//   }

input_file.addEventListener('change', importFile);
function importFile(e){
file = e.target.files[0];
var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
var blank = document.getElementById('blank');
if (canvas.toDataURL() !== blank.toDataURL())
ctx.clearRect(0, 0, canvas.width, canvas.height);
var img = new Image;
img.src = URL.createObjectURL(file);
img.onload = function(){
name2.innerText = file.name;
ctx.drawImage(img, 0, 0, 300, 300);
}
}

function savePicture() {
document.querySelector('#result').setAttribute('value', canvas.toDataURL("image/png"));
}


/// Event basedon start button eventlistener
startbutton.addEventListener('click', function(ev){
takepicture();
//ev.preventDefault();
}, false);

// retry.addEventListener('click', function(ev){
// retryPicture();
// ev.preventDefault();
// }, false);

save.addEventListener('click', function(ev){
savePicture();
ev.preventDefault();
}, false);

})(); 
</script>
</body>
</html>