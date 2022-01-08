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

checkAuthorization($_SESSION['rol'], array("Admin"));

if (!checkDatabaseLoggedIn($_SESSION['id'])) {
  header('Location: ./login.php');
}

$movies = getMovies();
$unreviewedMovies = getUnreviewedMovies();
$dissaprovedMovies = getDissaprovedMovies();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="./assets/css/thumbnail-display.css">
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
      <h1>Approved movies</h1>
    </div>

    <?php
    for ($row = 0; $row < 1; $row++) {
      echo "<div class=\"movie-row\">";
      for ($movie = 0; $movie < count($movies); $movie++) {
        if ($movies[$movie]["geaccepteerd"]){
          echo "
                  <div class=\"movie\">
                    <a href=" . "admin-movie.php?id=" . $movies[$movie]["id"] . ">
                      <div class=\"thumbnail\" title=" . $movies[$movie]["titel"] . " style=\"background-image:url('" . $movies[$movie]["thumbnail_pad"] . "')\">
                      </div>
                      <p> " . $movies[$movie]["titel"] . " </p>
                    </a>
                  </div>
                  ";
        }
      }
      echo "</div>";
    }
    ?>
    <div class="upper mt">
      <h1>Waiting for review</h1>
    </div>

    <?php
    for ($row = 0; $row < 1; $row++) {
      echo "<div class=\"movie-row\">";
      for ($movie = 0; $movie < count($unreviewedMovies); $movie++) {
        echo "
                <div class=\"movie\">
                  <a href=" . "admin-movie.php?id=" . $unreviewedMovies[$movie]["id"] . ">
                    <div class=\"thumbnail\" title=" . $unreviewedMovies[$movie]["titel"] . " style=\"background-image:url('" . $unreviewedMovies[$movie]["thumbnail_pad"] . "')\">
                    </div>
                    <p> " . $unreviewedMovies[$movie]["titel"] . " </p>
                  </a>
                </div>
                ";
      }
      echo "</div>";
    }
    ?>
    <div class="upper mt">
      <h1>Dissaproved movies</h1>
    </div>

    <?php
    for ($row = 0; $row < 1; $row++) {
      echo "<div class=\"movie-row\">";
      for ($movie = 0; $movie < count($dissaprovedMovies); $movie++) {
        echo "
              <div class=\"movie\">
                <a href=" . "admin-movie.php?id=" . $dissaprovedMovies[$movie]["id"] . ">
                  <div class=\"thumbnail\" title=" . $dissaprovedMovies[$movie]["titel"] . " style=\"background-image:url('" . $dissaprovedMovies[$movie]["thumbnail_pad"] . "')\">
                  </div>
                  <p> " . $dissaprovedMovies[$movie]["titel"] . " <br></p>
                  <p style=\"margin-top: 10px\"> last reviewed:<br> <span style=\"color: red\">". $dissaprovedMovies[$movie]["tijdsstempel"] ."</span></p>
                </a>
              </div>
              ";
      }
      echo "</div>";
    }
    ?>
    <!-- end main container  -->
    <?php include('../templates/footer.php') ?>
</body>

</html>