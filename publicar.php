<?php
// publicar.php — formulario para reportar mascota extraviada
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$tituloPagina = 'Publicar Mascota';
include 'php/head.php';   // Carga <head> y apertura de <body>
include 'php/menu.php';   // Carga el menú de navegación
?>

<!-- SECCIÓN: PUBLICAR MASCOTA -->
<section class="seccion-publicar">
  <div class="contenedor">
    <!-- Título de la sección -->
    <h2 class="titulo-seccion animar-entrada">Publicar Mascota Extraviada</h2>

    <!-- Formulario de publicación -->
    <form class="formulario-publicar animar-entrada"
          action="php/procesar_publicar.php" method="post" enctype="multipart/form-data">

      <h3>Datos del responsable</h3>
      <div class="row">
        <div class="col-md-6 grupo-formulario">
          <label for="nombre">Nombre completo:</label>
          <input type="text" id="nombre" name="nombre"
                 class="entrada-texto" required>
        </div>
        <div class="col-md-6 grupo-formulario">
          <label for="correo">Correo electrónico:</label>
          <input type="email" id="correo" name="correo"
                 class="entrada-texto" required>
        </div>
        <div class="col-md-6 grupo-formulario">
          <label for="telefono">Teléfono de contacto:</label>
          <input type="tel" id="telefono" name="telefono"
                 class="entrada-texto" required>
        </div>
      </div>

      <h3>Datos de la mascota</h3>
      <div class="row">
        <div class="col-md-4 grupo-formulario">
          <label for="nombreMascota">Nombre de la mascota:</label>
          <input type="text" id="nombreMascota" name="nombreMascota"
                 class="entrada-texto">
        </div>
        <div class="col-md-4 grupo-formulario">
          <label for="especie">Especie:</label>
          <select id="especie" name="especie" class="entrada-texto">
            <option value="perro">Perro</option>
            <option value="gato">Gato</option>
            <option value="otro">Otro</option>
          </select>
        </div>
        <div class="col-md-4 grupo-formulario">
          <label for="color">Color predominante:</label>
          <input type="text" id="color" name="color"
                 class="entrada-texto">
        </div>
        <div class="col-md-4 grupo-formulario">
          <label for="ubicacion">Zona o colonia:</label>
          <input type="text" id="ubicacion" name="ubicacion" class="entrada-texto" required>
        </div>
        <div class="col-md-12 grupo-formulario">
          <label for="foto">Foto de la mascota:</label>
          <input type="file" id="foto" name="foto"
                 class="entrada-archivo" accept="image/*">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 grupo-formulario">
          <label for="fecha">Fecha del extravío:</label>
          <input type="date" id="fecha" name="fecha"
                 class="entrada-texto" required>
        </div>
        <div class="col-md-6 grupo-formulario">
          <label for="descripcion">Descripción adicional:</label>
          <textarea id="descripcion" name="descripcion"
                    rows="3" class="entrada-texto"></textarea>
        </div>
      </div>

      <div class="grupo-formulario text-center mt-4">
        <button type="submit" class="boton">Publicar reporte</button>
      </div>
    </form>
  </div>
</section>

<?php
include 'php/footer.php';  
?>
