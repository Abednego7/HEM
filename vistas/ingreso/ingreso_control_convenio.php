<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "MANTENCION") {

        if (!isset($_GET['id_relacion_key'])) {
            header('Location: ../../catastro.php');
        }

        include '../../config/conexion.php';

        $id_relacion_key = $_GET['id_relacion_key'];


        // Validacion Datos Repetidos

        $sentenciaCV = $bd->prepare("SELECT id_control_convenio_relacion FROM control_convenio WHERE id_control_convenio_relacion = ?;");      // Compara relacion_id con la variable $id_recepcion_key
        $sentenciaCV->execute([$id_relacion_key]);                                                    // para ver si existe coincidencia

        $idsControlConvenio = $sentenciaCV->fetch(PDO::FETCH_OBJ);      // AL HACER UNA CONSULTA WHERE SE DEBE TRANSFORMAR LA SENTENCIA EN OBJETO PARA PODER TRANAJAR CON ELLA

        if (empty($idsControlConvenio)) {                                      // VALIDA SI relacion_id ESTA VACIA
            $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
            $sentencia->execute([$id_relacion_key]);

            $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

            $termino_garantia_F = date("d-m-Y", strtotime($idNew->termino_garantia));    // ! FORMATEO DE FECHA
        } else {
            echo '<script type="text/javascript">alert("Imposible Crear Recepción: Datos Repetidos"); window.location.href="../../catastro.php";</script>';

            header('Location: ../../control_convenio.php?result_copy=' . $id_relacion_key . '');  // En vez de enviar "1", se envia id para poder ser usada en la alerta de registro existente (nueva_recepcion.php)
        }

        // Termino
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: ../../catastro.php');
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
    <link rel="stylesheet" href="../../general_styles.css"> <!-- Estilos Generales -->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../img/favicon.png">
    <title>Ingreso Control Convenio</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="btn btn-primary" href="../../nuevo_control_convenio.php">HOME</a>
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
            <h3 style="text-align:center; margin-top: 20px;">Ingreso Control Convenio</h3>
        </div><br>

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Información
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="form-group col">
                                <label for="equipo" class="col-sm-2 control-label">Equipo</label>
                                <input type="text" class="form-control" id="equipo" value="<?php echo $idNew->equipo; ?>" disabled>
                            </div>

                            <div class=" form-group col">
                                <label for="marca" class="col-sm-2 control-label">Marca</label>
                                <input type="text" class="form-control" id="marca" value="<?php echo $idNew->marca; ?>" disabled>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="form-group col">
                                <label for="modelo" class="col-sm-2 control-label">Modelo</label>
                                <input type="text" class="form-control" id="modelo" value="<?php echo $idNew->modelo; ?>" disabled>
                            </div>

                            <div class=" form-group col">
                                <label for="serie" class="col-sm-2 control-label">Serie</label>
                                <input type="text" class="form-control" id="serie" value="<?php echo $idNew->serie; ?>" disabled>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="form-group col">
                                <label for="num_inventario" class="col-sm-2 control-label">Número Inventario</label>
                                <input type="text" class="form-control" id="num_inventario" value="<?php echo $idNew->num_inventario; ?>" disabled>
                            </div>

                            <div class="form-group col">
                                <label for="termino_garantia" class="col-sm-2 control-label">Term Gtia</label>
                                <input type="text" class="form-control" id="termino_garantia" value="<?php echo $termino_garantia_F; ?>" disabled>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="form-group col">
                                <label for="servicio" class="col-sm-2 control-label">Servicio</label>
                                <input type="text" class="form-control" id="servicio" value="<?php echo $idNew->servicio; ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/guardar/guardar_control_convenio.php" autocomplete="off">
            <div class="card">
                <h5 class="card-header">Ingreso</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="responsable" class="col-sm-2 control-label">Responsable</label>
                            <select class="form-select" name="responsable" id="responsable" oninput="correo_respon()" require>
                                <option value="0">SELECCIONE</option>
                                <option value="BAKI HANMA">BAKI HANMA</option>
                                <option value="RETSU KAIOH">RETSU KAIOH</option>
                                <option value="JACK HANMA">JACK HANMA</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="correo_responsable" class="col-sm-2 control-label">Correo</label>
                            <input type="email" class="form-control" id="correo_responsable" name="correo_responsable" placeholder="Correo" readonly>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="grupo" class="col-sm-2 control-label">Grupo</label>
                            <input type="text" class="form-control" id="grupo" name="grupo" placeholder="Grupo" required>
                        </div>

                        <div class="form-group col">
                            <label for="id_licitacion_convenio" class="col-sm-2 control-label">ID Lici Conve</label>
                            <input type="text" class="form-control" id="id_licitacion_convenio" name="id_licitacion_convenio" placeholder="ID Licitación Convenio" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="empresa_adjudicada" class="col-sm-2 control-label">Emp Adjudicada</label>
                            <input type="text" class="form-control" id="empresa_adjudicada" name="empresa_adjudicada" placeholder="Empresa Adjudicada" required>
                        </div>

                        <div class="form-group col">
                            <label for="equipo_critico_m_c" class="col-sm-2 control-label">Eq.Criti>Complejo</label>
                            <select class="form-select" name="equipo_critico_m_c" id="equipo_critico_m_c" require>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="ubicacion" class="col-sm-2 control-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicacion" required>
                        </div>

                        <div class="form-group col">
                            <label for="edificio" class="col-sm-2 control-label">Edificio</label>
                            <select class="form-select" name="edificio" id="edificio" require>
                                <option value="CA">CA</option>
                                <option value="CAR">CAR</option>
                                <option value="CE1">CE1</option>
                                <option value="CE2">CE2</option>
                                <option value="E">E</option>
                                <option value="G">G</option>
                                <option value="H">H</option>
                                <option value="H1">H1</option>
                                <option value="H2">H2</option>
                                <option value="PATIO">PATIO</option>
                                <option value="SET">SET</option>
                                <option value="HE">HE</option>
                                <option value="J">J</option>
                                <option value="L">L</option>
                                <option value="LAV">LAV</option>
                                <option value="O">O</option>
                                <option value="P">P</option>
                                <option value="PQE">PQE</option>
                                <option value="R">R</option>
                                <option value="S">S</option>
                                <option value="T">T</option>
                                <option value="U1">U1</option>
                                <option value="U2">U2</option>
                                <option value="ZE">ZE</option>
                                <option value="ENTRE PISO">ENTRE PISO</option>
                                <option value="ESTACIONAMIENTO">ESTACIONAMIENTO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="piso" class="col-sm-2 control-label">Piso</label>
                            <select class="form-select" name="piso" id="piso" require>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="ZOCALO">ZOCALO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="sala_pasillo" class="col-sm-2 control-label">Sala/Pasillo</label>
                            <input type="number" class="form-control" id="sala_pasillo" name="sala_pasillo" min="0" max="300" placeholder="Sala/Pasillo" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="ejecutivo_compra" class="col-sm-2 control-label">Ejecut Compra</label>
                            <select class="form-select" name="ejecutivo_compra" id="ejecutivo_compra" oninput="correo_eject()" require>
                                <option value="0">SELECCIONE</option>
                                <option value="YUICHIRO HANMA">YUICHIRO HANMA</option>
                                <option value="YUJIRO HANMA">YUJIRO HANMA</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="correo_ejecutivo" class="col-sm-2 control-label">Correo</label>
                            <input type="email" class="form-control" id="correo_ejecutivo" name="correo_ejecutivo" placeholder="Correo Ejecutivo" readonly>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_inicio_convenio" class="col-sm-2 control-label">Inic Convenio</label>
                            <input type="date" class="form-control" id="fecha_inicio_convenio" name="fecha_inicio_convenio" oninput="months()" placeholder="Inicio Convenio" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_termino_convenio" class="col-sm-2 control-label">Trm Convenio</label>
                            <input type="date" class="form-control" id="fecha_termino_convenio" name="fecha_termino_convenio" oninput="months()" placeholder="Termino Convenio" required>
                        </div>

                        <div class="form-group col">
                            <label for="duracion_en_meses" class="col-sm-2 control-label">Dura/Meses</label>
                            <input type="text" class="form-control" id="duracion_en_meses" name="duracion_en_meses" readonly>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="peridiocidad" class="col-sm-2 control-label">Peridiocidad</label>
                            <select class="form-select" name="peridiocidad" id="peridiocidad" oninput="maintenance()" require>
                                <option value="">SELECCIONE</option>
                                <option value="SEMANAL">SEMANAL</option>
                                <option value="MENSUAL">MENSUAL</option>
                                <option value="BIMENSUAL">BIMENSUAL</option>
                                <option value="TRIMESTRAL">TRIMESTRAL</option>
                                <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                <option value="SEMESTRAL">SEMESTRAL</option>
                                <option value="ANUAL">ANUAL</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="n_manten_preventivas" class="col-sm-2 control-label">N Mante Preventivas</label>
                            <input type="text" class="form-control" id="n_manten_preventivas" name="n_manten_preventivas" style="margin-bottom: 0.5rem;" readonly>

                            <button type="button" class="btn btn-info" id="mostrarFilas" style="width: 7em;">Generar</button>

                            <button type="button" class="btn btn-warning" id="borrarFilas" style="width: 7em;">Borrar</button>
                        </div>
                    </div><br>


                    <!-- Inicio Tabla -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Valor Mant</th>
                                    <th>Fecha Mant</th>
                                    <th>Fecha Recepción</th>
                                    <th>O.C</th>
                                    <th>Fecha O.C</th>
                                    <th>Verificable Mant</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="mts mts_1">
                                        <input type="number" class="form-control" id="valor_mantencion_1" name="valor_mantencion_1" placeholder="Valor Mantención" min="1" required>
                                    </td>
                                    <td class="mts mts_1">
                                        <input type="date" class="form-control" id="fecha_mantencion_1" name="fecha_mantencion_1" require>
                                    </td>
                                    <td class="mts mts_1">
                                        <input type="date" class="form-control" id="fecha_recep_mant_1" name="fecha_recep_mant_1" require>
                                    </td>
                                    <td class="mts mts_1">
                                        <input type="text" class="form-control" id="orden_compra_mant_1" name="orden_compra_mant_1" placeholder="Orden de Compra" require>
                                    </td>
                                    <td class="mts mts_1">
                                        <input type="date" class="form-control" id="fecha_oc_mant_1" name="fecha_oc_mant_1" require>
                                    </td>
                                    <td class="mts mts_1">
                                        <input type="text" class="form-control" id="verificable_mant_1" name="verificable_mant_1" placeholder="Verificable" require>
                                    </td>
                                    <td class="mts mts_1">
                                        <textarea class="form-control sizeT" name="observacion_mant_1" id="observacion_mant_1" rows="4" placeholder="Observación" require></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_2">
                                        <input type="number" class="form-control" id="valor_mantencion_2" name="valor_mantencion_2" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_2">
                                        <input type="date" class="form-control" id="fecha_mantencion_2" name="fecha_mantencion_2">
                                    </td>
                                    <td class="mts mts_2">
                                        <input type="date" class="form-control" id="fecha_recep_mant_2" name="fecha_recep_mant_2">
                                    </td>
                                    <td class="mts mts_2">
                                        <input type="text" class="form-control" id="orden_compra_mant_2" name="orden_compra_mant_2" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_2">
                                        <input type="date" class="form-control" id="fecha_oc_mant_2" name="fecha_oc_mant_2">
                                    </td>
                                    <td class="mts mts_2">
                                        <input type="text" class="form-control" id="verificable_mant_2" name="verificable_mant_2" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_2">
                                        <textarea class="form-control sizeT" name="observacion_mant_2" id="observacion_mant_2" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_3">
                                        <input type="number" class="form-control" id="valor_mantencion_3" name="valor_mantencion_3" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_3">
                                        <input type="date" class="form-control" id="fecha_mantencion_3" name="fecha_mantencion_3">
                                    </td>
                                    <td class="mts mts_3">
                                        <input type="date" class="form-control" id="fecha_recep_mant_3" name="fecha_recep_mant_3">
                                    </td>
                                    <td class="mts mts_3">
                                        <input type="text" class="form-control" id="orden_compra_mant_3" name="orden_compra_mant_3" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_3">
                                        <input type="date" class="form-control" id="fecha_oc_mant_3" name="fecha_oc_mant_3">
                                    </td>
                                    <td class="mts mts_3">
                                        <input type="text" class="form-control" id="verificable_mant_3" name="verificable_mant_3" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_3">
                                        <textarea class="form-control sizeT" name="observacion_mant_3" id="observacion_mant_3" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_4">
                                        <input type="number" class="form-control" id="valor_mantencion_4" name="valor_mantencion_4" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_4">
                                        <input type="date" class="form-control" id="fecha_mantencion_4" name="fecha_mantencion_4">
                                    </td>
                                    <td class="mts mts_4">
                                        <input type="date" class="form-control" id="fecha_recep_mant_4" name="fecha_recep_mant_4">
                                    </td>
                                    <td class="mts mts_4">
                                        <input type="text" class="form-control" id="orden_compra_mant_4" name="orden_compra_mant_4" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_4">
                                        <input type="date" class="form-control" id="fecha_oc_mant_4" name="fecha_oc_mant_4">
                                    </td>
                                    <td class="mts mts_4">
                                        <input type="text" class="form-control" id="verificable_mant_4" name="verificable_mant_4" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_4">
                                        <textarea class="form-control sizeT" name="observacion_mant_4" id="observacion_mant_4" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_5">
                                        <input type="number" class="form-control" id="valor_mantencion_5" name="valor_mantencion_5" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_5">
                                        <input type="date" class="form-control" id="fecha_mantencion_5" name="fecha_mantencion_5">
                                    </td>
                                    <td class="mts mts_5">
                                        <input type="date" class="form-control" id="fecha_recep_mant_5" name="fecha_recep_mant_5">
                                    </td>
                                    <td class="mts mts_5">
                                        <input type="text" class="form-control" id="orden_compra_mant_5" name="orden_compra_mant_5" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_5">
                                        <input type="date" class="form-control" id="fecha_oc_mant_5" name="fecha_oc_mant_5">
                                    </td>
                                    <td class="mts mts_5">
                                        <input type="text" class="form-control" id="verificable_mant_5" name="verificable_mant_5" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_5">
                                        <textarea class="form-control sizeT" name="observacion_mant_5" id="observacion_mant_5" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_6">
                                        <input type="number" class="form-control" id="valor_mantencion_6" name="valor_mantencion_6" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_6">
                                        <input type="date" class="form-control" id="fecha_mantencion_6" name="fecha_mantencion_6">
                                    </td>
                                    <td class="mts mts_6">
                                        <input type="date" class="form-control" id="fecha_recep_mant_6" name="fecha_recep_mant_6">
                                    </td>
                                    <td class="mts mts_6">
                                        <input type="text" class="form-control" id="orden_compra_mant_6" name="orden_compra_mant_6" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_6">
                                        <input type="date" class="form-control" id="fecha_oc_mant_6" name="fecha_oc_mant_6">
                                    </td>
                                    <td class="mts mts_6">
                                        <input type="text" class="form-control" id="verificable_mant_6" name="verificable_mant_6" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_6">
                                        <textarea class="form-control sizeT" name="observacion_mant_6" id="observacion_mant_6" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_7">
                                        <input type="number" class="form-control" id="valor_mantencion_7" name="valor_mantencion_7" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_7">
                                        <input type="date" class="form-control" id="fecha_mantencion_7" name="fecha_mantencion_7">
                                    </td>
                                    <td class="mts mts_7">
                                        <input type="date" class="form-control" id="fecha_recep_mant_7" name="fecha_recep_mant_7">
                                    </td>
                                    <td class="mts mts_7">
                                        <input type="text" class="form-control" id="orden_compra_mant_7" name="orden_compra_mant_7" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_7">
                                        <input type="date" class="form-control" id="fecha_oc_mant_7" name="fecha_oc_mant_7">
                                    </td>
                                    <td class="mts mts_7">
                                        <input type="text" class="form-control" id="verificable_mant_7" name="verificable_mant_7" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_7">
                                        <textarea class="form-control sizeT" name="observacion_mant_7" id="observacion_mant_7" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_8">
                                        <input type="number" class="form-control" id="valor_mantencion_8" name="valor_mantencion_8" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_8">
                                        <input type="date" class="form-control" id="fecha_mantencion_8" name="fecha_mantencion_8">
                                    </td>
                                    <td class="mts mts_8">
                                        <input type="date" class="form-control" id="fecha_recep_mant_8" name="fecha_recep_mant_8">
                                    </td>
                                    <td class="mts mts_8">
                                        <input type="text" class="form-control" id="orden_compra_mant_8" name="orden_compra_mant_8" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_8">
                                        <input type="date" class="form-control" id="fecha_oc_mant_8" name="fecha_oc_mant_8">
                                    </td>
                                    <td class="mts mts_8">
                                        <input type="text" class="form-control" id="verificable_mant_8" name="verificable_mant_8" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_8">
                                        <textarea class="form-control sizeT" name="observacion_mant_8" id="observacion_mant_8" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_9">
                                        <input type="number" class="form-control" id="valor_mantencion_9" name="valor_mantencion_9" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_9">
                                        <input type="date" class="form-control" id="fecha_mantencion_9" name="fecha_mantencion_9">
                                    </td>
                                    <td class="mts mts_9">
                                        <input type="date" class="form-control" id="fecha_recep_mant_9" name="fecha_recep_mant_9">
                                    </td>
                                    <td class="mts mts_9">
                                        <input type="text" class="form-control" id="orden_compra_mant_9" name="orden_compra_mant_9" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_9">
                                        <input type="date" class="form-control" id="fecha_oc_mant_9" name="fecha_oc_mant_9">
                                    </td>
                                    <td class="mts mts_9">
                                        <input type="text" class="form-control" id="verificable_mant_9" name="verificable_mant_9" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_9">
                                        <textarea class="form-control sizeT" name="observacion_mant_9" id="observacion_mant_9" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_10">
                                        <input type="number" class="form-control" id="valor_mantencion_10" name="valor_mantencion_10" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_10">
                                        <input type="date" class="form-control" id="fecha_mantencion_10" name="fecha_mantencion_10">
                                    </td>
                                    <td class="mts mts_10">
                                        <input type="date" class="form-control" id="fecha_recep_mant_10" name="fecha_recep_mant_10">
                                    </td>
                                    <td class="mts mts_10">
                                        <input type="text" class="form-control" id="orden_compra_mant_10" name="orden_compra_mant_10" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_10">
                                        <input type="date" class="form-control" id="fecha_oc_mant_10" name="fecha_oc_mant_10">
                                    </td>
                                    <td class="mts mts_10">
                                        <input type="text" class="form-control" id="verificable_mant_10" name="verificable_mant_10" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_10">
                                        <textarea class="form-control sizeT" name="observacion_mant_10" id="observacion_mant_10" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_11">
                                        <input type="number" class="form-control" id="valor_mantencion_11" name="valor_mantencion_11" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_11">
                                        <input type="date" class="form-control" id="fecha_mantencion_11" name="fecha_mantencion_11">
                                    </td>
                                    <td class="mts mts_11">
                                        <input type="date" class="form-control" id="fecha_recep_mant_11" name="fecha_recep_mant_11">
                                    </td>
                                    <td class="mts mts_11">
                                        <input type="text" class="form-control" id="orden_compra_mant_11" name="orden_compra_mant_11" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_11">
                                        <input type="date" class="form-control" id="fecha_oc_mant_11" name="fecha_oc_mant_11">
                                    </td>
                                    <td class="mts mts_11">
                                        <input type="text" class="form-control" id="verificable_mant_11" name="verificable_mant_11" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_11">
                                        <textarea class="form-control sizeT" name="observacion_mant_11" id="observacion_mant_11" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_12">
                                        <input type="number" class="form-control" id="valor_mantencion_12" name="valor_mantencion_12" placeholder="Valor Mantención" min="1">
                                    </td>
                                    <td class="mts mts_12">
                                        <input type="date" class="form-control" id="fecha_mantencion_12" name="fecha_mantencion_12">
                                    </td>
                                    <td class="mts mts_12">
                                        <input type="date" class="form-control" id="fecha_recep_mant_12" name="fecha_recep_mant_12">
                                    </td>
                                    <td class="mts mts_12">
                                        <input type="text" class="form-control" id="orden_compra_mant_12" name="orden_compra_mant_12" placeholder="Orden de Compra">
                                    </td>
                                    <td class="mts mts_12">
                                        <input type="date" class="form-control" id="fecha_oc_mant_12" name="fecha_oc_mant_12">
                                    </td>
                                    <td class="mts mts_12">
                                        <input type="text" class="form-control" id="verificable_mant_12" name="verificable_mant_12" placeholder="Verificable">
                                    </td>
                                    <td class="mts mts_12">
                                        <textarea class="form-control sizeT" name="observacion_mant_12" id="observacion_mant_12" rows="4" placeholder="Observación"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Termino Tabla -->


                    <!-- Validacion -->
                    <input type="hidden" name="oculto" value="1">
                    <input type="hidden" name="envioID" value="<?php echo $idNew->id_relacion; ?>">
                    <br>

                    <!-- Botones -->
                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success" style="width: 10em; margin-right: 1em;">Guardar</button>
                            <a href="../../catastro.php" class="btn btn-danger" style="width: 10em;">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form><br><br>
    </div>


    <script type="text/javascript" src="../../js/calculoMeses.js"></script>

    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>


    <script type="text/javascript" src="../../js/main.js"></script>

    <!-- Ocultar filas -->
    <script src="../../js/ocultarFilasControlConvenio.js"></script>

    <!-- Selects -->
    <script src="../../js/selectDinamico.js"></script>
</body>

</html>