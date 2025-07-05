<?php
session_start();
require 'php/conexion.php';

if (!isset($_SESSION['usuario_id']) || !isset($_GET['id'])) {
    header('Location: index.php');
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

    header("Location: detalle-mascota.php?id=" . $comentario['id_mascota']);
    exit;
}
?>

<!-- HTML para el formulario de edición -->
<!DOCTYPE html>
<html>
<head>
    <title>Editar Comentario</title>
</head>
<body>
    <h2>Editar Comentario</h2>
    <form method="POST">
        <textarea name="comentario" required rows="4"><?= htmlspecialchars($comentario['comentario']) ?></textarea>
        <br>
        <button type="submit">Guardar Cambios</button>
    </form>
    <a href="detalle-mascota.php?id=<?= $comentario['id_mascota'] ?>">Cancelar</a>
</body>
</html>
