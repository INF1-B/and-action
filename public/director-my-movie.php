<?php
include('../utils/authentication.php');
include '../src/database/credentials.php';

checkLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <link rel="stylesheet" href="./assets/css/thumpnail-display.css">
  <?php include "../templates/head.php" ?>
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php";?>
  </div>

  <!-- end navbar -->
  <div class="container container-movies">

    <!--Recently watched -->
    <div class="upper">
      <h1>My Movies</h1>
    </div>



    <?php 
    for ($row=0; $row < 1; $row++) { 
        echo "<div class=\"movie-row\">";
        for ($movie=0; $movie < 6; $movie++) { 
          echo "
          <div class=\"movie\">
            <a href=\"#\">
              <div class=\"thumbnail\" title=\"test\">
              </div>
              <p> scary moveh </p>
            </a>
          </div>
          ";
        }
        echo "</div>";
      }
?>

    <h1>Under review</h1>

    <?php 
    for ($row=0; $row < 1; $row++) { 
        echo "<div class=\"movie-row\">";
        for ($movie=0; $movie < 6; $movie++) { 
          echo "
          <div class=\"movie\">
            <a href=\"#\">
              <div class=\"thumbnail\" title=\"test\">
              </div>
              <p> scary moveh </p>
            </a>
          </div>
          ";
        }
        echo "</div>";
      }
?>



    <!-- end main container  -->

</body>

</html>