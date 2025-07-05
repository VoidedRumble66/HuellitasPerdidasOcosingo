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
    $stmt = $conexion->prepare('SELECT m.nombredemascota, e.nombre AS especie, r.nombre AS raza, m.descripcion, m.foto, m.ubicacion, m.fechadeextravio, m.id_usuario
                                FROM mascota m
                                LEFT JOIN especie e ON m.id_especie = e.id_especie
                                LEFT JOIN raza r ON m.id_raza = r.id_raza
                                WHERE m.id_mascota = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $mascota = $stmt->get_result()->fetch_assoc();
}
?>
<?php if ($mascota): ?>
<section class="seccion-detalle-mascota">
  <div class="contenedor">
    <div class="row tarjeta-detalle animar-entrada" style="background:#fff; border-radius:16px; box-shadow:0 8px 32px rgba(0,0,0,0.06); padding:28px; align-items:center;">
      <div class="col-md-6 contenedor-imagen-detalle" style="margin-bottom:20px;">
        <img src="img/<?= htmlspecialchars($mascota['foto']) ?>" alt="<?= htmlspecialchars($mascota['nombredemascota']) ?>" class="imagen-detalle-mascota" style="max-width:100%; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.08);">
      </div>
      <div class="col-md-6 info-detalle-mascota">
        <h2 class="nombre-mascota mb-2" style="color:#4CAF50; font-size:2.2em;"><?= htmlspecialchars($mascota['nombredemascota']) ?></h2>
        <p>
          <span class="badge badge-especie"><?= htmlspecialchars($mascota['especie']) ?></span>
          <span class="badge badge-raza"><?= htmlspecialchars($mascota['raza']) ?></span>
        </p>
        <p style="margin-top:20px;"><strong>Ubicación:</strong> <?= htmlspecialchars($mascota['ubicacion']) ?></p>
        <p><strong>Fecha de extravío:</strong> <?= date('d/m/Y', strtotime($mascota['fechadeextravio'])) ?></p>
        <p style="margin-bottom:20px;"><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($mascota['descripcion'])) ?></p>
        <p><strong>ID de Usuario: </strong> USR-<?= htmlspecialchars($mascota['id_usuario']) ?></p>
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
