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

        $sentencia = $bd->query("SELECT * FROM extintores ORDER BY id_extintor;");
        $extintores = $sentencia->fetchAll(PDO::FETCH_OBJ);
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
    <title>Extintores</title>

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
        <!-- INICIO MODAL -->
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
                                        <label for="id_extintor" class="col-form-label">ID EXT</label>
                                        <input type="text" style="background-color: khaki;" class="form-control" name="id_extintor" id="id_extintor" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_nanometro" class="col-form-label">¿El Manometro del extintor indica una presion normal de carga?</label>
                                        <input type="text" class="form-control" name="preg_nanometro" id="preg_nanometro" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_certificacion" class="col-form-label">¿El extintor esta certificado?</label>
                                        <input type="text" class="form-control" name="preg_certificacion" id="preg_certificacion" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_sello_garantia" class="col-form-label">¿El extintor de incendio, posee sello de garantia platicos, facil de retirar?</label>
                                        <input type="text" class="form-control" name="preg_sello_garantia" id="preg_sello_garantia" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_ident_cilindro" class="col-form-label">¿La etiqueta de identificacion del cilindro corresponde con el tipo del extintor: Clase A, B, C, D, K?</label>
                                        <input type="text" class="form-control" name="preg_ident_cilindro" id="preg_ident_cilindro" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_mants_vigentes" class="col-form-label">¿El agente extintor se encuentra con las mantenciones vigentes segun señala la etiqueta de fechas de carga?</label>
                                        <input type="text" class="form-control" name="preg_mants_vigentes" id="preg_mants_vigentes" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_lugar_visible" class="col-form-label">¿El extintor se encuentra en un lugar visible?</label>
                                        <input type="text" class="form-control" name="preg_lugar_visible" id="preg_lugar_visible" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_senaletica_ubic" class="col-form-label">¿El extintor cuenta con señaletica de su ubicacion?</label>
                                        <input type="text" class="form-control" name="preg_senaletica_ubic" id="preg_senaletica_ubic" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_facil_acceso" class="col-form-label">¿El equipo extintor es de facil acceso y retiro de usuarios?</label>
                                        <input type="text" class="form-control" name="preg_facil_acceso" id="preg_facil_acceso" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_altura_no_mayor" class="col-form-label">¿El extintor se encuentra en una altura no mayor de 1,30 MTS desde la base de este al suelo?</label>
                                        <input type="text" class="form-control" name="preg_altura_no_mayor" id="preg_altura_no_mayor" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_etiqueta_frontal" class="col-form-label">¿El extintor cuenta con la etiqueta frontal, con la informacion minima segun DS 44?</label>
                                        <input type="text" class="form-control" name="preg_etiqueta_frontal" id="preg_etiqueta_frontal" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_activado" class="col-form-label">¿El extintor ha sido activado o utilizado?</label>
                                        <input type="text" class="form-control" name="preg_activado" id="preg_activado" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_buena_fijacion" class="col-form-label">¿Se encuentra bien fijada la manguera o el cono del cilindro a la valvula del extintor?</label>
                                        <input type="text" class="form-control" name="preg_buena_fijacion" id="preg_buena_fijacion" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_pintura" class="col-form-label">¿La pintura del cilindro esta en buenas condiciones?</label>
                                        <input type="text" class="form-control" name="preg_pintura" id="preg_pintura" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_estado_general" class="col-form-label">¿El estado general del extintor, permite seguir utilizandolo en forma segura?</label>
                                        <input type="text" class="form-control" name="preg_estado_general" id="preg_estado_general" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_etiqueta_posterior" class="col-form-label">¿El extintor cuenta con la etiqueta posterior, con la informacion minima segun DS 44?</label>
                                        <input type="text" class="form-control" name="preg_etiqueta_posterior" id="preg_etiqueta_posterior" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="preg_etiqueta_serv_tec" class="col-form-label">¿El extintor cuenta con la etiqueta del servicio tecnico, segun DS 44?</label>
                                        <input type="text" class="form-control" name="preg_etiqueta_serv_tec" id="preg_etiqueta_serv_tec" readonly>
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
        <!-- FIN MODAL -->

        <div class="container-fluid">
            <div class="row">
                <h2 style="text-align:center; margin-top: 20px;">EXTINTORES</h2>
            </div><br><br>

            <div class="row">
                <div class="col">
                    <a href="vistas/ingreso/ingreso_extintores.php" class="btn btn-primary" style="width: 10em;">Nuevo Registro</a>
                    <a href="procesos/exportar_catastro.php" class="btn btn-success" style="width: 10em;">Exportar Excel</a>
                </div>
            </div><br>

            <!-- INICIO IMPORT EXCEL -->
            <?php

            if ($_SESSION['tipo'] === "ADMINISTRADOR") {
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
            </form>
            
            ';
            }

            ?>

            <script type="text/javascript">
                function uploadContacts() {
                    var Form = new FormData($('#filesForm')[0]);
                    $.ajax({
                        url: "import_extintores.php",
                        type: "post",
                        data: Form,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            location.href = "extintores.php";
                        }
                    });
                }
            </script><br><br>
            <!-- FIN IMPORT EXCEL -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row table-responsive-sm">
                        <table id="myTable" class="table table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID EXT</th>
                                    <th>Cod NUI</th>
                                    <th>N Inventario</th>
                                    <th>Recinto</th>
                                    <th>Edificio</th>
                                    <th>Piso</th>
                                    <th>Sala Pasillo</th>
                                    <th>Serv Usuario</th>
                                    <th>Sector</th>
                                    <th>Tipo Extintor</th>
                                    <th>KG</th>
                                    <th>Fecha Mant</th>
                                    <th>Estado</th>
                                    <th hidden>¿El Manometro del extintor indica una presion normal de carga?</th>
                                    <th hidden>¿El extintor esta certificado?</th>
                                    <th hidden>¿El extintor de incendio, posee sello de garantia platicos, facil de retirar?</th>
                                    <th hidden>¿La etiqueta de identificacion del cilindro corresponde con el tipo del extintor: Clase A, B, C, D, K?</th>
                                    <th hidden>¿El agente extintor se encuentra con las mantenciones vigentes segun señala la etiqueta de fechas de carga?</th>
                                    <th hidden>¿El extintor se encuentra en un lugar visible?</th>
                                    <th hidden>¿El extintor cuenta con señaletica de su ubicacion?</th>
                                    <th hidden>¿El equipo extintor es de facil acceso y retiro de usuarios?</th>
                                    <th hidden>¿El extintor se encuentra en una altura no mayor de 1,30 MTS desde la base de este al suelo?</th>
                                    <th hidden>¿El extintor cuenta con la etiqueta frontal, con la informacion minima segun DS 44?</th>
                                    <th hidden>¿El extintor ha sido activado o utilizado?</th>
                                    <th hidden>¿Se encuentra bien fijada la manguera o el cono del cilindro a la valvula del extintor?</th>
                                    <th hidden>¿La pintura del cilindro esta en buenas condiciones?</th>
                                    <th hidden>¿El estado general del extintor, permite seguir utilizandolo en forma segura?</th>
                                    <th hidden>¿El extintor cuenta con la etiqueta posterior, con la informacion minima segun DS 44?</th>
                                    <th hidden>¿El extintor cuenta con la etiqueta del servicio tecnico, segun DS 44?</th>
                                    <th style="color: red;">Plano de Ubicacion</th>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($extintores as $dato) {
                                    $fecha_mantencion_F = date("m-Y", strtotime($dato->fecha_mantencion)); ?>
                                    <tr>
                                        <td><button type="button" class="verExtintores" data-bs-toggle="modal" data-bs-target="#verModal" style="border: 0; background-color: transparent;"><i class="far fa-eye fa-2x" style="color: darkred;"></i></button></td>
                                        <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_extintor; ?></td>
                                        <td><?php echo $dato->cod_nui; ?></td>
                                        <td><?php echo $dato->n_inventario; ?></td>
                                        <td><?php echo $dato->recinto; ?></td>
                                        <td><?php echo $dato->edificio; ?></td>
                                        <td><?php echo $dato->piso; ?></td>
                                        <td><?php echo $dato->sala_pasillo; ?></td>
                                        <td><?php echo $dato->servicio_usuario; ?></td>
                                        <td><?php echo $dato->sector; ?></td>
                                        <td><?php echo $dato->tipo_extintor; ?></td>
                                        <td><?php echo $dato->kg; ?></td>
                                        <td><?php if ($dato->fecha_mantencion === "0000-00-00" || $dato->fecha_mantencion === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $fecha_mantencion_F;
                                            }; ?></td>
                                        <td><?php echo $dato->estado; ?></td>
                                        <td hidden><?php echo $dato->preg_nanometro; ?></td>
                                        <td hidden><?php echo $dato->preg_certificacion; ?></td>
                                        <td hidden><?php echo $dato->preg_sello_garantia; ?></td>
                                        <td hidden><?php echo $dato->preg_ident_cilindro; ?></td>
                                        <td hidden><?php echo $dato->preg_mants_vigentes; ?></td>
                                        <td hidden><?php echo $dato->preg_lugar_visible; ?></td>
                                        <td hidden><?php echo $dato->preg_senaletica_ubic; ?></td>
                                        <td hidden><?php echo $dato->preg_facil_acceso; ?></td>
                                        <td hidden><?php echo $dato->preg_altura_no_mayor; ?></td>
                                        <td hidden><?php echo $dato->preg_etiqueta_frontal; ?></td>
                                        <td hidden><?php echo $dato->preg_activado; ?></td>
                                        <td hidden><?php echo $dato->preg_buena_fijacion; ?></td>
                                        <td hidden><?php echo $dato->preg_pintura; ?></td>
                                        <td hidden><?php echo $dato->preg_estado_general; ?></td>
                                        <td hidden><?php echo $dato->preg_etiqueta_posterior; ?></td>
                                        <td hidden><?php echo $dato->preg_etiqueta_serv_tec; ?></td>
                                        <td>EN PROCESO DE CREACION</td>
                                        <td><a href="vistas/modificar/modificar_extintores_form.php?id_relacion_key=<?php echo $dato->id_extintor; ?>"><i class="fas fa-pencil-alt fa-2x" style="color: blueviolet;"></i></a></td>
                                        <td><a href="procesos/eliminar/eliminar_extintores.php?id_relacion_key=<?php echo $dato->id_extintor; ?>" class="btn-del"><i class="fas fa-trash-alt fa-2x" style="color: red;"></i></a></td>
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
        $('.verExtintores').on('click', function() {

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            });

            console.log(data);

            $('#id_extintor').val(data[1]);
            $('#preg_nanometro').val(data[14]);
            $('#preg_certificacion').val(data[15]);
            $('#preg_sello_garantia').val(data[16]);
            $('#preg_ident_cilindro').val(data[17]);
            $('#preg_mants_vigentes').val(data[18]);
            $('#preg_lugar_visible').val(data[19]);
            $('#preg_senaletica_ubic').val(data[20]);
            $('#preg_facil_acceso').val(data[21]);
            $('#preg_altura_no_mayor').val(data[22]);
            $('#preg_etiqueta_frontal').val(data[23]);
            $('#preg_activado').val(data[24]);
            $('#preg_buena_fijacion').val(data[25]);
            $('#preg_pintura').val(data[26]);
            $('#preg_estado_general').val(data[27]);
            $('#preg_etiqueta_posterior').val(data[28]);
            $('#preg_etiqueta_serv_tec').val(data[29]);
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