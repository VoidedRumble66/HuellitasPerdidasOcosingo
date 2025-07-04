<?php
// extraviados.php — listado de mascotas extraviadas desde la base de datos
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$tituloPagina = 'Extraviados';
require 'php/conexion.php';
include 'php/head.php';
include 'php/menu.php';

$resultado = $conexion->query("SELECT id, nombredemascota, ubicacion, foto FROM mascota ORDER BY fechadeextravio DESC");
$mascotas = $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
?>

<section class="seccion-mascotas-perdidas">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada">Mascotas Extraviadas</h2>
    <div class="row contenedor-tarjetas">
      <?php foreach ($mascotas as $m): ?>
      <div class="col-md-4 mb-4">
        <div class="tarjeta-mascota animar-entrada">
          <div class="contenedor-imagen-mascota">
            <img src="img/<?= htmlspecialchars($m['foto']) ?>" alt="<?= htmlspecialchars($m['nombredemascota']) ?>" class="imagen-mascota">
          </div>
          <div class="info-mascota">
            <h3 class="nombre-mascota"><?= htmlspecialchars($m['nombredemascota']) ?></h3>
            <p><strong>Zona:</strong> <?= htmlspecialchars($m['ubicacion']) ?></p>
            <a href="detalle-mascota.php?id=<?= $m['id'] ?>" class="boton-contorno">Ver más</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php include 'php/footer.php'; ?>
