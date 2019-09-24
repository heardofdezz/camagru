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
