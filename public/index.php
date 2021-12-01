<?php
  include '../src/database/credentials.php';
  echo DB_HOST;
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>template</title>
    <link href="assets/css/landingpage.css" rel="stylesheet">
    <?php include "../templates/head.php" ?>
  </head>

  <body>
    <!-- start navbar -->
      
    <div class="navbar">
      <?php include "../templates/navbar.php";?>
    </div>

    <!-- end navbar -->
    <!-- start main container -->
    <div class="image">
      <img src="assets/images/background.svg" alt="background">
    </div>
    <div class="container">
      <div><span class="line"></span></div>
      <div class="standard">Standard</div>
      <div class="premium">Premium</div>
      <div class="director">Director</div>
      <div class="select"></div>
      <div class="select"></div>
      <div class="select"></div>

    </div>
   
    <!-- end main container  -->
    
  </body>

</html>