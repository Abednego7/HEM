<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        include 'config/conexion.php';

        $sentencia = $bd->query("SELECT * FROM rrhh ORDER BY id_rrhh;");
        $equipamiento = $sentencia->fetchAll(PDO::FETCH_OBJ);
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS"
    ) {
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
    <title>RRHH</title>

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
        <div class="container-fluid">
            <div class="row">
                <h2 style="text-align:center; margin-top: 20px;">RECURSOS HUMANOS</h2>
            </div><br><br>

            <div class="row">
                <div class="col">
                    <a href="vistas/ingreso/ingreso_rrhh.php" class="btn btn-primary" style="width: 10em;">Nuevo Registro</a>
                    <a href="procesos/exportar/exportar_rrhh.php" class="btn btn-success" style="width: 10em;">Exportar Excel</a>
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
                        url: "import_rrhh.php",
                        type: "post",
                        data: Form,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            location.href = "rrhh.php";
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
                                    <th>ID</th>
                                    <th>Depto y/o Subdepto</th>
                                    <th>Uni Especifica</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>RUT</th>
                                    <th>Calidad</th>
                                    <th>Escalafon</th>
                                    <th>Grado</th>
                                    <th>Estudio o Titulo</th>
                                    <th>Tipo de Contrato</th>
                                    <th>Año Ingreso</th>
                                    <th>Correo</th>
                                    <th>Domicilio</th>
                                    <th>Fono</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Edad</th>
                                    <th>Enfermedad Cronica</th>
                                    <th>Estado Civil</th>
                                    <th>#</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($equipamiento as $dato) {
                                    $fecha_nacimiento_F = date("d-m-Y", strtotime($dato->fecha_nacimiento)); ?>
                                    <tr>
                                        <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_rrhh; ?></td>
                                        <td><?php echo $dato->dep_subdepto; ?></td>
                                        <td><?php echo $dato->unid_especifica; ?></td>
                                        <td><?php echo $dato->nombre; ?></td>
                                        <td><?php echo $dato->apellido_paterno; ?></td>
                                        <td><?php echo $dato->apellido_materno; ?></td>
                                        <td><?php echo $dato->rut; ?></td>
                                        <td><?php echo $dato->calidad; ?></td>
                                        <td><?php echo $dato->escalafon; ?></td>
                                        <td><?php echo $dato->grado; ?></td>
                                        <td><?php echo $dato->estudio_titulo; ?></td>
                                        <td><?php echo $dato->tipo_contrato; ?></td>
                                        <td><?php echo $dato->ano_ingreso; ?></td>
                                        <td><?php echo $dato->correo; ?></td>
                                        <td><?php echo $dato->domicilio; ?></td>
                                        <td><?php echo $dato->fono_contacto; ?></td>
                                        <td><?php if ($dato->fecha_nacimiento === "0000-00-00" || $dato->fecha_nacimiento === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $fecha_nacimiento_F;
                                            }; ?></td>
                                        <td><?php echo $dato->edad; ?></td>
                                        <td><?php echo $dato->enfermedad_cronica; ?></td>
                                        <td><?php echo $dato->estado_civil; ?></td>
                                        <td><a href="vistas/modificar/modificar_rrhh_form.php?id_rrhh_key=<?php echo $dato->id_rrhh; ?>"><i class="fas fa-pencil-alt fa-2x" style="color: blueviolet;"></i></a></td>
                                        <td><a href="procesos/eliminar/eliminar_rrhh.php?id_rrhh_key=<?php echo $dato->id_rrhh; ?>" class="btn-del"><i class="fas fa-trash-alt fa-2x" style="color: red;"></i></a></td>
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

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- DataTables JS-->

    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <!-- SweetAlert2 CDN -->

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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