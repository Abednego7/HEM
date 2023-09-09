<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS") {

        if (!isset($_POST['pdfId'])) {
            exit();
        } else {
            if (empty($_POST['idRecepcion'])) {
                header('Location: recepcion_equipo.php');   // Se activa si no se selecciona algun equipo en los checkboxes
            } else {

                // Include
                include('pdf_tables_format.php');
                // Include BD
                include 'config/conexion.php';

                $arreglo = $_POST['idRecepcion'];
                $cantidad = count($arreglo);

                $fechaActual = date('d-m-y');

                $sentencia = $bd->prepare("SELECT Eq.id_relacion, Eq.servicio, Eq.equipo, Eq.marca, Eq.modelo, Eq.serie, Eq.valor, Eq.vida_util, Eq.propiedad, Eq.id_licitacion, Eq.empresa,
                    Re.id_recepcion, Re.ano_fabrica, Re.financiamiento, Re.producto_solicitado, Re.requerimiento_tecnico, Re.nombre_proyecto, Re.decreto,
                    Re.fecha_decreto, Re.resolucion_especi_tec, Re.fecha_resolu_especi_tec, Re.resolucion_adjudicacion, Re.fecha_de_adjudi,
                    Re.resolucion_contrato, Re.fecha_resolu_contrato, Re.tipo_de_compra, Re.orden_compra, Re.fecha_orden_compra, Re.detalle_orden_compra, Re.plazo_entrega,
                    Re.tipo_de_dias, Re.fecha_entrega, Re.rut, Re.proveedor, Re.numero_acta, Re.fecha_recepcion_parcial, Re.fecha_puesta_marcha,
                    Re.fecha_recepcion_final, Re.capacitacion, Re.fecha_capacitacion, Re.garantia_fabricante, Re.fecha_inicio_garanti_fabricante,
                    Re.fecha_termino_garanti_fabricante, Re.mantenciones_en_garantia, Re.periodo_mantenci_garanti, Re.verificable_entrega, Re.fecha_verificable,
                    Re.ref_tecnico_recepcion, Re.ref_tecnico_clinico, Re.ref_tecnico_mantencion_1, Re.ref_tecnico_mantencion_2, Re.ref_tecnico_mantencion_3,
                    Re.ref_tecnico_externo, Re.otro_referente_1, Re.otro_referente_2, 
                    Re.accesorio_1, Re.accesorio_2, Re.accesorio_3, Re.accesorio_4, Re.accesorio_5, Re.accesorio_6, Re.accesorio_7, Re.accesorio_8, Re.accesorio_9, 
                    Re.accesorio_10, Re.observaciones, Re.cantidad
                    FROM equipamiento Eq
                    INNER JOIN recepcion Re ON Eq.id_relacion = Re.relacion_id
                    WHERE id_recepcion = :ids;");


                $registros = array();

                for ($i = 0; $i < $cantidad; $i++) {
                    $sentencia->execute(array(':ids' => $arreglo[$i]));

                    $registros[] = $sentencia->fetch(PDO::FETCH_OBJ);
                }

                // Loop Data
                foreach ($registros as $dato) {
                    $ids[] = $dato->id_relacion;

                    $servicio[] = $dato->servicio;
                    $equipo[] = $dato->equipo;
                    $marca[] = $dato->marca;
                    $modelo[] = $dato->modelo;
                    $serie[] = $dato->serie;

                    $valor[] = $dato->valor;

                    $formatted = array_map(function ($num) {
                        return number_format($num);
                    }, $valor);           // FORMAT ARRAY

                    $vida_util[] = $dato->vida_util;
                    $propiedad[] = $dato->propiedad;
                    $id_licitacion[] = $dato->id_licitacion;
                    $empresa[] = $dato->empresa;

                    $ano_fabricacion[] = $dato->ano_fabrica;
                    $financiamiento[] = $dato->financiamiento;
                    $producto_solicitado[] = $dato->producto_solicitado;
                    $requerimiento_tecnico[] = $dato->requerimiento_tecnico;
                    $nombre_proyecto[] = $dato->nombre_proyecto;
                    $decreto[] = $dato->decreto;
                    $fecha_decreto[] = $dato->fecha_decreto;
                    $resolucion_especi_tec[] = $dato->resolucion_especi_tec;
                    $fecha_resolu_especi_tec[] = $dato->fecha_resolu_especi_tec;
                    $resolucion_adjudicacion[] = $dato->resolucion_adjudicacion;
                    $fecha_de_adjudi[] = $dato->fecha_de_adjudi;
                    $resolucion_contrato[] = $dato->resolucion_contrato;
                    $fecha_resolu_contrato[] = $dato->fecha_resolu_contrato;
                    $tipo_de_compra[] = $dato->tipo_de_compra;
                    $orden_compra[] = $dato->orden_compra;
                    $fecha_orden_compra[] = $dato->fecha_orden_compra;
                    $detalle_orden_compra[] = $dato->detalle_orden_compra;
                    $plazo_entrega[] = $dato->plazo_entrega;
                    $tipo_de_dias[] = $dato->tipo_de_dias;
                    $fecha_entrega[] = $dato->fecha_entrega;
                    $rut[] = $dato->rut;
                    $proveedor[] = $dato->proveedor;
                    $numero_acta[] = $dato->numero_acta;
                    $fecha_recepcion_parcial[] = $dato->fecha_recepcion_parcial;
                    $fecha_puesta_marcha[] = $dato->fecha_puesta_marcha;
                    $fecha_recepcion_final[] = $dato->fecha_recepcion_final;
                    $capacitacion[] = $dato->capacitacion;
                    $fecha_capacitacion[] = $dato->fecha_capacitacion;
                    $garantia_fabricante[] = $dato->garantia_fabricante;
                    $fecha_inicio_garanti_fabricante[] = $dato->fecha_inicio_garanti_fabricante;
                    $fecha_termino_garanti_fabricante[] = $dato->fecha_termino_garanti_fabricante;
                    $mantenciones_en_garantia[] = $dato->mantenciones_en_garantia;
                    $periodo_mantenci_garanti[] = $dato->periodo_mantenci_garanti;
                    $verificable_entrega[] = $dato->verificable_entrega;
                    $fecha_verificable[] = $dato->fecha_verificable;
                    $ref_tecnico_recepcion[] = $dato->ref_tecnico_recepcion;
                    $ref_tecnico_clinico[] = $dato->ref_tecnico_clinico;
                    $ref_tecnico_mantencion_1[] = $dato->ref_tecnico_mantencion_1;
                    $ref_tecnico_mantencion_2[] = $dato->ref_tecnico_mantencion_2;
                    $ref_tecnico_mantencion_3[] = $dato->ref_tecnico_mantencion_3;
                    $ref_tecnico_externo[] = $dato->ref_tecnico_externo;
                    $otro_referente_1[] = $dato->otro_referente_1;
                    $otro_referente_2[] = $dato->otro_referente_2;


                    $accesorio_1[] = $dato->accesorio_1;
                    $accesorio_2[] = $dato->accesorio_2;
                    $accesorio_3[] = $dato->accesorio_3;
                    $accesorio_4[] = $dato->accesorio_4;
                    $accesorio_5[] = $dato->accesorio_5;
                    $accesorio_6[] = $dato->accesorio_6;
                    $accesorio_7[] = $dato->accesorio_7;
                    $accesorio_8[] = $dato->accesorio_8;
                    $accesorio_9[] = $dato->accesorio_9;
                    $accesorio_10[] = $dato->accesorio_10;

                    $observaciones[] = $dato->observaciones;

                    $cantidadE[] = $dato->cantidad;
                }

                $dato_ids = implode(" - ", $ids);

                $dato_servicio = implode(",", $servicio);
                $dato_equipo = implode("\n", $equipo);
                $dato_marca = implode("\n", $marca);
                $dato_modelo = implode("\n", $modelo);
                $dato_serie = implode("\n", $serie);
                $dato_valor = implode("\n", $formatted);
                $dato_vida_util = implode(",", $vida_util);
                $dato_propiedad = implode(",", $propiedad);
                $dato_id_licitacion = implode("\n", $id_licitacion);
                $dato_empresa = implode(",", $empresa);

                $dato_ano_fabricacion = implode(",", $ano_fabricacion);
                $dato_financiamiento = implode("\n", $financiamiento);
                $dato_producto_solicitado = implode(", ", $producto_solicitado);
                $dato_requerimiento_tecnico = implode(",     ", $requerimiento_tecnico);
                $dato_nombre_proyecto = implode(",", $nombre_proyecto);
                $dato_decreto = implode("\n", $decreto);
                $dato_fecha_decreto = implode(",", $fecha_decreto);
                $dato_resolucion_especi_tec = implode(",", $resolucion_especi_tec);
                $dato_fecha_resolu_especi_tec = implode(",", $fecha_resolu_especi_tec);
                $dato_resolucion_adjudicacion = implode(",", $resolucion_adjudicacion);
                $dato_fecha_de_adjudi = implode(",", $fecha_de_adjudi);
                $dato_resolucion_contrato = implode(",", $resolucion_contrato);
                $dato_fecha_resolu_contrato = implode(",", $fecha_resolu_contrato);
                $dato_tipo_de_compra = implode("\n", $tipo_de_compra);
                $dato_orden_compra = implode(",", $orden_compra);
                $dato_fecha_orden_compra = implode(",", $fecha_orden_compra);
                $dato_detalle_orden_compra = implode("\n", $detalle_orden_compra);
                $dato_plazo_entrega = implode(",", $plazo_entrega);
                $dato_tipo_de_dias = implode(",", $tipo_de_dias);
                $dato_fecha_entrega = implode(",", $fecha_entrega);
                $dato_rut = implode(",", $rut);
                $dato_proveedor = implode(",", $proveedor);
                $dato_numero_acta = implode(",", $numero_acta);
                $dato_fecha_recepcion_parcial = implode(",", $fecha_recepcion_parcial);
                $dato_fecha_puesta_marcha = implode(",", $fecha_puesta_marcha);
                $dato_fecha_recepcion_final = implode(",", $fecha_recepcion_final);
                $dato_capacitacion = implode(",", $capacitacion);
                $dato_fecha_capacitacion = implode(",", $fecha_capacitacion);
                $dato_garantia_fabricante = implode(",", $garantia_fabricante);
                $dato_fecha_inicio_garanti_fabricante = implode(",", $fecha_inicio_garanti_fabricante);
                $dato_fecha_termino_garanti_fabricante = implode(",", $fecha_termino_garanti_fabricante);
                $dato_mantenciones_en_garantia = implode(",", $mantenciones_en_garantia);
                $dato_periodo_mantenci_garanti = implode(",", $periodo_mantenci_garanti);
                $dato_verificable_enterega = implode(",", $verificable_entrega);
                $dato_fecha_verificable = implode(",", $fecha_verificable);
                $dato_ref_tecnico_recepcion = implode(",", $ref_tecnico_recepcion);
                $dato_ref_tecnico_clinico = implode(",", $ref_tecnico_clinico);
                $dato_ref_tecnico_mantencion_1 = implode(",", $ref_tecnico_mantencion_1);
                $dato_ref_tecnico_mantencion_2 = implode(",", $ref_tecnico_mantencion_2);
                $dato_ref_tecnico_mantencion_3 = implode(",", $ref_tecnico_mantencion_3);
                $dato_ref_tecnico_externo = implode(",", $ref_tecnico_externo);
                $dato_otro_referente_1 = implode(",", $otro_referente_1);
                $dato_otro_referente_2 = implode(",", $otro_referente_2);


                $dato_accesorio_1 = implode("                       ", $accesorio_1);
                $dato_accesorio_2 = implode("                       ", $accesorio_2);
                $dato_accesorio_3 = implode("                       ", $accesorio_3);
                $dato_accesorio_4 = implode("                       ", $accesorio_4);
                $dato_accesorio_5 = implode("                       ", $accesorio_5);
                $dato_accesorio_6 = implode("                       ", $accesorio_6);
                $dato_accesorio_7 = implode("                       ", $accesorio_7);
                $dato_accesorio_8 = implode("                       ", $accesorio_8);
                $dato_accesorio_9 = implode("                       ", $accesorio_9);
                $dato_accesorio_10 = implode("                      ", $accesorio_10);


                $dato_observaciones = implode("\n", $observaciones);

                $dato_cantidad = implode("\n", $cantidadE);

                // Make new Object
                $pdf = new PDF_MC_Table();

                // Page Title
                $pdf->SetTitle('Acta Recepcion de Equipos');

                $pdf->AddPage();
                $pdf->SetFont('Courier', '', 7);
                $pdf->Write(5, utf8_decode('
                    MINISTERIO DE SALUD
                    REGION DE LOS RIOS
                    HOSPITAL BASE VALDIVIA                                                     
                    DEPARTAMENTO DE OPERACIONES
                    SUBDEPARTAMENTO DE INVERSION Y PROYECTOS'));
                $pdf->Line(0, 41, 180, 41);

                // Set width (6 columns)
                $pdf->SetWidths(array(10, 55, 20, 30, 40, 40));

                // Set line height
                $pdf->SetLineHeight(5);

                // Content
                $pdf->SetFont('Arial', 'B', 14);
                $pdf->setY(50);
                $pdf->Cell(0, 5, 'ACTA DE RECEPCION DE EQUIPOS', 0, 0, 'C');
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetX(-65);
                $pdf->Cell(20, 10, utf8_decode('Acta N°: '), -20, -20);
                $pdf->SetX(176);
                $pdf->cell(20, 10, $dato_ids, 0, 0, 'R', 0);
                $pdf->Line(207, 62, 170, 62);
                $pdf->Ln();
                $pdf->SetX(-65);
                $pdf->Cell(20, 10, 'Fecha: ');
                $pdf->SetX(176);
                $pdf->cell(20, 10, $fechaActual, 0, 0, 'R', 0);
                $pdf->Line(207, 72, 170, 72);
                $pdf->Ln();
                $pdf->Write(10, 'Valdivia, ');
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(10, $fechaActual);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(10, utf8_decode('. Se procede a recepcionar equipos de correspondiente a Adquisición '));
                $pdf->Ln();

                // Add table heading
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->Cell(10, 5, 'CANT', 1, 0);
                $pdf->Cell(55, 5, 'DETALLE', 1, 0);
                $pdf->Cell(20, 5, 'DECRETO', 1, 0);
                $pdf->Cell(30, 5, 'FINANCIAMIENTO', 1, 0);
                $pdf->Cell(40, 5, 'TIPO DE COMPRA', 1, 0);
                $pdf->Cell(40, 5, 'ID LICITACION', 1, 0);

                $pdf->Ln();

                $pdf->SetFont('Arial', '', 8);

                // Data
                $pdf->Row(array(
                    $dato_cantidad,
                    $dato_detalle_orden_compra,
                    $dato_decreto,
                    $dato_financiamiento,
                    $dato_tipo_de_compra,
                    $dato_id_licitacion
                ));


                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('De acuerdo a lo estipulado en '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->nombre_proyecto);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(', se solicitó '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $cantidad);
                $pdf->Write(5, ' ');
                $pdf->Write(5, $dato->producto_solicitado);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(' de manera estandar.'));
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Write(5, utf8_decode('En las Especificaciones Técnicas (Solucitadas por '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->financiamiento);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(') se denomina '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato_requerimiento_tecnico);
                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('La cual incluirá los siguientes accesorios:'));
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato_accesorio_1);
                $pdf->Ln();
                $pdf->Write(5, $dato_accesorio_2);
                $pdf->Ln();
                $pdf->Write(5, $dato_accesorio_3);
                $pdf->Ln();
                $pdf->Write(5, $dato_accesorio_4);
                $pdf->Ln();
                $pdf->Write(5, $dato_accesorio_5);
                $pdf->Ln();
                $pdf->Write(5, $dato_accesorio_6);
                $pdf->Ln();
                $pdf->Write(5, $dato_accesorio_7);
                $pdf->Ln();
                $pdf->Write(5, $dato_accesorio_8);
                $pdf->Ln();
                $pdf->Write(5, $dato_accesorio_9);
                $pdf->Ln();
                $pdf->Write(5, $dato_accesorio_10);
                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('Observaciones: '));
                $pdf->Ln();
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato_observaciones);

                // New Page
                $pdf->AddPage();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(10, utf8_decode('Como recepción de equipos el '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(10, 'Hospital Base Valdivia ');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(10, utf8_decode('los reconocerá de la siguiente manera:'));
                $pdf->Ln();

                // Set width (3 columns)
                $pdf->SetWidths(array(10, 57, 45, 27, 34, 21));

                // Set line height
                $pdf->SetLineHeight(5);

                // Header Table 2
                $pdf->SetFont('Arial', 'B', 8);
                $pdf->Cell(10, 5, 'CANT', 1, 0);
                $pdf->Cell(57, 5, 'EQUIPO', 1, 0);
                $pdf->Cell(45, 5, 'MARCA', 1, 0);
                $pdf->Cell(27, 5, 'MODELO', 1, 0);
                $pdf->Cell(34, 5, 'SERIE', 1, 0);
                $pdf->Cell(21, 5, 'V UNITARIO', 1, 0);
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 8);

                // Data
                $pdf->Row(array(
                    $dato_cantidad,
                    $dato_equipo,
                    $dato_marca,
                    $dato_modelo,
                    $dato_serie,
                    $dato_valor
                ));

                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('Fueron adquiridos por la empresa '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->empresa);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(', según orden de compra numero: '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->orden_compra);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(' de fecha: '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->fecha_orden_compra);
                $pdf->Write(5, '.');
                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('En relación a los plazos de entrega corresponde a '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->plazo_entrega);
                $pdf->Write(5, utf8_decode(' Días Corridos, '));
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('teniendo como fecha entrega '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->fecha_entrega);

                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('Por lo cual la fecha de recepción parcial es, '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->fecha_recepcion_parcial);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(', en donde el equipo es recibido en Bodega General del Hospital Base Valdivia.'));
                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('La Fecha de Puesta en Marcha es '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->fecha_puesta_marcha);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(', en donde el equipo es instalado en Servicio Usuario de '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->servicio);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(' del Hospital Base Valdivia.'));
                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('Por lo cual la fecha de Recepción Final es '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->fecha_recepcion_final);
                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('El equipo tiene una vida util de '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->vida_util);
                $pdf->Write(5, utf8_decode(' años, '));
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('siendo su año de fabricación '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->ano_fabrica);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(' según antecedentes entregados por la empresa '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->empresa);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('.'));
                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('El equipo tendrá una garantia de  '));

                // * Inicio Calculo de meses

                $inicio_gtia = $dato->fecha_inicio_garanti_fabricante;
                $termino_gtia = $dato->fecha_termino_garanti_fabricante;

                $date1 = new DateTime($inicio_gtia);
                $date2 = new DateTime($termino_gtia);

                # Diferencia entre las dos fechas

                $interval = $date2->diff($date1);

                # Diferencia de meses

                $intervalMeses = $interval->format("%m");

                # Obtenemos la diferencia en años y multiplicamos por 12  para tener los meses

                $intervalAnos = $interval->format("%y") * 12;

                $result = $intervalMeses + $intervalAnos;

                // * Fin Calculo

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $result);
                $pdf->Write(5, ' meses');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(', en donde su garantía inicial es de fecha '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->fecha_inicio_garanti_fabricante);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(' y su fecha de término de garantía es '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->fecha_termino_garanti_fabricante);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(', la cual incluirá '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->mantenciones_en_garantia);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(', dividida en '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->periodo_mantenci_garanti);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(' por lo que dure la garantía.'));
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Write(5, utf8_decode('Para efectos de verificación de entrega de equipo, tiene como verificable la '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->verificable_entrega);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode(' de fecha '));
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->fecha_verificable);
                $pdf->Write(5, '.');

                // New Page
                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->SetY(83);
                $pdf->Write(5, $dato->ref_tecnico_mantencion_1);
                $pdf->SetX(120);
                $pdf->Write(5, $dato->ref_tecnico_mantencion_2);
                $pdf->Ln();
                $pdf->SetX(15);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('HOSPITAL BASE VALDIVIA'));
                $pdf->SetX(122);
                $pdf->Write(5, utf8_decode('HOSPITAL BASE VALDIVIA'));
                $pdf->Ln(70, 10);
                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Write(5, $dato->ref_tecnico_mantencion_3);
                $pdf->SetX(120);
                $pdf->Write(5, $dato->ref_tecnico_externo);
                $pdf->Ln();
                $pdf->SetX(15);
                $pdf->SetFont('Arial', '', 10);
                $pdf->Write(5, utf8_decode('HOSPITAL BASE VALDIVIA'));
                $pdf->SetX(122);
                $pdf->Write(5, utf8_decode('HOSPITAL BASE VALDIVIA'));

                // Lines
                $pdf->Line(5, 80, 75, 80);
                $pdf->Line(112, 80, 185, 80);
                $pdf->Line(5, 155, 75, 155);
                $pdf->Line(112, 155, 185, 155);

                $pdf->Output('I', 'Acta de Recepcion de Equipos.pdf');
            }
        }
    } elseif (
        $_SESSION['tipo'] === "MANTENCION" || $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: home.php');
    }
}
