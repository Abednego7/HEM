<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR") {

        if (!isset($_GET['id_relacion_key'])) {
            exit();
        }

        $id_relacion_key = $_GET['id_relacion_key'];

        include '../../config/conexion.php';


        // Validacion LLave Foranea    (POSIBLE ERROR AL SOLO PENSAR EN COMPROBACION DE RECEPCION Y NO DE CONTROL CONVENIO, ETC...)!

        $sentencia = $bd->prepare("SELECT relacion_id FROM recepcion WHERE relacion_id = ?;");      // Compara relacion_id con la variable $id_recepcion_key
        $sentencia->execute([$id_relacion_key]);                                                    // para ver si existe coincidencia

        $idsRecepcion = $sentencia->fetch(PDO::FETCH_OBJ);      // AL HACER UNA CONSULTA WHERE SE DEBE TRANSFORMAR LA SENTENCIA EN OBJETO PARA PODER TRABAJAR CON ELLA

        if ($idsRecepcion->relacion_id == $id_relacion_key) {
            header('Location: ../../catastro.php?result_delete=' . $id_relacion_key . '');         // Envio de variable para comprobar relacion antes de eliminar.
        } elseif ($idsRecepcion->relacion_id != $id_relacion_key) {
            $sentencia = $bd->prepare("DELETE FROM equipamiento WHERE id_relacion = ?;");
            $resultado = $sentencia->execute([$id_relacion_key]);

            if ($resultado === TRUE) {
                header('Location: ../../catastro.php?url_eliminar=1');    // Variable enviada por URL para SweetAlert (catastro_eliminar=1)
            } else {
                echo "Error";
            }
        } else {
            echo 'Error al borrar registro';
        }

        // Termino
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: ../../catastro.php');
    }
} else {
    echo "Error de Sistema";
}
