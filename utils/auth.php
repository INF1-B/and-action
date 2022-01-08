<?php

session_start();

/* checkSessionLoggedIn():
*
* check if the $_SESSION['loggedIn'] var is set, if so, redirect to login.php
*
*/
function checkSessionLoggedIn(){
    if (!isset($_SESSION['loggedIn'])) {
        header('Location: ./login.php');
    }
}

/* checkAuthorization(): 
*
* checks if the role is sufficient to enter the page. If not, the user will be redirected to a 403.php (Forbidden) page.
* 
* E.G. : 
* All users, loggedIn or not are allowed to enter the sign-up.php page
* All registered users are allowed to enter the change-password.php page
* Only users with the role 'Admin' are allowed to enter the admin-cpanel.php page
*
*/
function checkAuthorization($userRole, $allowedRoles) {
    if (!empty($userRole)){
        if (!in_array($userRole, $allowedRoles)) {
            header('Location: ./403.php');
        }
    } else {
        session_destroy();
        header('Location: ./login.php');
    }
}

/* checkDatabaseLoggedIn():
*
* checks whether the user has the attribute "ingelogd" set to 1 (true). If so, the user can continue. 
* Otherwise the user won't be allowed to continue and gets redirected to the login page
*
*/
function checkDatabaseLoggedIn($id){
    $user = getTableRecord("SELECT ingelogd FROM gebruiker WHERE id = ?", "i", array($id));
    if ($user['ingelogd'] == 1){
        return true;
    }
    session_destroy();
    return false;
}

/* logOut():
*
* logout the user, this will log the user out of the web app front-end by redirecting the user to the login.php page, 
* and also in the database the user attribute 'ingelogd' will be set to 0 (false)
*
*/
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