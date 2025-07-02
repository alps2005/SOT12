<?php
// Configuración de la base de datos
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root'); // Cambiar según tu configuración LEMP
define('DB_PASSWORD', ''); // Cambiar según tu configuración LEMP
define('DB_NAME', 'employees_db');

// Crear conexión usando mysqli
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Establecer charset para caracteres especiales
$mysqli->set_charset("utf8mb4");

// Función para cerrar la conexión
function closeConnection($connection) {
    if ($connection) {
        $connection->close();
    }
}

// Función para limpiar datos de entrada
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>