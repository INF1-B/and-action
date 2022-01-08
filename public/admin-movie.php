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

$movieId = isset($_GET['id']) && is_numeric($_GET['id']) ? filterInputGet($_GET['id'], "id") : 0;
$movie = getMovie($movieId);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="./assets/css/admin-approve.css">
  <link rel="stylesheet" href="./assets/css/thumbnail-display.css">
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->
  <?php if (array_key_exists("titel", $movie)): ?>
  <div class="container container-movie-specific">

    <div class="text-wrapper">
      <div class="description">
        <?php echo $movie["geaccepteerd"] ? "<p class=\"text-left success\"> Movie is verified! </p>" : "<p class=\"text-left error\"> Movie is unverified </p>"; ?>
        <h1><?php echo $movie['titel']?></h1>
        <p>
          <?php echo $movie['beschrijving']?>
        </p>
        <p class="category">
          <strong>
            Genre(s): 
          </strong>
          <?php echo $movie['genre']?>
        </p>
        <p class="author">
          <strong>
            Author:
          </strong>
          <a class="author-link" href="#"> 
            <?php echo $movie['gebruikersnaam'] ?>
          </a>
        </p>
        <video controls>
          <source src="<?php echo $movie['pad']?>" type="video/mp4">
        </video>
      </div>
    </div>
    <div class="movie-wrapper">
      <div class="movie">
        <a href="#">
          <img
            src="<?php echo $movie['thumbnail_pad']?>"
            alt="<?php echo $movie['titel']?>">
        </a>
      </div>
      <div class="form-movie">
        <a href="admin-approve.php?approve=true&id=<?php echo $movie['id']?>" class="approve-movie">
          Approve
        </a>
        <a href="admin-dissaprove.php?approve=false&id=<?php echo $movie['id']?>" class="dissaprove-movie">
          Disapprove
        </a>
      </div>
    </div>
  </div>
  <?php else : ?>
  <div class="container">
    <h1 style="text-align: center; color: white;">
      This movie could not be found! This is probably because the movie does not exist, or has already been approved.
      <a style="color: #F9B354" href="javascript:history.back()">
        Return 
      </a>
    </h1>
  </div>
  <?php endif ?>
  <!-- end main container  -->
  <?php include('../templates/footer.php') ?>
</body>

</html>