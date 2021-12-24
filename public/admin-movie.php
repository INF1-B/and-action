<?php 
  // imports
  require_once("../utils/authentication.php");
  require_once("../utils/database.php");
  require_once("../utils/filter.php");
  require_once("../utils/movies.php");
  require_once("../utils/functions.php");
?>

<?php
  checkSessionLoggedIn();
  
  if(!checkDatabaseLoggedIn($_SESSION['id'])){
    header('Location: ./login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <?php include "../templates/head.php"?>
  <link rel="stylesheet" href="./assets/css/admin-approve.css">
  <link rel="stylesheet" href="./assets/css/thumbnail-display.css">
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php";?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->

  <div class="container container-movie-specific">

    <div class="text-wrapper">
      <div class="description">
        <h1>Scary Movie</h1>
        <p>
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
        </p>
        <p class="category">
          <strong>
            Category:
          </strong>
          Comedy
        </p>
        <p class="author">
          <strong>
            Author:
          </strong>
          <a class="author-link" href="#"> John Doe </a>
        </p>
        <video autoplay>
          <source src="movie.mp4" type="video/mp4">
        </video>
      </div>
    </div>
    <div>
      <div class="movie-wrapper">
        <a href="#">
          <div class="movie">
            <img
              src="https://m.media-amazon.com/images/M/MV5BZmFkMzc2NTctN2U1Ni00MzE5LWJmMzMtYWQ4NjQyY2MzYmM1XkEyXkFqcGdeQXVyNTIzOTk5ODM@._V1_.jpg"
              alt="movie-title">
          </div>
        </a>
        <div class="form-movie">
          <a href="#" class="approve-movie">
            Approve
          </a>
          <a href="#" class="dissaprove-movie">
            Disapprove
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- end main container  -->

</body>

</html>