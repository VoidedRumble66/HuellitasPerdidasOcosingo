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
          <!-- MENÚ PERFIL DESPLEGABLE -->
          <li class="submenu-perfil">
            <a href="#" class="enlace-navegacion<?= activo('perfil.php'); ?>" id="perfilMenuBtn">
              Mi perfil <span style="font-size:1em;">▼</span>
            </a>
            <ul class="menu-desplegable" id="perfilDropdown">
              <li><a href="perfil.php">Ver perfil</a></li>
              <li><a href="php/cerrar_sesion.php">Cerrar sesión</a></li>
              <li><a href="contacto.php">Contáctanos</a></li>
              <li><a href="nosotros.php">Nosotros</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li><a href="index.php" class="enlace-navegacion<?= activo('index.php'); ?>">Inicio</a></li>
          <li><a href="login.php" class="enlace-navegacion<?= activo('login.php'); ?>">Iniciar sesión</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const perfilBtn = document.getElementById('perfilMenuBtn');
      const dropdown = document.getElementById('perfilDropdown');
      if (perfilBtn && dropdown) {
        perfilBtn.addEventListener('click', function(e) {
          e.preventDefault();
          dropdown.classList.toggle('visible');
        });
        document.addEventListener('click', function(e) {
          if (!perfilBtn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('visible');
          }
        });
      }
    });
</script>

</header>
