<?php
// nosotros.php — sección “Nosotros”
$tituloPagina = 'Nosotros';
include 'php/head.php';   // Metadatos, CSS y apertura de <body>
include 'php/menu.php';   // Menú de navegación
?>

<!-- SECCIÓN: NOSOTROS -->
<section class="seccion-nosotros">
  <div class="contenedor">
    <!-- ¿Quiénes somos? -->
    <h2 class="titulo-seccion animar-entrada">¿Quiénes somos?</h2>
    <p class="texto-nosotros animar-entrada">
      Somos un equipo de estudiantes de la Universidad Tecnológica de la Selva comprometidos con el 
      bienestar animal en Ocosingo. Nuestra misión es facilitar el reencuentro entre mascotas extraviadas 
      y sus familias mediante tecnología comunitaria.
    </p>

    <!-- ¿Qué hacemos? -->
    <h2 class="titulo-seccion animar-entrada">¿Qué hacemos?</h2>
    <p class="texto-nosotros animar-entrada">
      Desarrollamos esta plataforma como proyecto académico con impacto social. Aquí, cualquiera puede 
      reportar una mascota perdida o ayudar compartiendo información.
    </p>

    <!-- ¿Por qué lo hacemos? -->
    <h2 class="titulo-seccion animar-entrada">¿Por qué lo hacemos?</h2>
    <p class="texto-nosotros animar-entrada">
      Creemos que la tecnología debe resolver problemas reales. Las mascotas son parte de la familia y 
      sabemos lo doloroso que es perderlas. Ponemos nuestro aprendizaje al servicio de la comunidad.
    </p>

    <!-- ¿Cómo lo hacemos? -->
    <h2 class="titulo-seccion animar-entrada">¿Cómo lo hacemos?</h2>
    <p class="texto-nosotros animar-entrada">
      Usamos herramientas web, mapas interactivos, formularios y diseño accesible para que cualquier 
      persona, incluso desde un móvil, pueda usar la plataforma.
    </p>

    <!-- ¿Cómo puedes ayudar? -->
    <h2 class="titulo-seccion animar-entrada">¿Cómo puedes ayudar?</h2>
    <div class="row">
      <div class="col-md-4 grupo-formulario animar-entrada">
        <p class="texto-nosotros">Reportando una mascota extraviada.</p>
      </div>
      <div class="col-md-4 grupo-formulario animar-entrada">
        <p class="texto-nosotros">Compartiendo anuncios en redes sociales.</p>
      </div>
      <div class="col-md-4 grupo-formulario animar-entrada">
        <p class="texto-nosotros">Ofreciendo datos de avistamientos.</p>
      </div>
    </div>
  </div>
</section>

<?php
include 'php/footer.php';  // Pie de página y scripts (jQuery, Bootstrap JS, ScrollReveal…)
?>
