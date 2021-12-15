<?php

include "../utils/filter.php";
include "../utils/functions.php";
include "../utils/database.php";

$message = "
<p class=\"register-note\">
  Note that signing up can take some time. You will get a message once registration is succesfull
</p>";


if (isset($_POST["submit"])) { 
  // filter all user values
  $input["username"] = filterInputPost($_POST["username"], "username");
  $input["password"] = filterInputPost($_POST["password"], "password");
  $input["subscription"] = filterInputPost($_POST["subscription"], "subscription");
  $input["email"] = filterEmail($_POST["email"]);
  $input["email"] = $input["email"] ? filterInputPost($_POST["email"], "email") : false;
  if (filterPassword($input["password"])){
    if (in_array(false, $input)) {
      $message = "
      <p class=\"register-error\">
        Please double check if all fields were filled in, and if your email is a legitimate email address!
      </p>";
    } else {
      if (executeQuery("INSERT INTO gebruiker (rol_id, abonnement_id, geverifieerd, ingelogd, gebruikersnaam, wachtwoord, email) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)", 
                         "iiiisss",
                         array(3,  $input["subscription"], 0, 0, $input["username"], generateHash($input["password"]), $input["email"]))) {
        $message = "
        <p class=\"register-success\">
          You have been registered! Please log in at the <a href=\"login.php\"> Login page </a>
        </p>";
        } else {
        $message = "
        <p class=\"register-error\">
          ERROR: Duplicate email. Please pick another email to register!
        </p>";
      }
    }
  } else {
    $message = "
    <p class=\"register-error\">
      Your password must contain atleast 8 characters, containing 1 special character, 1 uppercase character and 1 number!.
    </p>";
  }
}

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
        <h1>Sign up</h1>
      </div>
      <div>
        <img class="logo" src="../public/assets/img/logo_login.png" alt="logo">
      </div>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div>
        <label for="email">Email address</label>
        <input
          value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' // if form is filled in, prefill same values ?>"
          type="text" name="email" id="email" placeholder="Type here your email address">
        <label for="username">Username</label>
        <input
          value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' // if form is filled in, prefill same values ?>"
          type="text" name="username" id="username" placeholder="Type here your username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Type here your password">
      </div>
      <div>
        <label for="subscription">Subscription</label>
        <select id="subscription" class="subscription" name="subscription">

          <!-- start subscription types, people can have this field prefilled from the index.php page - subscriptions -->
          <?php 
            $subscriptions = getTableRecords("SELECT id, naam FROM abonnement");
            if (!isset($_GET["subscription"])) {
              echo "<option value=\"0\" selected hidden> Please pick your subscription </option>";
            } 
            
            foreach ($subscriptions as $key => $subscription) {
              if (isset($_GET["subscription"]) && strtolower($_GET["subscription"]) == strtolower($subscription["naam"])) {
                echo "<option value=" . $subscription["id"] . " selected>" . $subscription["naam"] . "</option>";
              } else {
                echo "<option value=" . $subscription["id"] . " >" . $subscription["naam"] . "</option>";
              }
            }
          ?>
          <!-- end subscription types -->

        </select>
      </div>
      <div class="submit-form">
        <input type="submit" name="submit" value="Sign up">
      </div>
    </form>

    <?php
      echo $message;
    ?>
    <p class="no-account">
      Already have an account?
      <a class="sign-up" href="#">Log in</a>
    </p>
  </div>
</body>

</html>