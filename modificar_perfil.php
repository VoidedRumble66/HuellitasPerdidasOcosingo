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

// Si envió el formulario (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    $fechanacimiento = $_POST['fechanacimiento'];

    $stmt = $conexion->prepare("UPDATE usuario SET nombre=?, correo=?, telefono=?, fechanacimiento=? WHERE id_usuario=?");
    $stmt->bind_param('ssssi', $nombre, $correo, $telefono, $fechanacimiento, $id_usuario);
    $stmt->execute();
    $stmt->close();

    // Redirige al perfil con éxito
    header("Location: perfil.php?modificado=1");
    exit;
}

// Si solo está viendo la página, carga datos
$stmt = $conexion->prepare("SELECT nombre, correo, telefono, fechanacimiento FROM usuario WHERE id_usuario=?");
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$stmt->bind_result($nombre, $correo, $telefono, $fechanacimiento);
$stmt->fetch();
$stmt->close();
?>

<section class="seccion-perfil">
  <div class="contenedor perfil-contenedor">
    <h2 class="titulo-seccion mb-4">Modificar Perfil</h2>
    <form action="" method="POST" class="formulario-publicar" style="max-width:420px;">
      <div class="grupo-formulario">
        <label for="nombre">Nombre completo</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>
      </div>
      <div class="grupo-formulario">
        <label for="correo">Correo electrónico</label>
        <input type="email" name="correo" value="<?= htmlspecialchars($correo) ?>" required>
      </div>
      <div class="grupo-formulario">
        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" value="<?= htmlspecialchars($telefono) ?>">
      </div>
      <div class="grupo-formulario">
        <label for="fechanacimiento">Fecha de nacimiento</label>
        <input type="date" name="fechanacimiento" value="<?= htmlspecialchars($fechanacimiento) ?>" required>
      </div>
      <button type="submit" class="boton">Guardar cambios</button>
      <a href="perfil.php" class="boton-contorno mt-2">Cancelar</a>
    </form>
  </div>
</section>
<?php include 'php/footer.php'; ?>
