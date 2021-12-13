<!DOCTYPE html>
<html lang="en">

<head>
  <title>Log in</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="../public/assets/css/login.css">

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
    <form method="post">
      <div class="input-login-text">
        <input class="input" type="text" name="email" id="email" placeholder="Email address">
        <input class="input" type="password" name="password" id="password" placeholder="Password">
      </div>
      <div class="checkbox-form">
        <input type="checkbox" name="signed" id="signed">
        <label for="signed"> Keep me signed in </label>
      </div>
      <div class="submit-form">
        <input type="submit" name="submit" value="login">
      </div>
    </form>
    <p class="no-account">
      Don't have an account? 
      <a class="sign-up" href="#"> Sign up</a>
    </p>
  </div>
</body>

</html>