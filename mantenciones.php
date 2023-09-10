<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "MANTENCION" || $_SESSION['tipo'] === "TECNICOS") {
        include 'config/conexion.php';

        $sentencia = $bd->query("SELECT Eq.id_relacion, Eq.servicio, Eq.equipo, Eq.marca, Eq.modelo, Eq.serie, Eq.num_inventario, Eq.ano_instalacion, 
            Eq.unid_mante_hbv, Eq.referente_tecnico, Eq.id_licitacion, Mn.id_mantenciones, Mn.responsable, Mn.ubicacion, Mn.acreditacion, Mn.estado, 
            Mn.id_licitacion_convenio, Mn.programado_1, Mn.fecha_mp_1, Mn.programado_2, Mn.fecha_mp_2, Mn.programado_3, Mn.fecha_mp_3, Mn.programado_4, Mn.fecha_mp_4, 
            Mn.programado_5, Mn.fecha_mp_5, Mn.programado_6, Mn.fecha_mp_6, Mn.programado_7, Mn.fecha_mp_7, Mn.programado_8, Mn.fecha_mp_8, 
            Mn.programado_9, Mn.fecha_mp_9, Mn.programado_10, Mn.fecha_mp_10, Mn.programado_11, Mn.fecha_mp_11, Mn.programado_12, Mn.fecha_mp_12
            FROM equipamiento Eq 
            INNER JOIN mantenciones Mn ON Eq.id_relacion = Mn.id_mantenciones_relacion");

        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
    } elseif ($_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL") {
        header('Location: catastro.php');
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
    <title>Mantenciones</title>

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
                <a class="btn btn-primary" href="home.php">HOME</a>
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
                        <h5 class="modal-title" id="exampleModalLabel">Hoja de Vida</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="id_mant" class="col-form-label">ID M</label>
                                        <input type="text" style="background-color: khaki;" class="form-control" name="id_mant" id="id_mant" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="equipo" class="col-form-label">Equipo</label>
                                        <input type="text" class="form-control" name="equipo" id="equipo" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="marca" class="col-form-label">Marca</label>
                                        <input type="text" class="form-control" name="marca" id="marca" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="modelo" class="col-form-label">Modelo</label>
                                        <input type="text" class="form-control" name="modelo" id="modelo" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="serie" class="col-form-label">Serie</label>
                                        <input type="text" class="form-control" name="serie" id="serie" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="n_inventario" class="col-form-label">N° Inventario</label>
                                        <input type="text" class="form-control" name="n_inventario" id="n_inventario" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ano_insta" class="col-form-label">Año Instalación</label>
                                        <input type="text" class="form-control" name="ano_insta" id="ano_insta" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="uni_mantenimiento" class="col-form-label">Unid Mantenimiento</label>
                                        <input type="text" class="form-control" name="uni_mantenimiento" id="uni_mantenimiento" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tecnico" class="col-form-label">Ref Técnico</label>
                                        <input type="text" class="form-control" name="ref_tecnico" id="ref_tecnico" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="id_lici_compra" class="col-form-label">ID Licitación Compra</label>
                                        <input type="text" style="background-color: hotpink;" class="form-control" name="id_lici_compra" id="id_lici_compra" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="id_lici_convenio" class="col-form-label">ID Licitación Convenio</label>
                                        <input type="text" style="background-color: hotpink;" class="form-control" name="id_lici_convenio" id="id_lici_convenio" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="mp_1" class="col-form-label">Mant Programada 1</label>
                                        <input type="text" class="form-control" name="mp_1" id="mp_1" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="mp_2" class="col-form-label">Mant Programada 2</label>
                                        <input type="text" class="form-control" name="mp_2" id="mp_2" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="mp_3" class="col-form-label">Mant Programada 3</label>
                                        <input type="text" class="form-control" name="mp_3" id="mp_3" readonly>
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
                <h2 style="text-align:center; margin-top: 20px;">MANTENCIONES</h2>
            </div><br><br>

            <div class="row">
                <div class="col">
                    <a href="procesos/exportar_mantenciones.php" class="btn btn-success" style="width: 10em;">Exportar Excel</a>
                </div>
            </div><br>


            <!-- Inicio Form Import Excel -->
            <form action="files.php" method="post" enctype="multipart/form-data" id="filesForm">
                <div class="row">
                    <div class="form-group col">
                        <input type="file" name="fileContacts" accept=".csv" class="form-control">
                    </div>

                    <div class="form-group col">
                        <button type="button" onclick="uploadContacts()" class="btn btn-success">Importar Excel</button>
                    </div>
                </div>
            </form>

            <script type="text/javascript">
                function uploadContacts() {
                    var Form = new FormData($('#filesForm')[0]);
                    $.ajax({
                        url: "import_mantenciones.php",
                        type: "post",
                        data: Form,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            location.href = "mantenciones.php";
                        }
                    });
                }
            </script>

            <!-- Termino Form Import Excel -->

            <br><br>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row table-responsive-sm">
                        <table id="myTable" class="table table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID C</th>
                                    <th>ID M</th>
                                    <th>Equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th style="color: red;">Serie</th>
                                    <th style="color: red;">N Inventario</th>
                                    <th hidden>Año Instalacion</th>
                                    <th hidden>Unid Mantentenimiento</th>
                                    <th hidden>Ref Tecnico</th>
                                    <th hidden>ID Licitacion Compra</th>
                                    <th>Servicio</th>
                                    <th>Ubicacion</th>
                                    <th>Acreditacion</th>
                                    <th style="color: red;">Estado</th>
                                    <th hidden>ID Lici Convenio</th>
                                    <th>Prox MP</th>
                                    <th>Programado</th>
                                    <th>Responsable</th>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($consulta as $dato) {

                                    $fechaActual = date('m-Y');

                                    $fecha_mp_1 = date("m-Y", strtotime($dato->fecha_mp_1));
                                    $fecha_mp_2 = date("m-Y", strtotime($dato->fecha_mp_2));
                                    $fecha_mp_3 = date("m-Y", strtotime($dato->fecha_mp_3));
                                    $fecha_mp_4 = date("m-Y", strtotime($dato->fecha_mp_4));
                                    $fecha_mp_5 = date("m-Y", strtotime($dato->fecha_mp_5));
                                    $fecha_mp_6 = date("m-Y", strtotime($dato->fecha_mp_6));
                                    $fecha_mp_7 = date("m-Y", strtotime($dato->fecha_mp_7));
                                    $fecha_mp_8 = date("m-Y", strtotime($dato->fecha_mp_8));
                                    $fecha_mp_9 = date("m-Y", strtotime($dato->fecha_mp_9));
                                    $fecha_mp_10 = date("m-Y", strtotime($dato->fecha_mp_10));
                                    $fecha_mp_11 = date("m-Y", strtotime($dato->fecha_mp_11));
                                    $fecha_mp_12 = date("m-Y", strtotime($dato->fecha_mp_12));

                                ?>
                                    <tr>
                                        <td><button type="button" class="verHojaVida" data-bs-toggle="modal" data-bs-target="#verModal" style="border: 0; background-color: transparent;"><i class="fas fa-leaf fa-2x" style="color: mediumseagreen;"></i></button></td>
                                        <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_relacion; ?></td>
                                        <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->id_mantenciones; ?></td>
                                        <td><?php echo $dato->equipo; ?></td>
                                        <td><?php echo $dato->marca; ?></td>
                                        <td><?php echo $dato->modelo; ?></td>
                                        <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->serie; ?></td>
                                        <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->num_inventario; ?></td>
                                        <td hidden><?php echo $dato->ano_instalacion; ?></td>
                                        <td hidden><?php echo $dato->unid_mante_hbv; ?></td>
                                        <td hidden><?php echo $dato->referente_tecnico; ?></td>
                                        <td hidden><?php echo $dato->id_licitacion; ?></td>
                                        <td><?php echo $dato->servicio; ?></td>
                                        <td><?php echo $dato->ubicacion; ?></td>
                                        <td><?php echo $dato->acreditacion; ?></td>
                                        <td><?php echo $dato->estado; ?></td>
                                        <td hidden><?php echo $dato->id_licitacion_convenio; ?></td>

                                        <?php

                                        //! ORDEN DE FECHAS         (SEGUIR TESTEANDO CON LA FECHAS)

                                        if ($fecha_mp_1 == $fechaActual) {

                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_2 . '</td> 
                                                <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_2 . '</td>';
                                        } elseif ($fecha_mp_2 == $fechaActual) {

                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_3 . '</td> 
                                                <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_3 . '</td>';
                                        } elseif ($fecha_mp_3 == $fechaActual) {

                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_4 . '</td> 
                                                <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_4 . '</td>';
                                        } elseif ($fecha_mp_4 == $fechaActual) {
                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_5 . '</td> 
                                                <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_5 . '</td>';
                                        } elseif ($fecha_mp_5 == $fechaActual) {
                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_6 . '</td> 
                                            <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_6 . '</td>';
                                        } elseif ($fecha_mp_6 == $fechaActual) {
                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_7 . '</td> 
                                            <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_7 . '</td>';
                                        } elseif ($fecha_mp_7 == $fechaActual) {
                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_8 . '</td> 
                                            <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_8 . '</td>';
                                        } elseif ($fecha_mp_8 == $fechaActual) {
                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_9 . '</td> 
                                            <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_9 . '</td>';
                                        } elseif ($fecha_mp_9 == $fechaActual) {
                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_10 . '</td> 
                                            <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_10 . '</td>';
                                        } elseif ($fecha_mp_10 == $fechaActual) {
                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_11 . '</td> 
                                            <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_11 . '</td>';
                                        } elseif ($fecha_mp_11 == $fechaActual) {
                                            echo '<td style="background-color: rgb(247, 84, 84);">' . $dato->fecha_mp_12 . '</td> 
                                            <td style="background-color: rgb(247, 84, 84);">' . $dato->programado_12 . '</td>';
                                        } else {
                                            echo '<td>NO AFECTA</td>
                                                    <td>NO AFECTA</td>';
                                        }

                                        ?>

                                        <td><?php echo $dato->responsable; ?></td>
                                        <td><a href="vistas/modificar/modificar_mantenciones_form.php?id_mantenciones_key=<?php echo $dato->id_mantenciones; ?>&id_catastro_key=<?php echo $dato->id_relacion; ?>"><i class="fas fa-pencil-alt fa-2x" style="color: blueviolet;"></i></a></td>
                                        <td><a href="procesos/eliminar/eliminar_mantenciones.php?id_mantenciones_key=<?php echo $dato->id_mantenciones; ?>" class="btn-del"><i class="fas fa-trash-alt fa-2x" style="color: red;"></i></a></td>
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

    <!-- Copy Test -->
    <?php
    if (isset($_GET["result_copy"])) : ?>
        <div class="copyTest" data-ctest="<?= $_GET["result_copy"]; ?>"></div>
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
        $('.verHojaVida').on('click', function() {

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            });

            console.log(data);

            $('#id_mant').val(data[2]);
            $('#equipo').val(data[3]);
            $('#marca').val(data[4]);
            $('#modelo').val(data[5]);
            $('#serie').val(data[6]);
            $('#n_inventario').val(data[7]);
            $('#ano_insta').val(data[8]);
            $('#uni_mantenimiento').val(data[9]);
            $('#ref_tecnico').val(data[10]);
            $('#id_lici_compra').val(data[11]);
            $('#id_lici_convenio').val(data[16]);
        });
    </script>

    <!-- SweetAlert2 Save -->
    <script>
        const cTest = $('.copyTest').data('ctest') // data-ctest    "ctest"
        if (cTest) {
            Swal.fire({
                icon: 'error',
                title: 'Registro <?php echo $_GET["result_copy"] ?>, ya cuenta con una mantención',
                showConfirmButton: true,
                timer: 5500
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value) {
                        window.location = 'mantenciones.php';
                    }
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