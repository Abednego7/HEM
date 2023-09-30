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

        // Make new Object
        $pdf = new PDF_MC_Table();

        // Page Title
        $pdf->SetTitle('Acta Mantencion Solc de Compra');

        // Add page
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 14);

        // Set width (6 columns)
        $pdf->SetWidths(array(16, 15, 55, 30, 35, 35));

        // Set line height
        $pdf->SetLineHeight(5);

        // Content
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->setY(25);
        $pdf->SetX(-226);
        $pdf->Cell(0, 5, 'MANTENCION SOLICITUD DE COMPRA', 0, 0, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetY(10);
        $pdf->SetX(-65);
        $pdf->Cell(10, 20, utf8_decode('SOLICITUD DE COMPRA: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(-18);
        $pdf->cell(10, 20, $idNew->solici_de_compra, 0, 0, 'R', 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetY(17);
        $pdf->SetX(-65);
        $pdf->Cell(10, 20, utf8_decode('FECHA SOL DE COMPRA: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(-18);
        $pdf->cell(10, 20, $idNew->fecha_soli_compra, 0, 0, 'R', 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetY(24);
        $pdf->SetX(-65);
        $pdf->Cell(10, 20, utf8_decode('REFERENCIA: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(-18);
        $pdf->cell(10, 20, $idNew->referencia, 0, 0, 'R', 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetY(31);
        $pdf->SetX(-65);
        $pdf->Cell(10, 20, utf8_decode('FECHA DE REFERENCIA: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(-18);
        $pdf->cell(10, 20, $idNew->fecha_referencia, 0, 0, 'R', 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetY(38);
        $pdf->SetX(-65);
        $pdf->Cell(10, 20, utf8_decode('ITEM: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetX(-18);
        $pdf->cell(10, 20, $idNew->item_ppto_solicitado, 0, 0, 'R', 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetY(45);
        $pdf->SetX(-65);
        $pdf->Cell(10, 20, utf8_decode('CONVENIO SI PROCEDE: '));
        $pdf->SetFont('Arial', 'B', 8);


        $pdf->SetY(60);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('PARA FINANZAS'));
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Agradeceré a usted autorice la: COMPRA de:'));
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->descr_solicitud);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode(' Para el Servicio Usuario: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->serv_usuario);
        $pdf->Ln();
        $pdf->Ln();

        // Add table heading
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(16, 5, 'U/M', 1, 0);
        $pdf->Cell(15, 5, 'CANT', 1, 0);
        $pdf->Cell(55, 5, 'DETALLE', 1, 0);
        $pdf->Cell(30, 5, 'COD MANG', 1, 0);
        $pdf->Cell(35, 5, 'V UNI', 1, 0);
        $pdf->Cell(35, 5, 'V NETO', 1, 0);

        $pdf->Ln();

        $pdf->SetFont('Arial', '', 8);

        if ($idNew->c_manager_1 > 0) {
            // Loop data 1
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_1,
                    $item->cantidad_1,
                    $item->detalle_compra_1,
                    $item->c_manager_1,
                    number_format($item->valor_unitario_1),
                    number_format($item->neto_1),
                ));
            }
        }

        if ($idNew->c_manager_2 > 0) {
            // Loop data 2
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_2,
                    $item->cantidad_2,
                    $item->detalle_compra_2,
                    $item->c_manager_2,
                    number_format($item->valor_unitario_2),
                    number_format($item->neto_2),
                ));
            }
        }

        if ($idNew->c_manager_3 > 0) {
            // Loop data 3
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_3,
                    $item->cantidad_3,
                    $item->detalle_compra_3,
                    $item->c_manager_3,
                    number_format($item->valor_unitario_3),
                    number_format($item->neto_3),
                ));
            }
        }

        if ($idNew->c_manager_4 > 0) {
            // Loop data 4
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_4,
                    $item->cantidad_4,
                    $item->detalle_compra_4,
                    $item->c_manager_4,
                    number_format($item->valor_unitario_4),
                    number_format($item->neto_4),
                ));
            }
        }

        if ($idNew->c_manager_5 > 0) {
            // Loop data 5
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_5,
                    $item->cantidad_5,
                    $item->detalle_compra_5,
                    $item->c_manager_5,
                    number_format($item->valor_unitario_5),
                    number_format($item->neto_5),
                ));
            }
        }

        if ($idNew->c_manager_6 > 0) {
            // Loop data 6
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_6,
                    $item->cantidad_6,
                    $item->detalle_compra_6,
                    $item->c_manager_6,
                    number_format($item->valor_unitario_6),
                    number_format($item->neto_6),
                ));
            }
        }

        if ($idNew->c_manager_7 > 0) {
            // Loop data 7
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_7,
                    $item->cantidad_7,
                    $item->detalle_compra_7,
                    $item->c_manager_7,
                    number_format($item->valor_unitario_7),
                    number_format($item->neto_7),
                ));
            }
        }

        if ($idNew->c_manager_8 > 0) {
            // Loop data 8
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_8,
                    $item->cantidad_8,
                    $item->detalle_compra_8,
                    $item->c_manager_8,
                    number_format($item->valor_unitario_8),
                    number_format($item->neto_8),
                ));
            }
        }

        if ($idNew->c_manager_9 > 0) {
            // Loop data 9
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_9,
                    $item->cantidad_9,
                    $item->detalle_compra_9,
                    $item->c_manager_9,
                    number_format($item->valor_unitario_9),
                    number_format($item->neto_9),
                ));
            }
        }

        if ($idNew->c_manager_10 > 0) {
            // Loop data 10
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_10,
                    $item->cantidad_10,
                    $item->detalle_compra_10,
                    $item->c_manager_10,
                    number_format($item->valor_unitario_10),
                    number_format($item->neto_10),
                ));
            }
        }

        if ($idNew->c_manager_11 > 0) {
            // Loop data 11
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_11,
                    $item->cantidad_11,
                    $item->detalle_compra_11,
                    $item->c_manager_11,
                    number_format($item->valor_unitario_11),
                    number_format($item->neto_11),
                ));
            }
        }

        if ($idNew->c_manager_12 > 0) {
            // Loop data 12
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_12,
                    $item->cantidad_12,
                    $item->detalle_compra_12,
                    $item->c_manager_12,
                    number_format($item->valor_unitario_12),
                    number_format($item->neto_12),
                ));
            }
        }

        if ($idNew->c_manager_13 > 0) {
            // Loop data 13
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_13,
                    $item->cantidad_13,
                    $item->detalle_compra_13,
                    $item->c_manager_13,
                    number_format($item->valor_unitario_13),
                    number_format($item->neto_13),
                ));
            }
        }

        if ($idNew->c_manager_14 > 0) {
            // Loop data 14
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_14,
                    $item->cantidad_14,
                    $item->detalle_compra_14,
                    $item->c_manager_14,
                    number_format($item->valor_unitario_14),
                    number_format($item->neto_14),
                ));
            }
        }

        if ($idNew->c_manager_15 > 0) {
            // Loop data 15
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_15,
                    $item->cantidad_15,
                    $item->detalle_compra_15,
                    $item->c_manager_15,
                    number_format($item->valor_unitario_15),
                    number_format($item->neto_15),
                ));
            }
        }

        if ($idNew->c_manager_16 > 0) {
            // Loop data 16
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_16,
                    $item->cantidad_16,
                    $item->detalle_compra_16,
                    $item->c_manager_16,
                    number_format($item->valor_unitario_16),
                    number_format($item->neto_16),
                ));
            }
        }

        if ($idNew->c_manager_17 > 0) {
            // Loop data 17
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_17,
                    $item->cantidad_17,
                    $item->detalle_compra_17,
                    $item->c_manager_17,
                    number_format($item->valor_unitario_17),
                    number_format($item->neto_17),
                ));
            }
        }

        if ($idNew->c_manager_18 > 0) {
            // Loop data 18
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_18,
                    $item->cantidad_18,
                    $item->detalle_compra_18,
                    $item->c_manager_18,
                    number_format($item->valor_unitario_18),
                    number_format($item->neto_18),
                ));
            }
        }

        if ($idNew->c_manager_19 > 0) {
            // Loop data 19
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_19,
                    $item->cantidad_19,
                    $item->detalle_compra_19,
                    $item->c_manager_19,
                    number_format($item->valor_unitario_19),
                    number_format($item->neto_19),
                ));
            }
        }

        if ($idNew->c_manager_20 > 0) {
            // Loop data 20
            foreach ($datos as $item) {
                $pdf->Row(array(
                    $item->u_m_20,
                    $item->cantidad_20,
                    $item->detalle_compra_20,
                    $item->c_manager_20,
                    number_format($item->valor_unitario_20),
                    number_format($item->neto_20),
                ));
            }
        }

        $pdf->Ln();

        // Set width (3 columns)
        $pdf->SetWidths(array(35, 35, 35));

        // Set line height
        $pdf->SetLineHeight(5);

        // Header Table 2
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(35, 5, 'NETO', 1, 0);
        $pdf->Cell(35, 5, 'IVA', 1, 0);
        $pdf->Cell(35, 5, 'TOTAL', 1, 0);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);

        // Total
        foreach ($datos as $item) {
            $pdf->Row(array(
                $item->neto_gral,
                $item->iva_gral,
                $item->total_gral,
            ));
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('El detalle de compra antes señalado correspondería a los siguientes indicadores, programas, tipo de mantención y/o mal uso:'));
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('SISQ: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->sisq);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('        MP: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->mp);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('        MC: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->mc);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('        EQ-2.1: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->eq_2_1);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('        EQ-2.2: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->eq_2_2);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('        INS-3.1: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->ins_3_1);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('        INS-3.2: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->ins_3_2);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('        MAL USO: '));
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, $idNew->mal_uso);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('OBSERVACIONES:'));
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, $idNew->obser_pet);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Write(5, utf8_decode('DATOS REFERENCIALES'));
        $pdf->Ln();

        // Set width (3 columns)
        $pdf->SetWidths(array(50, 20, 40, 40, 40));

        // Set line height
        $pdf->SetLineHeight(5);

        // Header Table 2
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(50, 5, 'EMPRESA', 1, 0);
        $pdf->Cell(20, 5, 'GARANTIA', 1, 0);
        $pdf->Cell(40, 5, 'PLAZO DE ENTREGA', 1, 0);
        $pdf->Cell(40, 5, 'SERVICIO USUARIO', 1, 0);
        $pdf->Cell(40, 5, 'SECTOR', 1, 0);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);

        // Total
        foreach ($datos as $item) {
            $pdf->Row(array(
                $item->empresa,
                $item->garantia,
                $item->plazo_entrega,
                $item->serv_usuario,
                $item->sector,
            ));
        }

        $pdf->Ln();

        // Set width (3 columns)
        $pdf->SetWidths(array(40, 40, 30, 40, 40));

        // Set line height
        $pdf->SetLineHeight(5);

        // Header Table 2
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 5, 'REFERENTE TECNICO', 1, 0);
        $pdf->Cell(40, 5, 'CARGO REFERENTE', 1, 0);
        $pdf->Cell(30, 5, 'UNIDAD', 1, 0);
        $pdf->Cell(40, 5, 'SUBDEPTO', 1, 0);
        $pdf->Cell(40, 5, 'OBSERVACION', 1, 0);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 8);

        // Total
        foreach ($datos as $item) {
            $pdf->Row(array(
                $item->ref_tec_1,
                $item->cargo_ref_tec_1,
                $item->unidad,
                strtoupper($item->sub_depto),
                strtoupper($item->obser_pet),
            ));
        }

        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Write(5, utf8_decode('V°B° Encargado de área'));
        $pdf->Write(5, utf8_decode('                                                               y/o V°B° Jefe Serv. (Si procede)'));
        $pdf->Ln();
        $pdf->SetX(-163);
        $pdf->MultiCell(53, 0, '', 'T', 'L', false);
        $pdf->SetX(-62);
        $pdf->MultiCell(53, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('V°B° Jefe Depto. Operaciones'));
        $pdf->Ln();
        $pdf->SetX(-155);
        $pdf->MultiCell(87, 2, '', 'T', 'L', false);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetX(-62);
        $pdf->MultiCell(53, 0, '', 'T', 'L', false);
        $pdf->Write(5, utf8_decode('                                                                                                                                                                  Jefe Subdepto Mantenimiento
                                                                                                                                                                        Hospital Base Valdivia
        '));
        $pdf->Ln();
        $pdf->Write(5, utf8_decode('Autorización S.D.A.'));
        $pdf->Write(5, utf8_decode('                                                      FINANZAS'));
        $pdf->Ln();
        $pdf->SetX(-170);
        $pdf->MultiCell(45, 0, '', 'T', 'L', false);
        $pdf->SetX(-107);
        $pdf->MultiCell(40, 2, '', 'T', 'L', false);

        // Output PDF
        $pdf->Output('I', 'Formulario De Peticiones.pdf');
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION"
    ) {
        header('Location: home.php');
    }
}
