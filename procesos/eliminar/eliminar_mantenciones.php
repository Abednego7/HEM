<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR") {

        if (!isset($_GET['id_mantenciones_key'])) {
            exit();
        }

        $id_mantenciones_key = $_GET['id_mantenciones_key'];

        include '../../config/conexion.php';

        $sentencia = $bd->prepare("DELETE FROM mantenciones WHERE id_mantenciones = ?;");
        $resultado = $sentencia->execute([$id_mantenciones_key]);

        if ($resultado === TRUE) {
            header('Location: ../../mantenciones.php?url_eliminar=1');
        } else {
            echo "Error";
        }
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: ../../mantenciones.php');
    }
} else {
    echo "Error de Sistema";
}
