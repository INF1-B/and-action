<?php

/* 
This file will contain general functions used within the project. Think about a hashing function
functions related to video management and more.
*/

// this function retrieves an string value as an input, and returns the hashes value back to the user. The hashing algorithm used for this is BCRYPT.
// the default cost (times the values gets hased) is 12. Therefore we have set the value to 12 which increases some security on the hashes.
function generateHash($stringValue) {
  $options = [
    'cost' => 12,
  ];    
  return password_hash($stringValue, PASSWORD_BCRYPT, $options);
}

// echo generateHash("test3");

?>
