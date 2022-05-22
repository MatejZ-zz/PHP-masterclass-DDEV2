<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost:59863');
define('DB_USERNAME', 'db');
define('DB_PASSWORD', 'db');
define('DB_NAME', 'masterclass');

/* Attempt to connect to MySQL database */
/*
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
*/

/*
$host = "localhost:59863";
$db = "masterclass";
$user = "db";
$password = "db";
$conn = "mysql:host=$host;dbname=$db;charset=UTF8";

try {
    $pdo = new PDO($conn, $user, $password);

    if ($pdo) {
        echo "Connected to the $db database successfully!";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
*/

