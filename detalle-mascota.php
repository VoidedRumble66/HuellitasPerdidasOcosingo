<?php
// detalle-mascota.php — vista de detalle de una mascota extraviada

$tituloPagina = 'Detalle de Mascota';
include 'php/head.php';
include 'php/menu.php';

// Tomar el id desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Datos simulados
$listaMascotas = [
  1 => [
    'nombre'      => 'Rocky',
    'especie'     => 'Perro',
    'color'       => 'Negro',
    'zona'        => 'Colonia Centro',
    'descripcion' => 'Salió del patio el lunes y no ha regresado. Es muy juguetón.',
    'fecha'       => '05 de mayo 2025',
    'contacto'    => '961-123-4567',
    'imagen'      => 'perro1.jpg'
  ],
  2 => [
    'nombre'      => 'Michi',
    'especie'     => 'Gato',
    'color'       => 'Gris',
    'zona'        => 'Barrio San Antonio',
    'descripcion' => 'Desapareció durante el fin de semana. Muy cariñoso.',
    'fecha'       => '12 de abril 2025',
    'contacto'    => '961-987-6543',
    'imagen'      => 'gato1.jpg'
  ],
  3 => [
    'nombre'      => 'Toby',
    'especie'     => 'Perro',
    'color'       => 'Marrón',
    'zona'        => 'Cerca del mercado',
    'descripcion' => 'Se asustó con fuegos artificiales y huyó.',
    'fecha'       => '20 de marzo 2025',
    'contacto'    => '961-555-1234',
    'imagen'      => 'perro2.jpg'
  ],
];

$mascota = $listaMascotas[$id] ?? null;
?>

<?php if ($mascota): ?>
  <section class="seccion-detalle-mascota">
    <div class="contenedor">
      <div class="row tarjeta-detalle animar-entrada">
        <!-- Contenedor fijo para la imagen -->
        <div class="col-md-6 contenedor-imagen-detalle">
          <img src="img/<?= $mascota['imagen'] ?>"
               alt="<?= $mascota['nombre'] ?>"
               class="imagen-detalle-mascota">
        </div>
        <!-- Datos de la mascota -->
        <div class="col-md-6 info-detalle-mascota">
          <h2 class="titulo-seccion"><?= $mascota['nombre'] ?></h2>
          <p><strong>Especie:</strong> <?= $mascota['especie'] ?></p>
          <p><strong>Color:</strong> <?= $mascota['color'] ?></p>
          <p><strong>Zona:</strong> <?= $mascota['zona'] ?></p>
          <p><strong>Descripción:</strong> <?= $mascota['descripcion'] ?></p>
          <p><strong>Fecha:</strong> <?= $mascota['fecha'] ?></p>
          <p><strong>Contacto:</strong> <?= $mascota['contacto'] ?></p>
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

<?php include 'php/footer.php'; ?>
