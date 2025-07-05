<?php
// publicar.php — formulario para reportar mascota extraviada
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$tituloPagina = 'Reportar Mascota';
require 'php/conexion.php';
include 'php/head.php';
include 'php/menu.php';

// Obtener datos del usuario que inició sesión
$idUsuario = $_SESSION['usuario_id'];
$usuario = $conexion->query("SELECT nombre, correo, telefono FROM usuario WHERE id_usuario = $idUsuario")->fetch_assoc();

$especies = $conexion->query("SELECT id_especie, nombre FROM especie")->fetch_all(MYSQLI_ASSOC);
$razas = $conexion->query("SELECT id_raza, nombre FROM raza")->fetch_all(MYSQLI_ASSOC);
?>

<section class="seccion-publicar">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada text-center">Reportar Mascota</h2>

    <form class="formulario-publicar animar-entrada"
          action="php/procesar_publicar.php" method="post" enctype="multipart/form-data">
      
      <!-- Informacion del usuario -->
      <h3>Información del responsable</h3>
      <div class="row mb-3">
        <div class="col-md-6 grupo-formulario">
          <label>ID de Usuario</label>
          <input type="text" class="entrada-texto" value="USR-<?= $idUsuario ?>" readonly disabled>
        </div>
        <div class="col-md-6 grupo-formulario">
          <label>Nombre completo</label>
          <input type="text" class="entrada-texto" value="<?= htmlspecialchars($usuario['nombre']) ?>" readonly disabled>
        </div>
        <div class="col-md-6 grupo-formulario">
          <label>Correo electrónico</label>
          <input type="email" class="entrada-texto" value="<?= htmlspecialchars($usuario['correo']) ?>" readonly disabled>
        </div>
        <div class="col-md-6 grupo-formulario">
          <label>Teléfono</label>
          <input type="tel" class="entrada-texto" value="<?= htmlspecialchars($usuario['telefono']) ?>" readonly disabled>
        </div>
      </div>
      <input type="hidden" name="usuario_id" value="<?= $idUsuario ?>">

      <!-- Datos de la mascota -->
      <h3>Información de la mascota</h3>
      <div class="row mb-3">
        <div class="col-md-6 grupo-formulario">
          <label for="nombreMascota">Nombre de mascota <span style="color:red">*</span></label>
          <input type="text" id="nombreMascota" name="nombreMascota" class="entrada-texto" required>
        </div>
        <div class="col-md-6 grupo-formulario">
          <label for="ubicacion">Ubicación <span style="color:red">*</span></label>
          <input type="text" id="ubicacion" name="ubicacion" class="entrada-texto" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-4 grupo-formulario">
          <label for="especie">Especie <span style="color:red">*</span></label>
          <select id="especie" name="especie" class="entrada-texto" required>
            <option value="">Selecciona especie</option>
            <?php foreach ($especies as $e): ?>
              <option value="<?= $e['id_especie'] ?>"><?= htmlspecialchars($e['nombre']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4 grupo-formulario">
          <label for="raza">Raza <span style="color:red">*</span></label>
          <select id="raza" name="raza" class="entrada-texto" required>
            <option value="">Selecciona raza</option>
            <?php foreach ($razas as $r): ?>
              <option value="<?= $r['id_raza'] ?>"><?= htmlspecialchars($r['nombre']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4 grupo-formulario">
          <label for="fecha">Fecha de extravío <span style="color:red">*</span></label>
          <input type="date" id="fecha" name="fecha" class="entrada-texto" required>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-12 grupo-formulario">
          <label for="descripcion">Descripción detallada <span style="color:red">*</span></label>
          <textarea id="descripcion" name="descripcion" rows="3" class="entrada-texto" placeholder="Color, edad, señas, collar, etc." required></textarea>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-12 grupo-formulario">
          <label for="foto">Foto de la mascota <span style="color:red">*</span></label>
          <div class="form-upload">
            <input type="file" id="foto" name="foto" class="entrada-archivo" accept="image/*" required>
            <div class="upload-msg">Arrastra una imagen aquí o haz clic para seleccionar archivo</div>
          </div>
        </div>
      </div>
      <div class="grupo-formulario text-center mt-4">
        <button type="submit" class="boton">Publicar reporte</button>
      </div>
    </form>
  </div>
</section>

<?php include 'php/footer.php'; ?>
