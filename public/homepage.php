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

if (!checkDatabaseLoggedIn($_SESSION['id'])) {
  header('Location: ./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" type="text/css" href="../public/assets/css/homepage.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/filter.css">
  <link rel="stylesheet" type="text/css" href="../public/assets/css/thumbnail-display.css">
</head>

<body>
  <?php $movies = getMovies() ?>
  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <?php include "../templates/filter.php"; ?>

  <div class="container container-movies">

    <!--Recently watched -->
    <div class="upper">
      <h1>Movies</h1>
      <button id="filter" type="button">Filter</button>
    </div>



    <?php
    for ($row = 0; $row < 1; $row++) {
      echo "<div class=\"movie-row\">";
      for ($movie = 0; $movie < count($movies); $movie++) {
        echo "
                <div class=\"movie\">
                  <a href=\"#\">
                    <div class=\"thumbnail\" title=" . $movies[$movie]["titel"] . " style=\"background-image:url('" . $movies[$movie]["thumbnail_pad"] . "')\">
                    </div>
                    <p> " . $movies[$movie]["titel"] . " </p>
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