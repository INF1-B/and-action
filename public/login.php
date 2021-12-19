<?php 
include "../utils/authentication.php";
include "../utils/filter.php";
include "../utils/functions.php";
include "../utils/database.php";

$message = messageGenerator("login-note", "login");

if (isset($_POST["submit"])){
  $input["email"] = filterInputPost($_POST["email"], "email");
  $input["password"] = filterInputPost($_POST["password"], "password");
  $input["g-recaptcha"] = getRecaptchaResponse($_POST['g-recaptcha-response']);
  if ($input["g-recaptcha"]) {
    if (!in_array(false, $input)) {
      $data = getTableRecord("SELECT email, wachtwoord FROM gebruiker WHERE email = ?", 
                             "s", 
                             array($input["email"]));
      if (array_key_exists("email", $data) && array_key_exists("wachtwoord", $data)){
        if (verifyPassword($input["password"], $data["wachtwoord"]) && $data["email"] == $input["email"]){
            // -- start setting session from this point -- //
            executeQuery("UPDATE gebruiker SET ingelogd = 1 WHERE email = ?", "s", array($input["email"]));
            $data = getTableRecord("SELECT ingelogd FROM gebruiker WHERE email = ?", "s", array($input["email"]));
            $_SESSION['loggedIn'] = $data["ingelogd"];
            header('Location: ./homePage.php');
          } else {
            $message = messageGenerator("login-error", "login");
        }
      } else {
        $message = messageGenerator("login-error", "login");
      }
    } else {
      $message = messageGenerator("login-error", "login");
    }
  } else {
    $message = messageGenerator("recaptcha", "login"); // recaptcha error message
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Log in</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="../public/assets/css/login.css">
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
        <input
          value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' // if form is filled in, prefill same values ?>"
          type="text" name="email" id="email" placeholder="Email">
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
      print_r($message);
    ?>
  </div>
</body>

</html>