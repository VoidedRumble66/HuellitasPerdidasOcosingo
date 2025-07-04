<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $nacimiento = $_POST['nacimiento'] ?? '';
    $passwordRaw = $_POST['password'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    if ($passwordRaw !== $confirmar) {
        $_SESSION['flash'] = 'Las contraseñas no coinciden';
        header('Location: ../registro.php');
        exit;
    }

    $password = password_hash($passwordRaw, PASSWORD_DEFAULT);

    if (!$conexion->connect_errno) {
        // Verificar si ya existe ese correo
        $c = $conexion->prepare('SELECT id_usuario FROM usuario WHERE correo = ?');
        $c->bind_param('s', $email);
        $c->execute();
        $c->store_result();
        if ($c->num_rows > 0) {
            $_SESSION['flash'] = 'El correo ya está registrado';
        } else {
            // Insertar nuevo usuario
            $stmt = $conexion->prepare('INSERT INTO usuario(nombre, correo, telefono, fechanacimiento, password) VALUES (?,?,?,?,?)');
            $stmt->bind_param('sssss', $nombre, $email, $telefono, $nacimiento, $password);
            if ($stmt->execute()) {
                $_SESSION['usuario_id'] = $stmt->insert_id;
                header('Location: ../index.php');
                exit;
            } else {
                $_SESSION['flash'] = 'Error al registrar';
            }
        }
        $c->close();
        if (isset($stmt)) $stmt->close();
    } else {
        $_SESSION['flash'] = 'Error de conexión';
    }
    header('Location: ../registro.php');
    exit;
}
header('Location: ../registro.php');
exit;
