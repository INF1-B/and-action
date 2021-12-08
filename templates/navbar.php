<?php
$loggedIn = true;
/**
 * admin
 * director
 */
$role = 'admin';

?>
<header class="container">
    <div class="row">
        <div class="nav_logo">
            <img src="../public/assets/img/logo.png" alt="Logo And action" class="logo">
        </div>
        <?php
        if ($loggedIn) {
        ?>
            <div class="search_bar">
                <form action="#" method="POST">
                    <input type="text" id="search" placeholder="Search movie">
                </form>
            </div>
        <?php
        }
        ?>
        <ul class="nav_list">
            <?php
            if ($loggedIn) {
            ?>
                <li class="nav_list_item"><a class="nav_link" href="#">Home</a></li>
                <?php
                if ($role == 'admin') {
                ?>
                    <li class="nav_list_item"><a class="nav_link" href="../public/admin-dashboard.php">Dashboard</a></li>

                <?php
                }
                if ($role == 'director') {
                ?>
                    <li class="nav_list_item"><a class="nav_link" href="../public/director-my-movie.php">My movies</a></li>
                    <li class="nav_list_item"><a class="nav_link" href="../public/director-upload-movie.php">Upload movie</a></li>
                <?php
                }

                ?>
                <li class="nav_list_item"><a class="nav_button" href="#">Sign out</a></li>

            <?php
            } else {
            ?>
                <li class="nav_list_item"><a class="nav_link" href="../public/index.php">Home</a></li>
                <li class="nav_list_item"><a class="nav_link" href="../public/login.php">Login</a></li>
                <li class="nav_list_item"><a class="nav_button" href="../public/signUp.php">Sign up</a></li>
            <?php
            }
            ?>
        </ul>
    </div>
    <div class="row">
        <span class="line"></span>
    </div>
</header>