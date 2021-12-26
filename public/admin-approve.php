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
  <link rel="stylesheet" href="./assets/css/approve_warning.css">
  <?php include "../templates/head.php" ?>
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->

  <div class="container">
    <div class="approve_container">
      <h1 class="approve_title">Are you sure?</h1>
      <p class="approve_subtitle">You are about to approve: <a class="approve_link" href="#">Ron's gone wrong</a></p>
      <div class="button_container">
        <a href="#" class="approve button">Approve</a>
        <a href="#" class="cancel button">Cancel</a>
      </div>
    </div>
  </div>

  <!-- end main container  -->
</body>

</html>