<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS") {
        include 'config/conexion.php';

        $sentencia = $bd->query("SELECT Eq.id_relacion, Eq.servicio, Eq.equipo, Eq.marca, Eq.modelo, Eq.serie, Eq.valor, Eq.vida_util, Eq.propiedad, Eq.id_licitacion, 
                    Re.id_recepcion, Re.ano_fabrica, Re.financiamiento, Re.producto_solicitado, Re.requerimiento_tecnico, Re.nombre_proyecto, Re.decreto, 
                    Re.fecha_decreto, Re.resolucion_especi_tec, Re.fecha_resolu_especi_tec, Re.resolucion_adjudicacion, Re.fecha_de_adjudi, 
                    Re.resolucion_contrato, Re.fecha_resolu_contrato, Re.tipo_de_compra, Re.orden_compra, Re.fecha_orden_compra, Re.detalle_orden_compra, 
                    Re.plazo_entrega, Re.tipo_de_dias, Re.fecha_entrega, Re.rut, Re.proveedor, Re.numero_acta, Re.fecha_recepcion_parcial, Re.fecha_puesta_marcha, 
                    Re.fecha_recepcion_final, Re.capacitacion, Re.fecha_capacitacion, Re.garantia_fabricante, Re.fecha_inicio_garanti_fabricante, 
                    Re.fecha_termino_garanti_fabricante, Re.mantenciones_en_garantia, Re.periodo_mantenci_garanti, Re.verificable_entrega, Re.fecha_verificable, 
                    Re.ref_tecnico_recepcion, Re.ref_tecnico_clinico, Re.ref_tecnico_mantencion_1, Re.ref_tecnico_mantencion_2, Re.ref_tecnico_mantencion_3, 
                    Re.ref_tecnico_externo, Re.otro_referente_1, Re.otro_referente_2, 
                    Re.accesorio_1, Re.accesorio_2, Re.accesorio_3, Re.accesorio_4, Re.accesorio_5, Re.accesorio_6, Re.accesorio_7, Re.accesorio_8, Re.accesorio_9, 
                    Re.accesorio_10, Re.observaciones 
            FROM equipamiento Eq 
            INNER JOIN recepcion Re ON Eq.id_relacion = Re.relacion_id");

        $consulta = $sentencia->fetchAll(PDO::FETCH_OBJ);
    } elseif (
        $_SESSION['tipo'] === "MANTENCION" ||
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
    <title>Recepción Equipos</title>

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
                <a class="btn btn-primary" href="nueva_recepcion.php">HOME</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- 
                        <li class="nav-item">
                            <a class="nav-link active" href="recepcion_equipo.php">Recepción Equipo</a>
                        </li>
                        -->
                    </ul>
                    <form class="d-flex">
                        <a href="procesos/cerrar_sesion.php" class="btn btn-outline-success">Cerrar Sesión</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <div class="container-fluid">
        <div class="row">
            <h2 style="text-align:center; margin-top: 20px;">RECEPCIÓN DE EQUIPOS</h2>
        </div><br><br>

        <!--  MODAL -->
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
                                        <label for="id_recep" class="col-form-label">ID</label>
                                        <input type="text" style="background-color: khaki;" class="form-control" name="id_recep" id="id_recep" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="servicio" class="col-form-label">Servicio</label>
                                        <input type="text" class="form-control" name="servicio" id="servicio" readonly>
                                    </div>
                                </div>

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
                                        <label for="id_licitacion" class="col-form-label">ID Licitación</label>
                                        <input type="text" class="form-control" name="id_licitacion" id="id_licitacion" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="produc_solicitado" class="col-form-label">Prod Solicitado</label>
                                        <input type="text" class="form-control" name="produc_solicitado" id="produc_solicitado" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="requeri_tec" class="col-form-label">Requerimiento Tec</label>
                                        <input type="text" class="form-control" name="requeri_tec" id="requeri_tec" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="nomb_proyecto" class="col-form-label">Nombre Proyecto</label>
                                        <input type="text" class="form-control" name="nomb_proyecto" id="nomb_proyecto" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="decreto" class="col-form-label">Decreto</label>
                                        <input type="text" class="form-control" name="decreto" id="decreto" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_decreto" class="col-form-label">Fecha Decreto</label>
                                        <input type="date" class="form-control" name="fecha_decreto" id="fecha_decreto" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="resolu_especi_tec" class="col-form-label">Resolu Especifi Tec</label>
                                        <input type="text" class="form-control" name="resolu_especi_tec" id="resolu_especi_tec" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_especi_tec" class="col-form-label">Fecha Especifi Tec</label>
                                        <input type="date" class="form-control" name="fecha_especi_tec" id="fecha_especi_tec" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="resolu_adjudicacion" class="col-form-label">Resolu Adjudicación</label>
                                        <input type="text" class="form-control" name="resolu_adjudicacion" id="resolu_adjudicacion" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_adjudicacion" class="col-form-label">Fecha Adjudicación</label>
                                        <input type="date" class="form-control" name="fecha_adjudicacion" id="fecha_adjudicacion" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="resolu_contrato" class="col-form-label">Resolu Contrato</label>
                                        <input type="text" class="form-control" name="resolu_contrato" id="resolu_contrato" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_contrato" class="col-form-label">Fecha Contrato</label>
                                        <input type="date" class="form-control" name="fecha_contrato" id="fecha_contrato" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="tipo_compra" class="col-form-label">Tipo Compra</label>
                                        <input type="text" class="form-control" name="tipo_compra" id="tipo_compra" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_oc" class="col-form-label">Fecha Orden Compra</label>
                                        <input type="date" class="form-control" name="fecha_oc" id="fecha_oc" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="detalle_oc" class="col-form-label">Detalle Orden Compra</label>
                                        <input type="text" class="form-control" name="detalle_oc" id="detalle_oc" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="plazo_entrega" class="col-form-label">Plazo Entrega</label>
                                        <input type="text" class="form-control" name="plazo_entrega" id="plazo_entrega" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="tipo_dias" class="col-form-label">Tipo Días</label>
                                        <input type="text" class="form-control" name="tipo_dias" id="tipo_dias" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_entrega" class="col-form-label">Fecha Entrega</label>
                                        <input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="rut" class="col-form-label">RUT</label>
                                        <input type="text" class="form-control" name="rut" id="rut" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="proveedor" class="col-form-label">Proveedor</label>
                                        <input type="text" class="form-control" name="proveedor" id="proveedor" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="n_acta" class="col-form-label">N° Acta</label>
                                        <input type="text" class="form-control" name="n_acta" id="n_acta" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_recep_parcial" class="col-form-label">Fecha Recepc Parcial</label>
                                        <input type="date" class="form-control" name="fecha_recep_parcial" id="fecha_recep_parcial" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_puesta_m" class="col-form-label">Fecha Puesta En Marcha</label>
                                        <input type="date" class="form-control" name="fecha_puesta_m" id="fecha_puesta_m" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="capacitacion" class="col-form-label">Capacitación</label>
                                        <input type="text" class="form-control" name="capacitacion" id="capacitacion" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_capacitacion" class="col-form-label">Fecha Capacitación</label>
                                        <input type="date" class="form-control" name="fecha_capacitacion" id="fecha_capacitacion" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="garanti_fabri" class="col-form-label">Garantía Fabricante</label>
                                        <input type="text" class="form-control" name="garanti_fabri" id="garanti_fabri" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="mantens_en_garanti" class="col-form-label">Mantens en Garantía</label>
                                        <input type="text" class="form-control" name="mantens_en_garanti" id="mantens_en_garanti" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="periodo_mants_garan" class="col-form-label">Periodo Mantens Garantía</label>
                                        <input type="text" class="form-control" name="periodo_mants_garan" id="periodo_mants_garan" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="verificable_entrega" class="col-form-label">Verificable Entrega</label>
                                        <input type="text" class="form-control" name="verificable_entrega" id="verificable_entrega" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="fecha_verificable" class="col-form-label">Fecha Verificable</label>
                                        <input type="date" class="form-control" name="fecha_verificable" id="fecha_verificable" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_recep" class="col-form-label">Ref Tec Recepción</label>
                                        <input type="text" class="form-control" name="ref_tec_recep" id="ref_tec_recep" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_clinico" class="col-form-label">Ref Tec Clinico</label>
                                        <input type="text" class="form-control" name="ref_tec_clinico" id="ref_tec_clinico" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_mant_1" class="col-form-label">Ref Tec Mantención 1</label>
                                        <input type="text" class="form-control" name="ref_tec_mant_1" id="ref_tec_mant_1" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_mant_2" class="col-form-label">Ref Tec Mantención 2</label>
                                        <input type="text" class="form-control" name="ref_tec_mant_2" id="ref_tec_mant_2" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_mant_3" class="col-form-label">Ref Tec Mantención 3</label>
                                        <input type="text" class="form-control" name="ref_tec_mant_3" id="ref_tec_mant_3" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="ref_tec_externo" class="col-form-label">Ref Tec Externo</label>
                                        <input type="text" class="form-control" name="ref_tec_externo" id="ref_tec_externo" readonly>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="otro_ref_1" class="col-form-label">Otro Ref Tec 1</label>
                                        <input type="text" class="form-control" name="otro_ref_1" id="otro_ref_1" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="otro_ref_2" class="col-form-label">Otro Ref Tec 2</label>
                                        <input type="text" class="form-control" name="otro_ref_2" id="otro_ref_2" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_1" class="col-form-label">Accesorio 1</label>
                                        <input type="text" class="form-control" name="accesorio_1" id="accesorio_1" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_2" class="col-form-label">Accesorio 2</label>
                                        <input type="text" class="form-control" name="accesorio_2" id="accesorio_2" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_3" class="col-form-label">Accesorio 3</label>
                                        <input type="text" class="form-control" name="accesorio_3" id="accesorio_3" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_4" class="col-form-label">Accesorio 4</label>
                                        <input type="text" class="form-control" name="accesorio_4" id="accesorio_4" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_5" class="col-form-label">Accesorio 5</label>
                                        <input type="text" class="form-control" name="accesorio_5" id="accesorio_5" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_6" class="col-form-label">Accesorio 6</label>
                                        <input type="text" class="form-control" name="accesorio_6" id="accesorio_6" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_7" class="col-form-label">Accesorio 7</label>
                                        <input type="text" class="form-control" name="accesorio_7" id="accesorio_7" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_8" class="col-form-label">Accesorio 8</label>
                                        <input type="text" class="form-control" name="accesorio_8" id="accesorio_8" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_9" class="col-form-label">Accesorio 9</label>
                                        <input type="text" class="form-control" name="accesorio_9" id="accesorio_9" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="accesorio_10" class="col-form-label">Accesorio 10</label>
                                        <input type="text" class="form-control" name="accesorio_10" id="accesorio_10" readonly>
                                    </div>
                                </div>

                                <div class="form-group col">
                                    <div class="mb-3">
                                        <label for="observaciones" class="col-form-label">Observaciones</label>
                                        <input type="text" class="form-control" name="observaciones" id="observaciones" readonly>
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
                <div class="col-lg-12">
                    <div class="row table-responsive-sm">
                        <form method="post" action="pdf_multiples.php"> <!-- Envio de informacion -->
                            <table id="myTable" class="table table-bordered nowrap" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th><button type="submit" name="pdfId" style="border: 0; background-color: transparent;"><i class="fas fa-file-pdf fa-2x" style="color: #6533FF;"></i></button></th>
                                        <th>#</th>
                                        <th style="color: red;">ID C</th><!-- VER -->
                                        <th hidden>Servicio</th>
                                        <th>Equipo</th><!-- VER -->
                                        <th>Marca</th><!-- VER -->
                                        <th>Modelo</th><!-- VER -->
                                        <th>Serie</th><!-- VER -->
                                        <th hidden>Valor</th>
                                        <th hidden>Vida Util</th>
                                        <th>Propiedad</th><!-- VER -->
                                        <th hidden>ID Licitacion</th>
                                        <th style="color: red;">ID_RECEPCION</th><!-- VER -->
                                        <th>Año Fabricacion</th><!-- VER -->
                                        <th>Financiamiento</th><!-- VER -->
                                        <th hidden>Producto Solicitado</th>
                                        <th hidden>Requerimiento Tecnico</th>
                                        <th hidden>Nombre del Poyecto</th>
                                        <th hidden>Decreto</th>
                                        <th hidden>Fecha Decreto</th>
                                        <th hidden>Resolucion Especificaciones Tecnicas</th>
                                        <th hidden>Fecha Especifi Tec</th>
                                        <th hidden>Resolucion Adjudicacion</th>
                                        <th hidden>Fecha de Adjudicacion</th>
                                        <th hidden>Resolucion Contrato</th>
                                        <th hidden>Fecha Contrato</th>
                                        <th hidden>Tipo de Compra</th>
                                        <th>Orden de Compra</th><!-- VER -->
                                        <th hidden>Fecha Orden de Compra</th>
                                        <th hidden>Detalle Orden de Compra</th>
                                        <th hidden>Plazo Entrega</th>
                                        <th hidden>Tipo de Dias</th>
                                        <th hidden>Fecha Entrega</th>
                                        <th hidden>RUT</th>
                                        <th hidden>Proveedor</th>
                                        <th hidden>N° de Acta</th>
                                        <th hidden>Fecha Recepcion Parcial</th>
                                        <th hidden>Fecha Puesta en Marcha</th>
                                        <th>Fecha Recepcion Final</th><!-- VER -->
                                        <th hidden>Capacitacion</th>
                                        <th hidden>Fecha Capacitacion</th>
                                        <th hidden>Garantia Fabricante</th>
                                        <th>Fecha Inic Garantia Fabricante</th><!-- VER -->
                                        <th>Fecha Term Garantia Fabricante</th><!-- VER -->
                                        <th hidden>Mantenciones en Garantia</th>
                                        <th hidden>Periodo Mantencion Garantia</th>
                                        <th hidden>Verificable Entrega</th>
                                        <th hidden>Fecha Verificable</th>
                                        <th hidden>Ref Tecnico Recepcion</th>
                                        <th hidden>Ref Tecnico Clinico</th>
                                        <th hidden>Ref Tecnico Mantencion 1</th>
                                        <th hidden>Ref Tecnico Mantencion 2</th>
                                        <th hidden>Ref Tecnico Mantencion 3</th>
                                        <th hidden>Ref Tecnico Externo</th>
                                        <th hidden>Otro Ref 1</th>
                                        <th hidden>Otro Ref 2</th>

                                        <th hidden>Accesorio</th>
                                        <th hidden>Accesorio</th>
                                        <th hidden>Accesorio</th>
                                        <th hidden>Accesorio</th>
                                        <th hidden>Accesorio</th>
                                        <th hidden>Accesorio</th>
                                        <th hidden>Accesorio</th>
                                        <th hidden>Accesorio</th>
                                        <th hidden>Accesorio</th>
                                        <th hidden>Accesorio</th>
                                        <th hidden>Observaciones</th>
                                        <th>#</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($consulta as $dato) { ?>
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox" name="idRecepcion[]" value="<?php echo $dato->id_recepcion; ?>" id="flexCheckDefault"></td>
                                            <td><button type="button" class="verRecepcion" data-bs-toggle="modal" data-bs-target="#verModal" style="border: 0; background-color: transparent;"><i class="far fa-eye fa-2x" style="color: darkred;"></i></button></td>
                                            <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_relacion; ?></td>
                                            <td hidden><?php echo $dato->servicio; ?></td>
                                            <td><?php echo $dato->equipo; ?></td>
                                            <td><?php echo $dato->marca; ?></td>
                                            <td><?php echo $dato->modelo; ?></td>
                                            <td><?php echo $dato->serie; ?></td>
                                            <td hidden><?php echo number_format($dato->valor); ?></td> <!-- FORMAT NUM -->
                                            <td hidden><?php echo $dato->vida_util; ?></td>
                                            <td><?php echo $dato->propiedad; ?></td>
                                            <td hidden><?php echo $dato->id_licitacion; ?></td>

                                            <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->id_recepcion; ?></td>
                                            <td><?php echo $dato->ano_fabrica; ?></td>
                                            <td><?php echo $dato->financiamiento; ?></td>
                                            <td hidden><?php echo $dato->producto_solicitado; ?></td>
                                            <td hidden><?php echo $dato->requerimiento_tecnico; ?></td>
                                            <td hidden><?php echo $dato->nombre_proyecto; ?></td>
                                            <td hidden><?php echo $dato->decreto; ?></td>
                                            <td hidden><?php echo $dato->fecha_decreto; ?></td>
                                            <td hidden><?php echo $dato->resolucion_especi_tec; ?></td>
                                            <td hidden><?php echo $dato->fecha_resolu_especi_tec; ?></td>
                                            <td hidden><?php echo $dato->resolucion_adjudicacion; ?></td>
                                            <td hidden><?php echo $dato->fecha_de_adjudi; ?></td>
                                            <td hidden><?php echo $dato->resolucion_contrato; ?></td>
                                            <td hidden><?php echo $dato->fecha_resolu_contrato; ?></td>
                                            <td hidden><?php echo $dato->tipo_de_compra; ?></td>
                                            <td><?php echo $dato->orden_compra; ?></td>
                                            <td hidden><?php echo $dato->fecha_orden_compra; ?></td>
                                            <td hidden><?php echo $dato->detalle_orden_compra; ?></td>
                                            <td hidden><?php echo $dato->plazo_entrega; ?></td>
                                            <td hidden><?php echo $dato->tipo_de_dias; ?></td>
                                            <td hidden><?php echo $dato->fecha_entrega; ?></td>
                                            <td hidden><?php echo $dato->rut; ?></td>
                                            <td hidden><?php echo $dato->proveedor; ?></td>
                                            <td hidden><?php echo $dato->numero_acta; ?></td>
                                            <td hidden><?php echo $dato->fecha_recepcion_parcial; ?></td>
                                            <td hidden><?php echo $dato->fecha_puesta_marcha; ?></td>
                                            <td><?php echo $dato->fecha_recepcion_final; ?></td>
                                            <td hidden><?php echo $dato->capacitacion; ?></td>
                                            <td hidden><?php echo $dato->fecha_capacitacion; ?></td>
                                            <td hidden><?php echo $dato->garantia_fabricante; ?></td>
                                            <td><?php echo $dato->fecha_inicio_garanti_fabricante; ?></td>
                                            <td><?php echo $dato->fecha_termino_garanti_fabricante; ?></td>
                                            <td hidden><?php echo $dato->mantenciones_en_garantia; ?></td>
                                            <td hidden><?php echo $dato->periodo_mantenci_garanti; ?></td>
                                            <td hidden><?php echo $dato->verificable_entrega; ?></td>
                                            <td hidden><?php echo $dato->fecha_verificable; ?></td>
                                            <td hidden><?php echo $dato->ref_tecnico_recepcion; ?></td>
                                            <td hidden><?php echo $dato->ref_tecnico_clinico; ?></td>
                                            <td hidden><?php echo $dato->ref_tecnico_mantencion_1; ?></td>
                                            <td hidden><?php echo $dato->ref_tecnico_mantencion_2; ?></td>
                                            <td hidden><?php echo $dato->ref_tecnico_mantencion_3; ?></td>
                                            <td hidden><?php echo $dato->ref_tecnico_externo; ?></td>
                                            <td hidden><?php echo $dato->otro_referente_1; ?></td>
                                            <td hidden><?php echo $dato->otro_referente_2; ?></td>

                                            <td hidden><?php echo $dato->accesorio_1; ?></td>
                                            <td hidden><?php echo $dato->accesorio_2; ?></td>
                                            <td hidden><?php echo $dato->accesorio_3; ?></td>
                                            <td hidden><?php echo $dato->accesorio_4; ?></td>
                                            <td hidden><?php echo $dato->accesorio_5; ?></td>
                                            <td hidden><?php echo $dato->accesorio_6; ?></td>
                                            <td hidden><?php echo $dato->accesorio_7; ?></td>
                                            <td hidden><?php echo $dato->accesorio_8; ?></td>
                                            <td hidden><?php echo $dato->accesorio_9; ?></td>
                                            <td hidden><?php echo $dato->accesorio_10; ?></td>
                                            <td hidden><?php echo $dato->observaciones; ?></td>
                                            <td><a href="vistas/modificar/modificar_recepcion_form.php?id_recepcion_key=<?php echo $dato->id_recepcion; ?>"><i class="fas fa-pencil-alt fa-2x" style="color: blueviolet;"></i></a></td>
                                            <td><a href="procesos/eliminar/eliminar_recepcion.php?id_recepcion_key=<?php echo $dato->id_recepcion; ?>" class="btn-del"><i class="fas fa-trash-alt fa-2x" style="color: red;"></i></a></td>
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
        $('.verRecepcion').on('click', function() {

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            });

            console.log(data);

            $('#id_recep').val(data[12]);
            $('#servicio').val(data[3]);
            $('#valor').val(data[8]);
            $('#vida_util').val(data[9]);
            $('#id_licitacion').val(data[11]);
            $('#produc_solicitado').val(data[15]);
            $('#requeri_tec').val(data[16]);
            $('#nomb_proyecto').val(data[17]);
            $('#decreto').val(data[18]);
            $('#fecha_decreto').val(data[19]);
            $('#resolu_especi_tec').val(data[20]);
            $('#fecha_especi_tec').val(data[21]);
            $('#resolu_adjudicacion').val(data[22]);
            $('#fecha_adjudicacion').val(data[23]);
            $('#resolu_contrato').val(data[24]);
            $('#fecha_contrato').val(data[25]);
            $('#tipo_compra').val(data[26]);
            $('#fecha_oc').val(data[28]);
            $('#detalle_oc').val(data[29]);
            $('#plazo_entrega').val(data[30]);
            $('#tipo_dias').val(data[31]);
            $('#fecha_entrega').val(data[32]);
            $('#rut').val(data[33]);
            $('#proveedor').val(data[34]);
            $('#n_acta').val(data[35]);
            $('#fecha_recep_parcial').val(data[36]);
            $('#fecha_puesta_m').val(data[37]);
            $('#capacitacion').val(data[39]);
            $('#fecha_capacitacion').val(data[40]);
            $('#garanti_fabri').val(data[41]);
            $('#mantens_en_garanti').val(data[44]);
            $('#periodo_mants_garan').val(data[45]);
            $('#verificable_entrega').val(data[46]);
            $('#fecha_verificable').val(data[47]);
            $('#ref_tec_recep').val(data[48]);
            $('#ref_tec_clinico').val(data[49]);
            $('#ref_tec_mant_1').val(data[50]);
            $('#ref_tec_mant_2').val(data[51]);
            $('#ref_tec_mant_3').val(data[52]);
            $('#ref_tec_externo').val(data[53]);
            $('#otro_ref_1').val(data[54]);
            $('#otro_ref_2').val(data[55]);
            $('#accesorio_1').val(data[56]);
            $('#accesorio_2').val(data[57]);
            $('#accesorio_3').val(data[58]);
            $('#accesorio_4').val(data[59]);
            $('#accesorio_5').val(data[60]);
            $('#accesorio_6').val(data[61]);
            $('#accesorio_7').val(data[62]);
            $('#accesorio_8').val(data[63]);
            $('#accesorio_9').val(data[64]);
            $('#accesorio_10').val(data[65]);
            $('#observaciones').val(data[66]);
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