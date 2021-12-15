<?php 





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