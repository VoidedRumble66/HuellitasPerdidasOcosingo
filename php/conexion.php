<?php
// Configura las credenciales de conexión en variables de entorno
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db   = getenv('DB_NAME') ?: 'HuellitasPerdidas';
$conexion = new mysqli($host, $user, $pass, $db);
if ($conexion->connect_errno) {
    die('Error conexión: ' . $conexion->connect_error);
}
$conexion->set_charset('utf8');
?>
