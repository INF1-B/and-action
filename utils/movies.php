<?php 
require "database.php";
// Upload movie function

// example: uploadMovie(1, "title", "asdfg", "p" , 1, "asdfg", 1, 3);
function uploadMovie($userId, $title, $path, $thumbnailPath, $description, $ageRating, $filmGuides, $genres){
    $title = filterInputPost($_POST['MovieTitle'], 'MovieTitle');
    $genre = filterInputPost($_POST['Category'], 'Category'); 
    $ageRating = filterInputPost($_POST['AgeRating'], 'AgeRating');
    $filmGuide = filterInputPost($_POST['filmGuide'], 'filmGuide');
    $description = filterInputPost($_POST['Description'], 'Description');
    $accepted = getTableRecord("SELECT geverifieerd FROM gebruiker WHERE id = ?", "i", array($userId)   );
    executeQuery("INSERT INTO film (gebruiker_id, titel, pad, thumbnail_pad, geaccepteerd, beschrijving, kijkwijzer_leeftijd) VALUES (?, ?, ?, ?, ?, ?, ?)", "isssisi", array($userId, $title, $path, $thumbnailPath, $accepted, $description, $ageRating));
    $filmId = getTableRecords("SELECT MAX(id) FROM film");
    $filmIdInput = getTableRecord("SELECT film.id FROM film WHERE id = ?", "i", array($filmId[0]['MAX(id)']));
    
    foreach($genres as $genre){
        $genres = filterInputPost($_POST['Category'], 'Category');
        $genreInput = getTableRecord("SELECT genre.id FROM genre WHERE id = ?", "i", array($genre));
        executeQuery("INSERT INTO genre_film (genre_id, film_id) VALUES (?, ?)", "ii", array($genreInput['id'], $filmIdInput['id']));
    }
    foreach($filmGuides as $filmGuide){
        $filmGuides = filterInputPost($_POST['filmGuide'], 'filmGuide');
        $filmGuideInput = getTableRecord("SELECT kijkwijzer_geschiktheid.id FROM kijkwijzer_geschiktheid WHERE id = ?", "i", array($filmGuide));
        executeQuery("INSERT INTO film_kijkwijzer_geschiktheid (kijkwijzer_geschiktheid_id, film_id) VALUES (?, ?)", "ii", array($filmGuideInput['id'], $filmIdInput['id']));
    }
    $message = "Movie uploaded";
    return $message;
}

function getMovie($filmId){
    $sql = getTableRecord("SELECT id, titel, beschrijving, pad, thumbnail_pad FROM film WHERE id = ?", "i", array($filmId));
    return $sql;
}

    //  Function that adds to tumb_up table when liking a video. It will check if the user and film like combination does not already exist. If it exists it will not add otherwise it will.
function likeMovie($userId, $filmId){
    echo executeQuery("INSERT IGNORE INTO thumb_up (gebruiker_id, film_id) VALUES (?, ?);","ii",array($userId, $filmId));
    $message = "You have liked this movie";
    return $message;
}

// Function that will add comment given on a movie to the database table 'commentaar'.
function getComment($filmId, $userId, $message){
    $date = date('Y-m-d H:i:s');
    executeQuery("INSERT INTO commentaar (film_id, gebruiker_id, bericht, tijdsstempel) VALUES (?, ?, ?, ?)", "iiss", array($filmId, $userId, $message , $date));
    $message = "Added comment";
    return $message;
}



?>