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

if (!checkDatabaseLoggedIn($_SESSION['id'])) {
  header('Location: ./login.php');
}

if (isset($_GET["update-subscription-admin"]) && $_GET['update-subscription-admin'] == "true" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  updateSubscription($_GET['user-id']);
  echo "<script> window.alert('Account with ID " . $_GET['user-id'] . " subscription has been extended with 1 year!') </script>";
}

if (isset($_GET['delete-user-admin']) && $_GET['delete-user-admin'] == "true" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  if ($_GET['user-id'] == $_SESSION['id']) {
    echo "<script> window.alert('Can not delete your own account!') </script>";
  } else {
    if (executeQuery(
      "DELETE FROM film 
                      WHERE film.gebruiker_id = ? 
                      UNION 
                      DELETE FROM gebruiker 
                      WHERE gebruiker.id = ?",
      "ii",
      array($_GET['user-id'], $_GET['user-id']))){
        echo "<script> window.alert('user with id ".$_GET['user-id']." has been deleted') </script>";
    } else {
      echo "<script> window.alert('ERROR trying to delete user with id " . $_GET['user-id'] . "') </script>";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>And Action - control panel</title>
  <?php include "../templates/head.php" ?>
  <link rel="stylesheet" href="./assets/css/admin-cpanel.css">
</head>

<body>
  <!-- start navbar -->

  <div class="navbar">
    <?php include "../templates/navbar.php"; ?>
  </div>

  <!-- end navbar -->
  <!-- start main container -->

  <div class="container">
    <?php
    $users = getTableRecords(
      "SELECT gebruiker.id AS id, gebruikersnaam, email, abonnement_eind, rol.naam AS rol, abonnement.naam AS abonnement 
                                          FROM gebruiker
                                          INNER JOIN rol 
                                          ON gebruiker.rol_id = rol.id 
                                          INNER JOIN abonnement 
                                          ON gebruiker.abonnement_id = abonnement.id"
    );
    ?>
    <div class="admin-account-table-wrapper">
      <table id="admin-account-table">
        <tr>
          <th> # </th>
          <th> Username </th>
          <th> Email </th>
          <th> Role </th>
          <th> Subscription </th>
          <th> Subscription end </th>
          <th> Update subscription </th>
          <th> Delete user </th>
        </tr>
        <?php
        foreach ($users as $key => $user) {
          echo "<tr>";
          echo "<td>" . $key + 1 . "</td>";
          echo "<td>" . $user['gebruikersnaam'] . "</td>";
          echo "<td>" . $user['email'] . "</td>";
          echo "<td>" . $user['rol'] . "</td>";
          echo "<td>" . $user['abonnement'] . "</td>";
          echo "<td>" . $user['abonnement_eind'] . "</td>";
          echo "<td>
                        <a class=\"update-subscription-button\" href=\"?update-subscription-admin=true&user-id=" . $user["id"] . "\">
                          Update subscription
                        </a>
                      </td>";
          echo "<td>
                        <a class=\"delete-user-button\"  onclick=\"Are you certain that you want to delete user with id " . $user['id'] . "\" href=\"?delete-user-admin=true&user-id=" . $user["id"] . "\">
                          Delete
                        </a>
                      </td>";
          echo "</tr>";
        }
        ?>
      </table>
    </div>
  </div>

  <!-- end main container  -->

</body>

</html>