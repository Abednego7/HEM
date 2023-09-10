<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR") {

        if (!isset($_GET['id_proceso_peti_key'])) {
            exit();
        }

        $id_proceso_peti_key = $_GET['id_proceso_peti_key'];

        include '../../config/conexion.php';

        $sentencia = $bd->prepare("DELETE FROM proceso_peticiones WHERE id_peticiones = ?;");
        $resultado = $sentencia->execute([$id_proceso_peti_key]);

        if ($resultado === TRUE) {
            header('Location: ../../proceso_peticiones.php?url_eliminar=1');
        } else {
            echo "Error";
        }
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: ../../proceso_peticiones.php');
    }
} else {
    echo "Error de Sistema";
}
