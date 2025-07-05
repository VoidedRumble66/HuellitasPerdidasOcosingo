<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$conexion->connect_errno) {
        $stmt = $conexion->prepare('SELECT id_usuario, password FROM usuario WHERE correo = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($idUsuario, $hash);

        if ($stmt->fetch() && password_verify($password, $hash)) {
            $_SESSION['usuario_id'] = $idUsuario;
            $stmt->close();
            header('Location: ../index.php');
            exit;
        }
        $stmt->close();
    }
    $_SESSION['flash'] = 'Credenciales no válidas';
    header('Location: ../login.php');
    exit;
}
header('Location: ../login.php');
exit;


