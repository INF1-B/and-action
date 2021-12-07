<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sign up</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="../public/assets/css/signUp.css">

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
    <form method="post">
      <div class="input-login-text">
        <label>Email address</label>
        <input class="input" type="text" name="email" id="email" placeholder="Type here your email address">
        <label for="password">Password</label>
        <input class="input" type="text" name="password" id="password" placeholder="Type here yourassword">
      </div>
      <div class="submit-form">
        <input type="submit" name="submit" value="Sign up">
      </div>
    </form>
    <p class="no-account">
      Already have an account? 
      <a class="sign-up" href="#">Log in</a>
    </p>
  </div>
</body>

</html>