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

checkAuthorization($_SESSION['rol'], array("Admin", "Director"));

if (!checkDatabaseLoggedIn($_SESSION['id'])) {
  header('Location: ./login.php');
}

$movieId = isset($_GET['id']) && is_numeric($_GET['id']) ? filterInputGet($_GET['id'], "id") : 0;
$message = "";

$movieLikes = getMovieLikes($movieId);
$movie = getTableRecord("SELECT gebruiker.id as gebruikerId, film.id as filmId, film.beschrijving, film.titel, film.thumbnail_pad, film.geaccepteerd
                              FROM film
                              INNER JOIN gebruiker
                              ON film.gebruiker_id = gebruiker.id
                              WHERE film.id = ?", 
                           "i", 
                             array($movieId));
$movieComments = getTableRecordsFiltered("SELECT commentaar.id as commentId, commentaar.film_id, commentaar.gebruiker_id, commentaar.bericht, commentaar.tijdsstempel, gebruiker.gebruikersnaam, rol.naam as rol
                                               FROM commentaar 
                                               INNER JOIN gebruiker 
                                               ON commentaar.gebruiker_id = gebruiker.id 
                                               INNER JOIN rol 
                                               ON gebruiker.rol_id = rol.id
                                               WHERE commentaar.film_id = ?
                                               LIMIT 5", "i", array($movieId));
/* delete a comment ONLY if you are allowed to do so.
*
* Once a user presses the X button which can be done at a comment in the director-movie.php file (if any comments)
* the comment will be deleted. This will only be deleted if the user that is logged in has the same id as the user who originally uploaded the movie.
*
*/
if (isset($_GET['delete-comment']) && $_GET['delete-comment'] == "true" && isset($_GET['comment-id']) && is_numeric($_GET['comment-id'])) {
  $commentId = filterInputGet($_GET['comment-id'], "comment-id");
  if ($_SESSION['id'] == $movie['gebruikerId']) {
    executeQuery("DELETE FROM commentaar WHERE id = ?", "i", array($commentId));
    header("Location: director-movie.php?id=$movieId");
  } else {
    $message = messageGenerator("director-comment");
  }
}

/* delete a movie ONLY if you are allowed to do so.
*
* Once a user presses the 'Delete movie' button on director-movie.php, the movie will be deleted IF the user has the correct rights to do so.
* if the user fails to authorize correctly, an error message will popup
*
*/
if (isset($_GET['delete-movie']) && $_GET['delete-movie'] == "true" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  $userId = filterInputGet($_GET['user-id'], "user-id");
  if ($_SESSION['id'] == $movie['gebruikerId']) {
    executeQuery("DELETE FROM genre_film WHERE film_id = ?", "i", array($movie['filmId']));
    executeQuery("DELETE FROM thumb_up WHERE film_id = ?", "i", array($movie['filmId']));
    executeQuery("DELETE FROM commentaar WHERE film_id = ?", "i", array($movie['filmId']));
    executeQuery("DELETE FROM film_kijkwijzer_geschiktheid WHERE film_id = ?","i", array($movie['filmId']));
    executeQuery("DELETE FROM laatst_bekeken WHERE film_id = ?", "i", array($movie['filmId']));
    executeQuery("DELETE FROM film WHERE id = ?", "i", array($movie['filmId']));
    header("Location: director-my-movie.php");
  } else {
    $message = messageGenerator("director-comment");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="./assets/css/director-movie-specific.css">
  <link rel="stylesheet" href="./assets/css/thumbnail-display.css">
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->
  <?php if (array_key_exists("titel", $movie) && $_SESSION['id'] == $movie['gebruikerId']): ?>
  <div class="container container-movie-specific">
    <div class="text-wrapper">
      <div class="description">
        <?php echo $movie['geaccepteerd'] ? "<p class=\"text-left success\"> Movie is verified! </p>" : "<p class=\"text-left error\"> Movie is unverified </p>"; ?>
        <h1><?php echo $movie["titel"]?></h1>
        <p>
          <?php echo $movie['beschrijving'] ?>
        </p>
        <p class="movie-likes">
          <a>
            <i class="fas fa-thumbs-up" style="font-size: 36px;"></i>
          </a>
          <span> <?php echo $movieLikes['num'] ?> </span>
        </p>
      </div>
      <div class="feedback">
        <h2>Feedback</h2>
        <?php
        for ($comment = 0; $comment < count($movieComments); $comment++) {
          echo "
            <div class=\"comment-wrapper\"> 
              <p>". 
                $movieComments[$comment]["bericht"]
              ."<br>
              <span class=\"comment-author\"> 
                <small> - 
                <strong>".
                $movieComments[$comment]['gebruikersnaam'] . "
                </strong>"
                . " (".$movieComments[$comment]["rol"].") " .
                $movieComments[$comment]['tijdsstempel'] .
                "  </small>
              </span>
              </p>
              <div class=\"delete-comment\">
                  <a href=\"?delete-comment=true&comment-id=". $movieComments[$comment]["commentId"] . "&id=" . $movieComments[$comment]["film_id"] . "\"> X </a>
              </div> 
            </div>";
        }
        ?>
        <?php echo $message ?>
      </div>
    </div>

    <div class="movie-wrapper">
      <div class="movie">
        <a href="view-movie.php?id=<?php echo $movieId ?>">
          <img src="<?php echo $movie['thumbnail_pad']?>" alt="<?php echo $movie['titel']?>">
        </a>
        <div class="form-delete-movie">
          <a width="400px" height="600px"
            href="?delete-movie=true&user-id=<?php echo $_SESSION['id'] ?>&id=<?php echo $movie["filmId"] ?>"
            class="delete-movie">
            Delete movie
          </a>
        </div>
      </div>
    </div>
    <?php else: ?>
    <div class="container">
      <h1 style="text-align: center; color: white;">
        Your movie could not be found! This is probably an invalid movie, or you don't have the correct permissons. <br> Please continue your search <a style="color: #F9B354" href="homepage.php">
          here </a>
      </h1>
    </div>
    <?php endif ?>
  </div>

  <!-- end main container  -->
  <?php include('../templates/footer.php') ?>
</body>

</html>