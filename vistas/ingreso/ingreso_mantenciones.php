<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "MANTENCION" || $_SESSION['tipo'] === "TECNICOS") {

        if (!isset($_GET['id_relacion_key'])) {
            header('Location: ../../catastro.php');
        }

        include '../../config/conexion.php';

        $id_relacion_key = $_GET['id_relacion_key'];


        // Validacion Datos Repetidos

        $sentenciaMN = $bd->prepare("SELECT id_mantenciones_relacion FROM mantenciones WHERE id_mantenciones_relacion = ?;");   // Compara relacion_id con la variable $id_recepcion_key
        $sentenciaMN->execute([$id_relacion_key]);  // para ver si existe coincidencia

        $idsMantenciones = $sentenciaMN->fetch(PDO::FETCH_OBJ);   // AL HACER UNA CONSULTA WHERE SE DEBE TRANSFORMAR LA SENTENCIA EN OBJETO PARA PODER TRANAJAR CON ELLA

        if (empty($idsMantenciones)) {
            $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
            $sentencia->execute([$id_relacion_key]);

            $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

            $termino_garantia_F = date("d-m-Y", strtotime($idNew->termino_garantia));    // FORMATEO DE FECHA
        } else {
            header('Location: ../../mantenciones.php?result_copy=' . $id_relacion_key . '');  // En vez de enviar "1", se envia id para poder ser usada en la alerta de registro existente (mantenciones.php)
        }

        // Termino
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
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
    <link rel="stylesheet" href="../../css/general_styles.css"> <!-- Estilos Generales -->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../img/favicon.png">
    <title>Ingreso Mantenciones</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="btn btn-primary" href="../../mantenciones.php">HOME</a>
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
            <h3 style="text-align:center; margin-top: 20px;">Ingreso Mantenciones</h3>
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

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/guardar/guardar_mantenciones.php" enctype="multipart/form-data" autocomplete="off">
            <div class="card">
                <h5 class="card-header">Ingreso</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="responsable" class="col-sm-2 control-label">Responsable</label>
                            <input type="text" class="form-control" id="responsable" name="responsable" placeholder="Responsable" required>
                        </div>

                        <div class="form-group col">
                            <label for="correo_responsable" class="col-sm-2 control-label">Correo</label>
                            <input type="email" class="form-control" id="correo_responsable" name="correo_responsable" placeholder="Correo" required>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="ubicacion" class="col-sm-2 control-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicacion" required>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="acreditacion" class="col-sm-2 control-label">Acreditación</label>
                            <select class="form-select" name="acreditacion" id="acreditacion" require>
                                <option value="EQ-2.1">EQ-2.1</option>
                                <option value="EQ-2.2">EQ-2.2</option>
                                <option value="INS-3.1">INS-3.1</option>
                                <option value="INS-3.2">INS-3.2</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="estado" class="col-sm-2 control-label">Estado</label>
                            <select class="form-select" name="estado" id="estado" require>
                                <option value="OPERATIVO">OPERATIVO</option>
                                <option value="EN MP INTERNO">EN MP INTERNO</option>
                                <option value="MP EXTERNO">MP EXTERNO</option>
                                <option value="BAJA">BAJA</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="id_licitacion_convenio" class="col-sm-2 control-label">ID Lici Convenio</label>
                            <input type="text" class="form-control" id="id_licitacion_convenio" name="id_licitacion_convenio" placeholder="ID Licitación Convenio" required>
                        </div>

                        <div class="form-group col">
                            <label for="empresa_adjudicada" class="col-sm-2 control-label">Empr Adjudicada</label>
                            <input type="text" class="form-control" id="empresa_adjudicada" name="empresa_adjudicada" placeholder="Empresa Adjudicada" required>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_inicio_convenio" class="col-sm-2 control-label">Inic Convenio</label>
                            <input type="date" class="form-control" id="fecha_inicio_convenio" name="fecha_inicio_convenio" oninput="months()" placeholder="Inicio Convenio" required>
                        </div><br>

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
                                    <th>Programado</th>
                                    <th>Fecha MP</th>
                                    <th>Adjunto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="mts mts_1">
                                        <input type="month" class="form-control" id="programado_1" name="programado_1" required>
                                    </td>
                                    <td class="mts mts_1">
                                        <input type="date" class="form-control" id="fecha_mp_1" name="fecha_mp_1" require>
                                    </td>
                                    <td class="mts mts_1">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_1" name="adjunto_1">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_2">
                                        <input type="month" class="form-control" id="programado_2" name="programado_2">
                                    </td>
                                    <td class="mts mts_2">
                                        <input type="date" class="form-control" id="fecha_mp_2" name="fecha_mp_2">
                                    </td>
                                    <td class="mts mts_2">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_2" name="adjunto_2">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_3">
                                        <input type="month" class="form-control" id="programado_3" name="programado_3">
                                    </td>
                                    <td class="mts mts_3">
                                        <input type="date" class="form-control" id="fecha_mp_3" name="fecha_mp_3">
                                    </td>
                                    <td class="mts mts_3">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_3" name="adjunto_3">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_4">
                                        <input type="month" class="form-control" id="programado_4" name="programado_4">
                                    </td>
                                    <td class="mts mts_4">
                                        <input type="date" class="form-control" id="fecha_mp_4" name="fecha_mp_4">
                                    </td>
                                    <td class="mts mts_4">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_4" name="adjunto_4">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_5">
                                        <input type="month" class="form-control" id="programado_5" name="programado_5">
                                    </td>
                                    <td class="mts mts_5">
                                        <input type="date" class="form-control" id="fecha_mp_5" name="fecha_mp_5">
                                    </td>
                                    <td class="mts mts_5">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_5" name="adjunto_5">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_6">
                                        <input type="month" class="form-control" id="programado_6" name="programado_6">
                                    </td>
                                    <td class="mts mts_6">
                                        <input type="date" class="form-control" id="fecha_mp_6" name="fecha_mp_6">
                                    </td>
                                    <td class="mts mts_6">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_6" name="adjunto_6">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_7">
                                        <input type="month" class="form-control" id="programado_7" name="programado_7">
                                    </td>
                                    <td class="mts mts_7">
                                        <input type="date" class="form-control" id="fecha_mp_7" name="fecha_mp_7">
                                    </td>
                                    <td class="mts mts_7">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_7" name="adjunto_7">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_8">
                                        <input type="month" class="form-control" id="programado_8" name="programado_8">
                                    </td>
                                    <td class="mts mts_8">
                                        <input type="date" class="form-control" id="fecha_mp_8" name="fecha_mp_8">
                                    </td>
                                    <td class="mts mts_8">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_8" name="adjunto_8">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_9">
                                        <input type="month" class="form-control" id="programado_9" name="programado_9">
                                    </td>
                                    <td class="mts mts_9">
                                        <input type="date" class="form-control" id="fecha_mp_9" name="fecha_mp_9">
                                    </td>
                                    <td class="mts mts_9">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_9" name="adjunto_9">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_10">
                                        <input type="month" class="form-control" id="programado_10" name="programado_10">
                                    </td>
                                    <td class="mts mts_10">
                                        <input type="date" class="form-control" id="fecha_mp_10" name="fecha_mp_10">
                                    </td>
                                    <td class="mts mts_10">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_10" name="adjunto_10">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_11">
                                        <input type="month" class="form-control" id="programado_11" name="programado_11">
                                    </td>
                                    <td class="mts mts_11">
                                        <input type="date" class="form-control" id="fecha_mp_11" name="fecha_mp_11">
                                    </td>
                                    <td class="mts mts_11">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_11" name="adjunto_11">
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_12">
                                        <input type="month" class="form-control" id="programado_12" name="programado_12">
                                    </td>
                                    <td class="mts mts_12">
                                        <input type="date" class="form-control" id="fecha_mp_12" name="fecha_mp_12">
                                    </td>
                                    <td class="mts mts_12">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_12" name="adjunto_12">
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
    <script src="../../js/ocultarFilasMantenciones.js"></script>
</body>

</html>