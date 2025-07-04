<?php
// index.php — página principal
$tituloPagina = 'Inicio';
include 'php/head.php';   
include 'php/menu.php';    
?>

<!-- DESLIZADOR -->
<section class="deslizador">
  <div class="contenedor-deslizador">
    <div class="diapositiva activa">
      <img src="img/slide1.jpg" alt="Mascota extraviada" class="imagen-deslizador">
      <div class="texto-deslizador animar-entrada">
        <h2>Ayudemos a reunir familias</h2>
        <p>Una plataforma para encontrar y reportar mascotas extraviadas en Ocosingo.</p>
        <a href="publicar.php" class="boton">Publicar reporte</a>
      </div>
    </div>
    <div class="diapositiva">
      <img src="img/slide2.jpg" alt="Perro feliz" class="imagen-deslizador">
      <div class="texto-deslizador animar-entrada">
        <h2>¿Has visto una mascota perdida?</h2>
        <p>Ingresa el reporte y ayuda a encontrarla más rápido.</p>
        <a href="buscar.php" class="boton">Buscar mascota</a>
      </div>
    </div>
    <div class="diapositiva">
      <img src="img/slide3.jpg" alt="Mapa con ubicación" class="imagen-deslizador">
      <div class="texto-deslizador animar-entrada">
        <h2>Con tecnología y empatía</h2>
        <p>Mapas, testimonios y conexión entre usuarios.</p>
        <a href="mapa.php" class="boton">Ver mapa</a>
      </div>
    </div>
  </div>
  <div class="controles-deslizador">
    <span class="prev">&#10094;</span>
    <span class="next">&#10095;</span>
  </div>
</section>

<!-- INTRODUCCIÓN -->
<section class="introduccion">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada">¿Qué es Patitas Perdidas?</h2>
    <p class="texto-intro animar-entrada">
      Es una plataforma comunitaria que permite reportar, localizar y compartir información sobre mascotas
      extraviadas en Ocosingo. Con geolocalización, perfiles de mascotas y contacto directo, ayudamos a
      reunir familias peludas.
    </p>
    <div class="row grupo-botones">
      <div class="col-md-6">
        <a href="extraviados.php" class="boton">Ver reportes</a>
      </div>
      <div class="col-md-6">
        <a href="publicar.php" class="boton-contorno">Publicar mascota</a>
      </div>
    </div>
  </div>
</section>


<section class="galeria">
  <div class="contenedor contenedor-galeria row">
    <div class="col-md-4 animar-entrada">
      <img src="img/gato1.jpg" alt="Mascota destacada 1" class="imagen-galeria">
    </div>
    <div class="col-md-4 animar-entrada">
      <img src="img/perro1.jpg" alt="Mascota destacada 2" class="imagen-galeria">
    </div>
    <div class="col-md-4 animar-entrada">
      <img src="img/perro2.jpg" alt="Mascota destacada 3" class="imagen-galeria">
    </div>
  </div>
</section>

<!-- TESTIMONIOS -->
<section class="seccion-testimonios">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada">Testimonios</h2>
    <div class="row">
      <div class="col-md-6 item-testimonio animar-entrada">
        <p class="texto-testimonio">“Gracias a esta página encontramos a Toby en menos de 2 días. ¡Mil gracias!”</p>
        <p class="nombre-testimonio">– María Gómez</p>
      </div>
      <div class="col-md-6 item-testimonio animar-entrada">
        <p class="texto-testimonio">“La plataforma es fácil de usar y muy efectiva.”</p>
        <p class="nombre-testimonio">– Carlos Ramírez</p>
      </div>
    </div>
  </div>
</section>

<!-- Script para mostrar modal y controlar slider -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Iniciar modal de login
    var modalLogin = new bootstrap.Modal(document.getElementById('modalLogin'));
    modalLogin.show();

    // Slider a componer
    let indice = 0;
    const diapositivas = Array.from(document.querySelectorAll('.diapositiva'));
    const siguiente = document.querySelector('.next');
    const anterior = document.querySelector('.prev');
    if (diapositivas.length && siguiente && anterior) {
      function mostrar(i) {
        diapositivas.forEach((d, idx) => d.classList.toggle('activa', idx === i));
      }
      siguiente.addEventListener('click', () => mostrar(indice = (indice + 1) % diapositivas.length));
      anterior.addEventListener('click', () => mostrar(indice = (indice - 1 + diapositivas.length) % diapositivas.length));
      setInterval(() => mostrar(indice = (indice + 1) % diapositivas.length), 5000);
      mostrar(indice);
    }
  });
</script>

<?php include 'php/footer.php'; ?>

