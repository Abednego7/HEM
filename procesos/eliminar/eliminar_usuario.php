<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR") {

        if (!isset($_GET['id_usuario_key'])) {
            exit();
        }

        $id_usuario_key = $_GET['id_usuario_key'];

        include '../../config/conexion.php';

        $sentencia = $bd->prepare("DELETE FROM usuarios WHERE id_usuario = ?;");
        $resultado = $sentencia->execute([$id_usuario_key]);

        if ($resultado === TRUE) {
            header('Location: ../../usuarios.php?url_eliminar=1');
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
