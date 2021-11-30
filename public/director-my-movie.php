<?php
  include '../src/database/credentials.php';
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>And Action</title>
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
          for ($i=0; $i < 2; $i++) { 
            echo "<div class=\"movie-row\">";
            for ($j=0; $j < 5; $j++) { 
              echo "
              <div class=\"movie\">
                <a href=\"#\">
                  <div>
                    <img src=\"\" alt=\"thumbnail\">
                  </div>
                  <p> Movie title </p>
                </a>
              </div>
              ";
            }
            echo "</div>";
          }
        ?>

      <h1> Under review </h1>
      <?php
          for ($i=0; $i < 3; $i++) { 
            echo "<div class=\"movie-row\">";
            for ($j=0; $j < 5; $j++) { 
              echo "
              <div class=\"movie\">
                <a href=\"#\">
                  <div>
                    <img src=\"\" alt=\"thumbnail\">
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