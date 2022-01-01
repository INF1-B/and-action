<?php 

// example: uploadMovie(1, "title", "asdfg", "p" , 1, "asdfg", 1, 3);
function uploadMovie($userId, $title, $path, $thumbnailPath, $description, $ageRating, $filmGuides, $genres){
    // User input string
    $title = filterInputPost($_POST['MovieTitle'], 'MovieTitle');
    $ageRating = filterInputPost($_POST['AgeRating'], 'AgeRating');
    $description = filterInputPost($_POST['Description'], 'Description');
    $accepted = getTableRecord("SELECT geverifieerd FROM gebruiker WHERE id = ?", "i", array($userId));

    // User input array
    $filteredGenres = filterIntMultiple($genres);
    $filteredFilmguides = filterIntMultiple($filmGuides);
 
    executeQuery("INSERT INTO film (gebruiker_id, titel, pad, thumbnail_pad, geaccepteerd, beschrijving, kijkwijzer_leeftijd) VALUES (?, ?, ?, ?, ?, ?, ?)", "isssisi", array($userId, $title, $path, $thumbnailPath, $accepted, $description, $ageRating));
    $filmId = getTableRecords("SELECT MAX(id) FROM film");
    $filmIdInput = getTableRecord("SELECT film.id FROM film WHERE id = ?", "i", array($filmId[0]['MAX(id)']));

    $genres = setInsert($filteredGenres, $filmIdInput["id"]);
    $filmGuide = setInsert($filteredFilmguides, $filmIdInput["id"]);

    executeQuery("INSERT INTO genre_film (genre_id, film_id) VALUES " . implode(" ", $genres["questionMarks"]), 
             str_repeat("ii", count($genres["questionMarks"])), 
             $genres["values"]);

    executeQuery("INSERT INTO film_kijkwijzer_geschiktheid (kijkwijzer_geschiktheid_id, film_id) VALUES " . implode(" ", $filmGuide["questionMarks"]), 
                     str_repeat("ii", count($filmGuide["questionMarks"])), 
                     $filmGuide["values"]);

    $message = "Movie uploaded";
    return $message;
}

// retrieve all movies, limited by 50 movies
function getMovies(){
    $movies = getTableRecords("SELECT id, titel, thumbnail_pad FROM film LIMIT 50");
    return $movies;
}

/* getMoviesById(): 
*
* Used for the 'my movies' section from a director.
* this will retrieve all the movies which are bound to a specific user
*
*/
function getMoviesById($id) {
    $movies = getTableRecordsFiltered("SELECT film.id, titel, thumbnail_pad 
                                            FROM film 
                                            INNER JOIN gebruiker 
                                            ON film.gebruiker_id = gebruiker.id 
                                            WHERE gebruiker.id = ?", "i", array($id));
    return $movies;
}

/* getMovie():
*
* retrieve all the details from a movie when calling this function. This will retrieve all genres, filmguides, creator
* creator and other movie details.
*
*/
function getMovie($filmId){
    $movieDetails = getTableRecordsFiltered("SELECT film.id, film.titel, film.beschrijving, film.kijkwijzer_leeftijd, film.pad, genre.naam as genre, kijkwijzer_geschiktheid.naam as kijkwijzer, gebruiker.gebruikersnaam
                                                FROM film 
                                                INNER JOIN genre_film  
                                                ON film.id = genre_film.film_id 
                                                INNER JOIN genre 
                                                ON genre_film.genre_id = genre.id 
                                                INNER JOIN film_kijkwijzer_geschiktheid 
                                                ON film.id = film_kijkwijzer_geschiktheid.film_id 
                                                INNER JOIN kijkwijzer_geschiktheid 
                                                ON film_kijkwijzer_geschiktheid.kijkwijzer_geschiktheid_id = kijkwijzer_geschiktheid.id
                                                INNER JOIN gebruiker 
                                                ON film.gebruiker_id = gebruiker.id 
                                                WHERE film.id = ?", "i", array($filmId));
    $movieDetails = getMovieDetailsFiltered($movieDetails);
    return $movieDetails;
}

/* getMovieDetailsFiltered():
*
* Whenever data about 1 specific movie is retrieved, multiple rows will return since there can be multiple genres or multiple film guides attached to 1 movie. 
* this function formats it from a multi dimensional associative array to a normal associative array with multiple string values
* only used by getMovie() function.
*
*/
function getMovieDetailsFiltered($movieDetails) {
    if (empty($movieDetails)){
        return $movieDetails;
    }
    $movie["id"] = $movieDetails[0]['id'];
    $movie["titel"] = $movieDetails[0]['titel'];
    $movie["beschrijving"] = $movieDetails[0]['beschrijving'];
    $movie["kijkwijzer_leeftijd"] = $movieDetails[0]['kijkwijzer_leeftijd'];
    $movie["pad"] = $movieDetails[0]['pad'];
    $movie["gebruikersnaam"] = $movieDetails[0]['gebruikersnaam'];
    $movie['genres'] = array();
    $movie['kijkwijzers'] = array();
    foreach ($movieDetails as  $movieDetail) {
        array_push($movie['genres'], $movieDetail['genre']);
        array_push($movie['kijkwijzers'], $movieDetail['kijkwijzer']);
    }
    $movie['genre'] = implode(", ", array_unique($movie['genres']));
    $movie['kijkwijzer'] = implode(", ", array_unique($movie['kijkwijzers']));
    return $movie;  
}

/* getMovieLikes(): 
*
* retieves the likes from a specific movie, after that formats it from a multi dimensional associative array to a
* single associative array which holds the num of likes a movie contains
*
*/
function getMovieLikes($id){
    $likes = getTableRecordsFiltered("SELECT COUNT(*) as likes FROM thumb_up WHERE film_id = ?", "i", array($id));
    $likes["num"] = $likes[0]["likes"];
    return $likes;
}

// Function that adds to tumb_up table when liking a video. It will check if the user and film like combination does not already exist. If it exists it will not add otherwise it will.
function likeMovie($userId, $filmId){
    echo executeQuery("INSERT IGNORE INTO thumb_up (gebruiker_id, film_id) VALUES (?, ?)","ii",array($userId, $filmId));
    $message = "You have liked this movie";
    return $message;
}

// Function that will add comment given on a movie to the database table 'commentaar'.
function addComment($filmId, $userId, $message){
    $date = date('Y-m-d H:i:s');
    executeQuery("INSERT INTO commentaar (film_id, gebruiker_id, bericht, tijdsstempel) VALUES (?, ?, ?, ?)", "iiss", array($filmId, $userId, $message , $date));
    $message = "Added comment";
    return $message;
}



?>