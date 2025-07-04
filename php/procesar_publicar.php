<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['usuario_id'])) {
    $nombreMascota = trim($_POST['nombreMascota'] ?? '');
    $especie = intval($_POST['especie'] ?? 0);
    $raza = intval($_POST['raza'] ?? 0);
    $descripcion = trim($_POST['descripcion'] ?? '');
    $ubicacion = trim($_POST['ubicacion'] ?? '');
    $fecha = $_POST['fecha'] ?? date('Y-m-d');
    $archivo = '';

    if (!empty($_FILES['foto']['name'])) {
        $archivo = basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], '../img/' . $archivo);
    }

    $stmt = $conexion->prepare('INSERT INTO mascota(nombredemascota, id_especie, id_raza, descripcion, ubicacion, fechadeextravio, foto, id_usuario) VALUES (?,?,?,?,?,?,?,?)');
    $stmt->bind_param('siissssi', $nombreMascota, $especie, $raza, $descripcion, $ubicacion, $fecha, $archivo, $_SESSION['usuario_id']);
    $stmt->execute();
}

header('Location: ../extraviados.php');
