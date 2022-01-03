<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <link href="assets/css/landingpage.css" rel="stylesheet">
  <?php include "../templates/head.php" ?>
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <header class="container">
      <div class="row">
        <div class="nav_logo">
          <img src="../public/assets/img/logo.png" alt="Logo And action" class="logo">
        </div>
        <ul class="nav_list">
          <li class="nav_list_item"><a class="nav_link" href="../public/index.php">Home</a></li>
          <li class="nav_list_item"><a class="nav_link" href="../public/login.php">Login</a></li>
          <li class="nav_list_item"><a class="nav_button" href="../public/signUp.php">Sign up</a></li>
        </ul>
      </div>
      <div class="row">
        <span class="line"></span>
      </div>
    </header>
  </div>

  <!-- end navbar -->
  <!-- start main container -->
  <div class="image-container">
    <div class="container">
      <img src="assets/images/logo.svg" alt="logo">
      <h1>Show your show!</h1>
    </div>
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
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas cross fa-times"></i>&nbsp;Lorem ipsum</li>
              <li><i class="fas cross fa-times"></i>&nbsp;Lorem ipsum</li>
              <li><i class="fas cross fa-times"></i>&nbsp;Lorem ipsum</li>
            </ul>
            <a class="button" href="signup.php?subscription=standard">Select</a>
          </div>
        </div>
        <div class="premium">
          <div class="main">
            <h1>Premium</h1>
            <h2>&#8364;50,-</h2>
          </div>
          <div class="sub">
            <ul>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
            </ul>
            <a class="button" href="signup.php?subscription=premium">Select</a>
          </div>
        </div>
        <div class="director">
          <div class="main">
            <h1>Director</h1>
          </div>
          <div class="sub">
            <ul>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
              <li><i class="fas fa-check"></i>Lorem ipsum</li>
            </ul>
            <a class="button" href="signup.php?subscription=director">Select</a>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- end main container  -->
  <?php include('../templates/footer.php') ?>
</body>

</html>