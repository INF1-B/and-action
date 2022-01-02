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

$movieLikes = getMovieLikes($movieId);
$movie = getTableRecord("SELECT id, beschrijving, titel, thumbnail_pad
                              FROM film
                              WHERE id = ?", 
                           "i", 
                             array($movieId));
$movieComments = getTableRecordsFiltered("SELECT commentaar.film_id, commentaar.gebruiker_id, commentaar.bericht, commentaar.tijdsstempel, gebruiker.gebruikersnaam, rol.naam as rol
                                               FROM commentaar 
                                               INNER JOIN gebruiker 
                                               ON commentaar.gebruiker_id = gebruiker.id 
                                               INNER JOIN rol 
                                               ON gebruiker.rol_id = rol.id
                                               WHERE commentaar.film_id = ?", "i", array($movieId));
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

  <div class="container container-movie-specific">

    <div class="text-wrapper">
      <div class="description">
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
                  <a href=\"?delete-comment=true&user-id=". $movieComments[$comment]["gebruiker_id"] . "&id=" . $movieComments[$comment]["film_id"] . "\"> X </a>
              </div> 
            </div>";
        }
        ?>
      </div>
    </div>

    <div class="movie-wrapper">
      <a href="?id=<?php echo $movieId ?>">
        <div class="movie" >
          <img width="400px" height="600px" src="<?php echo $movie['thumbnail_pad']?>" alt="<?php echo $movie['titel']?>">
        </div>
      </a>
      <div class="form-delete-movie">
        <a href="?delete-movie=true&user-id=<?php echo $_SESSION['id'] ?>&id=<?php echo $movie["id"] ?>" class="delete-movie">
          Delete movie
        </a>
      </div>
    </div>
  </div>

  <!-- end main container  -->

</body>

</html>