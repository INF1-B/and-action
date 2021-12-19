<?php 

/* 
This file will contain all functions related to uploading of movies/thumbnails and filtering. 
*/

// filters text, if not empty it will return the value filtered, if empty it will return false
function filterInputTextGeneral($value){
  $value = !empty($value) ? htmlspecialchars($value) : false;
  return $value;
}

/* checks if a variable is empty, if not it filters the value and returns it
*
* Example : $filteredValue = filterInputGet($_GET["id"], "id");
*
*/
function filterInputGet($getVariable, $parameterName){
  $filteredValue = !empty($getVariable) ? FILTER_INPUT(INPUT_GET, $parameterName, FILTER_SANITIZE_SPECIAL_CHARS) : false;
  return $filteredValue;
}

/* filterInputPost(): same as filterInputGet, but with a $_POST variable
*
* Example : $filteredValue = filterInputPost($_POST["id"], "id");
*
*/
function filterInputPost($postVariable, $parameterName){
  $filteredValue = !empty($postVariable) ? FILTER_INPUT(INPUT_POST, $parameterName, FILTER_SANITIZE_SPECIAL_CHARS) : false;
  return $filteredValue;
}

/* filterEmail(): returns true if an email address is valid, if not it will return an error message
*
* Example 1 : filterEmail("michel.disbergen@test.com"); // returns true
* Example 2 : filterEmail("michel.disbergen@test"); // returns false
*
*/
function filterEmail($email){
  $email = filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
  return $email;
}

/* filterInputFileSize(): returns true if an file is smaller then a certain amount, $file is the image/video and the $size is in kb
*
* Example : filterInputFileSize($_FILES["uploadedFileParameter"]["name"], 500); // allowed file size of the uploaded file/video is 500kb
*
*/
// to be tested
function filterInputFileSize($file, $size){
  $size = $size * 1000; // converts it to KB
  if ($file < $size) {
    return true;
  }
  return "ERROR: file size is to big! it must be a max of " . $size . " KB";
}

/* filterFileMimeTypes(): returns true if a file is of a specific MIME type, returns false if it is not equal to the specific MIME type
*
* Example: filterFileMimeType($_FILES["uploadedFileParameter"]["tmp_name"], array("image/gif", "image/jpg", "image/jpeg"));
*
*/
// to be tested
function filterFileMimeType($file, $allowedMimeTypes){
  $uploadedMimeType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file);
  if (in_array($uploadedMimeType, $allowedMimeTypes)) {
    return true;
  }
  return "ERROR: MIME TYPE not supported";
}

/* moveUploadedFile(): returns true if a file can be uploaded, then uploads a file, and a error string if the uploaded file can't be moved
*
* Example 1: moveUploadedFile("upload/images", $_FILES["uploadedFileParameter"]["tmp_name"], $_FILES["uploadedFileParameter"]["name"]);
* Example 2: moveUploadedFile("upload/images", $_FILES["uploadedFileParameter"]["tmp_name"], "pot-pindakaas.jpg");
*
*/
function moveUploadedFile($destination, $tmpFileName, $fileName){
  if (!file_exists($destination . "/" . $fileName)) {
    if (move_uploaded_file($tmpFileName, $destination . "/" . $fileName)){
      return true;
    }
  }
  return "ERROR: Unable to move the uploaded file to the directory!";
}

/* filterUploadFileLength(): returns true if the length of a movie is less then 60 characters, if not it will return an error message
*
* Example : filterUploadFileLength($_FILES["uploadedFileParameter"]["name"], 50) // if the name of the file is less or equal to 50, it will return true.
*
*/
function filterUploadFileLength($fileName, $allowedLength){
  if (strlen($fileName) <= $allowedLength){
    return true;
  }
  return "ERROR: the name of the uploaded file contains to many characters!";
}

/* filterImageResolution(): returns true if the resolution of an image is $x x $y (e.g. : 400x600), if it is not that image size it will return an error message
*
* Example 1 : filterImageResolution('https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-13.png', 667, 184); // return true
* Example 2 : filterImageResolution('https://media.geeksforgeeks.org/wp-content/uploads/geeksforgeeks-13.png', 667, 185); // return error message
*
* For thumbnails, this should be set to 400x600
*
*/
function filterImageResolution($image, $x, $y){
  $imageAttributes = getImageSize($image);
  $imageX = $imageAttributes[0]; // x - width
  $imageY = $imageAttributes[1]; // y - height
  if ($imageX == $x && $imageY == $y){
    return true;
  }
  return "ERROR: The size of the image does not fit the specified x and y axes, these are " . $x . " x " . $y . " yours are $imageX x $imageY";
}

/* filterPassword(): checks whether the password contains the minimum of 8 characters in a password, and if the password matches the specified rules, the rules are noted underneath
*
* 8 characters minimum
* 1 number (minimum)
* 1 special character (minimum)
* 1 uppercase character (minimum)
*
*/
function filterPassword($password){
  if (strlen($password) >= 8) { // minimum of 8 characters long
    if (preg_match('/[A-Z]/', $password)) { // contains atleast 1 uppercase letter
      if (preg_match('/[0-9]/', $password)) { // contains atleast 1 number
        if (preg_match('/[^a-zA-Z\d]/', $password)) { // contains atleast 1 special character
          return true;
        }
      }
    }
  }
  return false;
}
/* retrieves the length of a video, the application ffmpeg is needed to succesfully execute this. On the server this should be installed as a binary
*
* Example: getVideoLength("video.mp4") // returns 60 if length of the video is 60 seconds
*
*/
function getVideoLength($file){
  $dur = shell_exec("ffmpeg -i ".$file." 2>&1");
  if(preg_match("/: Invalid /", $dur)){
    return false;
  }
  preg_match("/Duration: (.{2}):(.{2}):(.{2})/", $dur, $duration);
  if(!isset($duration[1])){
    return false;
  }
  // $hours = $duration[1];
  // $minutes = $duration[2];
  $seconds = $duration[3];
  //  return $seconds + ($minutes*60) + ($hours*60*60);
  return $seconds;
}

/* Once a user has uploaded a movie, the resolution will be changed here. for a user with a standard subscription this should be 720p. Make sure the rights are correctly set!
*
* Example: changeVideoQuality("test/testmovie.mp4", "200x200", "test/bad-movie.mp4")
*
*/
function changeVideoQuality($originalVideo, $resolution, $outputPath){
  system("ffmpeg -i " . $originalVideo . " -s " . $resolution . " " . $outputPath);
  return $outputPath;
}

?>