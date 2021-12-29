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

if (!checkDatabaseLoggedIn($_SESSION['id'])) {
  header('Location: ./login.php');
}

checkAuthorization($_SESSION['rol'], array("Admin", "Director", "Watcher"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="./assets/css/userview.css">
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->

  <div class="container">
    <div class="movie">
      <iframe src="" title="placeholder" height="500vh" width="100%"></iframe>
    </div>
    <div class="container-comment-description">
      <div class="text-wrapper">
        <div class="description">
          <h1>Narcos: Mexico</h1>
          <p>
            lorem ipsum dolor sit amet lorem ipsum
            lorem ipsum dolor sit amet lorem ipsum
            lorem ipsum dolor sit amet lorem ipsum
            lorem ipsum dolor sit amet lorem ipsum
          </p>
          <div class="sub-description">
            <p><strong>Category:</strong></p>
            <p><strong>Author:</strong></p>
            <p><strong>Age:</strong></p>
            <p><strong>Film guide:</strong></p>
          </div>
        </div>
        <p class="movie-likes">
          <a href="#">
            <i class="fas fa-thumbs-up" style="font-size: 36px"></i>
          </a>
          <span> 120.231.41 </span>
        </p>
      </div>
      <div>
        <form>
          <div>
            <h2>Feedback</h2>
            <textarea id="feedback" name="feedback" rows="5" cols="70" placeholder="Type here your feedback"></textarea>
          </div>
          <div>
            <input type="submit" value="Submit Feedback" class="submit-feedback">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- end main container  -->

</body>

</html>