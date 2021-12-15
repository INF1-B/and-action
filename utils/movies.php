<?php 
// Upload movie function
function uploadMovie($userId, $title, $path, $thumbnailPath, $accepted, $description, $agerestriction, $genre, $filmId){
    executeQuery("INSERT INTO film (gebruiker_id, titel, pad, thumbnail_pad, geaccepteerd, beschrijving, kijkwijzer_leeftijd) VALUES (?, ?, ?, ?, ?, ?, ?)", "isssisi", array($userId, $title, $path, $thumbnailPath, $accepted, $description, $agerestriction));
    $genreInput = getTableRecord("SELECT genre.id FROM genre WHERE id = ?", $genre);
    $filmIdInput = getTableRecord("SELECT film.id FROM film WHERE id = ?", $filmId);
    executeQuery("INSERT INTO genre_film (genre_id, film_id) VALUES (?, ?)", "ii", array($genreInput['id'], $filmIdInput['id']));
    $message = "Movie uploaded";
    return $message;
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