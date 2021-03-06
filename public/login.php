<?php
// imports
require_once("../utils/auth.php");
require_once("../utils/database.php");
require_once("../utils/filter.php");
require_once("../utils/movies.php");
require_once("../utils/functions.php");
?>

<?php

if (isset($_SESSION['id']) && is_numeric($_SESSION['id']) && isset($_SESSION["loggedIn"]) && $_SESSION['loggedIn']) {
  header("Location: homepage.php"); // redirect if user is already logged in
}

$message = messageGenerator("login-note");

if (isset($_POST["submit"])) {
  $input["email"] = strtolower(filterInputPost($_POST["email"], "email"));
  $input["password"] = filterInputPost($_POST["password"], "password");
  $input["g-recaptcha"] = getRecaptchaResponse($_POST['g-recaptcha-response']);
  if ($input["g-recaptcha"]) {
    if (!in_array(false, $input)) {
      $data = getTableRecord(
        "SELECT gebruiker.id as id, email, gebruikersnaam, wachtwoord, ingelogd, geverifieerd, abonnement_eind, abonnement.naam as abonnement, rol.naam as rol
              FROM gebruiker 
              INNER JOIN rol ON gebruiker.rol_id = rol.id 
              INNER JOIN abonnement ON gebruiker.abonnement_id = abonnement.id
              WHERE email = ?",
        "s",
        array($input["email"])
      );
      if (array_key_exists("email", $data) && array_key_exists("wachtwoord", $data)) {
        if (verifyPassword($input["password"], $data["wachtwoord"]) && $data["email"] == $input["email"]) {
          // set $_SESSION['id'] for getting the correct details of a user
          $_SESSION['id'] = $data["id"];
          if ($data["ingelogd"]) {
            $message = messageGenerator("login-true");
          } else {
            // User status is updated in database, user was not loggedin to the database
            executeQuery("UPDATE gebruiker SET ingelogd = 1 WHERE id = ? AND email = ?", "is", array($data["id"], $input["email"]));

            // Set $_SESSION['loggedIn'] for page authentication
            $_SESSION['gebruikersnaam'] = $data['gebruikersnaam'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['abonnement'] = $data['abonnement'];
            $_SESSION['abonnement_eind'] = $data['abonnement_eind'];
            $_SESSION['geverifieerd'] = $data['geverifieerd'];
            $_SESSION['rol'] = $data["rol"];
            $_SESSION['loggedIn'] = 1; // 1 equals true

            header('Location: ./homepage.php');
          }
        } else {
          $message = messageGenerator("login-error",);
        }
      } else {
        $message = messageGenerator("login-error");
      }
    } else {
      $message = messageGenerator("login-error");
    }
  } else {
    $message = messageGenerator("recaptcha"); // recaptcha error message
  }
}

// this part is used once a user has already logged in to the application
if (isset($_GET["reset"]) == "true") {
  if (isset($_SESSION["id"]) && is_numeric($_SESSION["id"])) {
    executeQuery("UPDATE gebruiker SET ingelogd = 0 WHERE id = ?", "i", array($_SESSION["id"]));
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action - login</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="assets/css/login-changepw.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

<body>
  <div class="container container-login">
    <div class="upper">
      <div>
        <h1>Login</h1>
      </div>
      <div>
        <img class="logo" src="../public/assets/img/logo_login.png" alt="logo">
      </div>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="input-login-text">
        <label for="email">Email address</label>
        <input value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' // if form is filled in, prefill same values 
                      ?>" type="text" name="email" id="email" placeholder="Email">
        <label for="password"> Password </label>
        <input class="input" type="password" name="password" id="password" placeholder="Password">
      </div>
      <div class="recaptcha-container">
        <div class="g-recaptcha" data-theme="light" data-sitekey="6LeNjaMdAAAAALpdCg3KEFPK8ypBE23Jf3t5gOq5"></div>
      </div>
      <div class="submit-form">
        <input type="submit" name="submit" value="login">
      </div>
    </form>
    <?php
    echo $message;
    ?>
  </div>
</body>

</html>