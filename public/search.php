<?php
  include '../src/database/credentials.php';
  echo DB_HOST;
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Search</title>
    <link rel="stylesheet" href="./assets/css/searchStyle.css"/>
    <?php include "../templates/head.php" ?>
  </head>

  <body>
    <!-- start navbar -->

    <div class="navbar">
      <?php include "../templates/navbar.php";?>
    </div>

    <!-- end navbar -->
    <!-- start main container -->

    <div class="container container-search-movies">
    <h1>Search: <span>Documentary</span></h1>        
   
   <?php
    for($row=0; $row < 2; $row++){
      echo "<div class=\"movie-row\">";
      for($movie = 0; $movie < 6; $movie++){
        echo "
            <div class=\"movieAndTitle\">
              <a href=\"#\">
                <div class=\"moviePicture\"> </div>
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