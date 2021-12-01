<?php
include '../src/database/credentials.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>template</title>
  <?php include "../templates/head.php"?>
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php";?>
    <link rel="stylesheet" href="assets/css/director-movie-specific.css">
  </div>

  <!-- end navbar -->
  <!-- start main container -->

  <div class="container container-movie-specific">

    <div class="text-wrapper">
      <div class="description">
        <h1>Narcos: Mexico</h1>
        <p> 
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
          lorem ipsum dolor sit amet lorem ipsum
        </p>
        <p class="movie-likes"> 
          <a href="#">
            <i class="fas fa-thumbs-up" style="font-size: 36px;"></i>
          </a>
          <span> 120.231.41 </span>
        </p>
      </div>
      <div class="feedback">
        <h2>Feedback</h2>
        <?php
          for ($comment = 0; $comment < 2; $comment++) {
            echo "
            <div class=\"comment-wrapper\"> 
              <p> 
              lorem ipsum dolor sit amet lorem ipsum
              lorem ipsum dolor sit amet lorem ipsum
              lorem ipsum dolor sit amet lorem ipsum
              lorem ipsum dolor sit amet lorem ipsum
              <br>
              <span class=\"comment-author\"> 
                <small>
                
                - user
                
                </small>
              </span>
              </p>
              <div class=\"delete-comment\">
                  <a href=\"#\">X</a>
              </div> 
            </div>";
          }
        ?>
      </div>
    </div>

    <div class="movie-wrapper">
      <a href="#">
        <div class="movie">
          <img src="https://m.media-amazon.com/images/M/MV5BZmFkMzc2NTctN2U1Ni00MzE5LWJmMzMtYWQ4NjQyY2MzYmM1XkEyXkFqcGdeQXVyNTIzOTk5ODM@._V1_.jpg" alt="movie-title">
        </div>
      </a>
      <div class="form-delete-movie"> 
        <form method="post"> 
          <button class="delete-movie" type="submit" name="delete-movie"> Delete This movie </button> 
        </form>
      </div>
    </div>
  </div>

  <!-- end main container  -->

</body>

</html>