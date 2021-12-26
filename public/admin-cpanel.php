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
    <title>And Action - control panel</title>
    <?php include "../templates/head.php" ?>
  </head>

  <body>
    <!-- start navbar -->

    <div class="navbar">
      <?php include "../templates/navbar.php";?>
    </div>

    <!-- end navbar -->
    <!-- start main container -->

    <div class="container">

      <div></div>
      <div></div>

    </div>

    <!-- end main container  -->
    
  </body>

</html>