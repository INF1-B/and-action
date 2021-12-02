<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Log in</title>
    <?php include "../templates/head.php" ?>
    <link rel="stylesheet" href="../public/assets\css/signUp.css">

  <body>
    
    <div class="container">
      <div class="row">

      <div class="upper">
         <h1>Sign up</h1>
          <img class="logo" src="../public/assets/img/logo_login.png" alt="logo">
      </div>

  
       <form method="post">
        <label for="email">Email Address</label><br>
        <input class="input" type="text" name="email" id="email" placeholder="Email address"><br>
        <label for="password">Password</label><br>
        <input class="input" type="text" name="password" id="password" placeholder="Password"><br>

        <input class="button" type="submit" name="submit" value="Sign up"><br>
        <div class="SignUp"> Already have an account?<div class="signUp"><a href="#"> Log in<a></div></div>
       </form>
      
     </div>
    </div>


    
  </body>
</html>