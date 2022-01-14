<?php
// imports
require_once("../utils/auth.php");
require_once("../utils/database.php");
require_once("../utils/filter.php");
require_once("../utils/movies.php");
require_once("../utils/functions.php");
?>

<?php
checkSessionLoggedIn();

checkAuthorization($_SESSION['rol'], array("Admin"));

if (!checkDatabaseLoggedIn($_SESSION['id'])) {
  header('Location: ./login.php');
}

$users;
$roles = getTableRecords("SELECT * FROM rol");
$subscriptions = getTableRecords("SELECT * FROM abonnement");

// retrieve all data from the users table, if the $_GET['search-user'] variable is set, then the query will be adjusted. If not, all users will be retrieved
if (isset($_GET['search-user'])) {
  $userId = filterInputGet($_GET['search-user'], "search-user");
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
    array($userId, $userId, $userId, $userId)
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

// if a user-role is selected in a column, the subscription will be updated in the database. Changes will take effect after logging in again
if (isset($_GET['user-role']) && is_numeric($_GET['user-role']) && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  $roleId = filterInputGet($_GET['user-role'], "user-role");
  $userId = filterInputGet($_GET['user-id'], "user-id");
  executeQuery("UPDATE gebruiker SET rol_id = ? WHERE id = ?", "ii", array($roleId, $userId));
  header("Location: admin-cpanel.php");
}

// if a user-subscription is selected in a column, the subscription will be updated in the database. Changes will take effect after logging in again
if (isset($_GET['user-subscription']) && is_numeric($_GET['user-subscription']) && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  $subId = filterInputGet($_GET['user-subscription'], "user-subscription");
  $userId = filterInputGet($_GET['user-id'], "user-id");
  executeQuery("UPDATE gebruiker SET abonnement_id = ? WHERE id = ?", "ii", array($subId, $userId));
  header("Location: admin-cpanel.php");
}

// if the 'update-subscription' tile is pressed at a user, the subscription will be extended with 1 year
if (isset($_GET["update-subscription-admin"]) && $_GET['update-subscription-admin'] == "true" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  $id = filterInputGet($_GET['user-id'], "user-id");
  updateSubscription($id);
  header("Location: admin-cpanel.php");
}

// if the 'Delete' tile is pressed at a user, the user will be deleted from the database. This will delete all movies attached to the users if there are any, and finally delete the user from the gebruiker table
if (isset($_GET['delete-user-admin']) && $_GET['delete-user-admin'] == "true" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  $id = filterInputGet($_GET['user-id'], "user-id");
  if ($id == $_SESSION['id']) {
    echo "<script> window.alert('Can not delete your own account!') </script>";
  } else {
    if (!executeQuery("DELETE FROM film WHERE gebruiker_id = ?", "i", array($id))){
      echo "<script> window.alert('User cannot be deleted before movies are deleted! Please contact this user first.') </script>";
    } else {
      executeQuery("DELETE FROM laatst_bekeken WHERE gebruiker_id = ?", "i", array($id));
      executeQuery("DELETE FROM commentaar WHERE gebruiker_id = ?", "i", array($id));
      executeQuery("DELETE FROM thumb_up WHERE gebruiker_id = ?", "i", array($id));
      executeQuery("DELETE FROM gebruiker WHERE id = ?", "i", array($id));
      header("Location: admin-cpanel.php");
    }
  }
}

// if the verify user tile is clicked in the 'verified' column, the user will be verified or unverified. Depending on the current verification state of the user
if (isset($_GET['verify-user-admin']) && $_GET['verify-user-admin'] == "true" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  $id = filterInputGet($_GET['user-id'], "user-id");
  executeQuery("UPDATE gebruiker SET geverifieerd = 1 WHERE id = ?", "i", array($id));
  header("Location: admin-cpanel.php");
} else if (isset($_GET['verify-user-admin']) && $_GET['verify-user-admin'] == "false" && isset($_GET['user-id']) && is_numeric($_GET['user-id'])) {
  $id = filterInputGet($_GET['user-id'], "user-id");
  executeQuery("UPDATE gebruiker SET geverifieerd = 0 WHERE id = ?", "i", array($id));
  header("Location: admin-cpanel.php");
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
        <input class="search-user" type="text" placeholder="Search by username, email, role or subscription"
          name="search-user" value="<?php echo isset($_GET['search-user']) ? $_GET['search-user'] : "" ?>">
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
          $key = $key + 1;
          $verified = $user['geverifieerd'] ? "yes, <a onclick=\"window.alert('user is now unverified! Reloading might be required.')\" href=\"?verify-user-admin=false&user-id=" . $user['id'] . "\" > unverify user </a>" : "no, <a onclick=\"window.alert('user is now verified! Reloading might be required.')\" href=\"?verify-user-admin=true&user-id=" . $user['id'] . "\" > verify user </a>";
          echo "<tr>";
          echo "<td> $key </td>";
          echo "<td>" . $user['gebruikersnaam'] . "</td>";
          echo "<td>" . $user['email'] . "</td>";
          echo "<td>"; 
          echo "<form action=\"$_SERVER[PHP_SELF] \"method=\"GET\">";
            echo "<select name=\"user-role\" onchange=\"this.form.submit()\">";
                      foreach ($roles as $role) {
                          if ($role["naam"] == $user['rol']){
                            echo "<option value=\"$role[id]\" selected> $role[naam] </option>";
                        } else {
                            echo "<option value=\"$role[id]\"> $role[naam] </option>";
                        }
                      }
            echo "</select>";
            echo "<input type=\"hidden\" value=\"$user[id]\" name=\"user-id\">";
          echo "</form>";
          echo "</td>";
          echo "<td>"; 
          echo "<form action=\"$_SERVER[PHP_SELF] \"method=\"GET\">";
            echo "<select name=\"user-subscription\" onchange=\"this.form.submit()\">";
                      foreach ($subscriptions as $sub) {
                          if ($sub["naam"] == $user['abonnement']){
                            echo "<option value=\"$sub[id]\" selected> $sub[naam] </option>";
                        } else {
                            echo "<option value=\"$sub[id]\"> $sub[naam] </option>";
                        }
                      }
            echo "</select>";
            echo "<input type=\"hidden\" value=\"$user[id]\" name=\"user-id\">";
          echo "</form>";
          echo "</td>";
          echo "<td>" . $user['abonnement_eind'] . "</td>";
          echo "<td> $verified </td>";
          echo "<td>
                  <a class=\"update-subscription-button\" onclick=\"window.alert('Account with email " . $user['email'] . " subscription has been extended with 1 year!')\" href=\"?update-subscription-admin=true&user-id=" . $user["id"] . "\">
                    Update subscription
                  </a>
                </td>";
          echo "<td>
                  <a class=\"delete-user-button\"  onclick=\"return window.confirm('Are you certain that you want to delete user with email " . $user['email'] . "?')\" href=\"?delete-user-admin=true&user-id=" . $user["id"] . "\">
                    Delete
                  </a>
                </td>";
          echo "</tr>";
        }
        ?>
      </table>
      <a href="?refresh=true"><button onclick="window.location.reload();"> <i class="fa refresh-button"> &#xf021;</i>
        </button></a>
    </div>
  </div>
  <!-- end main container  -->
  <?php include('../templates/footer.php') ?>
</body>

</html>