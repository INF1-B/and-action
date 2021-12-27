<div class="account-container">
  <div class="account-menu">
    <i id="close_account" class="close_account fas fa-times"></i>
    <div class="account-items">
      <h1><i class="fas fa-user-circle"></i> Account</h1>
      <div class="account-table">
        <table>
          <tr>
            <td class="account-td"> Username </td>
            <td class="account-td">
              <?php echo isset($_SESSION['gebruikersnaam']) ? "<span style=\"color: green\"> ".$_SESSION['gebruikersnaam']."</span>" : "<span style=\"color: red\"> No username found! </span>"; ?>
            </td>
          </tr>
          <tr>
            <td class="account-td"> Email </td>
            <td class="account-td">
              <?php echo isset($_SESSION['email']) ?  "<span style=\"color: green\"> ".$_SESSION['email']." </span>" : "<span style=\"color: red\"> No email found! </span>"; ?>
            </td>
          </tr>
          <tr>
            <td class="account-td"> Role </td>
            <td class="account-td">
              <?php echo isset($_SESSION['rol'])  ?  "<span style=\"color: green\"> ".$_SESSION['rol']." </span>" : "<span style=\"color: red\"> No role found! </span>"; ?>
            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="account-td"> Account status </td>
            <td class="account-td">
              <?php echo isset($_SESSION['geverifieerd']) && $_SESSION['geverifieerd'] ? "<span style=\"color: green\"> Verified </span>" : "<span style=\"color: red\"> unverified </span>"; ?>
            </td>
          </tr>
          <tr>
            <td class="account-td"> Subscription type </td>
            <td class="account-td">
              <?php echo isset($_SESSION['abonnement']) ? "<span style=\"color: green\"> ". $_SESSION['abonnement'] ." </span>" : "<span style=\"color: red\"> No subscription found </span>"; ?>
            </td>
          </tr>
          <tr>
            <td class="account-td"> Subscription </td>
            <td class="account-td">
              <?php echo isset($_SESSION['abonnement_eind']) && $_SESSION['abonnement_eind'] > date("Y-m-d H:i:s'")? "<span style=\"color: green\"> Active till ".$_SESSION['abonnement_eind']."</span>" : "<span style=\"color: red\"> Not active </span>"; ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="account-buttons">
        <a class="account-button" href="?update-subscription=true" onclick="window.alert('Your subscription will be updated with 1 year! Please login to see the changes')">Update subscription</a> 
        <a class="account-button" href="change-password.php">Change password</a>
      </div>
    </div>
  </div>
</div>