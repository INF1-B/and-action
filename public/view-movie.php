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
$message = "";
$movieId = isset($_GET['id']) && is_numeric($_GET['id']) ? filterInputGet($_GET['id'], "id") : 0;

$movieDetails = getMovie($movieId, "1");
$movieLikes = getMovieLikes($movieId);

if (isset($_GET['updateLikes']) && $_GET['updateLikes'] == "true" && isset($_GET['user-id']) && isset($_GET['id']) && is_numeric($_GET['user-id']) && is_numeric($_GET['id']) && !empty($movieDetails)) {
  likeMovie($_GET['user-id'], $_GET["id"]);
  header("Location: view-movie.php?id=$movieId");
}

if (isset($_GET['submit-feedback'])) {
  if (isset($_GET['feedback']) && strlen($_GET['feedback']) > 10 && strlen($_GET['feedback']) < 990){
    if (isset($_GET['user-id']) && isset($_GET['id']) && is_numeric($_GET['user-id']) && is_numeric($_GET['id'])){
        $message = messageGenerator("feedback-success");
        addComment($_GET['id'], $_GET['user-id'], $_GET['feedback']);
    } else {
      $message = messageGenerator("feedback-failure-id");
    }
  } else {
    $message = messageGenerator("feedback-failure-length");
  } 
} 

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
  <?php if ($_SESSION['abonnement_eind'] > date('Y-m-d H:i:s') && isset($_GET['id']) && is_numeric($_GET['id']) && $_SESSION['geverifieerd'] && count($movieDetails) > 0): ?>
  <div class="container">
    <?php if ($_SESSION['abonnement'] == "Premium" || $_SESSION['abonnement'] == "Director") : // good movie quality
      ?>
    <div class="movie">
      <video controls width="100%" height="850vh">
        <source src="<?php echo $movieDetails['pad'] ?>" type="video/mp4">
      </video>
    </div>
    <?php else :  // bad movie quality 


    ?>

    <div class="movie">
      <video controls width="100%" height="850vh">
        <source src="<?php echo $movieDetails['pad'] ?>" type="video/mp4">
      </video>
    </div>
    <?php endif ?>
    <div class="container-comment-description">
      <div class="text-wrapper">
        <div class="description">
          <h1> <?php echo $movieDetails['titel'] ?> </h1>
          <p>
            <?php echo $movieDetails['beschrijving'] ?>
          </p>
          <div class="sub-description">
            <p><strong>Author:</strong> <?php echo $movieDetails['gebruikersnaam'] ?> </p>
            <p><strong>Age rating:</strong> <?php echo $movieDetails['kijkwijzer_leeftijd'] ?> </p>
            <p><strong>Film guides(s):</strong> <?php echo $movieDetails['kijkwijzer'] ?> </p>
            <p><strong>Genre(s):</strong> <?php echo $movieDetails['genre'] ?> </p>
          </div>
        </div>
        <p class="movie-likes">
          <a onclick="window.alert('If not liked before, your like will be added to this movie!')"
            href="?id=<?php echo $movieDetails["id"]?>&updateLikes=true&user-id=<?php echo $_SESSION['id'] ?>">
            <i class="fas fa-thumbs-up" style="font-size: 36px"></i>
          </a>
          <span> <?php echo $movieLikes['num'] ?> </span>
        </p>
      </div>
      <div>
        <form method="GET" action="<?php $_SERVER['PHP_SELF']?>">
          <div>
            <h2>Feedback</h2>
            <textarea id="feedback" name="feedback" rows="5" cols="70" placeholder="Type your feedback"></textarea>
          </div>
          <div>
            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
            <input type="hidden" name="user-id" value="<?php echo $_SESSION['id']?>">
            <input type="submit" name="submit-feedback" value="submit" class="submit-feedback">
          </div>
        </form>
        <p>
          <?php 
          if (isset($message)){
            echo $message;
          }
         ?>
        </p>
      </div>
    </div>
  </div>
  <?php else:?>
  <div class="container">
    <h1 style="text-align: center"> Please check whether your subscription is active, your account is verified and if
      you have selected a valid movie! </h1>
  </div>
  <?php endif ?>
  <!-- end main container  -->
  <?php include('../templates/footer.php') ?>
</body>

</html>