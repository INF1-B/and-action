<?php

$loggedIn;
$role;
$movies;

// check if the id is set of a user, if so, set the value of 'ingelogd' column in the 'gebruiker' table to be true (1) or false (0)
if (isset($_SESSION['id']) && is_numeric($_SESSION["id"])) {
    $data = getTableRecord("SELECT ingelogd, rol.naam as rol
        FROM gebruiker 
        INNER JOIN rol 
        ON gebruiker.rol_id = rol.id 
        WHERE gebruiker.id = ?", "i", array($_SESSION["id"]));
    $loggedIn = $data["ingelogd"];
    $role = $data["rol"];
} else {
    $loggedIn = false;
}

// check if a user has pressed the logout button
if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    logOut();
}

// search for a movie. This will search for a movie title, a description of a movie or the director/user that has created the movie
if (isset($_GET["search-movie"])){
    $movies = getTableRecordsFiltered("SELECT gebruiker.gebruikersnaam, film.titel, film.pad, film.thumbnail_pad, film.geaccepteerd, film.beschrijving, film.kijkwijzer_leeftijd 
                                    FROM film 
                                    INNER JOIN gebruiker 
                                    ON film.gebruiker_id = gebruiker.id
                                    WHERE titel 
                                    LIKE CONCAT('%',?,'%')
                                    OR beschrijving 
                                    LIKE CONCAT('%',?,'%')
                                    OR gebruikersnaam 
                                    LIKE CONCAT('%',?,'%')
                                    AND geaccepteerd = 1",
                                     "sss",
                                     array($_GET["search-movie"], $_GET["search-movie"], $_GET["search-movie"]));
}


// $role = "Admin" // only use if db connection fails
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
                <form action="<?php $_SERVER["PHP_SELF"]?>" method="GET">
                    <input type="text" id="search" placeholder="search..." name="search-movie">
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
                if ($role == 'Admin') {
                ?>
                    <li class="nav_list_item"><a class="nav_link" href="../public/admin-dashboard.php">Dashboard</a></li>

                <?php
                }
                if ($role == 'Director') {
                ?>
                    <li class="nav_list_item"><a class="nav_link" href="../public/director-my-movie.php">My movies</a></li>
                    <li class="nav_list_item"><a class="nav_link" href="../public/director-upload-movie.php">Upload movie</a></li>
                <?php
                }

                ?>
                <li class="nav_list_item"><a id="open_account" class="nav_link">Account</a></li>

                <li class="nav_list_item"><a class="nav_button" href="?logout=true">Sign out</a></li>

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

<?php include "../templates/account.html"; ?>

<script src="../public/assets/js/account.js"></script>