<?php
// imports
require_once("../utils/auth.php");
require_once("../utils/database.php");
require_once("../utils/filter.php");
require_once("../utils/movies.php");
require_once("../utils/functions.php");
?>

<?php
checkSessionLoggedIn();

checkAuthorization($_SESSION['rol'], array("Admin", "Director"));

if (!checkDatabaseLoggedIn($_SESSION['id'])) {
  header('Location: ./login.php');
}

?>

<?php $movies = getMoviesById($_SESSION['id']); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <link rel="stylesheet" href="./assets/css/thumbnail-display.css">
  <?php include "../templates/head.php" ?>
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
      <h1>My Movies</h1>
    </div>


    <?php
    for ($row = 0; $row < 1; $row++) {
      echo "<div class=\"movie-row\">";
      for ($movie = 0; $movie < count($movies); $movie++) {
        echo "
                <div class=\"movie\">
                  <a href=" . "director-movie.php?id=" . $movies[$movie]["id"] . ">
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



    <!-- end main container  -->

</body>

</html>