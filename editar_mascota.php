<?php
session_start();
require 'php/conexion.php';
include 'php/head.php';
include 'php/menu.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$id_usuario = $_SESSION['usuario_id'];
$id_mascota = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verifica que la mascota sea del usuario actual
$stmt = $conexion->prepare("SELECT nombredemascota, id_especie, id_raza, descripcion, ubicacion, fechadeextravio FROM mascota WHERE id_mascota=? AND id_usuario=?");
$stmt->bind_param('ii', $id_mascota, $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$mascota = $result->fetch_assoc();
$stmt->close();

if (!$mascota) {
    echo "<div class='contenedor'><p>No se encontró la mascota o no tienes permiso.</p></div>";
    include 'php/footer.php';
    exit;
}

// Carga especies y razas (opcionalmente podrías tener arrays o consultarlos de la BD)
$especies = [];
$res = $conexion->query("SELECT id_especie, nombre FROM especie");
while ($row = $res->fetch_assoc()) $especies[] = $row;

$razas = [];
$res = $conexion->query("SELECT id_raza, nombre FROM raza");
while ($row = $res->fetch_assoc()) $razas[] = $row;

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombredemascota']);
    $id_especie = intval($_POST['id_especie']);
    $id_raza = intval($_POST['id_raza']);
    $descripcion = trim($_POST['descripcion']);
    $ubicacion = trim($_POST['ubicacion']);
    $fecha = $_POST['fechadeextravio'];

    $stmt = $conexion->prepare("UPDATE mascota SET nombredemascota=?, id_especie=?, id_raza=?, descripcion=?, ubicacion=?, fechadeextravio=? WHERE id_mascota=? AND id_usuario=?");
    $stmt->bind_param('siisssii', $nombre, $id_especie, $id_raza, $descripcion, $ubicacion, $fecha, $id_mascota, $id_usuario);
    $stmt->execute();
    $stmt->close();

    header("Location: perfil.php?editadomascota=1");
    exit;
}
?>
<section class="seccion-publicar">
  <div class="contenedor">
    <h2 class="titulo-seccion">Editar Mascota</h2>
    <form action="" method="POST" class="formulario-publicar">
      <div class="grupo-formulario">
        <label for="nombredemascota">Nombre</label>
        <input type="text" name="nombredemascota" value="<?= htmlspecialchars($mascota['nombredemascota']) ?>" required>
      </div>
      <div class="grupo-formulario">
        <label for="id_especie">Especie</label>
        <select name="id_especie" required>
          <?php foreach ($especies as $esp): ?>
            <option value="<?= $esp['id_especie'] ?>" <?= $mascota['id_especie'] == $esp['id_especie'] ? 'selected' : '' ?>><?= htmlspecialchars($esp['nombre']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="grupo-formulario">
        <label for="id_raza">Raza</label>
        <select name="id_raza" required>
          <?php foreach ($razas as $ra): ?>
            <option value="<?= $ra['id_raza'] ?>" <?= $mascota['id_raza'] == $ra['id_raza'] ? 'selected' : '' ?>><?= htmlspecialchars($ra['nombre']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="grupo-formulario">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" rows="3" required><?= htmlspecialchars($mascota['descripcion']) ?></textarea>
      </div>
      <div class="grupo-formulario">
        <label for="ubicacion">Ubicación</label>
        <input type="text" name="ubicacion" value="<?= htmlspecialchars($mascota['ubicacion']) ?>" required>
      </div>
      <div class="grupo-formulario">
        <label for="fechadeextravio">Fecha de extravío</label>
        <input type="date" name="fechadeextravio" value="<?= htmlspecialchars($mascota['fechadeextravio']) ?>" required>
      </div>
      <button type="submit" class="boton">Guardar cambios</button>
      <a href="perfil.php" class="boton-contorno mt-2">Cancelar</a>
    </form>
  </div>
</section>
<?php include 'php/footer.php'; ?>
