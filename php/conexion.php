<?php
// conexion.php — simulación de conexión MySQL
// Para producción: descomentar y ajustar credenciales
// $conexion = new mysqli('localhost','usuario','clave','basedatos');
// if ($conexion->connect_errno) { die("Error conexión: ".$conexion->connect_error); }

// Objeto simulado para no detener el flujo
$conexion = (object)['simulado' => true];
?>
