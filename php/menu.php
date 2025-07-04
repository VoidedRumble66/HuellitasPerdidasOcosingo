<?php
// php/menu.php — navegación principal
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$paginaActual = basename($_SERVER['PHP_SELF']);
function activo($archivo) {
    global $paginaActual;
    return $paginaActual === $archivo ? ' activo' : '';
}
?>
<header class="encabezado">
  <div class="contenedor navegacion">
    <h1 class="logo">Huellitas Perdidas</h1>
    <nav>
      <ul class="lista-navegacion">
        <?php if(isset($_SESSION['usuario_id'])): ?>
          <li><a href="index.php" class="enlace-navegacion<?= activo('index.php'); ?>">Inicio</a></li>
          <li><a href="extraviados.php" class="enlace-navegacion<?= activo('extraviados.php'); ?>">Mascotas extraviadas</a></li>
          <li><a href="publicar.php" class="enlace-navegacion<?= activo('publicar.php'); ?>">Reportar</a></li>
          <li><a href="contacto.php" class="enlace-navegacion<?= activo('contacto.php'); ?>">Contacto</a></li>
          <li><a href="nosotros.php" class="enlace-navegacion<?= activo('nosotros.php'); ?>">Consejos</a></li>
          <li><a href="php/cerrar_sesion.php" class="enlace-navegacion">Cerrar sesión</a></li>
        <?php else: ?>
          <li><a href="login.php" class="enlace-navegacion<?= activo('login.php'); ?>">Iniciar sesión</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
