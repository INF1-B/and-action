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

$movies = getUnverifiedMovies();

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
      <h1>Under review</h1>
    </div>

    <?php
    for ($row = 0; $row < 1; $row++) {
      echo "<div class=\"movie-row\">";
      for ($movie = 0; $movie < count($movies); $movie++) {
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
      echo "</div>";
    }
    ?>

    <!-- end main container  -->
    <?php include('../templates/footer.php') ?>
</body>

</html>