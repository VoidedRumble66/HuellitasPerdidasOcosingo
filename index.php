<?php
session_start();
$tituloPagina = 'Inicio';
require 'php/conexion.php';
include 'php/head.php';
include 'php/menu.php';

$sql = "SELECT m.id_mascota, m.nombredemascota, e.nombre AS especie, r.nombre AS raza, m.foto
        FROM mascota m
        LEFT JOIN especie e ON m.id_especie = e.id_especie
        LEFT JOIN raza r ON m.id_raza = r.id_raza
        ORDER BY m.fechadeextravio DESC LIMIT 4";
$res = $conexion->query($sql);
$recientes = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
?>

<!-- DESLIZADOR -->
<section class="deslizador">
  <div class="contenedor-deslizador">
    <div class="diapositiva activa">
      <img src="img/slide1.jpg" alt="Imagen" class="imagen-deslizador">
    </div>
    <div class="diapositiva">
      <img src="img/slide2.jpg" alt="Imagen" class="imagen-deslizador">
    </div>
    <div class="diapositiva">
      <img src="img/slide3.jpg" alt="Imagen" class="imagen-deslizador">
    </div>
  </div>
  <div class="controles-deslizador">
    <span class="prev">&#10094;</span>
    <span class="next">&#10095;</span>
  </div>
</section>

<!-- MASCOTAS RECIENTES -->
<section class="seccion-mascotas-perdidas">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada">Mascotas Extraviadas Recientes</h2>
    <div class="row contenedor-tarjetas">
      <?php foreach ($recientes as $m): ?>
      <div class="col-md-3 mb-4">
        <div class="tarjeta-mascota animar-entrada">
          <div class="contenedor-imagen-mascota">
            <img src="img/<?= htmlspecialchars($m['foto']) ?>" alt="<?= htmlspecialchars($m['nombredemascota']) ?>" class="imagen-mascota">
          </div>
          <div class="info-mascota">
            <h3 class="nombre-mascota"><?= htmlspecialchars($m['nombredemascota']) ?></h3>
            <p><?= htmlspecialchars($m['especie']) ?> - <?= htmlspecialchars($m['raza']) ?></p>
            <a href="detalle-mascota.php?id=<?= $m['id_mascota'] ?>" class="boton-contorno">Ver más</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center mt-3">
      <a href="extraviados.php" class="boton">Ver más mascotas</a>
    </div>
  </div>
</section>

<!-- PREGUNTA -->
<section class="seccion-pregunta bg-light py-5 text-center">
  <div class="contenedor">
    <h2 class="titulo-seccion">¿Perdiste a tu mascota?</h2>
    <a href="publicar.php" class="btn btn-warning m-2">Reportar mascota perdida</a>
    <a href="extraviados.php" class="btn btn-success m-2">Buscar mascotas</a>
  </div>
</section>

<!-- COMO FUNCIONA -->
<section class="seccion-como-funciona py-5 text-center">
  <div class="contenedor">
    <h2 class="titulo-seccion mb-4">¿Cómo funciona?</h2>
    <div class="row">
      <div class="col-md-4 mb-3">
        <div class="paso">
          <div class="circulo bg-success text-white mb-2">1</div>
          <p>Registra o reporta la mascota.</p>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="paso">
          <div class="circulo bg-success text-white mb-2">2</div>
          <p>Comparte la información con la comunidad.</p>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="paso">
          <div class="circulo bg-success text-white mb-2">3</div>
          <p>Reúne a la familia con su mascota.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    let indice = 0;
    const diapositivas = Array.from(document.querySelectorAll('.diapositiva'));
    const siguiente = document.querySelector('.next');
    const anterior = document.querySelector('.prev');
    function mostrar(i) {
      diapositivas.forEach((d, idx) => d.classList.toggle('activa', idx === i));
    }
    if (diapositivas.length) {
      siguiente.addEventListener('click', () => mostrar(indice = (indice + 1) % diapositivas.length));
      anterior.addEventListener('click', () => mostrar(indice = (indice - 1 + diapositivas.length) % diapositivas.length));
      setInterval(() => mostrar(indice = (indice + 1) % diapositivas.length), 5000);
      mostrar(indice);
    }
  });
</script>

<?php include 'php/footer.php'; ?>

