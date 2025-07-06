<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['usuario_id']) || !isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$id_comentario = intval($_GET['id']);

// Solo permite editar comentarios del usuario actual
$stmt = $conexion->prepare("SELECT * FROM comentario WHERE id_comentario = ? AND id_usuario = ?");
$stmt->bind_param('ii', $id_comentario, $_SESSION['usuario_id']);
$stmt->execute();
$comentario = $stmt->get_result()->fetch_assoc();

if (!$comentario) {
    echo "No tienes permiso para editar este comentario.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoComentario = trim($_POST['comentario']);
    $stmt = $conexion->prepare("UPDATE comentario SET comentario = ? WHERE id_comentario = ?");
    $stmt->bind_param('si', $nuevoComentario, $id_comentario);
    $stmt->execute();

    header("Location: ../detalle-mascota.php?id=" . $comentario['id_mascota']);
    exit;
}
?>
<!-- HTML para el formulario de edición, igual a tu mockup y responsivo -->
<!DOCTYPE html>
<html>
<head>
    <title>Editar Comentario</title>
    <link rel="stylesheet" href="../css/estilo.css"> <!-- Usa tu propio archivo de estilos -->
</head>
<body>
<div class="contenedor" style="max-width:500px;margin:40px auto;background:#fff;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,0.09);padding:32px;">
    <h2 class="titulo-seccion" style="margin-bottom:18px;">Editar Comentario</h2>
    <form method="POST" class="formulario-comentario">
        <textarea name="comentario" required rows="4" style="width:100%;"><?= htmlspecialchars($comentario['comentario']) ?></textarea>
        <button type="submit" class="boton" style="margin-top:15px;">Guardar Cambios</button>
        <a href="../detalle-mascota.php?id=<?= $comentario['id_mascota'] ?>" class="boton-contorno" style="margin-top:10px;">Cancelar</a>
    </form>
</div>
</body>
</html>
