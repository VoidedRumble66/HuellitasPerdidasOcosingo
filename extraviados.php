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

// 1. Leer filtros
$buscar  = isset($_GET['buscar'])  ? trim($_GET['buscar'])  : '';
$especie = isset($_GET['especie']) ? trim($_GET['especie']) : '';
$raza    = isset($_GET['raza'])    ? trim($_GET['raza'])    : '';

// Obtener especies y razas de la BD
$especies = [];
$res_especie = $conexion->query("SELECT nombre FROM especie ORDER BY nombre ASC");
while ($row = $res_especie->fetch_assoc()) $especies[] = $row['nombre'];

$razas = [];
$res_raza = $conexion->query("SELECT nombre FROM raza ORDER BY nombre ASC");
while ($row = $res_raza->fetch_assoc()) $razas[] = $row['nombre'];

// 2. Construir filtro dinámico
$where = [];
$params = [];
$types = '';

if ($buscar != '') {
    $where[] = "(m.nombredemascota LIKE ? OR m.ubicacion LIKE ?)";
    $params[] = "%$buscar%";
    $params[] = "%$buscar%";
    $types .= 'ss';
}
if ($especie != '') {
    $where[] = "e.nombre = ?";
    $params[] = $especie;
    $types .= 's';
}
if ($raza != '') {
    $where[] = "r.nombre = ?";
    $params[] = $raza;
    $types .= 's';
}

$whereSQL = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

$sql = "SELECT m.id_mascota, m.nombredemascota, e.nombre AS especie, r.nombre AS raza, m.ubicacion, m.foto, m.fechadeextravio
        FROM mascota m
        LEFT JOIN especie e ON m.id_especie = e.id_especie
        LEFT JOIN raza r ON m.id_raza = r.id_raza
        $whereSQL
        ORDER BY m.fechadeextravio DESC";

if (!empty($params)) {
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $mascotas = $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
    $stmt->close();
} else {
    $resultado = $conexion->query($sql);
    $mascotas = $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
}
?>

<section class="seccion-mascotas-extraviadas">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada text-center">Mascotas Extraviadas</h2>

    <!-- Barra de Filtros -->
    <form class="filtros-mascotas mb-4 d-flex flex-wrap justify-content-center gap-3" method="get">
      <input type="text" name="buscar" value="<?= htmlspecialchars($buscar) ?>" class="form-control filtro-texto" placeholder="Buscar por nombre, barrio...">
      <select name="especie" class="form-control filtro-select">
        <option value="">Especie</option>
        <?php foreach ($especies as $esp): ?>
          <option value="<?= htmlspecialchars($esp) ?>" <?= $especie == $esp ? 'selected' : '' ?>>
            <?= htmlspecialchars($esp) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <select name="raza" class="form-control filtro-select">
        <option value="">Raza</option>
        <?php foreach ($razas as $rz): ?>
          <option value="<?= htmlspecialchars($rz) ?>" <?= $raza == $rz ? 'selected' : '' ?>>
            <?= htmlspecialchars($rz) ?>
          </option>
        <?php endforeach; ?>
      </select>
      <button type="submit" class="boton">Filtrar</button>
    </form>

    <!-- Tarjetas de mascotas -->
    <div class="row contenedor-tarjetas">
      <?php if(count($mascotas)): ?>
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
      <?php else: ?>
        <div class="col-12">
          <p class="text-center">No se encontraron mascotas con ese filtro.</p>
        </div>
      <?php endif; ?>
    </div>

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
