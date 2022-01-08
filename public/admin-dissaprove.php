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

$message = "";

if (isset($_GET['submit']) && isset($_GET['feedback'])) {
  $movieId = filterInputGet($_GET['id'], "id");
  if ($movieId > 0 && strlen($_GET['feedback']) > 10) {
    addComment($movieId, $_SESSION['id'], $_GET['feedback']);
    executeQuery("UPDATE film SET geaccepteerd = 0 WHERE id = ?", "i", array($movieId));
    header("Location: admin-movie.php?id=$_GET[id]");
  } else {
    $message = messageGenerator("admin-dissaprove-fail");
  }
} else if (isset($_GET['cancel'])) {
  header("Location: admin-movie.php?id=$_GET[id]");
}

$movie = array();
$movieId = isset($_GET['id']) && is_numeric($_GET['id']) ? filterInputTextGeneral($_GET['id']) : 0;

if (isset($_GET['approve']) && $_GET['approve'] == "false" && isset($_GET['id']) && is_numeric($_GET['id'])) {
  $movie = getMovie($movieId, 0);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="./assets/css/admin-dissaprove.css">
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->
  <?php if (count($movie) > 0) : ?>
    <div class="container dissaprovePageContainer">
      <div class="content">
        <span>Are you sure ?</span>
        <p>You are about to disapprove: <a class="linkDissaprovedVideo" href="admin-movie.php?id=<?php echo $movie['id'] ?>"><?php echo $movie['titel'] ?></a>
        <div class="formWrapper">
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
            <label for="reasonDissaprove">Reason</label>
            <textarea id="reasonDissaprove" name="feedback" rows="6" placeholder="Type here your reason why the movie is not approved"></textarea>
            <input type="hidden" value="<?php echo $movieId ?>" name="id">
            <input type="hidden" value="false" name="approve">
            <div class="submitButtons">
              <input type="submit" name="submit" id="approve" value="Submit">
              <input type="submit" name="cancel" id="cancel" value="Cancel">
            </div>
          </form>
          <?php echo $message ?>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class="container">
      <h1 style="text-align: center; color: white;">
        This movie could not be found! This is probably because the movie does not exist, or has already been approved.
        <br>
        <a style="color: #F9B354" href="javascript:history.back()">
          return
        </a>
      </h1>
    </div>
  <?php endif ?>
  <!-- end main container  --
  <?php include "../templates/footer.php"; ?>

</body>

</html>