<?php
// conexión real a MySQL
$conexion = new mysqli('localhost', 'usuario', 'clave', 'huellitas');
if ($conexion->connect_errno) {
    die('Error conexión: ' . $conexion->connect_error);
}
$conexion->set_charset('utf8');
?>
