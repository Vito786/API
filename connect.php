<?php
 
$servername = "mysql8"; 
$username = "root";  
$password = "my_perfect_password"; 
$database = "movies"; 
$port = 3306; 

function get_movies($title){
    global $servername, $username, $password, $database, $port;

    $movies = array();
    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $query = "SELECT * FROM movie;";
   
    if(isset($title)){
        $query = 'SELECT * FROM movie WHERE title LIKE "%' . $title . '%"';
    }

    $result = $conn->query($query);

    while($row = $result->fetch_assoc()){
        $movieId = $row['id'];

        $actors_sql = "SELECT a.* FROM movie_actor ma INNER JOIN actor a ON ma.actor_id = a.id WHERE ma.movie_id = $movieId";

        $actorResult = mysqli_query($conn, $actors_sql);
        if (!$actorResult){
            die("Errore durante il recupero degli attori dal film $movieId: " . mysqli_error($conn));
        }

        $actors = array();
        while($actorRow = mysqli_fetch_assoc($actorResult)){
            $actors[] = $actorRow;
        }

        $row["actors"] = $actors;
        $movies[] = $row;
    }

    $conn->close();

    return $movies;
}

function get_actors($cognome){
    global $servername, $username, $password, $database, $port;

    $actors = array();
    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $query = "SELECT * FROM actor;";
   
    if(isset($cognome)){
        $query = 'SELECT * FROM actor WHERE cognome LIKE "%' . $cognome . '%"';
    }

    $result = $conn->query($query);

    while($row = $result->fetch_assoc()){
        $actors[] = $row;
    }
   
    $conn->close();

    return $actors;
}

function get_directors($cognome){
    global $servername, $username, $password, $database, $port;

    $directors = array();
    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $query = "SELECT * FROM directors;";
   
    if(isset($cognome)){
        $query = 'SELECT * FROM directors WHERE cognome LIKE "%' . $cognome . '%"';
    }

    $result = $conn->query($query);

    while($row = $result->fetch_assoc()){
        $directors[] = $row;
    }
   
    $conn->close();

    return $directors;
}

function get_genres($nome){
    global $servername, $username, $password, $database, $port;

    $genres = array();
    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $query = "SELECT * FROM genres;";
   
    if(isset($nome)){
        $query = 'SELECT * FROM genres WHERE nome LIKE "%' . $nome . '%"';
    }

    $result = $conn->query($query);

    while($row = $result->fetch_assoc()){
        $genres[] = $row;
    }
   
    $conn->close();

    return $genres;
}