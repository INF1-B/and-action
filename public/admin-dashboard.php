<!DOCTYPE html>
<html lang="en">

<head>
    <title>And action</title>
    <?php include "../templates/head.php" ?>
    <link rel="stylesheet" href="./assets/css/thumpnail-display.css">
</head>

<body>
    <!-- start navbar -->

    <div class="navbar">
        <?php include "../templates/navbar.php"; ?>
    </div>

    <!-- end navbar -->
    <div class="container container-movies">

<!--Recently watched -->
<div class="upper">
    <h1>Under review</h1>
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

<!-- end main container  -->

</body>

</html>