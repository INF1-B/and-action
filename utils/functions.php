<?php

/* 
This file will contain general functions used within the project. Think about a hashing function
functions related to video management and more.
*/

/* generateHash():
*
* this function retrieves an string value as an input, and returns the hashes value back to the user. The hashing algorithm used for this is BCRYPT.
*
*/
function generateHash($stringValue) {
  return password_hash($stringValue, PASSWORD_BCRYPT);
}

/* verifyPassword(): 
*
* verifies if a password exists, if so returns true, otherwise returns false;
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

/* getRecaptchaResponse(): 
*
* verifies whether the user has succesfully filled in the reCaptcha (V2)
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

/* activateSubscription(): 
* 
* extends the subscription of a user with 1 year, updates the record into the database
*
* Example: activateSubscription($_SESSION['id']) // abonnement_eind attribute is updated
*
*/
function updateSubscription($userId) {
  $timestamp = (date('Y')+1).date('-m-d H:i:s'); 
  executeQuery("UPDATE gebruiker SET abonnement_eind = ? WHERE id = ?", "ss", array($timestamp, $userId));
}

/* messageGenerator(): 
*
* generates error messages based on the $id and $page your giving
*
* Example : messageGenerator("recaptcha", "register");
*
*/
function messageGenerator($id){
  $message = "";
  switch ($id) {
    // ----- start error messages ----- //
    case 'recaptcha':
      $message = "<p class=\"error\"> ERROR: Your recaptcha is incorrect! </p>";
      break;
    case 'password':
      $message = "<p class=\"error\"> ERROR: Your password does not meet the minimum requirements. These are 8 characters containing atleast 1 number, 1 special character and 1 uppercase character. </p>";
      break;
    case 'email':
      $message = "<p class=\"error\"> ERROR: Email exists, please pick another email to register. </p>";
      break;
    case 'password-confirm':
      $message = "<p class=\"error\"> ERROR: Password and confirmed password do not match! </p>";
      break;
    case 'register-failure':
      $message = "<p class=\"error\"> ERROR: Please double check if all fields were filled in, and if your email is a legitimate email address! </p>";
      break;
    case 'register-failure-db': 
      $message = "<p class=\"error\"> ERROR: Unable to register! Please try registering another email adress. </p>";
      break;
    case 'login-error':
      $message = "<p class=\"error\"> ERROR: Incorrect email and/or password. </p>";
      break;
    case 'login-true':
      $message = "<p class=\"error\"> ERROR: Your account is already logged in! If you would like to login anyways, click <a href=\"?reset=true\" style=\"color: white\"> here </a> and re-enter your credentials. </p>";
      break;
    case 'ch-pw-current-pw':
      $message = "<p class=\"error\"> ERROR: Your current password does not match our records! </p>";
      break;
    case 'ch-pw-new-pw':
      $message = "<p class=\"error\"> ERROR: Your new password and confirmed password do not match! </p>";
      break;
    case 'feedback-failure-id':
      $message = "<p class=\"error\"> ERROR : Failure retrieving movie and/ or user ID, please contact the administrator of this website </p>";
      break;
    case 'feedback-failure-length':
      $message = "<p class=\"text-left error\"> ERROR : Feedback length is either to short or to long. A minimum of 10 characters are needed and a maximum of 990</p>";
      break;
    case 'director-comment':
      $message = "<p class=\"text-left error\"> ERROR : Cannot delete comments or this movie since you have no rights over this movie or attached comments! </p>";
      break;
    case 'admin-dissaprove-fail':
      $message = "<p class=\"text-left error\"> ERROR : A minimum of 10 characters are needed before submitting! </p>";
      break;
    // ----- start success messages ----- //
    case 'register-success':
      $message = "<p class=\"success\"> You have been registered! Please log in at the <a style=\"color: white\" href=\"login.php\"> Login page. </a></p>";
      break;
    case 'ch-pw-success':
      $message = "<p class=\"success\"> Your password has been changed! Please login again <a style=\"color: white\" href=\"login.php\"> here </a> </p>";
      break;
    case 'feedback-success':
      $message = "<p class=\"text-left success\"> Feedback was submitted succesfully! </p>";
      break;
    // ----- start note messages ----- //
    case 'register-note':
      $message = "<p class=\"note\"> Note that signing up might take a little time. <br> You will get a message once the process has finished! </p>";
      break;
    case 'login-note':
      $message = "<p class=\"note\"> Don't have an account? <a style=\"color: white\" class=\"sign-up\" href=\"signUp.php\"> Sign up. </a></p>";
      break;
    case 'ch-pw-note':
      $message = "<p class=\"note\">Click <a style=\"color: white\" href=\"javascript:history.back()\"> here </a> to go back</p>";
      break;
    // ----- default error message -----  //
    default:
      $message = "<p class=\"error\"> ERROR: contact the administrator of this website.";
      break;
  }
  return $message;
}
?>
