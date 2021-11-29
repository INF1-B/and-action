<?php
  include '../src/database/credentials.php';
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>template</title>
    <?php include "../templates/head.php" ?>
  </head>

  <body>
    <!-- start navbar -->

    <div class="navbar">
      <?php include "../templates/navbar.php";?>
    </div>

    <!-- end navbar -->
    <!-- start main container -->

    <div class="container container-my-movie-director">
      <h1>My Movies</h1>
      <div class="movie-row"> 
        <?php 
          for ($i=0; $i < 5; $i++) { 
            echo "<div class=\"movie\"> 
            </div>";
          }
        ?>
      </div>
      <h1> Under review </h1>
      <div class="movie-row"> 
        <?php 
          for ($i=0; $i < 2; $i++) { 
            echo "<div class=\"movie\"> 
            </div>";
          }
        ?>
      </div>
    </div>

    <!-- end main container  -->
    
  </body>

</html>