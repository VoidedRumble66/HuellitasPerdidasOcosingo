<?php

// Configura las credenciales de conexión en variables de entorno
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db   = getenv('DB_NAME') ?: 'HuellitasPerdidas';
$conexion = new mysqli($host, $user, $pass, $db);

// conexión real a MySQL
$host = 'localhost';

$user = 'usuario'; // Cambia por tu usuario de MySQL
$pass = 'tu_contrasena';
$db   = 'HuellitasPerdidas';
$conexion = new mysqli($host, $user, $pass, $db);

$user = 'root';
$pass = '';
$db   = 'HuellitasPerdidas';
$conexion = new mysqli($host, $user, $pass, $db);
$conexion = new mysqli('localhost', 'usuario', 'clave', 'huellitas');




if ($conexion->connect_errno) {
    die('Error conexión: ' . $conexion->connect_error);
}
$conexion->set_charset('utf8');
?>
