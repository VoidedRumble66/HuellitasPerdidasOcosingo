<?php
session_start();
require 'php/conexion.php';
include 'php/head.php';
include 'php/menu.php';

// Obtener datos del usuario actual
$id_usuario = $_SESSION['usuario_id'];
$stmt = $conexion->prepare("SELECT nombre, correo, telefono, fechanacimiento FROM usuario WHERE id_usuario = ?");
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$stmt->bind_result($nombre, $correo, $telefono, $fechanacimiento);
$stmt->fetch();
$stmt->close();

// Obtener mascotas reportadas
$mascotas = [];
$stm = $conexion->prepare("SELECT id_mascota, nombredemascota, especie.nombre as especie, raza.nombre as raza, ubicacion, fechadeextravio 
    FROM mascota
    JOIN especie ON mascota.id_especie = especie.id_especie
    JOIN raza ON mascota.id_raza = raza.id_raza
    WHERE id_usuario = ? ORDER BY fechadeextravio DESC");
$stm->bind_param('i', $id_usuario);
$stm->execute();
$result = $stm->get_result();
while($row = $result->fetch_assoc()) $mascotas[] = $row;
$stm->close();
?>

<section class="seccion-perfil">
  <div class="contenedor perfil-contenedor">
    <h2 class="titulo-seccion mb-4">Mi Perfil</h2>
    <div class="perfil-tarjeta">
      <div class="perfil-datos">
        <div class="perfil-usuario">
          <div>
            <div class="perfil-avatar"><?= strtoupper($nombre[0]) ?></div>
            <p class="perfil-nombre"><?= htmlspecialchars($nombre) ?></p>
            <p class="perfil-id">ID: <?= str_pad($id_usuario, 3, "0", STR_PAD_LEFT) ?></p>
          </div>
        </div>
        <a href="publicar.php" class="boton-secundario">Reportar nueva mascota</a>
        <a href="modificar_perfil.php" class="boton-contorno mt-2">Modificar Perfil</a>
      </div>

      <div class="perfil-info-personal">
        <h3>Información Personal</h3>
        <div class="info-personal-campo"><strong>Nombre completo:</strong> <?= htmlspecialchars($nombre) ?></div>
        <div class="info-personal-campo"><strong>Correo electrónico:</strong> <?= htmlspecialchars($correo) ?></div>
        <div class="info-personal-campo"><strong>Teléfono:</strong> <?= htmlspecialchars($telefono) ?></div>
        <div class="info-personal-campo"><strong>Fecha de nacimiento:</strong> <?= date('d/m/Y', strtotime($fechanacimiento)) ?></div>
      </div>
    </div>

    <h3 class="subtitulo-perfil mt-5 mb-3">Mis Mascotas Reportadas</h3>
    <div class="perfil-mascotas-lista">
      <?php if (count($mascotas)): ?>
        <table class="tabla-mascotas">
          <thead>
            <tr>
              <th>Mascota</th>
              <th>Especie y raza</th>
              <th>Ubicación</th>
              <th>Fecha</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($mascotas as $mascota): ?>
            <tr>
              <td><?= htmlspecialchars($mascota['nombredemascota']) ?></td>
              <td><?= htmlspecialchars($mascota['especie']) ?> / <?= htmlspecialchars($mascota['raza']) ?></td>
              <td><?= htmlspecialchars($mascota['ubicacion']) ?></td>
              <td><?= date('d/m/Y', strtotime($mascota['fechadeextravio'])) ?></td>
              <td>
                <a href="editar_mascota.php?id=<?= $mascota['id_mascota'] ?>" class="boton-contorno btn-tabla">Editar</a>
                <a href="borrar_mascota.php?id=<?= $mascota['id_mascota'] ?>" class="boton-contorno btn-tabla" onclick="return confirm('¿Seguro que deseas eliminar la mascota?')">Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No has reportado ninguna mascota.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include 'php/footer.php'; ?>
