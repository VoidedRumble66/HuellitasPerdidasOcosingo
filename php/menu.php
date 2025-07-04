<?php
// php/menu.php — navegación principal
session_start();
?>
<header class="encabezado">
  <div class="contenedor navegacion">
    <h1 class="logo">Patitas Perdidas <span>Ocosingo</span></h1>
    <nav>
      <ul class="lista-navegacion">
        <li><a href="index.php" class="enlace-navegacion">Inicio</a></li>
        <?php if(isset($_SESSION['usuario_id'])): ?>
          <li><a href="publicar.php" class="enlace-navegacion">Publicar</a></li>
          <li><a href="extraviados.php" class="enlace-navegacion">Extraviados</a></li>
          <li><a href="contacto.php" class="enlace-navegacion">Contáctanos</a></li>
          <li><a href="nosotros.php" class="enlace-navegacion">Nosotros</a></li>
          <li><a href="php/cerrar_sesion.php" class="enlace-navegacion">Cerrar sesión</a></li>
        <?php else: ?>
          <li><a href="login.php" class="enlace-navegacion">Iniciar sesión</a></li>
          <li><a href="registro.php" class="enlace-navegacion">Registro</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
