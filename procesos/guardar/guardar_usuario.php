<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR") {

        if (!isset($_POST['oculto'])) {
            exit;
        }

        include '../../config/conexion.php';

        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $passwr = $_POST['pass'];
        $tipo_de_usuario = $_POST['tipo_de_usuario'];

        $pass_cifrado = password_hash($passwr, PASSWORD_DEFAULT, array("cost" => 12));

        $sentencia = $bd->prepare("INSERT INTO usuarios(nombre, correo, contrasena, tipo_usuario) VALUES (?, ?, ?, ?)");

        $resultado = $sentencia->execute([ucfirst($nombre), $correo, $pass_cifrado, $tipo_de_usuario]);

        if ($resultado === TRUE) {
            header('Location: ../../usuarios.php');
        } else {
            echo "Error";
        }
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: ../../catastro.php');
    }
} else {
    echo "Error de Sistema";
}
