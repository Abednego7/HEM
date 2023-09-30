<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL" ||
        $_SESSION['tipo'] === "TECNICOS"
    ) {
        include 'config/conexion.php';

        $sentencia = $bd->query("SELECT * FROM proceso_peticiones ORDER BY id_peticiones;");
        $convenios = $sentencia->fetchAll(PDO::FETCH_OBJ);
    } elseif ($_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION") {
        header('Location: proceso_administrativo.php');
    }
} else {
    echo "Error de Sistema";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">

    <!-- DataTables JS-->
    <link rel="stylesheet" href="datatables/datatables.min.css">
    <link rel="stylesheet" href="datatables/DataTables-1.10.25/css/dataTables.bootstrap5.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <title>Proceso Administrativo</title>

    <style>
        #myTable td {
            font-size: 0.80em;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="btn btn-primary" href="home_proceso_peticiones.php">HOME</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- -->
                    </ul>
                    <form class="d-flex">
                        <a href="procesos/cerrar_sesion.php" class="btn btn-outline-success">Cerrar Sesión</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <h2 style="text-align:center; margin-top: 20px;">PROCESO ADMINISTRATIVO</h2>
            </div><br><br>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row table-responsive-sm">
                        <table id="myTable" class="table table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>P</th>
                                    <th>M.S.C</th>
                                    <th>R.T</th>
                                    <th>#</th>
                                    <th style="color: red;">ID</th>
                                    <th>Ordinario</th>
                                    <th>Fecha Ordinario</th>
                                    <th>Soli Compra</th>
                                    <th>Fecha Soli Compra</th>
                                    <th>Referencia</th>
                                    <th>Fecha Referencia</th>
                                    <th>Exigencia</th>
                                    <th>Acreditacion</th>
                                    <th>Categoria</th>
                                    <th>COVID</th>
                                    <th>Sub Depto</th>
                                    <th>Unidad</th>
                                    <th>Ref Tec 1</th>
                                    <th>Cargo Ref Tec 1</th>
                                    <th>Ref Tec 2</th>
                                    <th>Cargo Ref Tec 2</th>
                                    <th>Serv Usuario</th>
                                    <th>Sector</th>
                                    <th>Tipo Peticion</th>
                                    <th>Decrip Solici</th>
                                    <th>Obser Pet</th>
                                    <th>Orden Trabj</th>
                                    <th>Tipo Compra</th>
                                    <th>Doc Adjunta</th>
                                    <th>ID Contra Conexo</th>
                                    <th>Plazo Entrega</th>
                                    <th>SISQ</th>
                                    <th>MP</th>
                                    <th>MC</th>
                                    <th>EQ-2.1</th>
                                    <th>EQ-2.2</th>
                                    <th>INS-3.1</th>
                                    <th>INS-3.2</th>
                                    <th>Mal Uso</th>
                                    <th>Neto Gral</th>
                                    <th>IVA Gral</th>
                                    <th>Total Gral</th>
                                    <th>RUT</th>
                                    <th>Empresa</th>
                                    <th>OC</th>
                                    <th>Fecha OC</th>
                                    <th>Monto OC</th>
                                    <th>Resolu Base Tec</th>
                                    <th>Fecha RBT</th>
                                    <th>Resolu Adjudi</th>
                                    <th>Fecha Reso Adj</th>
                                    <th>ID Licitacion</th>
                                    <th>Resolu Contrato</th>
                                    <th>Fecha Resol Contra</th>
                                    <th>Item PPTO Solic</th>
                                    <th>Diferencia</th>
                                    <th>Notas</th>
                                    <th>Fecha Recep</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Termino</th>
                                    <th>Fecha Inc GT Tec</th>
                                    <th>Fecha Term GT Tec</th>
                                    <th>Dias de Mora</th>
                                    <th>Procede Multa</th>
                                    <th>Obsr Recep</th>
                                    <th>Verificable</th>
                                    <th>Fecha Fac</th>
                                    <th>Num Fac</th>
                                    <th>Num Acta</th>
                                    <th>Fecha Acta</th>
                                    <th>Folio Core</th>
                                    <th>Fecha Folio</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($convenios as $dato) { ?>
                                    <tr>
                                        <td><a href="pdf_peticiones.php?pdfId=<?php echo $dato->id_peticiones; ?>"><i class="fas fa-file-pdf fa-2x" style="color: #6533FF;"></i></a></td>
                                        <td><a href="pdf_peti_sol_compra.php?pdfId=<?php echo $dato->id_peticiones; ?>"><i class="fas fa-file-pdf fa-2x" style="color: #E74C3C;"></i></a></td>
                                        <td><a href="pdf_vali_fac.php?pdfId=<?php echo $dato->id_peticiones; ?>"><i class="fas fa-file-pdf fa-2x" style="color: #117A65;"></i></a></td>
                                        <td>
                                            <?php

                                            if ($dato->ordinario === null || $dato->ordinario === 0) {
                                                echo '<a href="vistas/modificar/modificar_proce_admin_form.php?id_proceso_peti_key=' . $dato->id_peticiones . '"><i class="fas fa-user-cog fa-2x" style="color: firebrick;"></i></a>';
                                            } else {
                                                echo '<a href="vistas/modificar/modificar_proce_admin_form.php?id_proceso_peti_key=' . $dato->id_peticiones . '"><i class="fas fa-user-cog fa-2x" style="color: darkslategray;"></i></a>';
                                            }

                                            ?>
                                        </td>
                                        <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_peticiones; ?></td>
                                        <td><?php echo $dato->ordinario; ?></td>
                                        <td><?php if ($dato->fecha_ordinario === "0000-00-00" || $dato->fecha_ordinario === "00-00-0000" || $dato->fecha_ordinario === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_ordinario;;
                                            }; ?></td>
                                        <td><?php echo $dato->solici_de_compra; ?></td>
                                        <td><?php if ($dato->fecha_soli_compra === "0000-00-00" || $dato->fecha_soli_compra === "00-00-0000" || $dato->fecha_soli_compra === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_soli_compra;;
                                            }; ?></td>
                                        <td><?php echo $dato->referencia; ?></td>
                                        <td><?php if ($dato->fecha_referencia === "0000-00-00" || $dato->fecha_referencia === "00-00-0000" || $dato->fecha_referencia === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_referencia;;
                                            }; ?></td>
                                        <td><?php echo $dato->exigencia; ?></td>
                                        <td><?php echo $dato->acreditacion; ?></td>
                                        <td><?php echo $dato->categoria; ?></td>
                                        <td><?php echo $dato->covid; ?></td>
                                        <td><?php echo $dato->sub_depto; ?></td>
                                        <td><?php echo $dato->unidad; ?></td>
                                        <td><?php echo $dato->ref_tec_1; ?></td>
                                        <td><?php echo $dato->cargo_ref_tec_1; ?></td>
                                        <td><?php echo $dato->ref_tec_2; ?></td>
                                        <td><?php echo $dato->cargo_ref_tec_2; ?></td>
                                        <td><?php echo $dato->serv_usuario; ?></td>
                                        <td><?php echo $dato->sector; ?></td>
                                        <td><?php echo $dato->tipo_peticion; ?></td>
                                        <td><?php echo $dato->descr_solicitud; ?></td>
                                        <td><?php echo $dato->obser_pet; ?></td>
                                        <td><?php echo $dato->orden_trabajo; ?></td>
                                        <td><?php echo $dato->tipo_compra; ?></td>
                                        <td><?php echo $dato->doc_adjunta; ?></td>
                                        <td><?php echo $dato->id_contrato_conexo; ?></td>
                                        <td><?php echo $dato->plazo_entrega; ?></td>
                                        <td><?php echo $dato->sisq; ?></td>
                                        <td><?php echo $dato->mp; ?></td>
                                        <td><?php echo $dato->mc; ?></td>
                                        <td><?php echo $dato->eq_2_1; ?></td>
                                        <td><?php echo $dato->eq_2_2; ?></td>
                                        <td><?php echo $dato->ins_3_1; ?></td>
                                        <td><?php echo $dato->ins_3_2; ?></td>
                                        <td><?php echo $dato->mal_uso; ?></td>
                                        <td><?php echo $dato->neto_gral; ?></td>
                                        <td><?php echo $dato->iva_gral; ?></td>
                                        <td><?php echo $dato->total_gral; ?></td>
                                        <td><?php echo $dato->rut; ?></td>
                                        <td><?php echo $dato->empresa; ?></td>
                                        <td><?php echo $dato->orden_compra; ?></td>
                                        <td><?php if ($dato->fecha_oc === "0000-00-00" || $dato->fecha_oc === "00-00-0000" || $dato->fecha_oc === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_oc;;
                                            }; ?></td>
                                        <td><?php echo $dato->monto_oc; ?></td>
                                        <td><?php echo $dato->resolu_base_tec; ?></td>
                                        <td><?php if ($dato->fecha_base_tec === "0000-00-00" || $dato->fecha_base_tec === "00-00-0000" || $dato->fecha_base_tec === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_base_tec;;
                                            }; ?></td>
                                        <td><?php echo $dato->resolu_adjudi; ?></td>
                                        <td><?php if ($dato->fecha_resolu_adjudi === "0000-00-00" || $dato->fecha_resolu_adjudi === "00-00-0000" || $dato->fecha_resolu_adjudi === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_resolu_adjudi;;
                                            }; ?></td>
                                        <td><?php echo $dato->id_licitacion; ?></td>
                                        <td><?php echo $dato->resolu_contrato; ?></td>
                                        <td><?php if ($dato->fecha_resolu_contra === "0000-00-00" || $dato->fecha_resolu_contra === "00-00-0000" || $dato->fecha_resolu_contra === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_resolu_contra;;
                                            }; ?></td>
                                        <td><?php echo $dato->item_ppto_solicitado; ?></td>
                                        <td><?php echo $dato->diferencia_peti; ?></td>
                                        <td><?php echo $dato->notas; ?></td>
                                        <td><?php if ($dato->fecha_recep === "0000-00-00" || $dato->fecha_recep === "00-00-0000" || $dato->fecha_recep === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_recep;;
                                            }; ?></td>
                                        <td><?php if ($dato->fecha_inicio === "0000-00-00" || $dato->fecha_inicio === "00-00-0000" || $dato->fecha_inicio === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_inicio;;
                                            }; ?></td>
                                        <td><?php if ($dato->fecha_termino === "0000-00-00" || $dato->fecha_termino === "00-00-0000" || $dato->fecha_termino === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_termino;;
                                            }; ?></td>
                                        <td><?php if ($dato->fecha_inic_gt_tec === "0000-00-00" || $dato->fecha_inic_gt_tec === "00-00-0000" || $dato->fecha_inic_gt_tec === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_inic_gt_tec;;
                                            }; ?></td>
                                        <td><?php if ($dato->fecha_term_gt_tec === "0000-00-00" || $dato->fecha_term_gt_tec === "00-00-0000" || $dato->fecha_term_gt_tec === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_term_gt_tec;;
                                            }; ?></td>
                                        <td><?php echo $dato->dias_de_mora; ?></td>
                                        <td><?php echo $dato->procede_multa; ?></td>
                                        <td><?php echo $dato->obser_recepcion; ?></td>
                                        <td><?php echo $dato->verificable; ?></td>
                                        <td><?php if ($dato->fecha_fac === "0000-00-00" || $dato->fecha_fac === "00-00-0000" || $dato->fecha_fac === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_fac;;
                                            }; ?></td>
                                        <td><?php echo $dato->n_factura; ?></td>
                                        <td><?php echo $dato->n_acta; ?></td>
                                        <td><?php if ($dato->fecha_acta === "0000-00-00" || $dato->fecha_acta === "00-00-0000" || $dato->fecha_acta === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_acta;;
                                            }; ?></td>
                                        <td><?php echo $dato->folio_core; ?></td>
                                        <td><?php if ($dato->fecha_folio === "0000-00-00" || $dato->fecha_folio === "00-00-0000" || $dato->fecha_folio === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $dato->fecha_folio;;
                                            }; ?></td>
                                        <td><?php echo $dato->estado_peti; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- DataTables JS-->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>