<?php
    $host = 'localhost';
    $user = 'root';       // Usuario por defecto en XAMPP
    $pass = '';           // Contraseña vacía
    $db   = 'huellitasperdidas';

    $conexion = new mysqli($host, $user, $pass, $db);

    if ($conexion->connect_errno) {
        die('Error conexión: ' . $conexion->connect_error);
    }
    $conexion->set_charset('utf8');
?>


