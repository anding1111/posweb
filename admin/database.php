<?php

//Make the database connection.
db_connect() or die('Unable to connect to database server!');

function db_connect($server = 'localhost', $username = 'root', $password = '', $database = 'teinnova', $link = 'db_link') {
    global $link;
    $link = new mysqli($server, $username, $password, $database);
    //if ($link) mysql_select_db($database);
    return $link;
}

//Function to handle database errors.
function db_error($query, $errno, $error) { 
    die('Cannot connect to database');
}

//Function to query the database.
function db_query($query, $link = 'db_link') {
    global $link;
    $result = $link->query($query) or db_error($query, mysqli_errno($link), mysqli_error($link));
    return $result;
}

//Get a row from the database query
function db_fetch_array($db_query) {
    return $db_query->fetch_array();
}
?>