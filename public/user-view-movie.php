<?php
include '../src/database/credentials.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action</title>
  <?php include "../templates/head.php"?>
  <link rel="stylesheet" href="./assets/css/director-movie-specific.css">
  <link rel="stylesheet" href="./assets/css/styleupload.css">
  <link rel="stylesheet" href="./assets/css/thumpnail-display.css">
  <link rel="stylesheet" href="./assets/css/userview.css">
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php";?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->

  <div class="container container-movie-specific">
    <div class="text-wrapper">
        <div class="movie">
            <iframe src="" title="placeholder" height="480" width="720"></iframe>
        </div>
        <div class="description">
            <h1>Narcos: Mexico</h1>
             <p> 
             lorem ipsum dolor sit amet lorem ipsum
             lorem ipsum dolor sit amet lorem ipsum
             lorem ipsum dolor sit amet lorem ipsum
             lorem ipsum dolor sit amet lorem ipsum
             </p>
             <div class="subdescription">
                <p><strong>Category:</strong></p>
                <p><strong>Author:</strong></p>
                <p><strong>Age:</strong></p>
                <p><strong>Film guide:</strong></p>
            </div>
        </div>
        <form>
            <div class="spaceupload">
                <label for="Feedback" class="spacetextupload">Feedback</label>
                <textarea id="Feedback" name="Feedback" rows="5" cols="70" placeholder="Type here your feedback"></textarea>
            </div>        
            <div class="spaceupload">         
                <input type="submit" value="Submit Feedback" class="supload">
            </div>
        </form>  
    </div>
    <div class="movie-wrapper">
      <a href="#">
        <div class="movie">
          <img src="https://m.media-amazon.com/images/M/MV5BZmFkMzc2NTctN2U1Ni00MzE5LWJmMzMtYWQ4NjQyY2MzYmM1XkEyXkFqcGdeQXVyNTIzOTk5ODM@._V1_.jpg" alt="movie-title">
        </div>
      </a>
      <p class="movie-likes"> 
          <a href="#">
            <i class="fas fa-thumbs-up" style="font-size: 36px;"></i>
          </a>
        </p>
      </div>
  </div>

  <!-- end main container  -->

</body>

</html>