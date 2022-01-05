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
 
    executeQuery("INSERT INTO film (gebruiker_id, titel, pad, thumbnail_pad, geaccepteerd, beschrijving, kijkwijzer_leeftijd) VALUES (?, ?, ?, ?, ?, ?, ?)", "isssisi", array($userId, $title, $path, $thumbnailPath, $accepted["geverifieerd"], $description, $ageRating));
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

/* getMovies()
*
* This function retrieves some specific details about a movie. 
* 
*/
function getMovies(){
    $movies = getTableRecords("SELECT id, titel, thumbnail_pad, geaccepteerd FROM film WHERE geaccepteerd = 1 LIMIT 50");
    return $movies;
}

/* getMovie():
*
* retrieve all the details from a movie when calling this function. This will retrieve all genres, filmguides, creator
* creator and other movie details.
*
*
*/
function getMovie($filmId){
    $movieDetails = getTableRecordsFiltered("SELECT film.id, film.titel, film.geaccepteerd, film.beschrijving, film.kijkwijzer_leeftijd, film.pad, film.thumbnail_pad, genre.naam as genre, kijkwijzer_geschiktheid.naam as kijkwijzer, gebruiker.gebruikersnaam, gebruiker.id as gebruikerId
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
    $movie['gebruikerId'] = $movieDetails[0]['gebruikerId'];
    $movie["titel"] = $movieDetails[0]['titel'];
    $movie["beschrijving"] = $movieDetails[0]['beschrijving'];
    $movie["kijkwijzer_leeftijd"] = $movieDetails[0]['kijkwijzer_leeftijd'];
    $movie["pad"] = $movieDetails[0]['pad'];
    $movie["gebruikersnaam"] = $movieDetails[0]['gebruikersnaam'];
    $movie["thumbnail_pad"] = $movieDetails[0]['thumbnail_pad'];
    $movie["geaccepteerd"] = $movieDetails[0]['geaccepteerd'];
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

/* getUnreviewedMovies():
*
* return all unreviewed movies. The query searched for movies who have not been accepted yet AND
* where there is no message attached to the movie either.
*
*/
function getUnreviewedMovies(){
    $movies = getTableRecords("SELECT count(commentaar.bericht) AS bericht, film.titel, film.thumbnail_pad, film.id, film.geaccepteerd  
                                    FROM film 
                                    LEFT JOIN commentaar 
                                    ON film.id = commentaar.film_id 
                                    GROUP BY film.id
                                    HAVING film.geaccepteerd = 0 
                                    AND bericht = 0;
                                    ");
    return $movies;
}

/* getDissaprovedMovies():
*
* Return all dissaproved movies, The query searches for movies which have not been accepted yet AND
* where a message is attached to the movie. That way a comment can only be from the admin which has reviewed it atleast once before.
*
*/
function getDissaprovedMovies(){
    $movies = getTableRecords("SELECT count(commentaar.bericht) AS bericht, MAX(commentaar.tijdsstempel) AS tijdsstempel, film.titel, film.thumbnail_pad, film.id, film.pad, film.geaccepteerd  
                                    FROM film 
                                    LEFT JOIN commentaar 
                                    ON film.id = commentaar.film_id 
                                    GROUP BY film.id
                                    HAVING film.geaccepteerd = 0 
                                    AND bericht > 0 ;
        ");
    return $movies;
}
/* getRecentlyWatchedMovies():
*
* returns all recently watched movies, this is bound to a user, and limited by the latest 5 movies they have watched
*
*/
function getRecentlyWatchedMovies($userId){
    $movies = getTableRecordsFiltered("SELECT MAX(tijdsstempel) as latest, id, titel, thumbnail_pad, geaccepteerd 
                                            FROM film 
                                            INNER JOIN laatst_bekeken
                                            ON film.id = laatst_bekeken.film_id
                                            WHERE geaccepteerd = 1 
                                            AND laatst_bekeken.gebruiker_id = ?
                                            GROUP BY film_id
                                            ORDER BY latest DESC
                                            LIMIT 5", "i", array($userId));
    return $movies;
}
/* getSuggestedMovies():
*
* Based on previously watched movies that the user has watched, other movies with the same genre will be advised to the user.
* This function returns all suggested movies, limited by 5
*
* explanation nested subquery: (WHERE genre.id IN (SELECT genre_id FROM genre_film WHERE film_id IN (SELECT film_id FROM laatst_bekeken)))
*
* This searches for moviegenres that ware previously watched by the user. It checks it by searching in the table 'laatst_bekeken' for movies the  
* user has seen, and retrieves all genres that ware attached to these movies
*
* explanation second subquery: (AND film.id NOT IN (SELECT film_id FROM laatst_bekeken WHERE gebruiker_id = ?))
*
* This second subquery retrieves all the movies that are in the film table, which the user has not seen yet. It does this by selecting all movies in the film table, 
* minus the movies the user has attached to itself in the laatst_bekeken table
*
*/
function getSuggestedMovies($userId){
    $movies = getTableRecordsFiltered("SELECT film.id, titel, thumbnail_pad, geaccepteerd, genre.naam as genre FROM film
                                            INNER JOIN genre_film
                                            ON film.id = genre_film.film_id
                                            INNER JOIN genre
                                            ON genre_film.genre_id = genre.id
                                            WHERE genre.id IN (SELECT genre_id 
                                                                FROM genre_film 
                                                                WHERE film_id 
                                                                IN (SELECT 
                                                                    film_id 
                                                                    FROM laatst_bekeken)) 
                                            AND film.id NOT IN (SELECT film_id 
                                                                FROM laatst_bekeken 
                                                                WHERE gebruiker_id = ?)
                                            AND geaccepteerd = 1
                                            GROUP BY film.id
                                            ORDER BY film.id DESC
                                            LIMIT 5
                                            ", "i", array($userId));
    return $movies;
}
/* getMovieLikes(): 
*
* retieves the likes from a specific movie, after that formats it from a multi dimensional associative array to a
* single associative array which holds the num of likes a movie contains
*
*/
function getMovieLikes($id){
    $id = filterInputGet($id, "id");
    $likes = getTableRecordsFiltered("SELECT COUNT(*) as likes FROM thumb_up WHERE film_id = ?", "i", array($id));
    $likes["num"] = $likes[0]["likes"];
    return $likes;
}

/* likeMovie():
*
* Function that adds userId and MovieId to thumb_up table when liking a video. 
* It will check if the user and film like combination does not already exist. 
* If it exists it will not add otherwise it will.
*
*/
function likeMovie($userId, $filmId){
    $userId = filterInputGet($userId, "user-id");
    $filmId = filterInputGet($filmId, "id");
    //
    executeQuery("INSERT IGNORE INTO thumb_up (gebruiker_id, film_id) VALUES (?, ?)","ii",array($userId, $filmId));
}

/* addComment():
*
* Function that will add comment given on a movie to the database table 'commentaar'
*
*/
function addComment($filmId, $userId, $message){
    $message = filterInputGet($message, "feedback");
    $date = date('Y-m-d H:i:s');
    executeQuery("INSERT INTO commentaar (film_id, gebruiker_id, bericht, tijdsstempel) VALUES (?, ?, ?, ?)", "iiss", array($filmId, $userId, $message , $date));
}

/* addRecentlyWatched():
*
* Once a movie has been watched or is in progress of watching by a user, a record will be added which retrieves some random movies in the "recently watched" section 
* This will only add 1 record in the table
*
*/
function addRecentlyWatched($filmId, $userId){
    $date = date('Y-m-d H:i:s');
    executeQuery("INSERT IGNORE INTO laatst_bekeken (film_id, gebruiker_id, tijdsstempel) VALUES (?, ?, ?)", "iis", array($filmId, $userId, $date));
}

?>