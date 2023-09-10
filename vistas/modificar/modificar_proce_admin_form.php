<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL" ||
        $_SESSION['tipo'] === "TECNICOS"
    ) {

        if (!isset($_GET['id_proceso_peti_key'])) {
            exit();
        }

        include '../../config/conexion.php';

        $id_proceso_peti_key = $_GET['id_proceso_peti_key'];

        $sentencia = $bd->prepare("SELECT * FROM proceso_peticiones WHERE id_peticiones = ?;");
        $sentencia->execute([$id_proceso_peti_key]);

        $idNew = $sentencia->fetch(PDO::FETCH_OBJ);
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION"
    ) {
        header('Location: ../../home_proceso_peticiones.php');
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
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/general_styles.css"> <!-- Estilos Generales -->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../img/favicon.png">
    <title>Modificar Proceso Peticiones</title>

    <style>
        .sizeT {
            resize: none;
        }

        .form-2,
        .form-3,
        .form-4 {
            display: none;
        }
    </style>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="btn btn-primary" href="../../proceso_administrativo.php">HOME</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- -->
                    </ul>
                    <form class="d-flex">
                        <a href="../../procesos/cerrar_sesion.php" class="btn btn-outline-success">Cerrar Sesión</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid fix">
        <div class="row">
            <h3 style="text-align:center; margin-top: 20px;">Modificar Proceso Administrativo</h3>
        </div><br>

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/modificar_proceso_peticiones.php" autocomplete="off">
            <!-- Form 1 -->
            <div class="card" id="form-1">
                <h5 class="card-header">Modificar</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="id_peticiones" class="col-sm-2 control-label">ID</label>
                            <input type="text" style="background-color: rgb(247, 242, 255);" class="form-control" id="id_peticiones" name="id_peticiones" maxlength="30" value="<?php echo $idNew->id_peticiones ?>" placeholder="ID" disabled>
                        </div>

                        <div class="form-group col">
                            <label for="ordinario" class="col-sm-2 control-label">Ordinario</label>
                            <input type="number" min="0" max="9999" class="form-control" id="ordinario" name="ordinario" value="<?php echo $idNew->ordinario ?>" placeholder="Ordinario">
                        </div>

                        <div class="form-group col">
                            <label for="tipo_compra" class="col-sm-2 control-label">Tipo Compra</label>
                            <input type="text" style="background-color: rgb(247, 242, 255);" maxlength="20" class="form-control" id="tipo_compra" name="tipo_compra" value="<?php echo $idNew->tipo_compra ?>" placeholder="Tipo Compra" disabled>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="descr_solicitud" class="col-sm-2 control-label">Descripción</label>
                            <textarea class="form-control sizeT" style="background-color: rgb(247, 242, 255);" name="descr_solicitud" id="descr_solicitud" rows="2" placeholder="Descripcion" disabled><?php echo $idNew->descr_solicitud ?></textarea>
                        </div>

                        <div class="form-group col">
                            <label for="notas" class="col-sm-2 control-label">Notas</label>
                            <textarea class="form-control sizeT" name="notas" id="notas" rows="2" placeholder="Notas"><?php echo $idNew->notas ?></textarea>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="doc_adjunta" class="col-sm-2 control-label">Doc Adj</label>
                            <input type="text" style="background-color: rgb(247, 242, 255);" class="form-control" id="doc_adjunta" name="doc_adjunta" value="<?php echo $idNew->doc_adjunta ?>" placeholder="Doc Adjunta" disabled>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_ordinario" class="col-sm-2 control-label">Ordinario</label>
                            <input type="date" class="form-control" id="fecha_ordinario" name="fecha_ordinario" value="<?php echo $idNew->fecha_ordinario ?>" placeholder="Fecha Ordinario">
                        </div>

                        <div class="form-group col">
                            <label for="total_gral" class="col-sm-2 control-label">Total Peti</label>
                            <input type="text" style="background-color: rgb(247, 242, 255);" class="form-control" id="total_gral" name="total_gral" value="<?php echo $idNew->total_gral ?>" placeholder="Total Peticion" disabled>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="id_licitacion" class="col-sm-2 control-label">ID Licitación</label>
                            <input type="text" class="form-control" id="id_licitacion" name="id_licitacion" maxlength="20" value="<?php echo $idNew->id_licitacion ?>" placeholder="ID Licitacion">
                        </div>

                        <div class="form-group col">
                            <label for="solici_de_compra" class="col-sm-2 control-label">Sol Compra</label>
                            <input type="number" min="0" max="9999999999" class="form-control" id="solici_de_compra" name="solici_de_compra" value="<?php echo $idNew->solici_de_compra ?>" placeholder="Solic Compra">
                        </div>

                        <div class="form-group col">
                            <label for="resolu_base_tec" class="col-sm-2 control-label">R.B.T</label>
                            <input type="number" min="0" max="999999" class="form-control" id="resolu_base_tec" name="resolu_base_tec" value="<?php echo $idNew->resolu_base_tec ?>" placeholder="Resolución Base Tec">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_base_tec" class="col-sm-2 control-label">F.RBT</label>
                            <input type="date" class="form-control" id="fecha_base_tec" name="fecha_base_tec" value="<?php echo $idNew->fecha_base_tec ?>" placeholder="Fecha RBT">
                        </div>

                        <div class="form-group col">
                            <label for="fecha_soli_compra" class="col-sm-2 control-label">F.Sol Compra</label>
                            <input type="date" class="form-control" id="fecha_soli_compra" name="fecha_soli_compra" value="<?php echo $idNew->fecha_soli_compra ?>" placeholder="Fecha Soli Compra">
                        </div>

                        <div class="form-group col">
                            <label for="resolu_adjudi" class="col-sm-2 control-label">Resolu Adjudi</label>
                            <input type="number" min="0" max="999999" class="form-control" id="resolu_adjudi" name="resolu_adjudi" value="<?php echo $idNew->resolu_adjudi ?>" placeholder="Resolución Adjudicación">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_resolu_adjudi" class="col-sm-2 control-label">F.R-Adj</label>
                            <input type="date" class="form-control" id="fecha_resolu_adjudi" name="fecha_resolu_adjudi" value="<?php echo $idNew->fecha_resolu_adjudi ?>" placeholder="Fecha Resol Adjud">
                        </div>

                        <div class="form-group col">
                            <label for="referencia" class="col-sm-2 control-label">Referencia</label>
                            <input type="number" min="0" max="9999999999" class="form-control" id="referencia" name="referencia" value="<?php echo $idNew->referencia ?>" placeholder="Referencia">
                        </div>

                        <div class="form-group col">
                            <label for="resolu_contrato" class="col-sm-2 control-label">R.Contrato</label>
                            <input type="number" min="0" max="999999" class="form-control" id="resolu_contrato" name="resolu_contrato" value="<?php echo $idNew->resolu_contrato ?>" placeholder="Resolución Contrato">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_resolu_contra" class="col-sm-2 control-label">F.R.Contra</label>
                            <input type="date" class="form-control" id="fecha_resolu_contra" name="fecha_resolu_contra" value="<?php echo $idNew->fecha_resolu_contra ?>" placeholder="Fecha Resol Contrato">
                        </div>

                        <div class="form-group col">
                            <label for="fecha_referencia" class="col-sm-2 control-label">F.Refe</label>
                            <input type="date" class="form-control" id="fecha_referencia" name="fecha_referencia" value="<?php echo $idNew->fecha_referencia ?>" placeholder="Fecha Referencia">
                        </div>

                        <div class="form-group col">
                            <label for="empresa" class="col-sm-2 control-label">Empresa</label>
                            <input type="text" style="background-color: rgb(247, 242, 255);" class="form-control" id="empresa" name="empresa" maxlength="30" value="<?php echo $idNew->empresa ?>" placeholder="Empresa" disabled>
                        </div>
                    </div><br>

                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="button" id="myForm1" class="btn btn-success" style="width: 10em;">Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form 2 -->
            <div class="card form-2" id="form-2">
                <h5 class="card-header">Modificar</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="rut" class="col-sm-2 control-label">RUT Empresa</label>
                            <input type="text" style="background-color: rgb(247, 242, 255);" class="form-control" id="rut" name="rut" maxlength="10" value="<?php echo $idNew->rut ?>" placeholder="Ejem: 00000000-K" disabled>
                        </div>

                        <div class="form-group col">
                            <label for="orden_compra" class="col-sm-2 control-label">O/C</label>
                            <input type="text" class="form-control" id="orden_compra" name="orden_compra" maxlength="20" value="<?php echo $idNew->orden_compra ?>" placeholder="O/C">
                        </div>

                        <div class="form-group col">
                            <label for="fecha_oc" class="col-sm-2 control-label">F.O/C</label>
                            <input type="date" class="form-control" id="fecha_oc" name="fecha_oc" value="<?php echo $idNew->fecha_oc ?>" placeholder="Fecha O/C">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="monto_oc" class="col-sm-2 control-label">Monto O/C</label>
                            <input type="number" class="form-control" id="monto_oc" name="monto_oc" min="0" max="999999999999999" value="<?php echo $idNew->monto_oc ?>" placeholder="Monto O/C">
                        </div>

                        <div class="form-group col">
                            <label for="ref_tec_1" class="col-sm-2 control-label">Referente</label>
                            <input type="text" style="background-color: rgb(247, 242, 255);" class="form-control" id="ref_tec_1" name="ref_tec_1" maxlength="30" value="<?php echo $idNew->ref_tec_1 ?>" placeholder="Referente" disabled>
                        </div>

                        <div class="form-group col">
                            <label for="diferencia_peti" class="col-sm-2 control-label">Difer Peti</label>
                            <input type="number" class="form-control" id="diferencia_peti" name="diferencia_peti" min="0" max="99999999999999999999" value="<?php echo $idNew->diferencia_peti ?>" placeholder="Diferencia Petición" require>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="item_ppto_solicitado" class="col-sm-2 control-label">Item PPTO</label>
                            <input type="text" style="background-color: rgb(247, 242, 255);" class="form-control" id="item_ppto_solicitado" name="item_ppto_solicitado" maxlength="20" value="<?php echo $idNew->item_ppto_solicitado ?>" placeholder="Item PPTO" disabled>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_recep" class="col-sm-2 control-label">Recepción</label>
                            <input type="date" class="form-control" id="fecha_recep" name="fecha_recep" value="<?php echo $idNew->fecha_recep ?>" placeholder="Fecha Recepcion">
                        </div>

                        <div class="form-group col">
                            <label for="n_acta" class="col-sm-2 control-label">Acta Recep</label>
                            <input type="number" class="form-control" id="n_acta" name="n_acta" min="0" max="9999999999" value="<?php echo $idNew->n_acta ?>" placeholder="Acta Recep">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="obser_recepcion" class="col-sm-2 control-label">Obser Recep</label>
                            <textarea class="form-control sizeT" name="obser_recepcion" id="obser_recepcion" rows="2" placeholder="Obs Recepcion"><?php echo $idNew->obser_recepcion ?></textarea>
                        </div>

                        <div class="form-group col">
                            <label for="verificable" class="col-sm-2 control-label">Verificable</label>
                            <textarea class="form-control sizeT" name="verificable" id="verificable" rows="2" placeholder="Verificable"><?php echo $idNew->verificable ?></textarea>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_acta" class="col-sm-2 control-label">Acta Recep</label>
                            <input type="date" class="form-control" id="fecha_acta" name="fecha_acta" value="<?php echo $idNew->fecha_acta ?>" placeholder="Fecha Acta Recepcion">
                        </div>

                        <div class="form-group col">
                            <label for="fecha_inicio" class="col-sm-2 control-label">Inic Trab</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $idNew->fecha_inicio ?>" placeholder="Fecha Inicio Trabajo">
                        </div>

                        <div class="form-group col">
                            <label for="fecha_termino" class="col-sm-2 control-label">Term Trab</label>
                            <input type="date" class="form-control" id="fecha_termino" name="fecha_termino" value="<?php echo $idNew->fecha_termino ?>" placeholder="Fecha Termino Trabajo">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="dias_de_mora" class="col-sm-2 control-label">Días Mora</label>
                            <input type="number" class="form-control" id="dias_de_mora" name="dias_de_mora" min="0" max="9999999999" value="<?php echo $idNew->dias_de_mora ?>" placeholder="Dias de Mora">
                        </div>

                        <div class="form-group col">
                            <label for="fecha_inic_gt_tec" class="col-sm-2 control-label">Inic Gtia</label>
                            <input type="date" class="form-control" id="fecha_inic_gt_tec" name="fecha_inic_gt_tec" value="<?php echo $idNew->fecha_inic_gt_tec ?>" placeholder="Fecha Inicio Garantia">
                        </div>

                        <div class="form-group col">
                            <label for="fecha_term_gt_tec" class="col-sm-2 control-label">Term Gtia</label>
                            <input type="date" class="form-control" id="fecha_term_gt_tec" name="fecha_term_gt_tec" value="<?php echo $idNew->fecha_term_gt_tec ?>" placeholder="Fecha Termino Garantia">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="orden_trabajo" class="col-sm-2 control-label">Orden Trabj</label>
                            <input type="number" style="background-color: rgb(247, 242, 255);" class="form-control" id="orden_trabajo" name="orden_trabajo" min="0" max="999999" value="<?php echo $idNew->orden_trabajo ?>" placeholder="Orden Trabajo" disabled>
                        </div>

                        <div class="form-group col">
                            <label for="n_factura" class="col-sm-2 control-label">Factura</label>
                            <input type="number" class="form-control" id="n_factura" name="n_factura" min="0" max="9999999999999999" value="<?php echo $idNew->n_factura ?>" placeholder="Factura">
                        </div>

                        <div class="form-group col">
                            <label for="fecha_fac" class="col-sm-2 control-label">Factura</label>
                            <input type="date" class="form-control" id="fecha_fac" name="fecha_fac" value="<?php echo $idNew->fecha_fac ?>" placeholder="Fecha Factura">
                        </div>
                    </div><br>



                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="button" id="myForm2At" class="btn btn-primary" style="width: 10em; margin-right: 1em;">Anterior</button>
                            <button type="button" id="myForm2" class="btn btn-success" style="width: 10em;">Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form 3 -->
            <div class="card form-3" id="form-3">
                <h5 class="card-header">Modificar</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="estado_peti" class="col-sm-2 control-label">Etd Peti</label>
                            <input type="text" class="form-control" id="estado_peti" name="estado_peti" maxlength="12" value="<?php echo $idNew->estado_peti ?>" placeholder="Estado Peticion">
                        </div>

                        <div class="form-group col">
                            <label for="folio_core" class="col-sm-2 control-label">Folio</label>
                            <input type="number" class="form-control" id="folio_core" name="folio_core" min="0" max="9999999999" value="<?php echo $idNew->folio_core ?>" placeholder="Folio">
                        </div>

                        <div class="form-group col">
                            <label for="fecha_folio" class="col-sm-2 control-label">Folio</label>
                            <input type="date" class="form-control" id="fecha_folio" name="fecha_folio" value="<?php echo $idNew->fecha_folio ?>" placeholder="Fecha Folio">
                        </div>
                    </div><br>


                    <!-- Inicio Tabla -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Detalle Compra</th>
                                    <th>ID Equipo</th>
                                    <th>Detalle Equipo</th>
                                    <th>COD Manager</th>
                                    <th>Producto</th>
                                    <th>U/M</th>
                                    <th>Cantidad</th>
                                    <th>V.Unitario</th>
                                    <th>NETO</th>
                                    <th>IVA</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="sec-1">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_1" id="detalle_compra_1" rows="3" cols="70" placeholder="Detalle Compra 1" disabled><?php echo $idNew->detalle_compra_1; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq" name="id_1" value="<?php echo $idNew->id_1; ?>" placeholder="ID Equipo 1" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_1" id="equipo_1" rows="3" cols="70" placeholder="Equipo 1" disabled><?php echo $idNew->equipo_1; ?></textarea>
                                    </td>
                                    <td>
                                        <!-- Buscador -->
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar" name="c_manager_1" value="<?php echo $idNew->c_manager_1; ?>" placeholder="COD Manager 1" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_1" id="producto_1" rows="3" cols="70" placeholder="Producto 1" disabled><?php echo $idNew->producto_1; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_1" id="u_m_1" rows="1" cols="25" placeholder="U/M 1" disabled><?php echo $idNew->u_m_1; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_1" name="cantidad_1" value="<?php echo $idNew->cantidad_1; ?>" placeholder="Cantidad 1" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_1" name="valor_unitario_1" value="<?php echo $idNew->valor_unitario_1; ?>" placeholder="V.Unitario 1" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="neto_1" id="neto_1" rows="1" cols="40" placeholder="NETO 1" disabled><?php echo $idNew->neto_1; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="iva_1" id="iva_1" rows="1" cols="40" placeholder="IVA 1" disabled><?php echo $idNew->iva_1; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="total_1" id="total_1" rows="1" cols="40" placeholder="Total 1" disabled><?php echo $idNew->total_1; ?></textarea>
                                    </td>
                                </tr>

                                <tr id="sec-2">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_2" id="detalle_compra_2" rows="3" cols="70" placeholder="Detalle Compra 2" disabled><?php echo $idNew->detalle_compra_2; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_2" name="id_2" value="<?php echo $idNew->id_2; ?>" placeholder="ID Equipo 2" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_2" id="equipo_2" rows="3" cols="70" placeholder="Equipo 2" disabled><?php echo $idNew->equipo_2; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_2" name="c_manager_2" value="<?php echo $idNew->c_manager_2; ?>" placeholder="COD Manager 2" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_2" id="producto_2" rows="3" cols="70" placeholder="Producto 2" disabled><?php echo $idNew->producto_2; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_2" id="u_m_2" rows="1" cols="25" placeholder="U/M 2" disabled><?php echo $idNew->u_m_2; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_2" name="cantidad_2" value="<?php echo $idNew->cantidad_2; ?>" placeholder="Cantidad 2" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_2" name="valor_unitario_2" value="<?php echo $idNew->valor_unitario_2; ?>" placeholder="V.Unitario 2" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_2" name="neto_2" value="<?php echo $idNew->neto_2; ?>" placeholder="NETO 2" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_2" name="iva_2" value="<?php echo $idNew->iva_2; ?>" placeholder="IVA 2" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_2" name="total_2" value="<?php echo $idNew->total_2; ?>" placeholder="Total 2" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-3">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_3" id="detalle_compra_3" rows="3" cols="70" placeholder="Detalle Compra 3" disabled><?php echo $idNew->detalle_compra_3; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_3" name="id_3" value="<?php echo $idNew->id_3; ?>" placeholder="ID Equipo 3" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_3" id="equipo_3" rows="3" cols="70" placeholder="Equipo 3" disabled><?php echo $idNew->equipo_3; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_3" name="c_manager_3" value="<?php echo $idNew->c_manager_3; ?>" placeholder="COD Manager 3" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_3" id="producto_3" rows="3" cols="70" placeholder="Producto 3" disabled><?php echo $idNew->producto_3; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_3" id="u_m_3" rows="1" cols="25" placeholder="U/M 3" disabled><?php echo $idNew->u_m_3; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_3" name="cantidad_3" value="<?php echo $idNew->cantidad_3; ?>" placeholder="Cantidad 3" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_3" name="valor_unitario_3" value="<?php echo $idNew->valor_unitario_3; ?>" placeholder="V.Unitario 3" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_3" name="neto_3" value="<?php echo $idNew->neto_3; ?>" placeholder="NETO 3" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_3" name="iva_3" value="<?php echo $idNew->iva_3; ?>" placeholder="IVA 3" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_3" name="total_3" value="<?php echo $idNew->total_3; ?>" placeholder="Total 3" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-4">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_4" id="detalle_compra_4" rows="3" cols="70" placeholder="Detalle Compra 4" disabled><?php echo $idNew->detalle_compra_4; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_4" name="id_4" value="<?php echo $idNew->id_4; ?>" placeholder="ID Equipo 4" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_4" id="equipo_4" rows="3" cols="70" placeholder="Equipo 4" disabled><?php echo $idNew->equipo_4; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_4" name="c_manager_4" value="<?php echo $idNew->c_manager_4; ?>" placeholder="COD Manager 4" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_4" id="producto_4" rows="3" cols="70" placeholder="Producto 4" disabled><?php echo $idNew->producto_4; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_4" id="u_m_4" rows="1" cols="25" placeholder="U/M 4" disabled><?php echo $idNew->u_m_4; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_4" name="cantidad_4" value="<?php echo $idNew->cantidad_4; ?>" placeholder="Cantidad 4" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_4" name="valor_unitario_4" value="<?php echo $idNew->valor_unitario_4; ?>" placeholder="V.Unitario 4" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_4" name="neto_4" value="<?php echo $idNew->neto_4; ?>" placeholder="NETO 4" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_4" name="iva_4" value="<?php echo $idNew->iva_4; ?>" placeholder="IVA 4" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_4" name="total_4" value="<?php echo $idNew->total_4; ?>" placeholder="Total 4" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-5">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_5" id="detalle_compra_5" rows="3" cols="70" placeholder="Detalle Compra 5" disabled><?php echo $idNew->detalle_compra_5; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_5" name="id_5" value="<?php echo $idNew->id_5; ?>" placeholder="ID Equipo 5" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_5" id="equipo_5" rows="3" cols="70" placeholder="Equipo 5" disabled><?php echo $idNew->equipo_5; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_5" name="c_manager_5" value="<?php echo $idNew->c_manager_5; ?>" placeholder="COD Manager 5" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_5" id="producto_5" rows="3" cols="70" placeholder="Producto 5" disabled><?php echo $idNew->producto_5; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_5" id="u_m_5" rows="1" cols="25" placeholder="U/M 5" disabled><?php echo $idNew->u_m_5; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_5" name="cantidad_5" value="<?php echo $idNew->cantidad_5; ?>" placeholder="Cantidad 5" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_5" name="valor_unitario_5" value="<?php echo $idNew->valor_unitario_5; ?>" placeholder="V.Unitario 5" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_5" name="neto_5" value="<?php echo $idNew->neto_5; ?>" placeholder="NETO 5" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_5" name="iva_5" value="<?php echo $idNew->iva_5; ?>" placeholder="IVA 5" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_5" name="total_5" value="<?php echo $idNew->total_5; ?>" placeholder="Total 5" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-6">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_6" id="detalle_compra_6" rows="3" cols="70" placeholder="Detalle Compra 6" disabled><?php echo $idNew->detalle_compra_6; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_6" name="id_6" value="<?php echo $idNew->id_6; ?>" placeholder="ID Equipo 6" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_6" id="equipo_6" rows="3" cols="70" placeholder="Equipo 6" disabled><?php echo $idNew->equipo_6; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_6" name="c_manager_6" value="<?php echo $idNew->c_manager_6; ?>" placeholder="COD Manager 6" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_6" id="producto_6" rows="3" cols="70" placeholder="Producto 6" disabled><?php echo $idNew->producto_6; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_6" id="u_m_6" rows="1" cols="25" placeholder="U/M 6" disabled><?php echo $idNew->u_m_6; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_6" name="cantidad_6" value="<?php echo $idNew->cantidad_6; ?>" placeholder="Cantidad 6" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_6" name="valor_unitario_6" value="<?php echo $idNew->valor_unitario_6; ?>" placeholder="V.Unitario 6" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_6" name="neto_6" value="<?php echo $idNew->neto_6; ?>" placeholder="NETO 6" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_6" name="iva_6" value="<?php echo $idNew->iva_6; ?>" placeholder="IVA 6" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_6" name="total_6" value="<?php echo $idNew->total_6; ?>" placeholder="Total 6" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-7">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_7" id="detalle_compra_7" rows="3" cols="70" placeholder="Detalle Compra 7" disabled><?php echo $idNew->detalle_compra_7; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_7" name="id_7" value="<?php echo $idNew->id_7; ?>" placeholder="ID Equipo 7" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_7" id="equipo_7" rows="3" cols="70" placeholder="Equipo 7" disabled><?php echo $idNew->equipo_7; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_7" name="c_manager_7" value="<?php echo $idNew->c_manager_7; ?>" placeholder="COD Manager 7" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_7" id="producto_7" rows="3" cols="70" placeholder="Producto 7" disabled><?php echo $idNew->producto_7; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_7" id="u_m_7" rows="1" cols="25" placeholder="U/M 7" disabled><?php echo $idNew->u_m_7; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_7" name="cantidad_7" value="<?php echo $idNew->cantidad_7; ?>" placeholder="Cantidad 7" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_7" name="valor_unitario_7" value="<?php echo $idNew->valor_unitario_7; ?>" placeholder="V.Unitario 7" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_7" name="neto_7" value="<?php echo $idNew->neto_7; ?>" placeholder="NETO 7" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_7" name="iva_7" value="<?php echo $idNew->iva_7; ?>" placeholder="IVA 7" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_7" name="total_7" value="<?php echo $idNew->total_7; ?>" placeholder="Total 7" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-8">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_8" id="detalle_compra_8" rows="3" cols="70" placeholder="Detalle Compra 8" disabled><?php echo $idNew->detalle_compra_8; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_8" name="id_8" value="<?php echo $idNew->id_8; ?>" placeholder="ID Equipo 8" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_8" id="equipo_8" rows="3" cols="70" placeholder="Equipo 8" disabled><?php echo $idNew->equipo_8; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_8" name="c_manager_8" value="<?php echo $idNew->c_manager_8; ?>" placeholder="COD Manager 8" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_8" id="producto_8" rows="3" cols="70" placeholder="Producto 8" disabled><?php echo $idNew->producto_8; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_8" id="u_m_8" rows="1" cols="25" placeholder="U/M 8" disabled><?php echo $idNew->u_m_8; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_8" name="cantidad_8" value="<?php echo $idNew->cantidad_8; ?>" placeholder="Cantidad 8" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_8" name="valor_unitario_8" value="<?php echo $idNew->valor_unitario_8; ?>" placeholder="V.Unitario 8" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_8" name="neto_8" value="<?php echo $idNew->neto_8; ?>" placeholder="NETO 8" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_8" name="iva_8" value="<?php echo $idNew->iva_8; ?>" placeholder="IVA 8" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_8" name="total_8" value="<?php echo $idNew->total_8; ?>" placeholder="Total 8" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-9">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_9" id="detalle_compra_9" rows="3" cols="70" placeholder="Detalle Compra 9" disabled><?php echo $idNew->detalle_compra_9; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_9" name="id_9" value="<?php echo $idNew->id_9; ?>" placeholder="ID Equipo 9" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_9" id="equipo_9" rows="3" cols="70" placeholder="Equipo 9" disabled><?php echo $idNew->equipo_9; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_9" name="c_manager_9" value="<?php echo $idNew->c_manager_9; ?>" placeholder="COD Manager 9" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_9" id="producto_9" rows="3" cols="70" placeholder="Producto 9" disabled><?php echo $idNew->producto_9; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_9" id="u_m_9" rows="1" cols="25" placeholder="U/M 9" disabled><?php echo $idNew->u_m_9; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_9" name="cantidad_9" value="<?php echo $idNew->cantidad_9; ?>" placeholder="Cantidad 9" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_9" name="valor_unitario_9" value="<?php echo $idNew->valor_unitario_9; ?>" placeholder="V.Unitario 9" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_9" name="neto_9" value="<?php echo $idNew->neto_9; ?>" placeholder="NETO 9" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_9" name="iva_9" value="<?php echo $idNew->iva_9; ?>" placeholder="IVA 9" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_9" name="total_9" value="<?php echo $idNew->total_9; ?>" placeholder="Total 9" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-10">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_10" id="detalle_compra_10" rows="3" cols="70" placeholder="Detalle Compra 10" disabled><?php echo $idNew->detalle_compra_10; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_10" name="id_10" value="<?php echo $idNew->id_10; ?>" placeholder="ID Equipo 10" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_10" id="equipo_10" rows="3" cols="70" placeholder="Equipo 10" disabled><?php echo $idNew->equipo_10; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_10" name="c_manager_10" value="<?php echo $idNew->c_manager_10; ?>" placeholder="COD Manager 10" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_10" id="producto_10" rows="3" cols="70" placeholder="Producto 10" disabled><?php echo $idNew->producto_10; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_10" id="u_m_10" rows="1" cols="25" placeholder="U/M 10" disabled><?php echo $idNew->u_m_10; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_10" name="cantidad_10" value="<?php echo $idNew->cantidad_10; ?>" placeholder="Cantidad 10" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_10" name="valor_unitario_10" value="<?php echo $idNew->valor_unitario_10; ?>" placeholder="V.Unitario 10" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_10" name="neto_10" value="<?php echo $idNew->neto_10; ?>" placeholder="NETO 10" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_10" name="iva_10" value="<?php echo $idNew->iva_10; ?>" placeholder="IVA 10" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_10" name="total_10" value="<?php echo $idNew->total_10; ?>" placeholder="Total 10" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-11">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_11" id="detalle_compra_11" rows="3" cols="70" placeholder="Detalle Compra 11" disabled><?php echo $idNew->detalle_compra_11; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_11" name="id_11" value="<?php echo $idNew->id_11; ?>" placeholder="ID Equipo 11" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_11" id="equipo_11" rows="3" cols="70" placeholder="Equipo 11" disabled><?php echo $idNew->equipo_11; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_11" name="c_manager_11" value="<?php echo $idNew->c_manager_11; ?>" placeholder="COD Manager 11" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_11" id="producto_11" rows="3" cols="70" placeholder="Producto 11" disabled><?php echo $idNew->producto_11; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_11" id="u_m_11" rows="1" cols="25" placeholder="U/M 11" disabled><?php echo $idNew->u_m_11; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_11" name="cantidad_11" value="<?php echo $idNew->cantidad_11; ?>" placeholder="Cantidad 11" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_11" name="valor_unitario_11" value="<?php echo $idNew->valor_unitario_11; ?>" placeholder="V.Unitario 11" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_11" name="neto_11" value="<?php echo $idNew->neto_11; ?>" placeholder="NETO 11" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_11" name="iva_11" value="<?php echo $idNew->iva_11; ?>" placeholder="IVA 11" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_11" name="total_11" value="<?php echo $idNew->total_11; ?>" placeholder="Total 11" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-12">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_12" id="detalle_compra_12" rows="3" cols="70" placeholder="Detalle Compra 12" disabled><?php echo $idNew->detalle_compra_12; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_12" name="id_12" value="<?php echo $idNew->id_12; ?>" placeholder="ID Equipo 12" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_12" id="equipo_12" rows="3" cols="70" placeholder="Equipo 12" disabled><?php echo $idNew->equipo_12; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_12" name="c_manager_12" value="<?php echo $idNew->c_manager_12; ?>" placeholder="COD Manager 12" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_12" id="producto_12" rows="3" cols="70" placeholder="Producto 12" disabled><?php echo $idNew->producto_12; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_12" id="u_m_12" rows="1" cols="25" placeholder="U/M 12" disabled><?php echo $idNew->u_m_12; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_12" name="cantidad_12" value="<?php echo $idNew->cantidad_12; ?>" placeholder="Cantidad 12" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_12" name="valor_unitario_12" value="<?php echo $idNew->valor_unitario_12; ?>" placeholder="V.Unitario 12" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_12" name="neto_12" value="<?php echo $idNew->neto_12; ?>" placeholder="NETO 12" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_12" name="iva_12" value="<?php echo $idNew->iva_12; ?>" placeholder="IVA 12" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_12" name="total_12" value="<?php echo $idNew->total_12; ?>" placeholder="Total 12" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-13">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_13" id="detalle_compra_13" rows="3" cols="70" placeholder="Detalle Compra 13" disabled><?php echo $idNew->detalle_compra_13; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_13" name="id_13" value="<?php echo $idNew->id_13; ?>" placeholder="ID Equipo 13" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_13" id="equipo_13" rows="3" cols="70" placeholder="Equipo 13" disabled><?php echo $idNew->equipo_13; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_13" name="c_manager_13" value="<?php echo $idNew->c_manager_13; ?>" placeholder="COD Manager 13" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_13" id="producto_13" rows="3" cols="70" placeholder="Producto 13" disabled><?php echo $idNew->producto_13; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_13" id="u_m_13" rows="1" cols="25" placeholder="U/M 13" disabled><?php echo $idNew->u_m_13; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_13" name="cantidad_13" value="<?php echo $idNew->cantidad_13; ?>" placeholder="Cantidad 13" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_13" name="valor_unitario_13" value="<?php echo $idNew->valor_unitario_13; ?>" placeholder="V.Unitario 13" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_13" name="neto_13" value="<?php echo $idNew->neto_13; ?>" placeholder="NETO 13" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_13" name="iva_13" value="<?php echo $idNew->iva_13; ?>" placeholder="IVA 13" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_13" name="total_13" value="<?php echo $idNew->total_13; ?>" placeholder="Total 13" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-14">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_14" id="detalle_compra_14" rows="3" cols="70" placeholder="Detalle Compra 14" disabled><?php echo $idNew->detalle_compra_14; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_14" name="id_14" value="<?php echo $idNew->id_14; ?>" placeholder="ID Equipo 14" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_14" id="equipo_14" rows="3" cols="70" placeholder="Equipo 14" disabled><?php echo $idNew->equipo_14; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_14" name="c_manager_14" value="<?php echo $idNew->c_manager_14; ?>" placeholder="COD Manager 14" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_14" id="producto_14" rows="3" cols="70" placeholder="Producto 14" disabled><?php echo $idNew->producto_14; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_14" id="u_m_14" rows="1" cols="25" placeholder="U/M 14" disabled><?php echo $idNew->u_m_14; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_14" name="cantidad_14" value="<?php echo $idNew->cantidad_14; ?>" placeholder="Cantidad 14" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_14" name="valor_unitario_14" value="<?php echo $idNew->valor_unitario_14; ?>" placeholder="V.Unitario 14" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_14" name="neto_14" value="<?php echo $idNew->neto_14; ?>" placeholder="NETO 14" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_14" name="iva_14" value="<?php echo $idNew->iva_14; ?>" placeholder="IVA 14" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_14" name="total_14" value="<?php echo $idNew->total_14; ?>" placeholder="Total 14" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-15">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_15" id="detalle_compra_15" rows="3" cols="70" placeholder="Detalle Compra 15" disabled><?php echo $idNew->detalle_compra_15; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_15" name="id_15" value="<?php echo $idNew->id_15; ?>" placeholder="ID Equipo 15" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_15" id="equipo_15" rows="3" cols="70" placeholder="Equipo 15" disabled><?php echo $idNew->equipo_15; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_15" name="c_manager_15" value="<?php echo $idNew->c_manager_15; ?>" placeholder="COD Manager 15" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_15" id="producto_15" rows="3" cols="70" placeholder="Producto 15" disabled><?php echo $idNew->producto_15; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_15" id="u_m_15" rows="1" cols="25" placeholder="U/M 15" disabled><?php echo $idNew->u_m_15; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_15" name="cantidad_15" value="<?php echo $idNew->cantidad_15; ?>" placeholder="Cantidad 15" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_15" name="valor_unitario_15" value="<?php echo $idNew->valor_unitario_15; ?>" placeholder="V.Unitario 15" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_15" name="neto_15" value="<?php echo $idNew->neto_15; ?>" placeholder="NETO 15" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_15" name="iva_15" value="<?php echo $idNew->iva_15; ?>" placeholder="IVA 15" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_15" name="total_15" value="<?php echo $idNew->total_15; ?>" placeholder="Total 15" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-16">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_16" id="detalle_compra_16" rows="3" cols="70" placeholder="Detalle Compra 16" disabled><?php echo $idNew->detalle_compra_16; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_16" name="id_16" value="<?php echo $idNew->id_16; ?>" placeholder="ID Equipo 16" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_16" id="equipo_16" rows="3" cols="70" placeholder="Equipo 16" disabled><?php echo $idNew->equipo_16; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_16" name="c_manager_16" value="<?php echo $idNew->c_manager_16; ?>" placeholder="COD Manager 16" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_16" id="producto_16" rows="3" cols="70" placeholder="Producto 16" disabled><?php echo $idNew->producto_16; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_16" id="u_m_16" rows="1" cols="25" placeholder="U/M 16" disabled><?php echo $idNew->u_m_16; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_16" name="cantidad_16" value="<?php echo $idNew->cantidad_16; ?>" placeholder="Cantidad 16" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_16" name="valor_unitario_16" value="<?php echo $idNew->valor_unitario_16; ?>" placeholder="V.Unitario 16" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_16" name="neto_16" value="<?php echo $idNew->neto_16; ?>" placeholder="NETO 16" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_16" name="iva_16" value="<?php echo $idNew->iva_16; ?>" placeholder="IVA 16" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_16" name="total_16" value="<?php echo $idNew->total_16; ?>" placeholder="Total 16" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-17">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_17" id="detalle_compra_17" rows="3" cols="70" placeholder="Detalle Compra 17" disabled><?php echo $idNew->detalle_compra_17; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_17" name="id_17" value="<?php echo $idNew->id_17; ?>" placeholder="ID Equipo 17" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_17" id="equipo_17" rows="3" cols="70" placeholder="Equipo 17" disabled><?php echo $idNew->equipo_17; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_17" name="c_manager_17" value="<?php echo $idNew->c_manager_17; ?>" placeholder="COD Manager 17" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_17" id="producto_17" rows="3" cols="70" placeholder="Producto 17" disabled><?php echo $idNew->producto_17; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_17" id="u_m_17" rows="1" cols="25" placeholder="U/M 17" disabled><?php echo $idNew->u_m_17; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_17" name="cantidad_17" value="<?php echo $idNew->cantidad_17; ?>" placeholder="Cantidad 17" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_17" name="valor_unitario_17" value="<?php echo $idNew->valor_unitario_17; ?>" placeholder="V.Unitario 17" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_17" name="neto_17" value="<?php echo $idNew->neto_17; ?>" placeholder="NETO 17" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_17" name="iva_17" value="<?php echo $idNew->iva_17; ?>" placeholder="IVA 17" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_17" name="total_17" value="<?php echo $idNew->total_17; ?>" placeholder="Total 17" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-18">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_18" id="detalle_compra_18" rows="3" cols="70" placeholder="Detalle Compra 18" disabled><?php echo $idNew->detalle_compra_18; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_18" name="id_18" value="<?php echo $idNew->id_18; ?>" placeholder="ID Equipo 18" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_18" id="equipo_18" rows="3" cols="70" placeholder="Equipo 18" disabled><?php echo $idNew->equipo_18; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_18" name="c_manager_18" value="<?php echo $idNew->c_manager_18; ?>" placeholder="COD Manager 18" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_18" id="producto_18" rows="3" cols="70" placeholder="Producto 18" disabled><?php echo $idNew->producto_18; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_18" id="u_m_18" rows="1" cols="25" placeholder="U/M 18" disabled><?php echo $idNew->u_m_18; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_18" name="cantidad_18" value="<?php echo $idNew->cantidad_18; ?>" placeholder="Cantidad 18" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_18" name="valor_unitario_18" value="<?php echo $idNew->valor_unitario_18; ?>" placeholder="V.Unitario 18" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_18" name="neto_18" value="<?php echo $idNew->neto_18; ?>" placeholder="NETO 18" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_18" name="iva_18" value="<?php echo $idNew->iva_18; ?>" placeholder="IVA 18" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_18" name="total_18" value="<?php echo $idNew->total_18; ?>" placeholder="Total 18" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-19">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_19" id="detalle_compra_19" rows="3" cols="70" placeholder="Detalle Compra 19" disabled><?php echo $idNew->detalle_compra_19; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_19" name="id_19" value="<?php echo $idNew->id_19; ?>" placeholder="ID Equipo 19" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_19" id="equipo_19" rows="3" cols="70" placeholder="Equipo 19" disabled><?php echo $idNew->equipo_19; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_19" name="c_manager_19" value="<?php echo $idNew->c_manager_19; ?>" placeholder="COD Manager 19" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_19" id="producto_19" rows="3" cols="70" placeholder="Producto 19" disabled><?php echo $idNew->producto_19; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_19" id="u_m_19" rows="1" cols="25" placeholder="U/M 19" disabled><?php echo $idNew->u_m_19; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_19" name="cantidad_19" value="<?php echo $idNew->cantidad_19; ?>" placeholder="Cantidad 19" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_19" name="valor_unitario_19" value="<?php echo $idNew->valor_unitario_19; ?>" placeholder="V.Unitario 19" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_19" name="neto_19" value="<?php echo $idNew->neto_19; ?>" placeholder="NETO 19" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_19" name="iva_19" value="<?php echo $idNew->iva_19; ?>" placeholder="IVA 19" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_19" name="total_19" value="<?php echo $idNew->total_19; ?>" placeholder="Total 19" disabled>
                                    </td>
                                </tr>

                                <tr id="sec-20">
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_20" id="detalle_compra_20" rows="3" cols="70" placeholder="Detalle Compra 20" disabled><?php echo $idNew->detalle_compra_20; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" class="form-control" id="buscar_eq_20" name="id_20" value="<?php echo $idNew->id_20; ?>" placeholder="ID Equipo 20" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_20" id="equipo_20" rows="3" cols="70" placeholder="Equipo 20" disabled><?php echo $idNew->equipo_20; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" class="form-control" id="buscar_20" name="c_manager_20" value="<?php echo $idNew->c_manager_20; ?>" placeholder="COD Manager 20" disabled>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_20" id="producto_20" rows="3" cols="70" placeholder="Producto 20" disabled><?php echo $idNew->producto_20; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(247, 242, 255);" class="form-control sizeT" name="u_m_20" id="u_m_20" rows="1" cols="25" placeholder="U/M 20" disabled><?php echo $idNew->u_m_20; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_20" name="cantidad_20" value="<?php echo $idNew->cantidad_20; ?>" placeholder="Cantidad 20" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_20" name="valor_unitario_20" value="<?php echo $idNew->valor_unitario_20; ?>" placeholder="V.Unitario 20" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="neto_20" name="neto_20" value="<?php echo $idNew->neto_20; ?>" placeholder="NETO 20" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="iva_20" name="iva_20" value="<?php echo $idNew->iva_20; ?>" placeholder="IVA 20" disabled>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="total_20" name="total_20" value="<?php echo $idNew->total_20; ?>" placeholder="Total 20" disabled>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>TOTALES</th>
                                    <th><input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="totalNetos" name="neto_gral" value="<?php echo $idNew->neto_gral; ?>" placeholder="TOTAL NETO" disabled></th>
                                    <th><input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="totalIvas" name="iva_gral" value="<?php echo $idNew->iva_gral; ?>" placeholder="TOTAL IVA" disabled></th>
                                    <th><input style="background-color: rgb(247, 242, 255);" type="text" class="form-control" id="totales" name="total_gral" value="<?php echo $idNew->total_gral; ?>" placeholder="TOTAL" disabled></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Termino Tabla -->

                    <!-- Validacion -->
                    <input type="hidden" name="oculto" value="2">
                    <input type="hidden" name="envioID" value="<?php echo $idNew->id_peticiones; ?>"><br>


                    <!-- Botones -->
                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="button" id="myForm3At" class="btn btn-primary" style="width: 10em; margin-right: 1em;">Anterior</button>


                            <button type="submit" class="btn btn-success" style="width: 10em; margin-right: 1em;">Guardar</button>
                            <a href="../../proceso_administrativo.php" class="btn btn-danger" style="width: 10em;">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form><br><br>
    </div>

    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <script src="../../js/bootstrap.js"></script>

    <!-- Ocultar filas -->
    <script src="../../js/ocultarFilasPeticiones.js"></script>

    <!-- Display Forms -->
    <script>
        $("#myForm1").click(function() {
            $("#form-1").css("display", "none");
            $("#form-2").css("display", "block");
        });

        $("#myForm2").click(function() {
            $("#form-2").css("display", "none");
            $("#form-3").css("display", "block");
        });

        // Backs
        $("#myForm2At").click(function() {
            $("#form-1").css("display", "block");
            $("#form-2").css("display", "none");
        });

        $("#myForm3At").click(function() {
            $("#form-2").css("display", "block");
            $("#form-3").css("display", "none");
        });
    </script>

</body>

</html>