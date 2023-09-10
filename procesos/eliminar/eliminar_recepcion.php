<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR") {

        if (!isset($_GET['id_recepcion_key'])) {
            exit();
        }

        $id_recepcion_key = $_GET['id_recepcion_key'];

        include '../../config/conexion.php';

        $sentencia = $bd->prepare("DELETE FROM recepcion WHERE id_recepcion = ?;");
        $resultado = $sentencia->execute([$id_recepcion_key]);

        if ($resultado === TRUE) {
            header('Location: ../../recepcion_equipo.php?url_eliminar=1');
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
