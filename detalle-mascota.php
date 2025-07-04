<?php
// detalle-mascota.php — muestra información completa de una mascota
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$tituloPagina = 'Detalle de Mascota';
require 'php/conexion.php';
include 'php/head.php';
include 'php/menu.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$mascota = null;
if ($id > 0) {
    $stmt = $conexion->prepare('SELECT nombredemascota, descripcion, foto, ubicacion, fechadeextravio FROM mascota WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $mascota = $stmt->get_result()->fetch_assoc();
}
?>
<?php if ($mascota): ?>
<section class="seccion-detalle-mascota">
  <div class="contenedor">
    <div class="row tarjeta-detalle animar-entrada">
      <div class="col-md-6 contenedor-imagen-detalle">
        <img src="img/<?= htmlspecialchars($mascota['foto']) ?>" alt="<?= htmlspecialchars($mascota['nombredemascota']) ?>" class="imagen-detalle-mascota">
      </div>
      <div class="col-md-6 info-detalle-mascota">
        <h2 class="titulo-seccion"><?= htmlspecialchars($mascota['nombredemascota']) ?></h2>
        <p><strong>Ubicación:</strong> <?= htmlspecialchars($mascota['ubicacion']) ?></p>
        <p><strong>Fecha:</strong> <?= htmlspecialchars($mascota['fechadeextravio']) ?></p>
        <p><strong>Descripción:</strong> <?= htmlspecialchars($mascota['descripcion']) ?></p>
        <a href="extraviados.php" class="boton-contorno mt-3">← Volver</a>
      </div>
    </div>
  </div>
</section>
<?php else: ?>
<section class="seccion-detalle-mascota">
  <div class="contenedor text-center">
    <p class="texto-nosotros">Lo sentimos, no se encontró la mascota.</p>
    <a href="extraviados.php" class="boton-contorno mt-3">← Ver todas</a>
  </div>
</section>
<?php endif; ?>
<?php include 'php/footer.php'; ?>
