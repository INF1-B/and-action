<?php
  include '../src/database/credentials.php';
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>And Action</title>
    <link rel="stylesheet" href="./assets/css/thumpnail-display.css"/>
    <?php include "../templates/head.php" ?>
  </head>

  <body>
    <!-- start navbar -->

    <div class="navbar">
      <?php include "../templates/navbar.php";?>
    </div>

    <!-- end navbar -->
    <!-- start main container -->

    <div class="container container-movies">
    <h1>Search: <span>Documentary</span></h1>        
   
   <?php
    for($row=0; $row < 2; $row++){
      echo "<div class=\"movie-row\">";
      for($movie = 0; $movie < 6; $movie++){
        echo "
            <div class=\"movie\">
              <a href=\"#\">
                <div class=\"thumbnail\"> </div>
                <p>The Elephant queen</p>
              </a>
            </div>
        ";
      }
      echo "</div>";
    }
    
    ?>
  
    <!-- end main container  -->
    <!-- start footer -->

    <div class="footer">
      <?php include "../templates/footer.php";?>
    </div>
    <!-- end footer -->
    
  </body>

</html>