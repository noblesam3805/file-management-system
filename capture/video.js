//my functions
function getBase64Image(img) {
  var canvas = document.createElement("canvas");
  canvas.width = img.width;
  canvas.height = img.height;
  var ctx = canvas.getContext("2d");
  ctx.drawImage(img, 0, 0);
  var dataURL = canvas.toDataURL("image/png");
  return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
}
 

function videoCapture() {
  'use strict';
  var video = document.querySelector('video')
    , canvas;



// use MediaDevices API
// docs: https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
if (navigator.mediaDevices) {
  // access the web cam
  navigator.mediaDevices.getUserMedia({video: true})
  // permission granted:
    .then(function(stream) {
      video.src = window.URL.createObjectURL(stream);
      video.addEventListener('click', takeSnapshot);
    })
    // permission denied:
    .catch(function(error) {
      document.body.textContent = 'Could not access the camera. Error: ' + error.name;
    });
}
}

function takeSnapshot() {
	  var video = document.querySelector('video')
    , canvas;
  var img = document.querySelector('img') || document.createElement('img');
  var context;
  var width = 180
    , height = 150;

  canvas = canvas || document.createElement('canvas');
  canvas.width = width;
  canvas.height = height;

  context = canvas.getContext('2d');
  context.drawImage(video, 0, 0, width, height);

  img.src = canvas.toDataURL('image/png');
  //document.body.appendChild(img);
  document.getElementById("vid").appendChild(img);
  var base64 = getBase64Image(img); console.log(base64);
  //var attr = document.createAttribute("action");
 // document.getElementById("imageFile").value = base64;
 // document.getElementById("imageFile3").innerHTML = base64;
}


function displayImg() {
 var base64 = getBase64Image(document.getElementById("vvv"));
 //var attr = document.createAttribute("action");
 document.getElementById("imageFile").value = base64;
 //document.getElementById("forme").setAttributeNode(attr);
 //console.log(document.getElementById("forme").action);
 //document.getElementById("forme").submit();
}
