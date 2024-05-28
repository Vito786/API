<?php
 
$servername = "mysql8";  
$username = "root";   
$password = "my_perfect_password";   
$database = "movies";  
$port = 3306; 

function get_movies($title) {
    global $servername, $username, $password, $database, $port;

    $movies = array();
    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM movie";

    if (isset($title)) {
        $query .= ' WHERE title LIKE "%' . $title . '%"';
    }

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $movieId = $row['id'];
        $actors = array();

        $actors_query = "SELECT a.* FROM movie_actor ma
            INNER JOIN actor a ON ma.actor_id = a.id
            WHERE ma.movie_id = $movieId";

        $actors_result = $conn->query($actors_query);

        while ($actor_row = $actors_result->fetch_assoc()) {
            $actors[] = $actor_row;
        }

        $row['actors'] = $actors;
        $movies[] = $row;
    }

    $conn->close();

    return $movies;
}

function get_actors($cognome = null) {
    global $servername, $username, $password, $database, $port;

    $actors = array();
    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM actor";

    if (isset($cognome)) {
        $query .= ' WHERE cognome LIKE "%' . $cognome . '%"';
    }

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $actors[] = $row;
    }

    $conn->close();

    return $actors;
}

function get_directors($cognome = null) {
    global $servername, $username, $password, $database, $port;

    $directors = array();
    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM director";

    if (isset($cognome)) {
        $query .= ' WHERE cognome LIKE "%' . $cognome . '%"';
    }

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $directors[] = $row;
    }

    $conn->close();

    return $directors;
}

function get_genres($nome = null) {
    global $servername, $username, $password, $database, $port;

    $genres = array();
    $conn = mysqli_connect($servername, $username, $password, $database, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM genre";

    if (isset($nome)) {
        $query .= ' WHERE nome LIKE "%' . $nome . '%"';
    }

    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $genres[] = $row;
    }

    $conn->close();

    return $genres;
}
?>
