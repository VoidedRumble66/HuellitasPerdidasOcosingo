<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
$tituloPagina = 'Iniciar Sesión';
include 'php/head.php';
include 'php/menu.php';
?>
<section class="seccion-login">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada text-center">Iniciar Sesión</h2>
    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['flash']; ?></div>
      <?php unset($_SESSION['flash']); endif; ?>
    <form action="php/procesar_login.php" method="post" class="formulario-login animar-entrada">
      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" name="email" id="email" required class="form-control" placeholder="ejemplo@correo.com" autocomplete="username">
      </div>
          <div class="mb-3 position-relative">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" required class="form-control" autocomplete="current-password">
            <span class="toggle-password" onclick="togglePassword('password', this)">👁️</span>
          </div>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="#" class="link-recuperar">¿Olvidaste tu contraseña?</a>
      </div>
      <button type="submit" class="btn btn-primary btn-block w-100">Iniciar sesión</button>
    </form>
    <p class="mt-3 text-center">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
  </div>
    <script>
  function togglePassword(inputId, elem) {
    const input = document.getElementById(inputId);
    if (!input) return;
    if (input.type === "password") {
      input.type = "text";
      elem.textContent = "🙈";
    } else {
      input.type = "password";
      elem.textContent = "👁️";
    }
  }
  </script>

</section>
<?php include 'php/footer.php'; ?>


