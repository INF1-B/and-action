<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Sign up Director</title>
    <?php include "../templates/head.php" ?>
    <link rel="stylesheet" href="../public/assets/css/signUpDirector.css">
  <body>
   <div class="container">
    <div class="row">


     <div class="upper">
      <h1>Sign up</h1>
      <img class="logo" src="../public/assets/img/logo_login.png" alt="logo">
    </div>


       <form method="post">
        <label for="email">Email Address</label><br>
        <input class="input" type="text" name="email" id="email" placeholder="Type here your emailaddress"><br>
        <label for="username">Username</label><br>
        <input class="input" type="text" name="username" id="username" placeholder="Type here your username"><br>
        <label for="password">Password</label><br>
        <input class="input" type="text" name="password" id="password" placeholder="Type here your password"><br>

        <input class="button" type="submit" name="submit" value="Sign up"><br>
        <div class="SignUp"> Already have an account?<div class="signUp"><a href="#">Log in<a></div></div>
       </form>

    </div>
   </div>

 </body>
</html>