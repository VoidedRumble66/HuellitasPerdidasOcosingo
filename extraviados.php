<?php
// extraviados.php — listado de mascotas extraviadas
$tituloPagina = 'Extraviados';
include 'php/head.php';
include 'php/menu.php';
?>

<section class="seccion-mascotas-perdidas">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada">Mascotas Extraviadas</h2>

    <!-- Botón para crear un nuevo reporte -->
    <div class="text-end mb-4">
      <a href="crear-extraviado.php" class="boton">+ Nuevo reporte</a>
    </div>

    <div class="row contenedor-tarjetas">
      <!-- Tarjeta 1 -->
      <div class="col-md-4 mb-4">
        <div class="tarjeta-mascota animar-entrada">
          <div class="contenedor-imagen-mascota">
            <img src="img/perro1.jpg" alt="Rocky" class="imagen-mascota">
          </div>
          <div class="info-mascota">
            <h3 class="nombre-mascota">Rocky</h3>
            <p><strong>Especie:</strong> Perro</p>
            <p><strong>Color:</strong> Negro</p>
            <p><strong>Zona:</strong> Colonia Centro</p>
            <!-- Ver detalle -->
            <a href="detalle-mascota.php?id=1" class="boton-contorno">Ver más</a>
            <!-- Editar registro -->
            <a href="editar-extraviado.php?id=1" class="boton-contorno ms-2">Editar</a>
          </div>
        </div>
      </div>

      <!-- Tarjeta 2 -->
      <div class="col-md-4 mb-4">
        <div class="tarjeta-mascota animar-entrada">
          <div class="contenedor-imagen-mascota">
            <img src="img/gato1.jpg" alt="Michi" class="imagen-mascota">
          </div>
          <div class="info-mascota">
            <h3 class="nombre-mascota">Michi</h3>
            <p><strong>Especie:</strong> Gato</p>
            <p><strong>Color:</strong> Gris</p>
            <p><strong>Zona:</strong> Barrio San Antonio</p>
            <a href="detalle-mascota.php?id=2" class="boton-contorno">Ver más</a>
            <a href="editar-extraviado.php?id=2" class="boton-contorno ms-2">Editar</a>
          </div>
        </div>
      </div>

      <!-- Tarjeta 3 -->
      <div class="col-md-4 mb-4">
        <div class="tarjeta-mascota animar-entrada">
          <div class="contenedor-imagen-mascota">
            <img src="img/perro2.jpg" alt="Toby" class="imagen-mascota">
          </div>
          <div class="info-mascota">
            <h3 class="nombre-mascota">Toby</h3>
            <p><strong>Especie:</strong> Perro</p>
            <p><strong>Color:</strong> Marrón</p>
            <p><strong>Zona:</strong> Cerca del mercado</p>
            <a href="detalle-mascota.php?id=3" class="boton-contorno">Ver más</a>
            <a href="editar-extraviado.php?id=3" class="boton-contorno ms-2">Editar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
include 'php/footer.php';
?>

