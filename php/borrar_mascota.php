<?php
session_start();
require 'php/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$id_mascota = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Primero, comprueba que la mascota sea del usuario actual
$stmt = $conexion->prepare("SELECT id_mascota FROM mascota WHERE id_mascota=? AND id_usuario=?");
$stmt->bind_param('ii', $id_mascota, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Mascota no encontrada o no es del usuario
    header("Location: perfil.php?errordelete=1");
    exit;
}

// Elimina la mascota
$stmt = $conexion->prepare("DELETE FROM mascota WHERE id_mascota=? AND id_usuario=?");
$stmt->bind_param('ii', $id_mascota, $id_usuario);
$stmt->execute();

header("Location: perfil.php?borradomascota=1");
exit;
?>
