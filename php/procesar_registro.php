<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email  = trim($_POST['email'] ?? '');
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);

    if (!$conexion->connect_errno) {
        $stmt = $conexion->prepare('INSERT INTO usuarios(nombre, email, password) VALUES (?,?,?)');
        $stmt->bind_param('sss', $nombre, $email, $password);
        if ($stmt->execute()) {
            $_SESSION['usuario_id'] = $stmt->insert_id;
            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['flash'] = 'Error al registrar';
        }
    } else {
        $_SESSION['flash'] = 'Error de conexión';
    }
}
header('Location: ../registro.php');

