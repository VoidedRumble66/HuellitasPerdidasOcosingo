<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
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
    header("Location: ../perfil.php?errordelete=1");
    exit;
}

// Función recursiva para eliminar comentarios y sus respuestas
function eliminarComentario($conexion, $id) {
    $stmtHijos = $conexion->prepare("SELECT id_comentario FROM comentario WHERE id_responde = ?");
    $stmtHijos->bind_param('i', $id);
    $stmtHijos->execute();
    $res = $stmtHijos->get_result();
    while ($row = $res->fetch_assoc()) {
        eliminarComentario($conexion, $row['id_comentario']);
    }
    $stmtDel = $conexion->prepare("DELETE FROM comentario WHERE id_comentario = ?");
    $stmtDel->bind_param('i', $id);
    $stmtDel->execute();
}

// Obtener comentarios principales de la mascota y eliminarlos en cascada
$stmtComentarios = $conexion->prepare("SELECT id_comentario FROM comentario WHERE id_mascota = ?");
$stmtComentarios->bind_param('i', $id_mascota);
$stmtComentarios->execute();
$resComentarios = $stmtComentarios->get_result();
while ($row = $resComentarios->fetch_assoc()) {
    eliminarComentario($conexion, $row['id_comentario']);
}

// Elimina la mascota
$stmt = $conexion->prepare("DELETE FROM mascota WHERE id_mascota=? AND id_usuario=?");
$stmt->bind_param('ii', $id_mascota, $id_usuario);
$stmt->execute();

header("Location: ../perfil.php?borradomascota=1");
exit;
?>
