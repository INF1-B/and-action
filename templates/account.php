<div class="account-container">
  <div class="account-menu">
    <i id="close_account" class="close_account fas fa-times"></i>
    <div class="account-items">
      <h1><i class="fas fa-user-circle"></i> Account</h1>
      <p>
        <span class="bold">Account status: </span>
        <?php 
        if (isset($_SESSION['geverifieerd']) && $_SESSION['geverifieerd']) {
            echo "<span style=\"color: green\"> verified </span>";
        } else {
            echo "<span style=\"color: red\"> not verified </span>";
        }
        ?>
      </p>
      <a class="account-buton" href="change-password.php">Change password</a>
    </div>
  </div>
</div>