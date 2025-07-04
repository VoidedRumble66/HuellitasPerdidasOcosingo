<?php
// conexión real a MySQL
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'HuellitasPerdidas';
$conexion = new mysqli($host, $user, $pass, $db);
=======
$conexion = new mysqli('localhost', 'usuario', 'clave', 'huellitas');

if ($conexion->connect_errno) {
    die('Error conexión: ' . $conexion->connect_error);
}
$conexion->set_charset('utf8');
?>
