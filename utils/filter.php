<?php 

/* 
This file will contain all functions related to uploading of movies/thumbnails and filtering. 
*/

// filters text, if not empty it will return the value filtered, if empty it will return false
function filterInputTextGeneral($value){
  $value = !empty($value) ? htmlspecialchars($value) : "ERROR: input value is empty, cannot filter!";
  return $value;
}

/* checks if a variable is empty, if not it filters the value and returns it
*
* Example : $filteredValue = filterInputGet($_GET["id"], "id");
*
*/
// to be tested
function filterInputGet($getVariable, $parameterName){
  $filteredValue = !empty($getVariable) ? FILTER_INPUT(INPUT_GET, $parameterName, FILTER_SANITIZE_SPECIAL_CHARS) : false;
  return $filteredValue;
}

/* same as filterInputGet, but with a $_POST variable
*
* Example : $filteredValue = filterInputPost($_POST["id"], "id");
*
*/
// to be tested
function filterInputPost($postVariable, $parameterName){
  $filteredValue = !empty($postVariable) ? FILTER_INPUT(INPUT_POST, $parameterName, FILTER_SANITIZE_SPECIAL_CHARS) : false;
  return $filteredValue;
}

// returns true if an email address is valid, if not it will return an error message
function filterEmail($email){
  $email = filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
  return $email;
}

/* returns true if an file is smaller then a certain amount, $file is the image/video and the $size is in kb
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

/* returns true if a file is of a specific MIME type, returns false if it is not equal to the specific MIME type
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

/* returns true if a file can be uploaded, then uploads a file, and a error string if the uploaded file can't be moved
*
* Example 1: moveUploadedFile("upload/images", $_FILES["uploadedFileParameter"]["tmp_name"], $_FILES["uploadedFileParameter"]["name"]);
* Example 2: moveUploadedFile("upload/images", $_FILES["uploadedFileParameter"]["tmp_name"], "pot-pindakaas.jpg");
*
*/
// to be tested
function moveUploadedFile($destination, $tmpFileName, $fileName){
  if (!file_exists($destination . "/" . $fileName)) {
    if (move_uploaded_file($tmpFileName, $destination . "/" . $fileName)){
      return true;
    }
  }
  return "ERROR: Unable to move the uploaded file to the directory!";
}

/* returns true if the length of a movie is less then 60 characters, if not it will return an error message
*
* Example : filterUploadFileLength($_FILES["uploadedFileParameter"]["name"], 50) // if the name of the file is less or equal to 50, it will return true.
*
*/
// to be tested
function filterUploadFileLength($fileName, $allowedLength){
  if (strlen($fileName) <= $allowedLength){
    return true;
  }
  return "ERROR: the name of the uploaded file contains to many characters!";
}

?>