# Huellitas Perdidas

Este proyecto es una aplicación web sencilla para registrar y buscar mascotas extraviadas en Ocosingo, Chiapas.

## Requisitos
- PHP 8
- Servidor MySQL (por ejemplo XAMPP)

## Instalación
1. Crea la base de datos ejecutando el script `db/esquema.sql` en tu servidor MySQL.
2. Configura las credenciales de conexión en variables de entorno o edita `php/conexion.php` con tu usuario y contraseña.
   - Variables de entorno usadas: `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`.
3. Coloca los archivos del proyecto en tu servidor web y accede mediante tu navegador.

## Uso
- Regístrate en `registro.php` y luego inicia sesión en `login.php`.
- Podrás publicar reportes de mascotas perdidas y ver las mascotas registradas.

## Pruebas
Ejecuta `tests/run_tests.sh` para validar la sintaxis de los archivos PHP modificados.
