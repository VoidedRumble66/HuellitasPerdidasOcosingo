<?php
session_start();
require 'php/conexion.php';

if (!isset($_SESSION['usuario_id']) || !isset($_GET['id']) || !isset($_GET['mascota'])) {
    header('Location: index.php');
    exit;
}

$id_comentario = intval($_GET['id']);
$id_mascota = intval($_GET['mascota']);

// Solo permite borrar comentarios del usuario actual
$stmt = $conexion->prepare("SELECT * FROM comentario WHERE id_comentario = ? AND id_usuario = ?");
$stmt->bind_param('ii', $id_comentario, $_SESSION['usuario_id']);
$stmt->execute();
$comentario = $stmt->get_result()->fetch_assoc();

if (!$comentario) {
    echo "No tienes permiso para borrar este comentario.";
    exit;
}

$stmt = $conexion->prepare("DELETE FROM comentario WHERE id_comentario = ?");
$stmt->bind_param('i', $id_comentario);
$stmt->execute();

header("Location: detalle-mascota.php?id=$id_mascota");
exit;
?>
