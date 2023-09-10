<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR") {

        if (!isset($_GET['id_control_convenio_key'])) {
            exit();
        }

        $id_control_convenio_key = $_GET['id_control_convenio_key'];

        include '../../config/conexion.php';

        $sentencia = $bd->prepare("DELETE FROM control_convenio WHERE id_control_convenio = ?;");
        $resultado = $sentencia->execute([$id_control_convenio_key]);

        if ($resultado === TRUE) {
            header('Location: ../../control_convenio.php?url_eliminar=1');  // Variable enviada por URL para SweetAlert
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
