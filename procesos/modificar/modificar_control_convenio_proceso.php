<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "MANTENCION") {

        if (!isset($_POST['oculto'])) {
            header('Location: ../../catastro.php');
        }

        include '../../config/conexion.php';

        $envioID = $_POST['envioID'];

        $ejecutivo_compra = $_POST['ejecutivo_compra'];
        $correo_ejecutivo = $_POST['correo_ejecutivo'];
        $edificio = $_POST['edificio'];
        $piso = $_POST['piso'];
        $sala_pasillo = $_POST['sala_pasillo'];
        $responsable = $_POST['responsable'];
        $correo_responsable = $_POST['correo_responsable'];
        $grupo = $_POST['grupo'];
        $id_licitacion_convenio = $_POST['id_licitacion_convenio'];
        $empresa_adjudicada = $_POST['empresa_adjudicada'];
        $equipo_critico_m_c = $_POST['equipo_critico_m_c'];
        $ubicacion = $_POST['ubicacion'];
        $fecha_inicio_convenio = $_POST['fecha_inicio_convenio'];
        $fecha_termino_convenio = $_POST['fecha_termino_convenio'];
        $duracion_en_meses = $_POST['duracion_en_meses'];
        $peridiocidad = $_POST['peridiocidad'];
        $n_manten_preventivas = $_POST['n_manten_preventivas'];

        // * MANTENCIONES

        $valor_mantencion_1 = $_POST['valor_mantencion_1'];
        $fecha_mantencion_1 = $_POST['fecha_mantencion_1'];
        $fecha_recep_mant_1 = $_POST['fecha_recep_mant_1'];
        $orden_compra_mant_1 = $_POST['orden_compra_mant_1'];
        $fecha_oc_mant_1 = $_POST['fecha_oc_mant_1'];
        $observacion_mant_1 = $_POST['observacion_mant_1'];
        $verificable_mant_1 = $_POST['verificable_mant_1'];

        $valor_mantencion_2 = $_POST['valor_mantencion_2'];
        $fecha_mantencion_2 = $_POST['fecha_mantencion_2'];
        $fecha_recep_mant_2 = $_POST['fecha_recep_mant_2'];
        $orden_compra_mant_2 = $_POST['orden_compra_mant_2'];
        $fecha_oc_mant_2 = $_POST['fecha_oc_mant_2'];
        $observacion_mant_2 = $_POST['observacion_mant_2'];
        $verificable_mant_2 = $_POST['verificable_mant_2'];

        $valor_mantencion_3 = $_POST['valor_mantencion_3'];
        $fecha_mantencion_3 = $_POST['fecha_mantencion_3'];
        $fecha_recep_mant_3 = $_POST['fecha_recep_mant_3'];
        $orden_compra_mant_3 = $_POST['orden_compra_mant_3'];
        $fecha_oc_mant_3 = $_POST['fecha_oc_mant_3'];
        $observacion_mant_3 = $_POST['observacion_mant_3'];
        $verificable_mant_3 = $_POST['verificable_mant_3'];

        $valor_mantencion_4 = $_POST['valor_mantencion_4'];
        $fecha_mantencion_4 = $_POST['fecha_mantencion_4'];
        $fecha_recep_mant_4 = $_POST['fecha_recep_mant_4'];
        $orden_compra_mant_4 = $_POST['orden_compra_mant_4'];
        $fecha_oc_mant_4 = $_POST['fecha_oc_mant_4'];
        $observacion_mant_4 = $_POST['observacion_mant_4'];
        $verificable_mant_4 = $_POST['verificable_mant_4'];

        $valor_mantencion_5 = $_POST['valor_mantencion_5'];
        $fecha_mantencion_5 = $_POST['fecha_mantencion_5'];
        $fecha_recep_mant_5 = $_POST['fecha_recep_mant_5'];
        $orden_compra_mant_5 = $_POST['orden_compra_mant_5'];
        $fecha_oc_mant_5 = $_POST['fecha_oc_mant_5'];
        $observacion_mant_5 = $_POST['observacion_mant_5'];
        $verificable_mant_5 = $_POST['verificable_mant_5'];

        $valor_mantencion_6 = $_POST['valor_mantencion_6'];
        $fecha_mantencion_6 = $_POST['fecha_mantencion_6'];
        $fecha_recep_mant_6 = $_POST['fecha_recep_mant_6'];
        $orden_compra_mant_6 = $_POST['orden_compra_mant_6'];
        $fecha_oc_mant_6 = $_POST['fecha_oc_mant_6'];
        $observacion_mant_6 = $_POST['observacion_mant_6'];
        $verificable_mant_6 = $_POST['verificable_mant_6'];

        $valor_mantencion_7 = $_POST['valor_mantencion_7'];
        $fecha_mantencion_7 = $_POST['fecha_mantencion_7'];
        $fecha_recep_mant_7 = $_POST['fecha_recep_mant_7'];
        $orden_compra_mant_7 = $_POST['orden_compra_mant_7'];
        $fecha_oc_mant_7 = $_POST['fecha_oc_mant_7'];
        $observacion_mant_7 = $_POST['observacion_mant_7'];
        $verificable_mant_7 = $_POST['verificable_mant_7'];

        $valor_mantencion_8 = $_POST['valor_mantencion_8'];
        $fecha_mantencion_8 = $_POST['fecha_mantencion_8'];
        $fecha_recep_mant_8 = $_POST['fecha_recep_mant_8'];
        $orden_compra_mant_8 = $_POST['orden_compra_mant_8'];
        $fecha_oc_mant_8 = $_POST['fecha_oc_mant_8'];
        $observacion_mant_8 = $_POST['observacion_mant_8'];
        $verificable_mant_8 = $_POST['verificable_mant_8'];

        $valor_mantencion_9 = $_POST['valor_mantencion_9'];
        $fecha_mantencion_9 = $_POST['fecha_mantencion_9'];
        $fecha_recep_mant_9 = $_POST['fecha_recep_mant_9'];
        $orden_compra_mant_9 = $_POST['orden_compra_mant_9'];
        $fecha_oc_mant_9 = $_POST['fecha_oc_mant_9'];
        $observacion_mant_9 = $_POST['observacion_mant_9'];
        $verificable_mant_9 = $_POST['verificable_mant_9'];

        $valor_mantencion_10 = $_POST['valor_mantencion_10'];
        $fecha_mantencion_10 = $_POST['fecha_mantencion_10'];
        $fecha_recep_mant_10 = $_POST['fecha_recep_mant_10'];
        $orden_compra_mant_10 = $_POST['orden_compra_mant_10'];
        $fecha_oc_mant_10 = $_POST['fecha_oc_mant_10'];
        $observacion_mant_10 = $_POST['observacion_mant_10'];
        $verificable_mant_10 = $_POST['verificable_mant_10'];

        $valor_mantencion_11 = $_POST['valor_mantencion_11'];
        $fecha_mantencion_11 = $_POST['fecha_mantencion_11'];
        $fecha_recep_mant_11 = $_POST['fecha_recep_mant_11'];
        $orden_compra_mant_11 = $_POST['orden_compra_mant_11'];
        $fecha_oc_mant_11 = $_POST['fecha_oc_mant_11'];
        $observacion_mant_11 = $_POST['observacion_mant_11'];
        $verificable_mant_11 = $_POST['verificable_mant_11'];

        $valor_mantencion_12 = $_POST['valor_mantencion_12'];
        $fecha_mantencion_12 = $_POST['fecha_mantencion_12'];
        $fecha_recep_mant_12 = $_POST['fecha_recep_mant_12'];
        $orden_compra_mant_12 = $_POST['orden_compra_mant_12'];
        $fecha_oc_mant_12 = $_POST['fecha_oc_mant_12'];
        $observacion_mant_12 = $_POST['observacion_mant_12'];
        $verificable_mant_12 = $_POST['verificable_mant_12'];


        $sentencia = $bd->prepare("UPDATE control_convenio SET ejecutivo_compra = ?, correo_ejecutivo = ?, edificio = ?, piso = ?, sala_pasillo = ?, responsable = ?, 
        correo_responsable = ?, grupo = ?, id_licitacion_convenio = ?, empresa_adjudicada = ?, equipo_critico_m_c = ?, ubicacion = ?, fecha_inicio_convenio = ?, 
        fecha_termino_convenio = ?, duracion_en_meses = ?, peridiocidad = ?, n_manten_preventivas = ?, 
        valor_mantencion_1 = ?, fecha_mantencion_1 = ?, fecha_recep_mant_1 = ?, orden_compra_mant_1 = ?, fecha_oc_mant_1 = ?, observacion_mant_1 = ?, verificable_mant_1 = ?, 
        valor_mantencion_2 = ?, fecha_mantencion_2 = ?, fecha_recep_mant_2 = ?, orden_compra_mant_2 = ?, fecha_oc_mant_2 = ?, observacion_mant_2 = ?, verificable_mant_2 = ?, 
        valor_mantencion_3 = ?, fecha_mantencion_3 = ?, fecha_recep_mant_3 = ?, orden_compra_mant_3 = ?, fecha_oc_mant_3 = ?, observacion_mant_3 = ?, verificable_mant_3 = ?, 
        valor_mantencion_4 = ?, fecha_mantencion_4 = ?, fecha_recep_mant_4 = ?, orden_compra_mant_4 = ?, fecha_oc_mant_4 = ?, observacion_mant_4 = ?, verificable_mant_4 = ?, 
        valor_mantencion_5 = ?, fecha_mantencion_5 = ?, fecha_recep_mant_5 = ?, orden_compra_mant_5 = ?, fecha_oc_mant_5 = ?, observacion_mant_5 = ?, verificable_mant_5 = ?, 
        valor_mantencion_6 = ?, fecha_mantencion_6 = ?, fecha_recep_mant_6 = ?, orden_compra_mant_6 = ?, fecha_oc_mant_6 = ?, observacion_mant_6 = ?, verificable_mant_6 = ?, 
        valor_mantencion_7 = ?, fecha_mantencion_7 = ?, fecha_recep_mant_7 = ?, orden_compra_mant_7 = ?, fecha_oc_mant_7 = ?, observacion_mant_7 = ?, verificable_mant_7 = ?, 
        valor_mantencion_8 = ?, fecha_mantencion_8 = ?, fecha_recep_mant_8 = ?, orden_compra_mant_8 = ?, fecha_oc_mant_8 = ?, observacion_mant_8 = ?, verificable_mant_8 = ?, 
        valor_mantencion_9 = ?, fecha_mantencion_9 = ?, fecha_recep_mant_9 = ?, orden_compra_mant_9 = ?, fecha_oc_mant_9 = ?, observacion_mant_9 = ?, verificable_mant_9 = ?, 
        valor_mantencion_10 = ?, fecha_mantencion_10 = ?, fecha_recep_mant_10 = ?, orden_compra_mant_10 = ?, fecha_oc_mant_10 = ?, observacion_mant_10 = ?, verificable_mant_10 = ?,
        valor_mantencion_11 = ?, fecha_mantencion_11 = ?, fecha_recep_mant_11 = ?, orden_compra_mant_11 = ?, fecha_oc_mant_11 = ?, observacion_mant_11 = ?, verificable_mant_11 = ?, 
        valor_mantencion_12 = ?, fecha_mantencion_12 = ?, fecha_recep_mant_12 = ?, orden_compra_mant_12 = ?, fecha_oc_mant_12 = ?, observacion_mant_12 = ?, verificable_mant_12 = ? 
        WHERE id_control_convenio = ?;");


        $resultado = $sentencia->execute([
            $ejecutivo_compra, $correo_ejecutivo, $edificio, $piso, $sala_pasillo, $responsable, $correo_responsable, $grupo, $id_licitacion_convenio,
            $empresa_adjudicada, $equipo_critico_m_c, $ubicacion, $fecha_inicio_convenio, $fecha_termino_convenio, $duracion_en_meses, $peridiocidad,
            $n_manten_preventivas,
            $valor_mantencion_1, $fecha_mantencion_1, $fecha_recep_mant_1, $orden_compra_mant_1, $fecha_oc_mant_1, $observacion_mant_1, $verificable_mant_1,
            $valor_mantencion_2, $fecha_mantencion_2, $fecha_recep_mant_2, $orden_compra_mant_2, $fecha_oc_mant_2, $observacion_mant_2, $verificable_mant_2,
            $valor_mantencion_3, $fecha_mantencion_3, $fecha_recep_mant_3, $orden_compra_mant_3, $fecha_oc_mant_3, $observacion_mant_3, $verificable_mant_3,
            $valor_mantencion_4, $fecha_mantencion_4, $fecha_recep_mant_4, $orden_compra_mant_4, $fecha_oc_mant_4, $observacion_mant_4, $verificable_mant_4,
            $valor_mantencion_5, $fecha_mantencion_5, $fecha_recep_mant_5, $orden_compra_mant_5, $fecha_oc_mant_5, $observacion_mant_5, $verificable_mant_5,
            $valor_mantencion_6, $fecha_mantencion_6, $fecha_recep_mant_6, $orden_compra_mant_6, $fecha_oc_mant_6, $observacion_mant_6, $verificable_mant_6,
            $valor_mantencion_7, $fecha_mantencion_7, $fecha_recep_mant_7, $orden_compra_mant_7, $fecha_oc_mant_7, $observacion_mant_7, $verificable_mant_7,
            $valor_mantencion_8, $fecha_mantencion_8, $fecha_recep_mant_8, $orden_compra_mant_8, $fecha_oc_mant_8, $observacion_mant_8, $verificable_mant_8,
            $valor_mantencion_9, $fecha_mantencion_9, $fecha_recep_mant_9, $orden_compra_mant_9, $fecha_oc_mant_9, $observacion_mant_9, $verificable_mant_9,
            $valor_mantencion_10, $fecha_mantencion_10, $fecha_recep_mant_10, $orden_compra_mant_10, $fecha_oc_mant_10, $observacion_mant_10, $verificable_mant_10,
            $valor_mantencion_11, $fecha_mantencion_11, $fecha_recep_mant_11, $orden_compra_mant_11, $fecha_oc_mant_11, $observacion_mant_11, $verificable_mant_11,
            $valor_mantencion_12, $fecha_mantencion_12, $fecha_recep_mant_12, $orden_compra_mant_12, $fecha_oc_mant_12, $observacion_mant_12, $verificable_mant_12,
            $envioID
        ]);


        if ($resultado === TRUE) {
            header('Location: ../../control_convenio.php');
        } else {
            echo "Error";
        }
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: ../../catastro.php');
    }
} else {
    echo "Error de Sistema";
}
