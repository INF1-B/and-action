<?php 

session_start();


function checkLoggedIn(){
    if(!isset($_SESSION['loggedIn'] )){
        header('Location: ./login.php');
    }
}

function logOut(){
    include "database.php";

    // log the user out in the database
    if (isset($_SESSION["id"])){
        executeQuery("UPDATE gebruiker SET ingelogd = 0 WHERE id = ?", "i", array($_SESSION["id"]));
    }

    // destroy the entire session
    session_destroy();

    // redirect to login
    header('Location: ./login.php');
}