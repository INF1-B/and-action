<?php
  include '../src/database/credentials.php';
  echo DB_HOST;


    // $movie = array(
    //     conor mcgegor = array(
    //         $src => ''
    //     ), 
    // )

//   printMovies(){
//       foreach($movies as $movie){
//           echo '<img class="movie" src="" alt="movie">';
//           echo 'title';

//       }
//   }
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>template</title>
    <link ref="stylesheet" href="./assets/homepageStyle.css"/>
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
    <h1><span>Search:</span> Documentary</h1>        
      <div class="movies">
        

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