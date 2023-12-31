<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR") {

        if (!isset($_GET['id_rrhh_key'])) {
            exit();
        }

        $id_rrhh_key = $_GET['id_rrhh_key'];

        include '../../config/conexion.php';

        $sentencia = $bd->prepare("DELETE FROM rrhh WHERE id_rrhh = ?;");
        $resultado = $sentencia->execute([$id_rrhh_key]);

        if ($resultado === TRUE) {
            header('Location: ../../rrhh.php?url_eliminar=1');
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
