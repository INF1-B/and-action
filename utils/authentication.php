<?php 

session_start();


function checkLoggedIn(){
    if(!isset($_SESSION['loggedIn'] )){
        header('Location: ./index.php');
    }
}