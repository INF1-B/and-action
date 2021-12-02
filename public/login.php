<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Log in</title>
    <?php include "../templates/head.php" ?>
    <link rel="stylesheet" href="../public/assets/css/login.css">

  <body>
  
   <div class="container">
    <div class="row">
    
    <div class="upper">
      <h1>Login</h1>
      <img class="logo" src="../public/assets/img/logo_login.png" alt="logo">
    </div>
      <form method="post">
        <input class="input" type="text" name="email" id="email" placeholder="Email address"><br>
        <input class="input" type="text" name="password" id="password" placeholder="Password"><br>
          <div class="SignedIn">
          <input class="checkmark" type="checkbox" name="signed" id="signed">Keep me signed in<br>
          </div>
        <input class="button" type="submit" name="submit" value="login"><br>
        <div class="SignUp">Don't have an account?<div class="signUp"><a href="#"> Sign up </a></div></div>
       </form>



    </div>
   </div> 
  </body>

</html>