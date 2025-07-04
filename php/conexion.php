<?php
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
