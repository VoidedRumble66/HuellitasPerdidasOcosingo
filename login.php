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
    <h2 class="titulo-seccion animar-entrada">Iniciar Sesión</h2>
    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['flash']; ?></div>
      <?php unset($_SESSION['flash']); endif; ?>
    <form action="php/procesar_login.php" method="post" class="formulario-login animar-entrada">
      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" name="email" id="email" required class="form-control">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" id="password" required class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
    <p class="mt-3">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
  </div>
</section>
<?php include 'php/footer.php'; ?>

