<!DOCTYPE html>
<html lang="en">

<head>
    <title>And action</title>
    <?php include "../templates/head.php" ?>
    <link rel="stylesheet" href="./assets/css/admin-dashboard.css">
    <link rel="stylesheet" href="./assets/css/thumpnail-display.css">
</head>

<body>
    <!-- start navbar -->

    <div class="navbar">
        <?php include "../templates/navbar.php"; ?>
    </div>

    <!-- end navbar -->
    <!-- start main container -->

    <div class="container admin-dashboard thumpnail-display">
        <div class="row">
            <h1>Under review</h1>
        </div>
        <div class="row">
            <div class="movies">
                <div class="movie">
                    <a href="#">    
                        <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
                        <p class="movie_title">Boss baby</p>
                    </a>
                </div>
                <div class="movie">
                    <a href="#">
                        <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
                        <p class="movie_title">Boss baby</p>
                    </a>
                </div>
                <div class="movie">
                    <a href="#">
                        <img class="movie_thumbnail" src="https://media.pathe.nl/nocropthumb/620x955/gfx_content/posters/the_boss_baby_56164684_ps_1_s-high.jpg" alt="movie_name">
                        <p class="movie_title">Boss baby</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- end main container  -->

</body>

</html>