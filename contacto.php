<?php
// contacto.php — formulario de contacto
$tituloPagina = 'Contáctanos';
include 'php/head.php';   // Metadatos, CSS y <body>
include 'php/menu.php';   // Menú de navegación
?>

<!-- SECCIÓN: CONTÁCTANOS -->
<section class="seccion-contacto">
  <div class="contenedor">
    <!-- Título y subtítulo -->
    <h2 class="titulo-seccion animar-entrada">Contáctanos</h2>
    <p class="texto-contacto animar-entrada">
      ¿Tienes dudas, sugerencias o deseas colaborar? Escríbenos y te responderemos a la brevedad.
    </p>

    <!-- Formulario de contacto -->
    <form class="formulario-contacto animar-entrada" action="#" method="post">
      <div class="row">
        <div class="col-md-6 grupo-formulario">
          <label for="nombre">Tu nombre:</label>
          <input type="text" id="nombre" name="nombre" class="entrada-texto" required>
        </div>
        <div class="col-md-6 grupo-formulario">
          <label for="correo">Correo electrónico:</label>
          <input type="email" id="correo" name="correo" class="entrada-texto" required>
        </div>
        <div class="col-12 grupo-formulario">
          <label for="mensaje">Tu mensaje:</label>
          <textarea id="mensaje" name="mensaje" rows="4" class="entrada-texto" required></textarea>
        </div>
      </div>

      <!-- Botón enviar -->
      <div class="grupo-formulario text-center mt-4">
        <button type="submit" class="boton">Enviar mensaje</button>
      </div>
    </form>
  </div>
</section>

<?php
include 'php/footer.php';  // Pie de página y scripts
?>
