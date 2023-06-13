<?php
function connectToDB() {
    $host = 'devkinsta_db';
    $dbname = 'Valorant';
    $dbuser = 'root';
    $dbpassword = 'aqvEwR9D41FvwC6l';

    $database = new PDO (
        "mysql:host=$host;dbname=$dbname",
        $dbuser,
        $dbpassword
    );

    return $database;
}

//function to check if the user is an admin (long way)
function isAdmin() {
    if ( isset( $_SESSION['user']['roles'] ) && $_SESSION['user']['roles'] === 'admin') {
        return true;
    } else {
        return false;
    }
}

function isEditor() {
    if ( isset( $_SESSION['user']['roles'] ) && $_SESSION['user']['roles'] === 'editor') {
        return true;
    } else {
        return false;
    }
}