function loadScreen() {
  var uploadImage = document.getElementById("upload-image");
  uploadImage.src = "assets/img/loading.gif";
  uploadImage.style.marginTop = "100px";
  uploadImage.style.marginBottom = "100px";
  uploadImage.style.width = "150px";
  uploadImage.style.height = "150px";
  document.getElementById("upload-title").innerHTML = "Please wait while we get things ready... <br> this might take a couple of minutes"
}