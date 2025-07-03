<?php
// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // Change according to your LEMP configuration
define('DB_PASSWORD', 'P2ssw0rd'); // Change according to your LEMP configuration
define('DB_NAME', 'employees_db');

// Create connection using mysqli
$mysqli = new mysqli(localhost, root, P2ssw0rd, employees_db);

// Check connection
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Set charset for special characters
$mysqli->set_charset("utf8mb4");

// Function to close the connection
function closeConnection($connection) {
    if ($connection) {
        $connection->close();
    }
}

// Function to clean input data
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>