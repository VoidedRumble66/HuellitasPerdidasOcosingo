<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
$tituloPagina = 'Registro';
include 'php/head.php';
include 'php/menu.php';
?>
<section class="seccion-registro">
  <div class="contenedor">
    <h2 class="titulo-seccion animar-entrada">Crear Cuenta</h2>
    <?php if (!empty($_SESSION['flash'])): ?>
      <div class="alert alert-danger"><?= $_SESSION['flash']; ?></div>
      <?php unset($_SESSION['flash']); endif; ?>
    <form action="php/procesar_registro.php" method="post" class="formulario-registro animar-entrada">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre completo</label>
        <input type="text" name="nombre" id="nombre" required class="form-control">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" name="email" id="email" required class="form-control">
      </div>
      <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="tel" name="telefono" id="telefono" required class="form-control">
      </div>
      <div class="mb-3">
        <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
        <input type="date" name="nacimiento" id="nacimiento" required class="form-control">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" id="password" required class="form-control">
      </div>
      <div class="mb-3">
        <label for="confirmar" class="form-label">Confirmar contraseña</label>
        <input type="password" name="confirmar" id="confirmar" required class="form-control">
      </div>

        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" id="password" required class="form-control">
      </div>



      <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
    <p class="mt-3">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
  </div>
</section>
<?php include 'php/footer.php'; ?>

