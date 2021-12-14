
<!DOCTYPE html>
<html lang="en">

<head>
    <title>And Action</title>
    <?php include "../templates/head.php" ?>
    <link rel="stylesheet" type="text/css" href="../public/assets/css/homepage.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/filter.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/thumpnail-display.css">
    <script src="https://kit.fontawesome.com/e187230ac2.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="navbar">
        <?php include "../templates/navbar.php";?>
    </div>

    <?php include "../templates/filter.html"; ?>

    <div class="container container-movies">

        <!--Recently watched -->
        <div class="upper">
            <h1>Recently watched</h1>
            <button id="filter" type="button">Filter</button>
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

        <h1>Documentary</h1>

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

    </div>
    <script src="./assets/js/filter.js"></script>
    <!-- end main container  -->
  </body>

</html>