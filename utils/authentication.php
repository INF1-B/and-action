<?php

session_start();

function checkSessionLoggedIn(){
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: ./login.php');
    }
}

function checkAuthorization($userRole, $allowedRoles) {
    if (!in_array($userRole, $allowedRoles)) {
        header('Location: ./403.php');
    }
}

function checkDatabaseLoggedIn($id){
    $user = getTableRecord("SELECT ingelogd FROM gebruiker WHERE id = ?", "i", array($id));
    if($user['ingelogd'] == 1){
        return true;
    }
    session_destroy();
    return false;
}

function logOut() {
    // log the user out in the database
    if (isset($_SESSION["id"]) && is_numeric($_SESSION["id"])) {
        executeQuery("UPDATE gebruiker SET ingelogd = 0 WHERE id = ?", "i", array($_SESSION["id"]));
    }

    // destroy the entire session
    session_destroy();

    // redirect to login
    header('Location: ./login.php');
}