<?php
// Inicia la sesión y carga la conexión a la base de datos
session_start();
require 'conexion.php'; // El archivo ya está en la carpeta php

if (!isset($_SESSION['usuario_id']) || !isset($_GET['id']) || !isset($_GET['mascota'])) {
    header('Location: ../index.php');
    exit;
}

$id_comentario = intval($_GET['id']);
$id_mascota = intval($_GET['mascota']);

// Verifica que el comentario pertenezca al usuario actual
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

// Ejecuta la eliminación en cascada
eliminarComentario($conexion, $id_comentario);

// Vuelve al detalle de la mascota
header("Location: ../detalle-mascota.php?id=$id_mascota");
exit;
?>
