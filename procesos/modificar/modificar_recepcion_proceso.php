<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS") {

        if (!isset($_POST['oculto'])) {
            header('Location: ../../recepcion_equipo.php');
        }

        include '../../config/conexion.php';

        $envioID = $_POST['envioID'];


        $ano_fabrica = $_POST['ano_fabrica'];
        $financiamiento = $_POST['financiamiento'];
        $producto_solicitado = $_POST['producto_solicitado'];
        $requerimiento_tecnico = $_POST['requerimiento_tecnico'];
        $nombre_proyecto = $_POST['nombre_proyecto'];
        $decreto = $_POST['decreto'];
        $fecha_decreto = $_POST['fecha_decreto'];
        $resolucion_especi_tec = $_POST['resolucion_especi_tec'];
        $fecha_resolu_especi_tec = $_POST['fecha_resolu_especi_tec'];
        $resolucion_adjudicacion = $_POST['resolucion_adjudicacion'];
        $fecha_de_adjudi = $_POST['fecha_de_adjudi'];
        $resolucion_contrato = $_POST['resolucion_contrato'];
        $fecha_resolu_contrato = $_POST['fecha_resolu_contrato'];
        $tipo_de_compra = $_POST['tipo_de_compra'];
        $orden_compra = $_POST['orden_compra'];
        $fecha_orden_compra = $_POST['fecha_orden_compra'];
        $detalle_orden_compra = $_POST['detalle_orden_compra'];
        $plazo_entrega = $_POST['plazo_entrega'];
        $tipo_de_dias = $_POST['tipo_de_dias'];
        $fecha_entrega = $_POST['fecha_entrega'];
        $rut = $_POST['rut'];
        $proveedor = $_POST['proveedor'];
        $numero_acta = $_POST['numero_acta'];
        $fecha_recepcion_parcial = $_POST['fecha_recepcion_parcial'];
        $fecha_puesta_marcha = $_POST['fecha_puesta_marcha'];
        $fecha_recepcion_final = $_POST['fecha_recepcion_final'];
        $capacitacion = $_POST['capacitacion'];
        $fecha_capacitacion = $_POST['fecha_capacitacion'];
        $garantia_fabricante = $_POST['garantia_fabricante'];
        $fecha_inicio_garanti_fabricante = $_POST['fecha_inicio_garanti_fabricante'];
        $fecha_termino_garanti_fabricante = $_POST['fecha_termino_garanti_fabricante'];
        $mantenciones_en_garantia = $_POST['mantenciones_en_garantia'];
        $periodo_mantenci_garanti = $_POST['periodo_mantenci_garanti'];
        $verificable_entrega = $_POST['verificable_entrega'];
        $fecha_verificable = $_POST['fecha_verificable'];
        $ref_tecnico_recepcion = $_POST['ref_tecnico_recepcion'];
        $ref_tecnico_clinico = $_POST['ref_tecnico_clinico'];
        $ref_tecnico_mantencion_1 = $_POST['ref_tecnico_mantencion_1'];
        $ref_tecnico_mantencion_2 = $_POST['ref_tecnico_mantencion_2'];
        $ref_tecnico_mantencion_3 = $_POST['ref_tecnico_mantencion_3'];
        $ref_tecnico_externo = $_POST['ref_tecnico_externo'];
        $otro_referente_1 = $_POST['otro_referente_1'];
        $otro_referente_2 = $_POST['otro_referente_2'];

        $accesorio_1 = $_POST['accesorio_1'];
        $accesorio_2 = $_POST['accesorio_2'];
        $accesorio_3 = $_POST['accesorio_3'];
        $accesorio_4 = $_POST['accesorio_4'];
        $accesorio_5 = $_POST['accesorio_5'];
        $accesorio_6 = $_POST['accesorio_6'];
        $accesorio_7 = $_POST['accesorio_7'];
        $accesorio_8 = $_POST['accesorio_8'];
        $accesorio_9 = $_POST['accesorio_9'];
        $accesorio_10 = $_POST['accesorio_10'];
        $observaciones = $_POST['observaciones'];

        $cantidad = 1;


        $sentencia = $bd->prepare("UPDATE recepcion SET ano_fabrica = ?, financiamiento = ?, producto_solicitado = ?,
                                        requerimiento_tecnico = ?, nombre_proyecto = ?, decreto = ?, fecha_decreto = ?, resolucion_especi_tec = ?,
                                        fecha_resolu_especi_tec = ?, resolucion_adjudicacion = ?, fecha_de_adjudi = ?, resolucion_contrato = ?,
                                        fecha_resolu_contrato = ?, tipo_de_compra = ?, orden_compra = ?, fecha_orden_compra = ?, detalle_orden_compra = ?, 
                                        plazo_entrega = ?, tipo_de_dias = ?, fecha_entrega = ?, rut = ?, proveedor = ?, numero_acta = ?, fecha_recepcion_parcial = ?,
                                        fecha_puesta_marcha = ?, fecha_recepcion_final = ?, capacitacion = ?, fecha_capacitacion = ?,
                                        garantia_fabricante = ?, fecha_inicio_garanti_fabricante = ?, fecha_termino_garanti_fabricante = ?,
                                        mantenciones_en_garantia = ?, periodo_mantenci_garanti = ?, verificable_entrega = ?, fecha_verificable = ?,
                                        ref_tecnico_recepcion = ?, ref_tecnico_clinico = ?, ref_tecnico_mantencion_1 = ?,
                                        ref_tecnico_mantencion_2 = ?, ref_tecnico_mantencion_3 = ?, ref_tecnico_externo = ?,
                                        otro_referente_1 = ?, otro_referente_2 = ?, 
                                        accesorio_1 = ?, accesorio_2 = ?, accesorio_3 = ?, accesorio_4 = ?, accesorio_5 = ?, accesorio_6 = ?, accesorio_7 = ?, 
                                        accesorio_8 = ?, accesorio_9 = ?, accesorio_10 = ?, observaciones = ?, cantidad = ? WHERE id_recepcion = ?;");


        $resultado = $sentencia->execute([
            $ano_fabrica, $financiamiento, $producto_solicitado, $requerimiento_tecnico, $nombre_proyecto, $decreto, $fecha_decreto,
            $resolucion_especi_tec, $fecha_resolu_especi_tec, $resolucion_adjudicacion, $fecha_de_adjudi, $resolucion_contrato,
            $fecha_resolu_contrato, $tipo_de_compra, $orden_compra, $fecha_orden_compra, $detalle_orden_compra, $plazo_entrega,
            $tipo_de_dias, $fecha_entrega, $rut, $proveedor, $numero_acta, $fecha_recepcion_parcial, $fecha_puesta_marcha,
            $fecha_recepcion_final, $capacitacion, $fecha_capacitacion, $garantia_fabricante, $fecha_inicio_garanti_fabricante,
            $fecha_termino_garanti_fabricante, $mantenciones_en_garantia, $periodo_mantenci_garanti, $verificable_entrega,
            $fecha_verificable, $ref_tecnico_recepcion, $ref_tecnico_clinico, $ref_tecnico_mantencion_1, $ref_tecnico_mantencion_2,
            $ref_tecnico_mantencion_3, $ref_tecnico_externo, $otro_referente_1, $otro_referente_2,
            $accesorio_1, $accesorio_2, $accesorio_3, $accesorio_4, $accesorio_5, $accesorio_6, $accesorio_7, $accesorio_8, $accesorio_9, $accesorio_10,
            $observaciones, $cantidad, $envioID
        ]);


        if ($resultado === TRUE) {
            header('Location: ../../recepcion_equipo.php');
        } else {
            echo "Error";
        }
    } elseif (
        $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: ../../catastro.php');
    }
} else {
    echo "Error de Sistema";
}
