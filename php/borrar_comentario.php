<?php
session_start();
require 'conexion.php'; // ¡Ya estás en la carpeta php!

if (!isset($_SESSION['usuario_id']) || !isset($_GET['id']) || !isset($_GET['mascota'])) {
    header('Location: ../index.php');
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


// Función recursiva para eliminar un comentario y todas sus respuestas
function eliminarComentario($conexion, $id) {
    // Primero elimina las respuestas de este comentario
    $stmtHijos = $conexion->prepare("SELECT id_comentario FROM comentario WHERE id_responde = ?");
    $stmtHijos->bind_param('i', $id);
    $stmtHijos->execute();
    $res = $stmtHijos->get_result();
    while ($row = $res->fetch_assoc()) {
        eliminarComentario($conexion, $row['id_comentario']);
    }
    // Ahora elimina el propio comentario
    $stmtDel = $conexion->prepare("DELETE FROM comentario WHERE id_comentario = ?");
    $stmtDel->bind_param('i', $id);
    $stmtDel->execute();
}

eliminarComentario($conexion, $id_comentario);

header("Location: ../detalle-mascota.php?id=$id_mascota");
exit;
?>
