<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = trim($_POST['comentario']);
    $id_mascota = intval($_POST['id_mascota']);
    $id_usuario = $_SESSION['usuario_id'];
    $id_responde = !empty($_POST['id_responde']) ? intval($_POST['id_responde']) : null;

    // ¡Aquí cambió id_reporte por id_mascota!
    $stmt = $conexion->prepare("INSERT INTO comentario (fechadelcomentario, comentario, id_usuario, id_mascota, id_responde)
        VALUES (NOW(), ?, ?, ?, ?)");
    $stmt->bind_param('siii', $comentario, $id_usuario, $id_mascota, $id_responde);
    $stmt->execute();

    header("Location: ../detalle-mascota.php?id=$id_mascota");
    exit;
}
?>
