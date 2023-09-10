<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "MANTENCION") {
        include 'config/conexion.php';

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
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS"  ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
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
    <title>Control Convenio</title>

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
                <a class="btn btn-primary" href="nuevo_control_convenio.php">HOME</a>
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
            <div class="modal-dialog modal-lg">
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
                                        <label for="id_control_c" class="col-form-label">ID</label>
                                        <input type="text" style="background-color: khaki;" class="form-control" name="id_control_c" id="id_control_c" readonly>
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
                                        <label for="valor_us" class="col-form-label">Valor US</label>
                                        <input type="text" class="form-control" name="valor_us" id="valor_us" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="valor" class="col-form-label">Valor</label>
                                        <input type="text" class="form-control" name="valor" id="valor" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="vida_util" class="col-form-label">Vida Útil</label>
                                        <input type="text" class="form-control" name="vida_util" id="vida_util" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="vida_util_resi" class="col-form-label">Vida Útil Residual</label>
                                        <input type="text" class="form-control" name="vida_util_resi" id="vida_util_resi" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="prog_manten" class="col-form-label">Prog Manten</label>
                                        <input type="text" class="form-control" name="prog_manten" id="prog_manten" readonly>
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
                                        <label for="periodicidad_mp" class="col-form-label">Periodicidad MP</label>
                                        <input type="text" class="form-control" name="periodicidad_mp" id="periodicidad_mp" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="id_licitacion" class="col-form-label">ID Licitación</label>
                                        <input type="text" class="form-control" name="id_licitacion" id="id_licitacion" readonly>
                                    </div>
                                </div>

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
                <h2 style="text-align:center; margin-top: 20px;">CONTROL DE CONVENIO</h2>
            </div><br><br>

            <div class="col">
                <a href="procesos/exportar/exportar_control_convenio.php" class="btn btn-success" style="width: 10em;">Exportar Excel</a>
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
            </form><br><br>

            <script type="text/javascript">
                function uploadContacts() {
                    var Form = new FormData($('#filesForm')[0]);
                    $.ajax({
                        url: "import_control_convenio.php",
                        type: "post",
                        data: Form,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            location.href = "control_convenio.php";
                        }
                    });
                }
            </script>
            <!-- Termino Form Import Excel -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row table-responsive-sm">
                        <form method="post" action="pdf_multiples.php">
                            <table id="myTable" class="table table-bordered nowrap" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="color: red;">ID C.C</th><!-- VER -->
                                        <th style="color: red;">ID C</th><!-- VER -->
                                        <th>Responsable</th>
                                        <th>Correo</th>
                                        <th>Progr de Manten</th>
                                        <th>Caract de Acreditación</th>
                                        <th>Equipo</th><!-- VER -->
                                        <th>Marca</th><!-- VER -->
                                        <th>Modelo</th><!-- VER -->
                                        <th>Serie</th><!-- VER -->
                                        <th>N° Inventario</th>
                                        <th>Grupo</th>
                                        <th>Servicio</th><!-- VER -->
                                        <th>Sector</th>
                                        <th style="color: red;">Fin Garantia Fabricante</th>
                                        <th>Peridiocidad de Mantencion MP</th> <!-- VER -->
                                        <th style="color: red;">Id Licitación Convenio</th><!-- VER -->
                                        <th>Empresa Adjudicada</th>
                                        <th>Equipo Critico Mayor Complejidad</th>
                                        <th>Ubicación</th>
                                        <th>Edificio</th>
                                        <th>Piso</th>
                                        <th>Sala/Pasillo</th>
                                        <th>Fecha Inicio Convenio</th><!-- VER -->
                                        <th>Fecha Termino Convenio</th><!-- VER -->
                                        <th>Duracion en Meses</th>
                                        <th>Ejecutivo de Compra</th>
                                        <th>Correo</th>
                                        <th>Peridiocidad</th>
                                        <th>Nº Mantenciones Preventivas</th><!-- VER -->
                                        <th>Valor Mantencion 1</th>
                                        <th>Fecha Mantencion 1</th>
                                        <th>Fecha Recepcion Mantencion 1</th>
                                        <th>Orden de Compra Mantencion 1</th>
                                        <th>Fecha Orden Compra Mantencion 1</th>
                                        <th>Observación Mantencion 1</th>
                                        <th>Verificable Mantencion 1</th>
                                        <th>Valor Mantencion 2</th>
                                        <th>Fecha Mantencion 2</th>
                                        <th>Fecha Recepcion Mantencion 2</th>
                                        <th>Orden de Compra Mantencion 2</th>
                                        <th>Fecha Orden Compra Mantencion 2</th>
                                        <th>Observación Mantencion 2</th>
                                        <th>Verificable Mantencion 2</th>
                                        <th>Valor Mantencion 3</th>
                                        <th>Fecha Mantencion 3</th>
                                        <th>Fecha Recepcion Mantencion 3</th>
                                        <th>Orden de Compra Mantencion 3</th>
                                        <th>Fecha Orden Compra Mantencion 3</th>
                                        <th>Observación Mantencion 3</th>
                                        <th>Verificable Mantencion 3</th>
                                        <th>Valor Mantencion 4</th>
                                        <th>Fecha Mantencion 4</th>
                                        <th>Fecha Recepcion Mantencion 4</th>
                                        <th>Orden de Compra Mantencion 4</th>
                                        <th>Fecha Orden Compra Mantencion 4</th>
                                        <th>Observación Mantencion 4</th>
                                        <th>Verificable Mantencion 4</th>
                                        <th>Valor Mantencion 5</th>
                                        <th>Fecha Mantencion 5</th>
                                        <th>Fecha Recepcion Mantencion 5</th>
                                        <th>Orden de Compra Mantencion 5</th>
                                        <th>Fecha Orden Compra Mantencion 5</th>
                                        <th>Observación Mantencion 5</th>
                                        <th>Verificable Mantencion 5</th>
                                        <th>Valor Mantencion 6</th>
                                        <th>Fecha Mantencion 6</th>
                                        <th>Fecha Recepcion Mantencion 6</th>
                                        <th>Orden de Compra Mantencion 6</th>
                                        <th>Fecha Orden Compra Mantencion 6</th>
                                        <th>Observación Mantencion 6</th>
                                        <th>Verificable Mantencion 6</th>
                                        <th>Valor Mantencion 7</th>
                                        <th>Fecha Mantencion 7</th>
                                        <th>Fecha Recepcion Mantencion 7</th>
                                        <th>Orden de Compra Mantencion 7</th>
                                        <th>Fecha Orden Compra Mantencion 7</th>
                                        <th>Observación Mantencion 7</th>
                                        <th>Verificable Mantencion 7</th>
                                        <th>Valor Mantencion 8</th>
                                        <th>Fecha Mantencion 8</th>
                                        <th>Fecha Recepcion Mantencion 8</th>
                                        <th>Orden de Compra Mantencion 8</th>
                                        <th>Fecha Orden Compra Mantencion 8</th>
                                        <th>Observación Mantencion 8</th>
                                        <th>Verificable Mantencion 8</th>
                                        <th>Valor Mantencion 9</th>
                                        <th>Fecha Mantencion 9</th>
                                        <th>Fecha Recepcion Mantencion 9</th>
                                        <th>Orden de Compra Mantencion 9</th>
                                        <th>Fecha Orden Compra Mantencion 9</th>
                                        <th>Observación Mantencion 9</th>
                                        <th>Verificable Mantencion 9</th>
                                        <th>Valor Mantencion 10</th>
                                        <th>Fecha Mantencion 10</th>
                                        <th>Fecha Recepcion Mantencion 10</th>
                                        <th>Orden de Compra Mantencion 10</th>
                                        <th>Fecha Orden Compra Mantencion 10</th>
                                        <th>Observación Mantencion 10</th>
                                        <th>Verificable Mantencion 10</th>
                                        <th>Valor Mantencion 11</th>
                                        <th>Fecha Mantencion 11</th>
                                        <th>Fecha Recepcion Mantencion 11</th>
                                        <th>Orden de Compra Mantencion 11</th>
                                        <th>Fecha Orden Compra Mantencion 11</th>
                                        <th>Observación Mantencion 11</th>
                                        <th>Verificable Mantencion 11</th>
                                        <th>Valor Mantencion 12</th>
                                        <th>Fecha Mantencion 12</th>
                                        <th>Fecha Recepcion Mantencion 12</th>
                                        <th>Orden de Compra Mantencion 12</th>
                                        <th>Fecha Orden Compra Mantencion 12</th>
                                        <th>Observación Mantencion 12</th>
                                        <th>Verificable Mantencion 12</th>
                                        <th>#</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td><button type="button" class="verCC" data-bs-toggle="modal" data-bs-target="#verModal" style="border: 0; background-color: transparent;"><i class="far fa-eye fa-2x" style="color: darkred;"></i></button></td>
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
                                            <td style="background-color: rgb(247, 84, 84);"><?php if ($dato->termino_garantia === "0000-00-00" || $dato->termino_garantia === NULL) {
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
                                            <td><a href="vistas/modificar/modificar_control_convenio_form.php?id_control_convenio_key=<?php echo $dato->id_control_convenio; ?>"><i class="fas fa-pencil-alt fa-2x" style="color: blueviolet;"></i></a></td>
                                            <td><a href="procesos/eliminar/eliminar_control_convenio.php?id_control_convenio_key=<?php echo $dato->id_control_convenio; ?>" class="btn-del"><i class="fas fa-trash-alt fa-2x" style="color: red;"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
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
        $('.verCC').on('click', function() {

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            });

            console.log(data);

            $('#id_control_c').val(data[1]);
            $('#eq_inst').val(data[5]);
            $('#clase').val(data[8]);
            $('#subclase').val(data[9]);
            $('#ley_ppto').val(data[10]);
            $('#valor_us').val(data[15]);
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