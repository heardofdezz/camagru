<?php
session_start();
//  var_dump($_SESSION['User_id']);
	if (!isset($_SESSION['User_id']))
	{  
   
     header("Location: " . WEBROOT . "users/login");
    // exit;
  }

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
    position: static;
    margin-right: 100px;
  }
  #filters_container{
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
 
  </style>
  </head>
  <body>
  
    <div id="main_container">
      <div id="video_stream_container">
        <video id="video"></video><br>
      </div>
      <div id= "filters_container">
      <p>Pick Your Filter</p>
        <img class="filter" src="/filters/fileret.png" alt="" width="300" height="400"><br>
        <img class="filter" src="/filters/filter-cat.png" alt="" width="300" height="400"><br>
        <img class="filter" src="/filters/filter-dog.png" alt="" width="300" height="400"><br>
        <img class="filter" src="/filters/filter-rose.png" alt="" width="300" height="400"><br>
        <img class="filter" src="/filters/filtr2.png" alt="" width="300" height="400">
      </div>
    </div>
    <canvas id="canvas"></canvas>
    <div id="upload_container">
      <button id="startbutton">Prendre une photo</button>
      <p>OR</p>
      <input type='file' onchange="readURL(this);" hide=/>
        <span id=“custom-text”>No picture uploaded, yet.</span>
        </div>
      <button > POST </button>
      
    <script>

    function add_filter(event){

      var canvas = document.getElementById('canvasFilter');
      var ctx = canvas.getContext('2d');
      var img = new Image(300, 300);

      img.src = event.target.src;
      var width = 300;
      var height = 300;

      
    }

  (function() {

/// Anonym function that initialize very action
var streaming = false,
    video        = document.querySelector('#video'), // WEBCAM STREAM
    cover        = document.querySelector('#cover'),
    canvas       = document.querySelector('#canvas'),
    photo        = document.querySelector('#photo'),
    startbutton  = document.querySelector('#startbutton'),
   
    width = 640,
    height = 400;
    var constraints = { audio: false, video: { width: 300, height: 300 } }; 


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
  /// Event basedon start button eventlistener
  startbutton.addEventListener('click', function(ev){
    takepicture();
  ev.preventDefault();
}, false);
// take picture function 
// assigning the took the img tag src
function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

})(); 
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#canvas')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
</body>
</html>