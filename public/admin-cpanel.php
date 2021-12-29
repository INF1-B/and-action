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

$users;

// retrieve all data from the users table, if the $_GET['search-user'] variable is set, then the query will be adjusted. If not, all users will be retrieved
if (isset($_GET['search-user'])) {
  $users = getTableRecordsFiltered(
    "SELECT gebruiker.id AS id, gebruikersnaam, email, abonnement_eind, geverifieerd, rol.naam AS rol, abonnement.naam AS abonnement 
                                        FROM gebruiker
                                        INNER JOIN rol 
                                        ON gebruiker.rol_id = rol.id 
                                        INNER JOIN abonnement 
                                        ON gebruiker.abonnement_id = abonnement.id
                                        WHERE gebruikersnaam 
                                        LIKE CONCAT('%',?,'%')
                                        OR email 
                                        LIKE CONCAT('%',?,'%')
                                        OR rol.naam 
                                        LIKE CONCAT('%',?,'%')
                                        OR abonnement.naam 
                                        LIKE CONCAT('%',?,'%')",
    "ssss",
    array($_GET['search-user'], $_GET['search-user'], $_GET['search-user'], $_GET['search-user'])
  );
} else {
  $users = getTableRecords(
    "SELECT gebruiker.id AS id, gebruikersnaam, email, abonnement_eind, geverifieerd, rol.naam AS rol, abonnement.naam AS abonnement 
                                        FROM gebruiker
                                        INNER JOIN rol 
                                        ON gebruiker.rol_id = rol.id 
                                        INNER JOIN abonnement 
                                        ON gebruiker.abonnement_id = abonnement.id"
  );
}

// if the 'update-subscription' tile is pressed at a user, the subscription will be extended with 1 year
if (isset($_GET["update-subscription-admin"]) && $_GET['update-subscription-admin'] == "true" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  updateSubscription($_GET['user-id']);
  echo "<script> window.alert('Account with ID " . $_GET['user-id'] . " subscription has been extended with 1 year!') </script>";
}

// if the 'Delete' tile is pressed at a user, the user will be deleted from the database. This will delete all movies attached to the users if there are any, and finally delete the user from the gebruiker table
if (isset($_GET['delete-user-admin']) && $_GET['delete-user-admin'] == "true" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  if ($_GET['user-id'] == $_SESSION['id']) {
    echo "<script> window.alert('Can not delete your own account!') </script>";
  } else {
    if (executeQuery("DELETE FROM film WHERE gebruiker_id = ?", "i", array($_GET['user-id']))){
      if (executeQuery("DELETE FROM gebruiker WHERE id = ?", "i", array($_GET['user-id']))) {
       echo "<script> window.alert('user with id " . $_GET['user-id'] . " has been deleted') </script>";
      }
    } else {
      echo "<script> window.alert('ERROR trying to delete user with id " . $_GET['user-id'] . "') </script>";
    }
  }
}

// if the verify user tile is clicked in the 'verified' column, the user will be verified or unverified. Depending on the current verification state of the user
if (isset($_GET['verify-user-admin']) && $_GET['verify-user-admin'] == "true" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  executeQuery("UPDATE gebruiker SET geverifieerd = 1 WHERE id = ?", "i", array($_GET['user-id']));
} else if (isset($_GET['verify-user-admin']) && $_GET['verify-user-admin'] == "false" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  executeQuery("UPDATE gebruiker SET geverifieerd = 0 WHERE id = ?", "i", array($_GET['user-id']));
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
    <div class="admin-account-table-wrapper">
      <form class="search-user-container" action="<?php $_SERVER['PHP_SELF'] ?>" method="GET">
        <input class="search-user" type="text" placeholder="Search by username, email, role or subscription" name="search-user" value="<?php echo isset($_GET['search-user']) ? $_GET['search-user'] : "" ?>">
        <button type="submit" class="search-button">
          <i class="fa fa-search"></i>
        </button>
      </form>
      <table id="admin-account-table">
        <tr>
          <th> # </th>
          <th> Username </th>
          <th> Email </th>
          <th> Role </th>
          <th> Subscription </th>
          <th> Subscription end </th>
          <th> Verified </th>
          <th> Update subscription </th>
          <th> Delete user </th>
        </tr>
        <?php
        foreach ($users as $key => $user) {
          $verified = $user['geverifieerd'] ? "yes, <a onclick=\"window.alert('user is now unverified! Reloading might be required.')\" href=\"?verify-user-admin=false&user-id=" . $user['id'] . "\" > unverify user </a>" : "no, <a onclick=\"window.alert('user is now verified! Reloading might be required.')\" href=\"?verify-user-admin=true&user-id=" . $user['id'] . "\" > verify user </a>";
          echo "<tr>";
          echo "<td>" . $key + 1 . "</td>";
          echo "<td>" . $user['gebruikersnaam'] . "</td>";
          echo "<td>" . $user['email'] . "</td>";
          echo "<td>" . $user['rol'] . "</td>";
          echo "<td>" . $user['abonnement'] . "</td>";
          echo "<td>" . $user['abonnement_eind'] . "</td>";
          echo "<td> $verified </td>";
          echo "<td>
                  <a class=\"update-subscription-button\" href=\"?update-subscription-admin=true&user-id=" . $user["id"] . "\">
                    Update subscription
                  </a>
                </td>";
          echo "<td>
                  <a class=\"delete-user-button\"  onclick=\"return window.confirm('Are you certain that you want to delete user with id " . $user['id'] . "?')\" href=\"?delete-user-admin=true&user-id=" . $user["id"] . "\">
                    Delete
                  </a>
                </td>";
          echo "</tr>";
        }
        ?>
      </table>
        <a href="?refresh=true"><button onclick="window.location.reload();"> <i class="fa refresh-button"> Refresh &#xf021;</i> </button></a>
    </div>
  </div>

  <!-- end main container  -->

</body>

</html>