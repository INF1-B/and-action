<?php

/* 
This file will contain general functions used within the project. Think about a hashing function
functions related to video management and more.
*/

// this function retrieves an string value as an input, and returns the hashes value back to the user. The hashing algorithm used for this is BCRYPT.
// the default cost (times the values gets hased) is 10. Therefore we have set the value to 12 which increases some security on the hashes.
function generateHash($stringValue) {
  return password_hash($stringValue, PASSWORD_BCRYPT);
}

/* verifyPassword(): verifies if a password exists, if so returns true, otherwise returns false;
*
* Example: verifyPassword("test", "$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a"); // returns true of false
*
*/
function verifyPassword($password, $hashedpassword){
  if (password_verify($password, $hashedpassword)) {
    return true;
  }
  return false;
}

/* getRecaptchaResponse(): verifies whether the user has succesfully filled in the reCaptcha (V2)
*
* No example can be provided here since this will be the sitekey client side which is the user input.
*
*/
function getRecaptchaResponse($recaptchaResponse){
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode("6LeNjaMdAAAAAJW-AtObAMN7atf4xkuQ3rjvKO-a") .  '&response=' . urlencode($recaptchaResponse);
  $response = file_get_contents($url);
  $responseKeys = json_decode($response, true);
  return $responseKeys["success"];
} 

/* messageGenerator(): generates error messages based on the $id and $page your giving
*
* Example : messageGenerator("recaptcha", "register");
*
*/
function messageGenerator($id, $page){
  switch ($id) {
    case 'recaptcha':
      if ($page == "register") {
        return "<p class=\"register-error\"> ERROR: Your recaptcha is incorrect! </p>";
      } else if ($page == "login") {
        return "<p class=\"login-error\"> ERROR: Your recaptcha is incorrect! </p>";
      }
      break;
    case 'password':
      if ($page == "register"){
      return "<p class=\"register-error\"> ERROR: Your password does not meet the minimum requirements. These are 8 characters containing atleast 1 number, 1 special character and 1 uppercase character. </p>";
      }
      break;
    case 'email':
      if ($page == "register") {
        return "<p class=\"register-error\"> ERROR: Email exists, please pick another email to register </p>";
      } 
      break;
    case 'password-confirm':
      return "<p class=\"register-error\"> ERROR: Password and confirmed password do not match! </p>";
      break;
    case 'register-success':
      return "<p class=\"register-success\"> You have been registered! Please log in at the <a href=\"login.php\"> Login page </a></p>";
      break;
    case 'register-failure':
      return "<p class=\"register-error\"> ERROR: Please double check if all fields were filled in, and if your email is a legitimate email address! </p>";
      break;
    case 'register-failure-db': 
      return "<p class=\"register-error\"> ERROR: Unable to register! Please try registering another email adress </p>";
      break;
    case 'register-note':
      return "<p class=\"register-note\"> Note that signing up might take a little time. <br> You will get a message once the process has finished! </p>";
      break;
    case 'login-note':
      return "<p class=\"no-account login-note\"> Don't have an account? <a class=\"sign-up\" href=\"signUp.php\"> Sign up </a> </p>";
      break;
    case 'login-error':
      return "<p class=\"login-error\"> ERROR: unable to login with the combination of username and password. </p>";
      break;
    default:
      return "ERROR: contact the administrator of this page for more information";
      break;
  }
}
?>
