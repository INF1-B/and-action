<?php
  include '../src/database/credentials.php';
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>And Action</title>
    <link rel="stylesheet" href="../public/assets/css/my-movies-director.css">
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

      <h1> Under review </h1>
      <?php
          for ($row=0; $row < 1; $row++) { 
            echo "<div class=\"movie-row\">";
            for ($movie=0; $movie < 6; $movie++) { 
              echo "
              <div class=\"movie\">
                <a href=\"#\">
                  <div class=\"thumbnail\" title=\"test\">
                  </div>
                  <p> Movie title </p>
                </a>
              </div>
              ";
            }
            echo "</div>";
          }
        ?>
    </div>

    <!-- end main container  -->
    
  </body>

</html>