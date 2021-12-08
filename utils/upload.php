<?php 

/* 
This file will contain all functions related to uploading of movies/thumbnails and filtering. 
*/

// filters text, if not empty it will return the value filtered, if empty it will return false
function filterInputText($value){
  $value = !empty($value) ? htmlspecialchars($value) : "ERROR: value is empty, cannot filter!";
  return $value;
}

// returns true if an email address is valid, if not it will return false
function filterEmail($email){
  $email = filter_var($email, FILTER_VALIDATE_EMAIL) ? true : "ERROR: Not an valid email!";
  return $email;
}

// returns true if an file is smaller then a certain amount, $file is the image/video and the $size is in kb
// to be tested
function filterInputFileSize($file, $size){
  $size = $size * 1000; // converts it to KB
  if ($file < $size) {
    return true;
  }
  return "ERROR: file size is to big! it must be a max of " . $size . " KB";
}

// returns true if a file is of a specific MIME type, returns false if it is not equal to the specific MIME type
// to be tested
function filterFileMimeType($file, $allowedMimeTypes){
  $uploadedMimeType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file);
  if (in_array($uploadedMimeType, $allowedMimeTypes)) {
    return true;
  }
  return "ERROR: MIME TYPE not supported";
}

// returns true if a file can be uploaded, and a error string if the uploaded file can't be moved 
// to be tested
function moveUploadedFile($destination, $tmpFileName, $fileName){
  if (!file_exists($destination . "/" . $fileName)) {
    if (move_uploaded_file($tmpFileName, $destination . "/" . $fileName)){
      return true;
    }
  }
  return "ERROR: Unable to move the uploaded file to the directory!";
}

// returns true if the length of a movie is less then 60 characters, if not it will return an error message
// to be tested
function filterUploadFileLength($fileName, $allowedLength){
  if (strlen($fileName) <= $allowedLength){
    return true;
  }
  return "ERROR: the name of the uploaded file contains to many characters!";
}

?>