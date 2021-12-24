<?php 
  // imports
  require_once("../utils/authentication.php");
  require_once("../utils/database.php");
  require_once("../utils/filter.php");
  require_once("../utils/movies.php");
  require_once("../utils/functions.php");
?>

<?php
  checkSessionLoggedIn();
  
  if(!checkDatabaseLoggedIn($_SESSION['id'])){
    header('Location: ./login.php');
  }

  $message = messageGenerator("return-ch-pw", "change-password");

  if (isset($_POST["submit"])) {
    // filter all user values
    $input["current-pw"] = filterInputPost($_POST["current-pw"], "current-pw");
    $input["new-pw"] = filterInputPost($_POST["new-pw"], "new-pw");
    $input["confirm-new-pw"] = filterInputPost($_POST["confirm-new-pw"], "confirm-new-pw");

    if (filterPassword($input["new-pw"])) {
      if ($input["new-pw"] == $input["confirm-new-pw"]){
        $data = getTableRecord("SELECT wachtwoord FROM gebruiker WHERE id = ?", "i", array($_SESSION["id"]));
        if (verifyPassword($input["current-pw"], $data["wachtwoord"])) {
          executeQuery("UPDATE gebruiker SET wachtwoord = ?, ingelogd = 0 WHERE id = ?", "si", array(generateHash($input["new-pw"]), $_SESSION["id"]));
          $message = messageGenerator("pw-change-success", "change-password");
          session_destroy();
        } else {
          $message = messageGenerator("current-pw-error", "change-password");
        }
      } else {
        $message = messageGenerator("new-pw-match-error", "change-password");
      }
    } else {
      $message = messageGenerator("password-min", "change-password");
    }
  }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action - Change password</title>
  <?php
  include "../templates/head.php";
  ?>
  <link rel="stylesheet" href="assets/css/login-changepw.css">
</head>

<body>
  <div class="container container-change-password">
    <div class="upper">
      <div>
        <h1>Change password</h1>
      </div>
      <div>
        <img class="logo" src="../public/assets/img/logo_login.png" alt="logo">
      </div>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="input-login-text">
        <label for="old-pw">Current password</label>
        <input type="password" name="current-pw" id="current-pw" placeholder="Current password">
        <label for="password"> New password </label>
        <input type="password" name="new-pw" id="new-pw" placeholder="New password">
        <label for="password"> Confirm </label>
        <input type="password" name="confirm-new-pw" id="confirm-new-pw" placeholder="Confirm">
      </div>
      <div class="submit-form">
        <input type="submit" name="submit" value="Change password">
      </div>
    </form>
      <?php 
        if (isset($message)) {
          echo $message;
        }
      ?>
  </div>
</body>

</html>