<?php

include '../../config/conexion.php';

$sentencia = $bd->query("SELECT Eq.id_relacion, Eq.progr_mantenimiento, Eq.caracteristica_acredi, Eq.equipo, Eq.marca, Eq.modelo, Eq.serie, 
            Eq.num_inventario, Eq.servicio, Eq.sector, Eq.termino_garantia, Eq.periodicidad_mp, Mn.id_control_convenio, Mn.ejecutivo_compra, Mn.correo_ejecutivo, 
            Mn.edificio, Mn.piso, Mn.sala_pasillo, Mn.responsable, Mn.correo_responsable, Mn.grupo, Mn.id_licitacion_convenio, Mn.empresa_adjudicada, 
            Mn.equipo_critico_m_c, Mn.ubicacion, Mn.fecha_inicio_convenio, Mn.fecha_termino_convenio, Mn.duracion_en_meses, Mn.peridiocidad, Mn.n_manten_preventivas, 
        Mn.valor_mantencion_1, Mn.fecha_mantencion_1, Mn.fecha_recep_mant_1, Mn.orden_compra_mant_1, Mn.fecha_oc_mant_1, Mn.observacion_mant_1, Mn.verificable_mant_1, 
        Mn.valor_mantencion_2, Mn.fecha_mantencion_2, Mn.fecha_recep_mant_2, Mn.orden_compra_mant_2, Mn.fecha_oc_mant_2, Mn.observacion_mant_2, Mn.verificable_mant_2, 
        Mn.valor_mantencion_3, Mn.fecha_mantencion_3, Mn.fecha_recep_mant_3, Mn.orden_compra_mant_3, Mn.fecha_oc_mant_3, Mn.observacion_mant_3, Mn.verificable_mant_3,
        Mn.valor_mantencion_4, Mn.fecha_mantencion_4, Mn.fecha_recep_mant_4, Mn.orden_compra_mant_4, Mn.fecha_oc_mant_4, Mn.observacion_mant_4, Mn.verificable_mant_4, 
        Mn.valor_mantencion_5, Mn.fecha_mantencion_5, Mn.fecha_recep_mant_5, Mn.orden_compra_mant_5, Mn.fecha_oc_mant_5, Mn.observacion_mant_5, Mn.verificable_mant_5, 
        Mn.valor_mantencion_6, Mn.fecha_mantencion_6, Mn.fecha_recep_mant_6, Mn.orden_compra_mant_6, Mn.fecha_oc_mant_6, Mn.observacion_mant_6, Mn.verificable_mant_6, 
        Mn.valor_mantencion_7, Mn.fecha_mantencion_7, Mn.fecha_recep_mant_7, Mn.orden_compra_mant_7, Mn.fecha_oc_mant_7, Mn.observacion_mant_7, Mn.verificable_mant_7, 
        Mn.valor_mantencion_8, Mn.fecha_mantencion_8, Mn.fecha_recep_mant_8, Mn.orden_compra_mant_8, Mn.fecha_oc_mant_8, Mn.observacion_mant_8, Mn.verificable_mant_8, 
        Mn.valor_mantencion_9, Mn.fecha_mantencion_9, Mn.fecha_recep_mant_9, Mn.orden_compra_mant_9, Mn.fecha_oc_mant_9, Mn.observacion_mant_9, Mn.verificable_mant_9, 
        Mn.valor_mantencion_10, Mn.fecha_mantencion_10, Mn.fecha_recep_mant_10, Mn.orden_compra_mant_10, Mn.fecha_oc_mant_10, Mn.observacion_mant_10, Mn.verificable_mant_10, 
        Mn.valor_mantencion_11, Mn.fecha_mantencion_11, Mn.fecha_recep_mant_11, Mn.orden_compra_mant_11, Mn.fecha_oc_mant_11, Mn.observacion_mant_11, Mn.verificable_mant_11, 
        Mn.valor_mantencion_12, Mn.fecha_mantencion_12, Mn.fecha_recep_mant_12, Mn.orden_compra_mant_12, Mn.fecha_oc_mant_12, Mn.observacion_mant_12, Mn.verificable_mant_12 
            FROM equipamiento Eq 
            INNER JOIN control_convenio Mn ON Eq.id_relacion = Mn.id_control_convenio_relacion");

$consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);

header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=CONTROL_CONVENIO.xls");

?>

<table border="1">
    <h1 style="text-align: center;">Control de Convenio 2023</h1>
    <tr>
        <th>ID Control Convenio</th>
        <th>ID Catastro</th>
        <th>Responsable</th>
        <th>Correo</th>
        <th>Programa de Mantenimiento</th>
        <th>Caracteristica de Acreditacion</th>
        <th>Equipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Serie</th>
        <th>Num Inventario</th>
        <th>Grupo</th>
        <th>Servicio</th>
        <th>Sector</th>
        <th>Fin Garantia Fabricante</th>
        <th>Peridiocidad de Mantencion MP</th>
        <th>Id Licitacion Convenio</th>
        <th>Empresa Adjudicada</th>
        <th>Equipo Critico Mayor Complejidad</th>
        <th>Ubicacion</th>
        <th>Edificio</th>
        <th>Piso</th>
        <th>Sala/Pasillo</th>
        <th>Fecha Inicio Convenio</th>
        <th>Fecha Termino Convenio</th>
        <th>Duracion en Meses</th>
        <th>Ejecutivo de Compra</th>
        <th>Correo</th>
        <th>Peridiocidad</th>
        <th>Nº Mantenciones Preventivas</th>
        <th>Valor Mantencion 1</th>
        <th>Fecha Mantencion 1</th>
        <th>Fecha Recepcion Mantencion 1</th>
        <th>Orden de Compra Mantencion 1</th>
        <th>Fecha Orden Compra Mantencion 1</th>
        <th>Observacion Mantencion 1</th>
        <th>Verificable Mantencion 1</th>
        <th>Valor Mantencion 2</th>
        <th>Fecha Mantencion 2</th>
        <th>Fecha Recepcion Mantencion 2</th>
        <th>Orden de Compra Mantencion 2</th>
        <th>Fecha Orden Compra Mantencion 2</th>
        <th>Observacion Mantencion 2</th>
        <th>Verificable Mantencion 2</th>
        <th>Valor Mantencion 3</th>
        <th>Fecha Mantencion 3</th>
        <th>Fecha Recepcion Mantencion 3</th>
        <th>Orden de Compra Mantencion 3</th>
        <th>Fecha Orden Compra Mantencion 3</th>
        <th>Observacion Mantencion 3</th>
        <th>Verificable Mantencion 3</th>
        <th>Valor Mantencion 4</th>
        <th>Fecha Mantencion 4</th>
        <th>Fecha Recepcion Mantencion 4</th>
        <th>Orden de Compra Mantencion 4</th>
        <th>Fecha Orden Compra Mantencion 4</th>
        <th>Observacion Mantencion 4</th>
        <th>Verificable Mantencion 4</th>
        <th>Valor Mantencion 5</th>
        <th>Fecha Mantencion 5</th>
        <th>Fecha Recepcion Mantencion 5</th>
        <th>Orden de Compra Mantencion 5</th>
        <th>Fecha Orden Compra Mantencion 5</th>
        <th>Observacion Mantencion 5</th>
        <th>Verificable Mantencion 5</th>
        <th>Valor Mantencion 6</th>
        <th>Fecha Mantencion 6</th>
        <th>Fecha Recepcion Mantencion 6</th>
        <th>Orden de Compra Mantencion 6</th>
        <th>Fecha Orden Compra Mantencion 6</th>
        <th>Observacion Mantencion 6</th>
        <th>Verificable Mantencion 6</th>
        <th>Valor Mantencion 7</th>
        <th>Fecha Mantencion 7</th>
        <th>Fecha Recepcion Mantencion 7</th>
        <th>Orden de Compra Mantencion 7</th>
        <th>Fecha Orden Compra Mantencion 7</th>
        <th>Observacion Mantencion 7</th>
        <th>Verificable Mantencion 7</th>
        <th>Valor Mantencion 8</th>
        <th>Fecha Mantencion 8</th>
        <th>Fecha Recepcion Mantencion 8</th>
        <th>Orden de Compra Mantencion 8</th>
        <th>Fecha Orden Compra Mantencion 8</th>
        <th>Observacion Mantencion 8</th>
        <th>Verificable Mantencion 8</th>
        <th>Valor Mantencion 9</th>
        <th>Fecha Mantencion 9</th>
        <th>Fecha Recepcion Mantencion 9</th>
        <th>Orden de Compra Mantencion 9</th>
        <th>Fecha Orden Compra Mantencion 9</th>
        <th>Observacion Mantencion 9</th>
        <th>Verificable Mantencion 9</th>
        <th>Valor Mantencion 10</th>
        <th>Fecha Mantencion 10</th>
        <th>Fecha Recepcion Mantencion 10</th>
        <th>Orden de Compra Mantencion 10</th>
        <th>Fecha Orden Compra Mantencion 10</th>
        <th>Observacion Mantencion 10</th>
        <th>Verificable Mantencion 10</th>
        <th>Valor Mantencion 11</th>
        <th>Fecha Mantencion 11</th>
        <th>Fecha Recepcion Mantencion 11</th>
        <th>Orden de Compra Mantencion 11</th>
        <th>Fecha Orden Compra Mantencion 11</th>
        <th>Observacion Mantencion 11</th>
        <th>Verificable Mantencion 11</th>
        <th>Valor Mantencion 12</th>
        <th>Fecha Mantencion 12</th>
        <th>Fecha Recepcion Mantencion 12</th>
        <th>Orden de Compra Mantencion 12</th>
        <th>Fecha Orden Compra Mantencion 12</th>
        <th>Observacion Mantencion 12</th>
        <th>Verificable Mantencion 12</th>
    </tr>
    <?php foreach ($consulta as $dato) {
        $termino_garantia_F = date("d-m-Y", strtotime($dato->termino_garantia));
        $fecha_inicio_convenio_F = date("d-m-Y", strtotime($dato->fecha_inicio_convenio));
        $fecha_termino_convenio_F = date("d-m-Y", strtotime($dato->fecha_termino_convenio));

        $fecha_mantencion_1_F = date("d-m-Y", strtotime($dato->fecha_mantencion_1));
        $fecha_recep_mant_1_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_1));
        $fecha_oc_mant_1_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_1));
        $fecha_mantencion_2_F = date("d-m-Y", strtotime($dato->fecha_mantencion_2));
        $fecha_recep_mant_2_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_2));
        $fecha_oc_mant_2_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_2));
        $fecha_mantencion_3_F = date("d-m-Y", strtotime($dato->fecha_mantencion_3));
        $fecha_recep_mant_3_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_3));
        $fecha_oc_mant_3_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_3));
        $fecha_mantencion_4_F = date("d-m-Y", strtotime($dato->fecha_mantencion_4));
        $fecha_recep_mant_4_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_4));
        $fecha_oc_mant_4_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_4));
        $fecha_mantencion_5_F = date("d-m-Y", strtotime($dato->fecha_mantencion_5));
        $fecha_recep_mant_5_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_5));
        $fecha_oc_mant_5_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_5));
        $fecha_mantencion_6_F = date("d-m-Y", strtotime($dato->fecha_mantencion_6));
        $fecha_recep_mant_6_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_6));
        $fecha_oc_mant_6_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_6));
        $fecha_mantencion_7_F = date("d-m-Y", strtotime($dato->fecha_mantencion_7));
        $fecha_recep_mant_7_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_7));
        $fecha_oc_mant_7_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_7));
        $fecha_mantencion_8_F = date("d-m-Y", strtotime($dato->fecha_mantencion_8));
        $fecha_recep_mant_8_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_8));
        $fecha_oc_mant_8_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_8));
        $fecha_mantencion_9_F = date("d-m-Y", strtotime($dato->fecha_mantencion_9));
        $fecha_recep_mant_9_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_9));
        $fecha_oc_mant_9_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_9));
        $fecha_mantencion_10_F = date("d-m-Y", strtotime($dato->fecha_mantencion_10));
        $fecha_recep_mant_10_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_10));
        $fecha_oc_mant_10_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_10));
        $fecha_mantencion_11_F = date("d-m-Y", strtotime($dato->fecha_mantencion_11));
        $fecha_recep_mant_11_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_11));
        $fecha_oc_mant_11_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_11));
        $fecha_mantencion_12_F = date("d-m-Y", strtotime($dato->fecha_mantencion_12));
        $fecha_recep_mant_12_F = date("d-m-Y", strtotime($dato->fecha_recep_mant_12));
        $fecha_oc_mant_12_F = date("d-m-Y", strtotime($dato->fecha_oc_mant_12)); ?>

        <tr>
            <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_control_convenio; ?></td>
            <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->id_relacion; ?></td>
            <td><?php echo $dato->responsable; ?></td>
            <td><?php echo $dato->correo_responsable; ?></td>
            <td><?php echo $dato->progr_mantenimiento; ?></td>
            <td><?php echo $dato->caracteristica_acredi; ?></td>
            <td><?php echo $dato->equipo; ?></td>
            <td><?php echo $dato->marca; ?></td>
            <td><?php echo $dato->modelo; ?></td>
            <td><?php echo $dato->serie; ?></td>
            <td><?php echo $dato->num_inventario; ?></td>
            <td><?php echo $dato->grupo; ?></td>
            <td><?php echo $dato->servicio; ?></td>
            <td><?php echo $dato->sector; ?></td>
            <td style="background-color: rgb(247, 84, 84);"><?php if ($dato->termino_garantia === "0000-00-00" || $dato->termino_garantia === "0") {
                                                                echo 'NO APLICA';
                                                            } else {
                                                                echo $termino_garantia_F;
                                                            }; ?></td>
            <td><?php echo $dato->periodicidad_mp; ?></td>
            <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_licitacion_convenio; ?></td>
            <td><?php echo $dato->empresa_adjudicada; ?></td>
            <td><?php echo $dato->equipo_critico_m_c; ?></td>
            <td><?php echo $dato->ubicacion; ?></td>
            <td><?php echo $dato->edificio; ?></td>
            <td><?php echo $dato->piso; ?></td>
            <td><?php echo $dato->sala_pasillo; ?></td>
            <td style="background-color: rgb(191, 105, 241);"><?php if ($dato->fecha_inicio_convenio === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_inicio_convenio_F;
                                                                }; ?></td>
            <td style="background-color: rgb(191, 105, 241);"><?php if ($dato->fecha_termino_convenio === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_termino_convenio_F;
                                                                }; ?></td>
            <td><?php echo $dato->duracion_en_meses; ?></td>
            <td><?php echo $dato->ejecutivo_compra; ?></td>
            <td><?php echo $dato->correo_ejecutivo; ?></td>
            <td><?php echo $dato->peridiocidad; ?></td>
            <td style="background-color: rgb(191, 105, 241);"><?php echo $dato->n_manten_preventivas; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo number_format($dato->valor_mantencion_1); ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_mantencion_1 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_1_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_recep_mant_1 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_1_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->orden_compra_mant_1; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_oc_mant_1 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_1_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->observacion_mant_1; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->verificable_mant_1; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo number_format($dato->valor_mantencion_2); ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_mantencion_2 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_2_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_recep_mant_2 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_2_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->orden_compra_mant_2; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_oc_mant_2 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_2_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->observacion_mant_2; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->verificable_mant_2; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo number_format($dato->valor_mantencion_3); ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_mantencion_3 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_3_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_recep_mant_3 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_3_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->orden_compra_mant_3; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_oc_mant_3 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_3_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->observacion_mant_3; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->verificable_mant_3; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo number_format($dato->valor_mantencion_4); ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_mantencion_4 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_4_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_recep_mant_4 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_4_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->orden_compra_mant_4; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_oc_mant_4 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_4_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->observacion_mant_4; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->verificable_mant_4; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo number_format($dato->valor_mantencion_5); ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_mantencion_5 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_5_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_recep_mant_5 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_5_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->orden_compra_mant_5; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_oc_mant_5 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_5_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->observacion_mant_5; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->verificable_mant_5; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo number_format($dato->valor_mantencion_6); ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_mantencion_6 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_6_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_recep_mant_6 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_6_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->orden_compra_mant_6; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_oc_mant_6 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_6_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->observacion_mant_6; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->verificable_mant_6; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo number_format($dato->valor_mantencion_7); ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_mantencion_7 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_7_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_recep_mant_7 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_7_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->orden_compra_mant_7; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_oc_mant_7 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_7_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->observacion_mant_7; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->verificable_mant_7; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo number_format($dato->valor_mantencion_8); ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_mantencion_8 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_8_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_recep_mant_8 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_8_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->orden_compra_mant_8; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_oc_mant_8 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_8_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->observacion_mant_8; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->verificable_mant_8; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo number_format($dato->valor_mantencion_9); ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_mantencion_9 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_9_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_recep_mant_9 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_9_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->orden_compra_mant_9; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_oc_mant_9 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_9_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->observacion_mant_9; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->verificable_mant_9; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo number_format($dato->valor_mantencion_10); ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_mantencion_10 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_10_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_recep_mant_10 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_10_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->orden_compra_mant_10; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php if ($dato->fecha_oc_mant_10 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_10_F;
                                                                }; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->observacion_mant_10; ?></td>
            <td style="background-color: rgb(163, 245, 130);"><?php echo $dato->verificable_mant_10; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo number_format($dato->valor_mantencion_11); ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_mantencion_11 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_11_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_recep_mant_11 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_11_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->orden_compra_mant_11; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php if ($dato->fecha_oc_mant_11 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_11_F;
                                                                }; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->observacion_mant_11; ?></td>
            <td style="background-color: rgb(245, 195, 130);"><?php echo $dato->verificable_mant_11; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo number_format($dato->valor_mantencion_12); ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_mantencion_12 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_mantencion_12_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_recep_mant_12 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_recep_mant_12_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->orden_compra_mant_12; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php if ($dato->fecha_oc_mant_12 === "0000-00-00") {
                                                                    echo 'NO APLICA';
                                                                } else {
                                                                    echo $fecha_oc_mant_12_F;
                                                                }; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->observacion_mant_12; ?></td>
            <td style="background-color: rgb(130, 245, 216);"><?php echo $dato->verificable_mant_12; ?></td>
        </tr>
    <?php } ?>
</table>