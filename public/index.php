<?php
  include '../src/database/credentials.php';
  echo DB_HOST;
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <title>template</title>
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

      <div></div>
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