<?php

include "../utils/filter.php";
include "../utils/functions.php";
include "../utils/database.php";

$message = "
<p class=\"register-note\">
  Note that signing up can take some time. You will get a message once password is succesfull changed
</p>";

if (isset($_POST["submit"])) { 
  // filter all user values
  $input["Newpassword"] = filterInputPost($_POST["Newpassword"], "Newpassword");
  $input["Confirmpassword"] = filterInputPost($_POST["Confirmpassword"], "Confirmpassword");
}
  // check if any values were false, if so return an
 //if (in_array(false, $input)) {
 //   $message = "  <p class=\"register-error\">please double check if all fields were filled in!</p>";
  //  if(in_array(true, $input)){
  //      } 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sign up director</title>
  <?php
  include "../templates/head.php";
  ?>
  <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body>

  <div class="container container-login">
    <div class="upper">
      <div>
        <h2>Change password</h2>
      </div>
      <div>
        <img class="logo" src="../public/assets/img/logo_login.png" alt="logo">
      </div>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div>
        <label for="Newpassword">New password</label>
        <input type="password" name="NewePasword" id="Newpassword" placeholder="Type here your new password">
        <label for="Confirmpassword">Confirm new Password</label>
        <input type="password" name="Confirmpassword" id="Confirmpassword" placeholder="Confirm your new password">
      </div>
      <div class="submit-form">
        <input type="submit" name="Change Password" value="Change Password">
      </div>
    </form>

    <?php
    echo $message;
    ?>
  </div>
</body>
</html>