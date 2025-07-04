<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$conexion->connect_errno) {
        $stmt = $conexion->prepare('SELECT id, password FROM usuarios WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->bind_result($id, $hash);
        if ($stmt->fetch() && password_verify($password, $hash)) {
            $_SESSION['usuario_id'] = $id;
            header('Location: ../index.php');
            exit;
        }
    }
    $_SESSION['flash'] = 'Credenciales no válidas';
}
header('Location: ../login.php');

