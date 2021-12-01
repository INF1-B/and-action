<!DOCTYPE html>
<html lang="en">

  <head>
    <title>And action</title>
    <link rel="stylesheet" href="./assets/css/approve_warning.css">
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
        <div class="approve_container">
            <h1 class="approve_title">Are you sure?</h1>
            <h2 class="approve_subtitle">You are about to approve: <a class="approve_link" href="#">Ron's gone wrong</a></h2>
            <div class="button_container">
                <a href="#" class="approve button">Approve</a>
                <a href="#" class="cancel button">Cancel</a>
            </div>
        </div>
    </div>

    <!-- end main container  -->
  </body>

</html>