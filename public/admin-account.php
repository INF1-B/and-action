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

$error = '';

if (isset($_GET['approve-user'])) {
  $input["id"] = filterInputGet($_GET["approve-user"], "approve-user");

  $user = getTableRecord('SELECT * FROM gebruiker WHERE id = ?', 'i', array($input['id']));
  if (!isset($user['ERROR'])) {
    if ($user['geverifieerd'] == 0) {
      executeQuery('UPDATE gebruiker SET geverifieerd = ? WHERE id = ?', 'ii', array(1, $input['id']));
    }
  } else {
    $error = 'User does not exist';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <link rel="stylesheet" href="./assets/css/account-admin.css">
  <link rel="stylesheet" href="./assets/css/thumbnail-display.css">
  <?php include "../templates/head.php" ?>
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->

  <div class="container account">
    <div class="row">
      <div class="approved_movies">
        <h1 class="title">Approved movies</h1>
        <div class="movies">
          <div class="movie">
            <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
            <h2 class="movie_title">Boss baby</h2>
          </div>
          <div class="movie">
            <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
            <h2 class="movie_title">Boss baby</h2>
          </div>
          <div class="movie">
            <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
            <h2 class="movie_title">Boss baby</h2>
          </div>
        </div>
      </div>
      <div class="account_container">
        <div class="account_card">
          <h2 class="account_name">John doe</h2>
          <p class="account_info"><span class="bold">Role:</span> Producer</p>
          <p class="account_info"><span class="bold">Email address:</span> johnDoe@mail.com</p>
          <p class="account_info"><span class="bold">Status:</span> verified</p>
        </div>
        <div class="button_container">
          <!-- ID moet nog dynamisch -->
          <a href="./admin-account.php?approve-user=22" class="button">Approve user</a>
          <?php
          if ($error) {
          ?>
            <p class="error"><?php echo $error ?></p>

          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="review_container">
        <h1 class="title">Waiting for review</h1>

        <div class="movies">
          <div class="movie">
            <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
            <h2 class="movie_title">Boss baby</h2>
          </div>
          <div class="movie">
            <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
            <h2 class="movie_title">Boss baby</h2>
          </div>
          <div class="movie">
            <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
            <h2 class="movie_title">Boss baby</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="disapproved_container">
        <h1 class="title">Disapproved movies</h1>
        <p>There ara none movies disapproved</p>
        <!-- <div class="movies">
          <div class="movie">
            <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
            <h2 class="movie_title">Boss baby</h2>
          </div>
          <div class="movie">
            <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
            <h2 class="movie_title">Boss baby</h2>
          </div>
          <div class="movie">
            <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
            <h2 class="movie_title">Boss baby</h2>
          </div>
        </div> -->
      </div>
    </div>
  </div>
  <!-- end main container  -->
  <?php include('../templates/footer.php') ?>
</body>

</html>
