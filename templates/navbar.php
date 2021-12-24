<?php
$movies;

// check if a user has pressed the logout button
if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    logOut();
}

// search for a movie. This will search for a movie title, a description of a movie or the director/user that has created the movie
if (isset($_GET["search-movie"])){
    $movies = getTableRecordsFiltered("SELECT film.id, film.titel, film.thumbnail_pad
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


?>
<header class="container">
    <div class="row">
        <div class="nav_logo">
            <img src="../public/assets/img/logo.png" alt="Logo And action" class="logo">
        </div>
        <?php
        if ($_SESSION['loggedIn']) {
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
            if ($_SESSION['loggedIn']) {
            ?>
                <li class="nav_list_item"><a class="nav_link" href="../public/homepage.php">Home</a></li>
                <?php
                if ($_SESSION['rol'] == 'Admin') {
                ?>
                    <li class="nav_list_item"><a class="nav_link" href="../public/admin-dashboard.php">Dashboard</a></li>

                <?php
                }

                if ($_SESSION['rol'] == 'Director') {
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