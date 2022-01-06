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

$movie = array();
$movieId = isset($_GET['id']) && is_numeric($_GET['id']) ? filterInputGet($_GET['id'], "id") : 0;

if (isset($_GET['approve']) && $_GET['approve'] == "true" && isset($_GET['id']) && is_numeric($_GET['id'])){
  $movie = getMovie($movieId, 0);
}

if (isset($_GET['approve']) && $_GET['approve'] == "true" && count($movie) > 0 && $movieId > 0 && isset($_GET['button']) && $_GET['button'] == "clicked"){
  executeQuery("UPDATE film SET geaccepteerd = 1 WHERE id = ?", "i", array($movieId));
  header("Location: admin-movie.php?id=$_GET[id]");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <link rel="stylesheet" href="./assets/css/admin-approve_warning.css">
  <?php include "../templates/head.php" ?>
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->
  <?php if (count($movie) > 0): ?>
  <div class="container">
    <div class="approve_container">
      <h1 class="approve_title">Are you sure?</h1>
      <p class="approve_subtitle">You are about to approve: <a class="approve_link"
          href="admin-movie.php?id=<?php echo $movie['id']?>"><?php echo $movie['titel']?></a>
      </p>
      <div class="button_container">
        <a onclick="window.alert('Movie is now verified!')"
          href="?approve=true&button=clicked&id=<?php echo $movie['id']?>" class="approve button">Approve</a>
        <a href="javascript:history.back()" class="cancel button">Cancel</a>
      </div>
    </div>
  </div>
  <?php else: ?>
  <div class="container">
    <h1 style="text-align: center; color: white;">
      This movie could not be found! This is probably because the movie does not exist, or has already been approved.
      <br>
      <a style="color: #F9B354" href="javascript:history.back()">
        return
      </a>
    </h1>
  </div>
  <?php endif; ?>
  <!-- end main container  -->
  <?php include('../templates/footer.php') ?>
</body>

</html>