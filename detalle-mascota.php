<?php
// Inicio de sesión y archivos comunes
session_start();
require 'php/conexion.php';
include 'php/head.php';
include 'php/menu.php';

// Obtiene el id de la mascota desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$mascota = null;

// Si existe un id válido, consulta los datos de la mascota
if ($id > 0) {
    $stmt = $conexion->prepare('SELECT m.nombredemascota, e.nombre AS especie, r.nombre AS raza, m.descripcion, m.foto, m.ubicacion, m.fechadeextravio, m.id_usuario
                                FROM mascota m
                                LEFT JOIN especie e ON m.id_especie = e.id_especie
                                LEFT JOIN raza r ON m.id_raza = r.id_raza
                                WHERE m.id_mascota = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $mascota = $stmt->get_result()->fetch_assoc();
}
?>
<?php if ($mascota): ?>
<section class="seccion-detalle-mascota">
  <div class="contenedor">
    <div class="row tarjeta-detalle animar-entrada" style="background:#fff; border-radius:16px; box-shadow:0 8px 32px rgba(0,0,0,0.06); padding:28px; align-items:center;">
      <div class="col-md-6 contenedor-imagen-detalle" style="margin-bottom:20px;">
        <img src="img/<?= htmlspecialchars($mascota['foto']) ?>" alt="<?= htmlspecialchars($mascota['nombredemascota']) ?>" class="imagen-detalle-mascota" style="max-width:100%; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.08);">
      </div>
      <div class="col-md-6 info-detalle-mascota">
        <h2 class="nombre-mascota mb-2" style="color:#4CAF50; font-size:2.2em;"><?= htmlspecialchars($mascota['nombredemascota']) ?></h2>
        <p>
          <span class="badge badge-especie"><?= htmlspecialchars($mascota['especie']) ?></span>
          <span class="badge badge-raza"><?= htmlspecialchars($mascota['raza']) ?></span>
        </p>
        <p style="margin-top:20px;"><strong>Ubicación:</strong> <?= htmlspecialchars($mascota['ubicacion']) ?></p>
        <p><strong>Fecha de extravío:</strong> <?= date('d/m/Y', strtotime($mascota['fechadeextravio'])) ?></p>
        <p style="margin-bottom:20px;"><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($mascota['descripcion'])) ?></p>
        <p><strong>ID de Usuario: </strong> USR-<?= htmlspecialchars($mascota['id_usuario']) ?></p>
        <a href="extraviados.php" class="boton-contorno mt-3">← Volver</a>
      </div>
    </div>
  </div>
</section>
<?php else: ?>
<section class="seccion-detalle-mascota">
  <div class="contenedor text-center">
    <p class="texto-nosotros">Lo sentimos, no se encontró la mascota.</p>
    <a href="extraviados.php" class="boton-contorno mt-3">← Ver todas</a>
  </div>
</section>
<?php endif; ?>

<?php if (isset($_SESSION['usuario_id'])): ?>
<section class="seccion-comentarios">
  <div class="contenedor">
    <h3>Comentarios</h3>
    <!-- Formulario para agregar un nuevo comentario -->
    <form action="php/procesar_comentario.php" method="POST" class="formulario-comentario">
      <textarea name="comentario" required placeholder="Escribe un comentario..." rows="3"></textarea>
      <input type="hidden" name="id_mascota" value="<?= $id ?>">
      <button type="submit" class="boton">Comentar</button>
    </form>
  </div>
</section>
<?php endif; ?>

<?php
// Obtener comentarios principales (que no son respuesta a otro comentario)
$comentarios = [];
$stmt = $conexion->prepare("SELECT c.*, u.nombre FROM comentario c
    JOIN usuario u ON c.id_usuario = u.id_usuario
    WHERE c.id_mascota = ? AND c.id_responde IS NULL
    ORDER BY c.fechadelcomentario DESC");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Almacena los comentarios en un arreglo
while($row = $result->fetch_assoc()) {
    $comentarios[] = $row;
}
?>

<section class="seccion-lista-comentarios">
  <div class="contenedor">
    <?php foreach ($comentarios as $comentario): ?>
      <div class="comentario-principal">
        <strong><?= htmlspecialchars($comentario['nombre']) ?></strong>
        <span><?= date('d/m/Y H:i', strtotime($comentario['fechadelcomentario'])) ?></span>
        <p><?= nl2br(htmlspecialchars($comentario['comentario'])) ?></p>
        <!-- Botones de responder, editar, borrar -->
        <?php if (isset($_SESSION['usuario_id'])): ?>
        <form action="php/procesar_comentario.php" method="POST" class="formulario-respuesta" style="display:inline;">
          <input type="hidden" name="id_mascota" value="<?= $id ?>">
          <input type="hidden" name="id_responde" value="<?= $comentario['id_comentario'] ?>">
          <input type="text" name="comentario" placeholder="Responder..." required>
          <button type="submit" class="boton-contorno">Responder</button>
        </form>
        <?php endif; ?>

        <!-- Solo mostrar si es el usuario actual -->
        <?php if (isset($_SESSION['usuario_id']) && $comentario['id_usuario'] == $_SESSION['usuario_id']): ?>
          <a href="php/editar_comentario.php?id=<?= $comentario['id_comentario'] ?>">Editar</a>
          <a href="php/borrar_comentario.php?id=<?= $comentario['id_comentario'] ?>&mascota=<?= $id ?>" onclick="return confirm('¿Seguro de borrar?')">Borrar</a>
        <?php endif; ?>

        <!-- Mostrar respuestas -->
        <?php
        $stmt2 = $conexion->prepare("SELECT c.*, u.nombre FROM comentario c
            JOIN usuario u ON c.id_usuario = u.id_usuario
            WHERE c.id_responde = ?
            ORDER BY c.fechadelcomentario ASC");
        $stmt2->bind_param('i', $comentario['id_comentario']);
        $stmt2->execute();
        $respuestas = $stmt2->get_result();
        ?>
        <!-- Listado de respuestas al comentario -->
        <div class="respuestas">
          <?php while ($respuesta = $respuestas->fetch_assoc()): ?>
            <div class="comentario-respuesta">
              <strong><?= htmlspecialchars($respuesta['nombre']) ?></strong>
              <span><?= date('d/m/Y H:i', strtotime($respuesta['fechadelcomentario'])) ?></span>
              <p><?= nl2br(htmlspecialchars($respuesta['comentario'])) ?></p>
              <?php if (isset($_SESSION['usuario_id']) && $respuesta['id_usuario'] == $_SESSION['usuario_id']): ?>
                <a href="php/editar_comentario.php?id=<?= $respuesta['id_comentario'] ?>">Editar</a>
                <a href="php/borrar_comentario.php?id=<?= $respuesta['id_comentario'] ?>&mascota=<?= $id ?>" onclick="return confirm('¿Seguro de borrar?')">Borrar</a>
              <?php endif; ?>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include 'php/footer.php'; ?>
