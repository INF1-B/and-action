<?php
  include '../src/database/credentials.php';
  echo DB_HOST;
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Homepage</title>
    <link rel="stylesheet" href="./assets/homepageStyle.css"/>
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
    <h1>Search: <span>Documentary</span></h1>        
      <div class="movies">
        <div class="movieAndTitle">
          <div class="moviePicture">
            <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>The Elephant queen</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Soldaat zonder wapen</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>
        <div class="movieAndTitle">
          <div class="moviePicture">
          <img src="./assets/moviePic.jpeg" alt="Movie Poster">
          </div>
          <div class="movieTitle">
            <p>Movie title</p>
          </div>
        </div>

      </div>
      <div></div>

    </div>

    <!-- end main container  -->
    <!-- start footer -->

    <div class="footer">
      <?php include "../templates/footer.php";?>
    </div>
    <!-- end footer -->
    
  </body>

</html>