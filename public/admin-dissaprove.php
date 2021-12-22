<?php 
  require_once("../utils/database.php");
  require_once("../utils/authentication.php");
  require_once("../utils/filter.php");
  require_once("../utils/movies.php");
  require_once("../utils/functions.php");
  checkLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And action</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="./assets/css/dissaprovePageStyle.css">
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php";?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->

  <div class="container dissaprovePageContainer">
    <div class="content">
      <span>Are you sure ?</span>
      <p>You are about to disapprove: <a class="linkDissaprovedVideo" href="#">Ron's gone wrong</a>
      <div class="formWrapper">
        <form action="" method="POST">
          <label for="reasonDissaprove">Reason</label>
          <textarea id="reasonDissaprove" name="reason" rows="6"
            placeholder="Type here your reason why the movie is not approved"></textarea>
          <div class="submitButtons">
            <input type="submit" name="approve" id="approve" value="Approve">
            <input type="submit" name="cancel" id="cancel" value="Cancel">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- end main container  -->
  <!-- start footer -->

  <div class="footer">
    <?php include "../templates/footer.php";?>
  </div>
  <!-- end footer -->

</body>

</html>