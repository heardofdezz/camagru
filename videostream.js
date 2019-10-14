function addFilter(event){

  var canvas = document.getElementById('canvasFilter');
  var ctx = canvas.getContext('2d');
  var img = new Image(300, 300);

  img.src = event.target.src;
  var width = 300;
  var height = 300;
  canvas.setAttribute('width', width);
  canvas.setAttribute('height', height);
  canvas.width = width;
  canvas.height = height;

  img.onload = function(){
    ctx.clearRect(0, 0, 300, canvas.height);
    ctx.drawImage(img, 0, 0, 300, 300, 0, 0, 300, 300);
    document.querySelector('#imgFilter').setAttribute('src', canvas.toDataURL("image/png"));
    document.querySelector('#resultFilter').setAttribute('value', canvas.toDataURL("image/png"));
  }
  // document.getElementById('shot').disabled = false;
}

(function() {

/// Anonym function that initialize very action
var streaming = false,
video        = document.querySelector('video'), // WEBCAM STREAM
// cover        = document.querySelector('cover'),
canvas       = document.querySelector('canvas'),
canvasFilter = document.querySelector('canvasFilter'),
startbutton  = document.querySelector('shot'),
savebutton   = document.querySelector('save'),
width = 300,
height = 300;


///// Each Elements
var name = document.getElementById('file_name');
var image = document.getElementById('image');
var blank = document.getElementById('blank');
var result = document.getElementById('result');
var result2 = document.getElementById('result2');
var resultFilter = document.getElementById('resultFilter');
var publish = document.getElementById('publish');
var context = canvas.getContext('2d');
//var contextFilter = canvasFilter.getContext('2d');
var constraints = { audio: false, video: { width: 300, height: 300 } };
//  var formRegister = documentgetElementById('formPicture');
var input_file = document.querySelector('#import_file');
var name2 = document.querySelector('#file_name2');
var retry = document.getElementById('retry');


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
publish.disabled = false;
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
ev.preventDefault();
}, false);

retry.addEventListener('click', function(ev){
retryPicture();
ev.preventDefault();
}, false);

save.addEventListener('click', function(ev){
savePicture();
ev.preventDefault();
}, false);

})(); 