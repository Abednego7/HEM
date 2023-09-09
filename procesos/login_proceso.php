<?php

session_start();
include_once '../config/conexion.php';

$mail = $_POST['emailUser'];
$pass = $_POST['passUser'];

$sentencia = $bd->prepare("SELECT id_usuario, nombre, correo, contrasena, tipo_usuario FROM usuarios WHERE correo = ?;");

$sentencia->execute([$mail]);
$datos = $sentencia->fetch(PDO::FETCH_OBJ);

if (password_verify($pass, $datos->contrasena)) {
    $_SESSION['nombre'] = $datos->nombre;
    $_SESSION['tipo'] = $datos->tipo_usuario;

    if (isset($_SESSION['nombre'])) {
        if ($_SESSION['tipo'] === "ADMINISTRADOR") {
            header('Location: ../home.php');
        } elseif (
            $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
            $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
        ) {
            header('Location: ../home.php');
        }
    } else {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
}
