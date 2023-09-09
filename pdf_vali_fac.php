<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL" ||
        $_SESSION['tipo'] === "TECNICOS"
    ) {

        // Include
        include('pdf_tables_format.php');

        include 'config/conexion.php';

        if (!isset($_GET['pdfId'])) {
            exit();
        }

        $pdfId = $_GET['pdfId'];

        // Load Data For Label
        $sentencia1 = $bd->prepare("SELECT * FROM proceso_peticiones WHERE id_peticiones = ?;");
        $sentencia1->execute([$pdfId]);
        $idNew = $sentencia1->fetch(PDO::FETCH_OBJ);

        // Load Data For Table
        $sentencia = $bd->query("SELECT * FROM proceso_peticiones WHERE id_peticiones = $pdfId;");
        $datos = $sentencia->fetchAll(PDO::FETCH_OBJ);

        // Length string
        $ordinario = $idNew->ordinario;
        $ordinarioTamano = strlen($ordinario);

        $referencia = $idNew->referencia;
        $referenciaTamano = strlen($referencia);

        $solici_de_compra = $idNew->solici_de_compra;
        $solici_de_compraTamano = strlen($solici_de_compra);

        // Actual Date
        $fechaActual = date('d-m-Y');

        // Make new Object
        $pdf = new PDF_MC_Table();

        // Page Title
        $pdf->SetTitle('Acta Recepcion de Trabajos');

        // Add page
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 14);

        // Set width (6 columns)
        $pdf->SetWidths(array(16, 15, 55, 30, 35, 35));

        // Set line height
        $pdf->SetLineHeight(5);

        // Content
        $pdf->SetFont('Courier', '', 7);
        $pdf->Write(5, utf8_decode('
                    MINISTERIO DE SALUD
                    REGION DE LOS RIOS
                    HOSPITAL BASE VALDIVIA                                                     
                    DEPARTAMENTO DE OPERACIONES
                    SUBDEPARTAMENTO MANTENCION'));
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetY(10);
        $pdf->SetX(-65);
        $pdf->Cell(10, 20, utf8_decode('ACTA N°: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(-18);
        $pdf->cell(10, 20, $idNew->n_acta, 0, 0, 'R', 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetY(17);
        $pdf->SetX(-65);
        $pdf->Cell(10, 20, utf8_decode('CODIGO: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(-18);
        $pdf->cell(10, 20, $idNew->fecha_soli_compra, 0, 0, 'R', 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetY(24);
        $pdf->SetX(-65);
        $pdf->Cell(10, 20, utf8_decode('COSTO: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(-18);
        $pdf->cell(10, 20, $idNew->total_gral, 0, 0, 'R', 0);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->setY(47);
        $pdf->Cell(0, 5, 'ACTA RECEPCION DE TRABAJOS POR CONTRATACION DE SERVICIOS', 0, 0, 'C');
        $pdf->SetY(60);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, utf8_decode('En Valdivia a   '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $fechaActual);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, utf8_decode('    , se procede a recepcionar trabajo, servicio y/o producto de la Empresa:'));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->empresa);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, utf8_decode('Correspondiente a trabajos ocasionales realizados en:   '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->serv_usuario);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, utf8_decode('Descripción de equipo, máquina, instrumental o espacio físico:'));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->descr_solicitud);
        $pdf->Ln();

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Solicitados en Ord. N°      '));    // 2 tab
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->solici_de_compra);
        $pdf->SetX(-139);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('fecha       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->fecha_soli_compra);
        $pdf->SetX(-102);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('del Subdepto.       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->sub_depto);
        $pdf->Ln();
        $pdf->SetX(-166);
        $pdf->MultiCell(25, 0, '', 'T', 'L', false);    // MultiCell for better lines
        $pdf->SetX(-127);
        $pdf->MultiCell(23, 2, '', 'T', 'L', false);
        $pdf->SetY(95);
        $pdf->SetX(-78);
        $pdf->MultiCell(50, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Según Licitación ID     '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->id_licitacion);
        $pdf->SetX(-127);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('o Trato Directo       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->tipo_compra);
        $pdf->Ln();
        $pdf->SetX(-169);
        $pdf->MultiCell(40, 2, '', 'T', 'L', false);
        $pdf->SetY(104);
        $pdf->SetX(-101);
        $pdf->MultiCell(45, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Res. Bases Técnicas/Términos de Referencia      '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->resolu_base_tec);
        $pdf->SetX(-112);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('de fecha       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->fecha_base_tec);
        $pdf->Ln();
        $pdf->SetX(-132);
        $pdf->MultiCell(18, 2, '', 'T', 'L', false);
        $pdf->SetY(113);
        $pdf->SetX(-96);
        $pdf->MultiCell(35, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Res. Adjudicación o Autorización N°      '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->resolu_adjudi);
        $pdf->SetX(-126);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('de fecha       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->fecha_resolu_adjudi);
        $pdf->Ln();
        $pdf->SetX(-146);
        $pdf->MultiCell(18, 2, '', 'T', 'L', false);
        $pdf->SetY(122);
        $pdf->SetX(-110);
        $pdf->MultiCell(35, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Resolución de Contrato N°      '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->resolu_contrato);
        $pdf->SetX(-139);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('de fecha       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->fecha_resolu_contra);
        $pdf->Ln();
        $pdf->SetX(-159);
        $pdf->MultiCell(18, 2, '', 'T', 'L', false);
        $pdf->SetY(131);
        $pdf->SetX(-123);
        $pdf->MultiCell(35, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Orden de Compra N°      '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->orden_compra);
        $pdf->SetX(-125);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('de fecha       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->fecha_oc);
        $pdf->Ln();
        $pdf->SetX(-167);
        $pdf->MultiCell(40, 2, '', 'T', 'L', false);
        $pdf->SetY(140);
        $pdf->SetX(-109);
        $pdf->MultiCell(35, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Por un monto de      $ '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->monto_oc);
        $pdf->Ln();
        $pdf->SetX(-173);
        $pdf->MultiCell(47, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Ejecutado para el Servicio, Unidad o espacio físico     '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->serv_usuario);
        $pdf->Ln();
        $pdf->SetX(-125);
        $pdf->MultiCell(100, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Plazo de entrega ofertado por empresa      '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->plazo_entrega);
        $pdf->SetX(-99);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Verificable:       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->verificable);
        $pdf->Ln();
        $pdf->SetX(-141);
        $pdf->MultiCell(40, 2, '', 'T', 'L', false);
        $pdf->SetY(179);
        $pdf->SetX(-80);
        $pdf->MultiCell(56, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Informe Técnico      '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->plazo_entrega);
        $pdf->SetX(-122);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Fecha Inf. Técnico:       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->verificable);
        $pdf->Ln();
        $pdf->SetX(-174);
        $pdf->MultiCell(50, 2, '', 'T', 'L', false);
        $pdf->SetY(188);
        $pdf->SetX(-91);
        $pdf->MultiCell(56, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Fecha recepción Bodega General      '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->fecha_recep);
        $pdf->SetX(-122);
        $pdf->Ln();
        $pdf->SetX(-149);
        $pdf->MultiCell(30, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Garantía técnica:      Desde        '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->fecha_inic_gt_tec);
        $pdf->SetX(-126);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Hasta       '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->fecha_term_gt_tec);
        $pdf->Ln();
        $pdf->SetX(-158);
        $pdf->MultiCell(30, 2, '', 'T', 'L', false);
        $pdf->SetY(206);
        $pdf->SetX(-114);
        $pdf->MultiCell(30, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Boleta garantía asociada:      '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->fecha_recep);
        $pdf->SetX(-122);
        $pdf->Ln();
        $pdf->SetX(-160);
        $pdf->MultiCell(50, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->Ln();

        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('OBSERVACIONES:     '));
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, $idNew->obser_pet);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('Recibe conforme (según indica Res.)'));

        // New Page
        $pdf->AddPage();
        $pdf->Ln(40);
        $pdf->SetX(-190);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, utf8_decode('ING LUIS DELGADO'));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(5, utf8_decode('UNIDAD DE EQ. INDUSTRIALES
SUBDEPARTAMENTO DE MANTECION
        '));
        $pdf->SetY(86);
        $pdf->SetX(-50);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('0'));
        $pdf->Ln();
        $pdf->SetX(-75);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, utf8_decode('UNIDAD DE EQUIPOS INDUSTRIALES
                                                                                                                                              SUBDEPARTAMENTO DE MANTECION
        '));
        $pdf->Ln();
        $pdf->SetY(82);
        $pdf->SetX(-205);
        $pdf->MultiCell(77, 2, '', 'T', 'L', false);
        $pdf->SetY(82);
        $pdf->SetX(-83);
        $pdf->MultiCell(77, 2, '', 'T', 'L', false);
        $pdf->Ln(85);

        $pdf->SetX(-197);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Write(5, utf8_decode('JOSE ALFREDO ARCE REINOSO'));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(5, utf8_decode('JEFE SUBDEPTO DE MANTENCION
HOSPITAL BASE VALDIVIA
        '));
        $pdf->SetY(171);
        $pdf->SetX(-66);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('JOSE MIGUEL SANCHO LL'));
        $pdf->Ln();
        $pdf->SetX(-75);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Write(5, utf8_decode('UNIDAD DE EQUIPOS INDUSTRIALES
                                                                                                                                              SUBDEPARTAMENTO DE MANTECION
        '));
        $pdf->Ln();
        $pdf->SetY(166);
        $pdf->SetX(-205);
        $pdf->MultiCell(77, 2, '', 'T', 'L', false);
        $pdf->SetY(166);
        $pdf->SetX(-83);
        $pdf->MultiCell(77, 2, '', 'T', 'L', false);

        // Output PDF
        $pdf->Output('I', 'Acta Recep Trabajos Por Contratacion Servicios.pdf');
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION"
    ) {
        header('Location: home.php');
    }
}
