<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        include 'config/conexion.php';

        $sentencia = $bd->query("SELECT * FROM equipamiento ORDER BY id_relacion;");
        $equipamiento = $sentencia->fetchAll(PDO::FETCH_OBJ);
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
    <title>Catastro</title>

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
                <a class="btn btn-primary" href="home_catastro.php">HOME</a>
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
                                        <label for="id_catastro" class="col-form-label">ID</label>
                                        <input type="text" style="background-color: khaki;" class="form-control" name="id_catastro" id="id_catastro" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="eq_inst" class="col-form-label">EQ/INST</label>
                                        <input type="text" class="form-control" name="eq_inst" id="eq_inst" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="clase" class="col-form-label">Clase</label>
                                        <input type="text" class="form-control" name="clase" id="clase" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="subclase" class="col-form-label">SubClase</label>
                                        <input type="text" class="form-control" name="subclase" id="subclase" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ley_ppto" class="col-form-label">Ley PPTO</label>
                                        <input type="text" class="form-control" name="ley_ppto" id="ley_ppto" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="valor" class="col-form-label">Valor</label>
                                        <input type="text" class="form-control" name="valor" id="valor" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="vida_util" class="col-form-label">Vida Util</label>
                                        <input type="text" class="form-control" name="vida_util" id="vida_util" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="vida_util_resi" class="col-form-label">Vida Util Residual</label>
                                        <input type="text" class="form-control" name="vida_util_resi" id="vida_util_resi" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="prog_manten" class="col-form-label">Prog Manten</label>
                                        <input type="text" class="form-control" name="prog_manten" id="prog_manten" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tecnico" class="col-form-label">Ref Tecnico</label>
                                        <input type="text" class="form-control" name="ref_tecnico" id="ref_tecnico" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="periodicidad_mp" class="col-form-label">Periodicidad MP</label>
                                        <input type="text" class="form-control" name="periodicidad_mp" id="periodicidad_mp" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="id_licitacion" class="col-form-label">ID Licitacion</label>
                                        <input type="text" class="form-control" name="id_licitacion" id="id_licitacion" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="empresa" class="col-form-label">Empresa</label>
                                        <input type="text" class="form-control" name="empresa" id="empresa" readonly>
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
                <h2 style="text-align:center; margin-top: 20px;">CATASTRO EQUIPAMIENTO</h2>
            </div><br><br>

            <div class="row">
                <div class="col">
                    <a href="vistas/ingreso/ingreso_catastro.php" class="btn btn-primary" style="width: 10em;">Nuevo Registro</a>
                    <a href="procesos/exportar/exportar_catastro.php" class="btn btn-success" style="width: 10em;">Exportar Excel</a>
                </div>
            </div><br>

            <!-- Inicio Form Import Excel -->
            <?php

            if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS") {
                echo '
            
            <form action="files.php" method="post" enctype="multipart/form-data" id="filesForm">
                <div class="row">
                    <div class="form-group col">
                        <input type="file" name="fileContacts" accept=".csv" class="form-control">
                    </div>

                    <div class="form-group col">
                        <button type="button" onclick="uploadContacts()" class="btn btn-success">Importar Excel</button>
                    </div>
                </div>
            </form><br><br>
            
            ';
            }

            ?>

            <script type="text/javascript">
                function uploadContacts() {
                    var Form = new FormData($('#filesForm')[0]);
                    $.ajax({
                        url: "import_catastro.php",
                        type: "post",
                        data: Form,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            location.href = "catastro.php";
                        }
                    });
                }
            </script>
            <!-- Termino Form Import Excel -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="row table-responsive-sm">
                        <table id="myTable" class="table table-bordered nowrap" style="width: 100%">
                            <!-- id="myTable" active datatables -->
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>#</th>
                                    <th>#</th>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th hidden>Eq/Inst</th>
                                    <th>Servicio</th>
                                    <th>Sector</th>
                                    <th hidden>Clase</th>
                                    <th hidden>SubClase</th>
                                    <th hidden>Def Ley Ppto</th>
                                    <th>Equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th style="color: blue;">Serie</th>
                                    <th hidden>Valor</th>
                                    <th style="color: blue;">N Inventario</th>
                                    <th>Año Instalacion</th>
                                    <th hidden>Vida Util</th>
                                    <th hidden>Vida Residual</th>
                                    <th>V.U.R Estand</th>
                                    <th>Estado</th>
                                    <th>Propiedad</th>
                                    <th hidden>Prog Mmto</th>
                                    <th>Acreditacion</th>
                                    <th>Uni.Mmto</th>
                                    <th hidden>Reft Tecnico</th>
                                    <th hidden>Periodicidad MP</th>
                                    <th hidden>ID Licitacion</th>
                                    <th>Inicio Gtia</th>
                                    <th>Termino Gtia</th>
                                    <th hidden>Empresa</th>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($equipamiento as $dato) {
                                    $inicio_garantia_F = date("d-m-Y", strtotime($dato->inicio_garantia));
                                    $termino_garantia_F = date("d-m-Y", strtotime($dato->termino_garantia)); ?>
                                    <tr>
                                        <td><button type="button" class="verCatastro" data-bs-toggle="modal" data-bs-target="#verModal" style="border: 0; background-color: transparent;"><i class="far fa-eye fa-2x" style="color: darkred;"></i></button></td>
                                        <td><a href="vistas/ingreso/ingreso_recepcion.php?id_relacion_key=<?php echo $dato->id_relacion; ?>"><i class="fas fa-concierge-bell fa-2x" style="color: red;"></i></i></a></td>
                                        <td><a href="vistas/ingreso/ingreso_control_convenio.php?id_relacion_key=<?php echo $dato->id_relacion; ?>"><i class="fas fa-handshake fa-2x"></a></td>
                                        <td><a href="vistas/ingreso/ingreso_mantenciones.php?id_relacion_key=<?php echo $dato->id_relacion; ?>"><i class="fas fa-tools fa-2x" style="color: purple;"></i></a></td>
                                        <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_relacion; ?></td>
                                        <td hidden><?php echo $dato->equipos_instalaciones; ?></td>
                                        <td><?php echo $dato->servicio; ?></td>
                                        <td><?php echo $dato->sector; ?></td>
                                        <td hidden><?php echo $dato->clase; ?></td>
                                        <td hidden><?php echo $dato->subclase; ?></td>
                                        <td hidden><?php echo $dato->def_ley_presupuesto; ?></td>
                                        <td><?php echo $dato->equipo; ?></td>
                                        <td><?php echo $dato->marca; ?></td>
                                        <td><?php echo $dato->modelo; ?></td>
                                        <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->serie; ?></td>
                                        <td hidden><?php echo number_format($dato->valor); ?></td> <!-- FORMAT NUM -->
                                        <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->num_inventario; ?></td>
                                        <td><?php echo $dato->ano_instalacion; ?></td>
                                        <td hidden><?php echo $dato->vida_util; ?></td>
                                        <td hidden><?php echo $dato->vida_util_residual; ?></td>
                                        <td><?php echo $dato->vida_ur_estandarizada; ?></td>
                                        <td><?php echo $dato->estado_conservacion; ?></td>
                                        <td><?php echo $dato->propiedad; ?></td>
                                        <td hidden><?php echo $dato->progr_mantenimiento; ?></td>
                                        <td><?php echo $dato->caracteristica_acredi; ?></td>
                                        <td><?php echo $dato->unid_mante_hbv; ?></td>
                                        <td hidden><?php echo $dato->referente_tecnico; ?></td>
                                        <td hidden><?php echo $dato->periodicidad_mp; ?></td>
                                        <td hidden><?php echo $dato->id_licitacion; ?></td>
                                        <td><?php if ($dato->inicio_garantia === "0000-00-00" || $dato->inicio_garantia === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $inicio_garantia_F;
                                            }; ?></td>
                                        <td><?php if ($dato->termino_garantia === "0000-00-00" || $dato->termino_garantia === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $termino_garantia_F;
                                            }; ?></td>
                                        <td hidden><?php echo $dato->empresa; ?></td>


                                        <td><a href="vistas/modificar/modificar_catastro_form.php?id_relacion_key=<?php echo $dato->id_relacion; ?>"><i class="fas fa-pencil-alt fa-2x" style="color: blueviolet;"></i></a></td>
                                        <td><a href="procesos/eliminar/eliminar_catastro.php?id_relacion_key=<?php echo $dato->id_relacion; ?>" class="btn-del"><i class="fas fa-trash-alt fa-2x" style="color: red;"></i></a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Save -->
    <?php
    if (isset($_GET["catastro_guardar"])) : ?>
        <div id="guardarCatastro" data-guardar="<?= $_GET["catastro_guardar"]; ?>"></div>
    <?php endif; ?>

    <!-- Eliminar Datos -->
    <?php
    if (isset($_GET["url_eliminar"])) : ?>
        <div class="eliminar-data" data-eliminar="<?= $_GET["url_eliminar"]; ?>"></div>
    <?php endif; ?>

    <!-- Delete Test -->
    <?php
    if (isset($_GET["result_delete"])) : ?>
        <div class="deleteTest" data-dtest="<?= $_GET["result_delete"]; ?>"></div>
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

            $('#id_catastro').val(data[4]);
            $('#eq_inst').val(data[5]);
            $('#clase').val(data[8]);
            $('#subclase').val(data[9]);
            $('#ley_ppto').val(data[10]);
            $('#valor').val(data[16]);
            $('#vida_util').val(data[19]);
            $('#vida_util_resi').val(data[20]);
            $('#prog_manten').val(data[24]);
            $('#ref_tecnico').val(data[27]);
            $('#periodicidad_mp').val(data[28]);
            $('#id_licitacion').val(data[29]);
            $('#empresa').val(data[32]);
        });
    </script>

    <!-- SweetAlert2 Save -->
    <script>
        const guardar = $('#guardarCatastro').data('guardar')
        if (guardar) {
            Swal.fire({
                icon: 'success',
                title: 'Registro guardado',
                showConfirmButton: true,
                timer: 3500
            }).then((result) => {
                if (result.value) {
                    window.location = 'catastro.php';
                }
            })
        }
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
                    // Eliminar esta linea de codigo, produce error al borrar los registros
                    // window.location = 'catastro.php';
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

        // eliminarCatastro id
        const eliminar = $('.eliminar-data').data('eliminar')
        if (eliminar) {
            Swal.fire({
                type: 'success',
                title: "Eliminado!",
                text: 'Su registro fue eliminado.'
            })
        }
    </script>

    <!-- SweetAlert2 Copy Delete -->
    <script>
        const dtest = $('.deleteTest').data('dtest') // data-dtest    "dtest"
        if (dtest) {
            Swal.fire({
                icon: 'error',
                title: 'Registro <?php echo $_GET["result_delete"] ?>, tiene una relación',
                showConfirmButton: true,
                timer: 5500
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value) {
                        window.location = 'catastro.php';
                    }
                }
            })
        }
    </script>
</body>

</html>