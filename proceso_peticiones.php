<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] == "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        include 'config/conexion.php';

        $sentencia = $bd->query("SELECT * FROM proceso_peticiones ORDER BY id_peticiones;");
        $convenios = $sentencia->fetchAll(PDO::FETCH_OBJ);
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
    <title>Proceso Peticiones</title>

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

        <!-- MODAL -->
        <div class="modal fade" id="verModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="id_convenio" class="col-form-label">ID</label>
                                        <input type="text" style="background-color: khaki;" class="form-control" name="id_convenio" id="id_convenio" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ordinario" class="col-form-label">Ordinario</label>
                                        <input type="text" class="form-control" name="ordinario" id="ordinario" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_ordinario" class="col-form-label">Fecha Ordinario</label>
                                        <input type="text" class="form-control" name="fecha_ordinario" id="fecha_ordinario" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="resolu_base_tec" class="col-form-label">Reso Base Tec</label>
                                        <input type="number" min="0" class="form-control" name="resolu_base_tec" id="resolu_base_tec" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_base_tec" class="col-form-label">Fecha RBT</label>
                                        <input type="text" class="form-control" name="fecha_base_tec" id="fecha_base_tec" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="resolu_adjudicacion" class="col-form-label">Reso Adjudicación</label>
                                        <input type="number" min="0" class="form-control" name="resolu_adjudicacion" id="resolu_adjudicacion" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_resolu_adjudi" class="col-form-label">Fecha Reso Adjudi</label>
                                        <input type="text" class="form-control" name="fecha_resolu_adjudi" id="fecha_resolu_adjudi" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="resolu_contrato" class="col-form-label">Reso_Contrato</label>
                                        <input type="number" min="0" class="form-control" name="resolu_contrato" id="resolu_contrato" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_resolu_contra" class="col-form-label">Fecha Reso Contrato</label>
                                        <input type="text" class="form-control" name="fecha_resolu_contra" id="fecha_resolu_contra" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_1" class="col-form-label">Ref Técnico 1</label>
                                        <input type="text" class="form-control" name="ref_tec_1" id="ref_tec_1" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_2" class="col-form-label">Ref Técnico 2</label>
                                        <input type="text" class="form-control" name="ref_tec_2" id="ref_tec_2" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_3" class="col-form-label">Ref Técnico 3</label>
                                        <input type="text" class="form-control" name="ref_tec_3" id="ref_tec_3" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_4" class="col-form-label">Ref Técnico 4</label>
                                        <input type="text" class="form-control" name="ref_tec_4" id="ref_tec_4" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="item" class="col-form-label">Ítem</label>
                                        <input type="text" class="form-control" name="item" id="item" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="acreditacion" class="col-form-label">Acreditación</label>
                                        <input type="text" class="form-control" name="acreditacion" id="acreditacion" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="boleta_garanti" class="col-form-label">Boleta Garantía</label>
                                        <input type="number" min="0" class="form-control" name="boleta_garanti" id="boleta_garanti" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="venci_b_gatanti" class="col-form-label">Vencimiento B.Garantía</label>
                                        <input type="text" class="form-control" name="venci_b_gatanti" id="venci_b_gatanti" readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL -->


        <div class="container-fluid">
            <div class="row">
                <h2 style="text-align:center; margin-top: 20px;">PROCESO PETICIONES</h2>
            </div><br><br>

            <div class="row">
                <div class="col">
                    <a href="vistas/ingreso/ingreso_proce_peticiones.php" class="btn btn-primary" style="width: 10em;">Nuevo Registro</a>
                </div>
            </div><br><br>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row table-responsive-sm">
                        <table id="myTable" class="table table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
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
                                    <th>Obsr Recep</th>
                                    <th>Verificable</th>
                                    <th>Fecha Fac</th>
                                    <th>Num Fac</th>
                                    <th>Num Acta</th>
                                    <th>Fecha Acta</th>
                                    <th>Folio Core</th>
                                    <th>Fecha Folio</th>
                                    <th>Estado</th>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($convenios as $dato) { ?>
                                    <tr>
                                        <td><button type="button" class="verCatastro" data-bs-toggle="modal" data-bs-target="#verModal" style="border: 0; background-color: transparent;"><i class="far fa-eye fa-2x" style="color: darkred;"></i></button></td>
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
                                        <td><a href="vistas/modificar/modificar_proce_peticiones_form.php?id_proceso_peti_key=<?php echo $dato->id_peticiones; ?>"><i class="fas fa-pencil-alt fa-2x" style="color: blueviolet;"></i></a></td>
                                        <td><a href="procesos/eliminar/eliminar_proce_peticiones.php?id_proceso_peti_key=<?php echo $dato->id_peticiones; ?>" class="btn-del"><i class="fas fa-trash-alt fa-2x" style="color: red;"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Eliminar Datos -->
    <?php
    if (isset($_GET["url_eliminar"])) : ?>
        <div class="eliminar-data" data-eliminar="<?= $_GET["url_eliminar"]; ?>"></div>
    <?php endif; ?>

    <!-- Jquery and Bootstrap-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- DataTables JS-->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <!-- SweetAlert2 CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- MODAL ACTIVATION -->
    <script>
        $('.verCatastro').on('click', function() {

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            });

            console.log(data);

            $('#id_convenio').val(data[1]);
            $('#ordinario').val(data[5]);
            $('#fecha_ordinario').val(data[6]);
            $('#resolu_base_tec').val(data[7]);
            $('#fecha_base_tec').val(data[8]);
            $('#resolu_adjudicacion').val(data[9]);
            $('#fecha_resolu_adjudi').val(data[10]);
            $('#resolu_contrato').val(data[11]);
            $('#fecha_resolu_contra').val(data[12]);
            $('#ref_tec_1').val(data[23]);
            $('#ref_tec_2').val(data[24]);
            $('#ref_tec_3').val(data[25]);
            $('#ref_tec_4').val(data[26]);
            $('#item').val(data[27]);
            $('#acreditacion').val(data[28]);
            $('#boleta_garanti').val(data[29]);
            $('#venci_b_gatanti').val(data[30]);
        });
    </script>

    <!-- SweetAlert2 Eliminar -->
    <script>
        $('.btn-del').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')

            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminalo!',
                cancelButtonText: 'No, cancela!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
        })

        $('#btn').on('click', function() {
            Swal.fire({
                type: 'success',
                title: "Success",
                text: 'Your Text'
            })
        })

        const eliminar = $('.eliminar-data').data('eliminar')
        if (eliminar) {
            Swal.fire({
                type: 'success',
                title: "Eliminado!",
                text: 'Su registro fue eliminado.'
            })
        }
    </script>
</body>

</html>