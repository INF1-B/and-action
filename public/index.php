<?php
include '../src/database/credentials.php';
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
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->
  <div class="image-container">
    <img src="assets/images/logo.svg" alt="logo">
    <h1>Show your show</h1>
  </div> 
  <div class="container">
    <div class="row">
      <span class="line"></span>
    </div>
    <div class="row">

      <div class="subscription">
        <div class="standard">
          <div class="main">
            <h1>Standard</h1>
            <h2>&#8364;20,-</h2>
          </div>
          <div class="sub">
            <ul>
              <li><img src="./assets/images/check_mark.png" alt="checkmark"> Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
            </ul>
          </div>
        </div>
        <div class="premium">
          <div class="main">
            <h1>Premium</h1>
            <h2>&#8364;50,-</h2>
          </div>
          <div class="sub">
            <ul>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
            </ul>
          </div>
        </div>
        <div class="director">
          <div class="main">
            <h1>Director</h1>
          </div>
          <div class="sub">
            <ul>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
              <li>Lorem ipsum</li>
            </ul>
            <a class="button" href="#">Select</a>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- end main container  -->

</body>

</html>