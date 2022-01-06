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

checkAuthorization($_SESSION['rol'], array("Admin", "Director", "Watcher"));

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
  <?php 
  $movies = getMovies(); 
  $recWMovies = getRecentlyWatchedMovies($_SESSION['id']);
  $suggestedMovies = getSuggestedMovies($_SESSION['id']);

  ?>
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
                  <a href=" . "view-movie.php?id=" . $movies[$movie]["id"] . ">
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
    <!--Recently watched -->
    <div class="upper mt">
      <h1>Recently watched</h1>
    </div>

    <?php
    for ($row = 0; $row < 1; $row++) {
      echo "<div class=\"movie-row\">";
      for ($recWMovie = 0; $recWMovie < count($recWMovies); $recWMovie++) {
        echo "
              <div class=\"movie\">
                <a href=" . "view-movie.php?id=" . $recWMovies[$recWMovie]["id"] . ">
                  <div class=\"thumbnail\" title=" . $recWMovies[$recWMovie]["titel"] . " style=\"background-image:url('" . $recWMovies[$recWMovie]["thumbnail_pad"] . "')\">
                  </div>
                  <p> " . $recWMovies[$recWMovie]["titel"] . " </p>
                </a>
              </div>
              ";
      }
      echo "</div>";
    }
    ?>
    <?php if (count($suggestedMovies) > 0) :?>
    <div class="upper mt">
      <p>
      <h1>Suggestions</h1><br></p>
    </div>
    <p> Since you recently watched movies in the genre(s) <?php  echo $suggestedMovies[0]["genres"] ?> </p>

    <?php
    for ($row = 0; $row < 1; $row++) {
      echo "<div class=\"movie-row\">";
      for ($sugMovie = 0; $sugMovie < count($suggestedMovies); $sugMovie++) {
        echo "
              <div class=\"movie\">
                <a href=" . "view-movie.php?id=" . $suggestedMovies[$sugMovie]["id"] . ">
                  <div class=\"thumbnail\" title=" . $suggestedMovies[$sugMovie]["titel"] . " style=\"background-image:url('" . $suggestedMovies[$sugMovie]["thumbnail_pad"] . "')\">
                  </div>
                  <p> " . $suggestedMovies[$sugMovie]["titel"] . " </p>
                </a>
              </div>
              ";
      }
      echo "</div>";
    }
    ?>
    <?php endif ?>
  </div>
  <script src="./assets/js/filter.js"></script>
  <!-- end main container  -->
  <?php include('../templates/footer.php') ?>
</body>

</html>