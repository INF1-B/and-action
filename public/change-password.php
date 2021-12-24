<?php

include "../utils/filter.php";
include "../utils/functions.php";
include "../utils/database.php";


if (isset($_POST["submit"])) { 
  // filter all user values
  $input["Newpassword"] = filterInputPost($_POST["Newpassword"], "Newpassword");
  $input["Confirmpassword"] = filterInputPost($_POST["Confirmpassword"], "Confirmpassword");
}
  

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Change password</title>
  <?php
  include "../templates/head.php";
  ?>
  <link rel="stylesheet" href="assets/css/signup.css">
</head>

<body>
  <div class="container container-changepassword">
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

  </div>
</body>
</html>