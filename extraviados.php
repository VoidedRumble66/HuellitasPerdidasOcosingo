<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$tituloPagina = 'Mascotas Extraviadas';
require 'php/conexion.php';
include 'php/head.php';
include 'php/menu.php';

// Consulta de mascotas extraviadas
$sql = "SELECT m.id_mascota, m.nombredemascota, e.nombre AS especie, r.nombre AS raza, m.ubicacion, m.foto, m.fechadeextravio
        FROM mascota m
        LEFT JOIN especie e ON m.id_especie = e.id_especie
        LEFT JOIN raza r ON m.id_raza = r.id_raza
        ORDER BY m.fechadeextravio DESC";
$resultado = $conexion->query($sql);
$mascotas = $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
?>

<section class="seccion-mascotas-extraviadas">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada text-center">Mascotas Extraviadas</h2>

    <!-- Barra de Filtros -->
    <form class="filtros-mascotas mb-4 d-flex flex-wrap justify-content-center gap-3">
      <input type="text" name="buscar" class="form-control filtro-texto" placeholder="Buscar por nombre, barrio...">
      <select name="especie" class="form-control filtro-select">
        <option value="">Especie</option>
        <option>Perro</option>
        <option>Gato</option>
      </select>
      <select name="raza" class="form-control filtro-select">
        <option value="">Raza</option>
        <option>Chihuahua</option>
        <option>Shiba Inu</option>
        <option>Himalayo</option>
        <option>Salchicha</option>
        <option>Rottweiler</option>
        <option>Border Collie</option>
      </select>
      <button type="submit" class="boton">Filtrar</button>
    </form>

    <!-- Tarjetas de mascotas -->
    <div class="row contenedor-tarjetas">
      <?php foreach ($mascotas as $m): ?>
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="tarjeta-mascota animar-entrada">
          <div class="contenedor-imagen-mascota">
            <img src="img/<?= htmlspecialchars($m['foto']) ?>" alt="<?= htmlspecialchars($m['nombredemascota']) ?>" class="imagen-mascota">
          </div>
          <div class="info-mascota">
            <h3 class="nombre-mascota mb-2"><?= htmlspecialchars($m['nombredemascota']) ?></h3>
            <p class="mb-2">
              <span class="badge badge-especie"><?= htmlspecialchars($m['especie']) ?></span>
              <span class="badge badge-raza"><?= htmlspecialchars($m['raza']) ?></span>
            </p>
            <p class="mb-1"><strong>Barrio:</strong> <?= htmlspecialchars($m['ubicacion']) ?></p>
            <p class="mb-2"><strong>Fecha de extravío:</strong> <?= date('d/m/Y', strtotime($m['fechadeextravio'])) ?></p>
            <a href="detalle-mascota.php?id=<?= $m['id_mascota'] ?>" class="boton-contorno w-100">Ver detalles</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Paginación visual -->
    <nav class="paginacion mt-4">
      <ul class="pagination justify-content-center">
        <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
      </ul>
    </nav>
  </div>
</section>

<section class="seccion-pregunta bg-light py-5 text-center">
  <div class="contenedor">
    <h2 class="titulo-seccion">¿Perdiste a tu mascota?</h2>
    <a href="publicar.php" class="btn btn-warning m-2">Reportar mascota perdida</a>
    <a href="extraviados.php" class="btn btn-success m-2">Buscar mascota</a>
  </div>
</section>

<?php include 'php/footer.php'; ?>
