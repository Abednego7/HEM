<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS") {

        if (!isset($_GET['id_recepcion_key'])) {
            header('Location: ../../catastro.php');
        }

        include '../../config/conexion.php';

        $id_recepcion_key = $_GET['id_recepcion_key'];

        $sentencia = $bd->prepare("SELECT * FROM recepcion WHERE id_recepcion = ?;");
        $sentencia->execute([$id_recepcion_key]);

        $idNew = $sentencia->fetch(PDO::FETCH_OBJ);
    } elseif (
        $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
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
    <title>Modificar Recepción</title>

    <style>
        textarea {
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
                <a class="btn btn-primary" href="../../recepcion_equipo.php">HOME</a>
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
            <h3 style="text-align:center; margin-top: 20px;">Modificar Recepción</h3>
        </div><br>

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/modificar/modificar_recepcion_proceso.php" autocomplete="off">
            <div class="card" id="form-1">
                <h5 class="card-header">Modificar</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="ano_fabrica" class="col-sm-2 control-label">Año Fabri</label>
                            <input type="number" class="form-control" id="ano_fabrica" name="ano_fabrica" value="<?php echo $idNew->ano_fabrica; ?>" placeholder="Año Fabricación" min="2000" max="2099" required>
                        </div>

                        <div class="form-group col">
                            <label for="financiamiento" class="col-sm-2 control-label">Financiamiento</label>
                            <select class="form-select" name="financiamiento" id="financiamiento" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->financiamiento; ?>"><?php echo $idNew->financiamiento; ?></option>
                                <option value="GORE">GORE</option>
                                <option value="MINSAL">MINSAL</option>
                                <option value="DONACION">DONACION</option>
                                <option value="OTRO">OTRO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="producto_solicitado" class="col-sm-2 control-label">Produc Solicitado</label>
                            <input type="text" class="form-control" id="producto_solicitado" name="producto_solicitado" value="<?php echo $idNew->producto_solicitado; ?>" placeholder="Producto Solicitado" required>
                        </div>

                        <div class="form-group col">
                            <label for="requerimiento_tecnico" class="col-sm-2 control-label">Requeri Tec</label>
                            <input type="text" class="form-control" id="requerimiento_tecnico" name="requerimiento_tecnico" value="<?php echo $idNew->requerimiento_tecnico; ?>" placeholder="Requerimiento Tecnico" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="nombre_proyecto" class="col-sm-2 control-label">Nombre_Del_Proyecto</label>
                            <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" value="<?php echo $idNew->nombre_proyecto; ?>" placeholder="Nombre del Proyecto" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="decreto" class="col-sm-2 control-label">Decreto</label>
                            <input type="text" class="form-control" id="decreto" name="decreto" value="<?php echo $idNew->decreto; ?>" placeholder="Decreto" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_decreto" class="col-sm-2 control-label">Fecha Decreto</label>
                            <input type="date" class="form-control" id="fecha_decreto" name="fecha_decreto" value="<?php echo $idNew->fecha_decreto; ?>" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="resolucion_especi_tec" class="col-sm-2 control-label">Resolu Especi Tec</label>
                            <input type="number" class="form-control" id="resolucion_especi_tec" name="resolucion_especi_tec" value="<?php echo $idNew->resolucion_especi_tec; ?>" placeholder="Resolución Especificaciones Tec" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_resolu_especi_tec" class="col-sm-2 control-label">Fecha R.E.T</label>
                            <input type="date" class="form-control" id="fecha_resolu_especi_tec" name="fecha_resolu_especi_tec" value="<?php echo $idNew->fecha_resolu_especi_tec; ?>" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="resolucion_adjudicacion" class="col-sm-2 control-label">Resolu Adjudicación</label>
                            <input type="number" class="form-control" id="resolucion_adjudicacion" name="resolucion_adjudicacion" value="<?php echo $idNew->resolucion_adjudicacion; ?>" placeholder="Resolución Adjudicación" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_de_adjudi" class="col-sm-2 control-label">Fecha Adjudicación</label>
                            <input type="date" class="form-control" id="fecha_de_adjudi" name="fecha_de_adjudi" value="<?php echo $idNew->fecha_de_adjudi; ?>" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="resolucion_contrato" class="col-sm-2 control-label">Resolución Contrato</label>
                            <input type="number" class="form-control" id="resolucion_contrato" name="resolucion_contrato" value="<?php echo $idNew->resolucion_contrato; ?>" placeholder="Resolución Contrato" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_resolu_contrato" class="col-sm-2 control-label">Fecha R.C</label>
                            <input type="date" class="form-control" id="fecha_resolu_contrato" name="fecha_resolu_contrato" value="<?php echo $idNew->fecha_resolu_contrato; ?>" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="tipo_de_compra" class="col-sm-2 control-label">Tipo Compra</label>
                            <select class="form-select" name="tipo_de_compra" id="tipo_de_compra" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->tipo_de_compra; ?>"><?php echo $idNew->tipo_de_compra; ?></option>
                                <option value="LICITACION PUBLICA">LICITACIÓN PUBLICA</option>
                                <option value="TRATO DIRECTO">TRATO DIRECTO</option>
                                <option value="CONVENIO MARCO">CONVENIO MARCO</option>
                                <option value="COMPRA AGIL">COMPRA AGIL</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="orden_compra" class="col-sm-2 control-label">Orden Compra</label>
                            <input type="text" class="form-control" id="orden_compra" name="orden_compra" value="<?php echo $idNew->orden_compra; ?>" placeholder="Orden De Compra" required>
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
                            <label for="fecha_orden_compra" class="col-sm-2 control-label">Fecha O.C</label>
                            <input type="date" class="form-control" id="fecha_orden_compra" name="fecha_orden_compra" value="<?php echo $idNew->fecha_orden_compra; ?>" required>
                        </div>

                        <div class="form-group col">
                            <label for="detalle_orden_compra" class="col-sm-2 control-label">Detalle O.C</label>
                            <input type="text" class="form-control" id="detalle_orden_compra" name="detalle_orden_compra" value="<?php echo $idNew->detalle_orden_compra; ?>" placeholder="Detalle Orden De Compra" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="plazo_entrega" class="col-sm-2 control-label">Plazo Entrega</label>
                            <input type="number" class="form-control" id="plazo_entrega" name="plazo_entrega" value="<?php echo $idNew->plazo_entrega; ?>" placeholder="Plazo Entrega" required>
                        </div>

                        <div class="form-group col">
                            <label for="tipo_de_dias" class="col-sm-2 control-label">Tipo De Dias</label>
                            <select class="form-select" name="tipo_de_dias" id="tipo_de_dias" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->tipo_de_dias; ?>"><?php echo $idNew->tipo_de_dias; ?></option>
                                <option value="DIAS CORRIDOS">DIAS CORRIDOS</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_entrega" class="col-sm-2 control-label">Fecha Entrega</label>
                            <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="<?php echo $idNew->fecha_entrega; ?>" required>
                        </div>

                        <div class="form-group col">
                            <label for="rut" class="col-sm-2 control-label">RUT</label>
                            <input type="text" class="form-control" name="rut" id="rut" value="<?php echo $idNew->rut; ?>" placeholder="Ejem: 00000000-k" maxlength="10" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="proveedor" class="col-sm-2 control-label">Proveedor</label>
                            <select class="form-select" name="proveedor" id="proveedor" required>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->proveedor; ?>"><?php echo $idNew->proveedor; ?></option>
                                <option value="A&O SERV. Y CONSTRUCCIONES LTDA">A&O SERV. Y CONSTRUCCIONES LTDA</option>
                                <option value="ACRILICOS ACRILANDIA SPA">ACRILICOS ACRILANDIA SPA</option>
                                <option value="ADVANCED STERILIZATION PRODUCTS CHILE  SPA">ADVANCED STERILIZATION PRODUCTS CHILE SPA</option>
                                <option value="AGENCIAS INTERNACIONALES S.A.">AGENCIAS INTERNACIONALES S.A.</option>
                                <option value="AGUAS DECIMAS S.A.">AGUAS DECIMAS S.A.</option>
                                <option value="AGUASIN SPA">AGUASIN SPA</option>
                                <option value="AGUIRRE, BRAVO Y MELLADO LTDA (ABMEDICAL)">AGUIRRE, BRAVO Y MELLADO LTDA (ABMEDICAL)</option>
                                <option value="AILLAPAN MELLA EQUIPOS MEDICOS LTDA">AILLAPAN MELLA EQUIPOS MEDICOS LTDA</option>
                                <option value="ANALISIS AMBIENTALES S.A">ANALISIS AMBIENTALES S.A</option>
                                <option value="ANDOVER ALIANZA MEDICA S.A">ANDOVER ALIANZA MEDICA S.A</option>
                                <option value="ARTURO RODRIGUEZ LOPEZ">ARTURO RODRIGUEZ LOPEZ</option>
                                <option value="ASCENSORES SCHINDLER (CHILE) S.A.">ASCENSORES SCHINDLER (CHILE) S.A.</option>
                                <option value="ASESORIA E ING DRJ LTDA">ASESORIA E ING DRJ LTDA</option>
                                <option value="B BRAUN MEDICAL SPA">B BRAUN MEDICAL SPA</option>
                                <option value="BLUEMEDICAL SPA">BLUEMEDICAL SPA</option>
                                <option value="CARESTREAM HEALTH CHILE LTDA">CARESTREAM HEALTH CHILE LTDA</option>
                                <option value="COMERC. E INDUSTRIAL INQUINAT CHILE LTDA.">COMERC. E INDUSTRIAL INQUINAT CHILE LTDA.</option>
                                <option value="COMERCIAL BYG LTDA">COMERCIAL BYG LTDA</option>
                                <option value="COMERCIAL DIMARA LTDA">COMERCIAL DIMARA LTDA</option>
                                <option value="COMERCIAL KENDALL CHILE LTDA">COMERCIAL KENDALL CHILE LTDA</option>
                                <option value="COMERCIALIZADORA SMARTVISION LTDA">COMERCIALIZADORA SMARTVISION LTDA</option>
                                <option value="CONSTRUCTORA BELARMINO JARA LTDA">CONSTRUCTORA BELARMINO JARA LTDA</option>
                                <option value="COTACO LTDA.">COTACO LTDA.</option>
                                <option value="DESARROLLO DE TECNOLOGIAS Y SISTEMAS LTDA">DESARROLLO DE TECNOLOGIAS Y SISTEMAS LTDA</option>
                                <option value="DISTRIBUIDORA Y COMERCIAL DE EQUIPOS ELECTRONICOS INTEGRAL SERVICE LTDA">DISTRIBUIDORA Y COMERCIAL DE EQUIPOS ELECTRONICOS INTEGRAL SERVICE LTDA</option>
                                <option value="DRAGER CHILE LTDA">DRAGER CHILE LTDA</option>
                                <option value="ECM INGENIERIA S.A.">ECM INGENIERIA S.A.</option>
                                <option value="ELECTROM S.A.">ELECTROM S.A.</option>
                                <option value="ENDOS LTDA">ENDOS LTDA</option>
                                <option value="ENEL DISTRIBUCIÓN CHILE S.A.">ENEL DISTRIBUCIÓN CHILE S.A.</option>
                                <option value="ENRIQUE VAZQUEZ Y CIA LTDA. (PROCOMED)">ENRIQUE VAZQUEZ Y CIA LTDA. (PROCOMED)</option>
                                <option value="ENTIDAD TECNICA MONITOREO AGUAS SPA (ETMA)">ENTIDAD TECNICA MONITOREO AGUAS SPA (ETMA)</option>
                                <option value="EQUIMED ELECTRONICA LTDA">EQUIMED ELECTRONICA LTDA</option>
                                <option value="EXTINTORES ALFA VALDIVIA SPA">EXTINTORES ALFA VALDIVIA SPA</option>
                                <option value="FERNANDO ALBERTO VELOSO OLIVA">FERNANDO ALBERTO VELOSO OLIVA</option>
                                <option value="FUENTES Y LONCOMIL LTDA. (CORIMED)">FUENTES Y LONCOMIL LTDA. (CORIMED)</option>
                                <option value="GASCO GLP (GAS LICUADO DE PETROLEO)">GASCO GLP (GAS LICUADO DE PETROLEO)</option>
                                <option value="GEMCO GENERAL MACHINERY S.A.">GEMCO GENERAL MACHINERY S.A.</option>
                                <option value="GENERAL ELECTRIC INTERNATIONAL INC AGENCIA EN CHILE">GENERAL ELECTRIC INTERNATIONAL INC AGENCIA EN CHILE</option>
                                <option value="GENSET ENERGY SOLUTIONS LTDA">GENSET ENERGY SOLUTIONS LTDA</option>
                                <option value="GOLDEN SOLUTIONS SPA">GOLDEN SOLUTIONS SPA</option>
                                <option value="GOMEZ VERGARA Y CIA LTDA">GOMEZ VERGARA Y CIA LTDA</option>
                                <option value="HEMISFERIO SUR S.A.">HEMISFERIO SUR S.A.</option>
                                <option value="HIDROS DEL SUR SPA">HIDROS DEL SUR SPA</option>
                                <option value="IMPORT. DE EQUIPOS FRANCISCO GACITUA EIRL (NEWLAB)">IMPORT. DE EQUIPOS FRANCISCO GACITUA EIRL (NEWLAB)</option>
                                <option value="IMPORT. E INV PROLAB LTDA.">IMPORT. E INV PROLAB LTDA.</option>
                                <option value="IMPORTA. ARQUIMED LTDA">IMPORTA. ARQUIMED LTDA</option>
                                <option value="INDURA S.A">INDURA S.A</option>
                                <option value="INDUSTRIAL Y COMERCIAL BAXTER DE CHILE LTDA">INDUSTRIAL Y COMERCIAL BAXTER DE CHILE LTDA</option>
                                <option value="INDUSTRIAL Y COMERCIAL ROMER HERMANOS LTDA">INDUSTRIAL Y COMERCIAL ROMER HERMANOS LTDA</option>
                                <option value="ING SERVICIOS INTEGRALES LTDA.">ING SERVICIOS INTEGRALES LTDA.</option>
                                <option value="INGENIERIA Y CONSTRUCCION SABATEC SPA">INGENIERIA Y CONSTRUCCION SABATEC SPA</option>
                                <option value="INRA REFRIGERACION INDUSTRIAL SPA">INRA REFRIGERACION INDUSTRIAL SPA</option>
                                <option value="INVERSIONES Y SERVICIOS BALDER LTDA">INVERSIONES Y SERVICIOS BALDER LTDA</option>
                                <option value="JOHNSON Y JOHNSON DE CHILE S.A">JOHNSON Y JOHNSON DE CHILE S.A</option>
                                <option value="JORGE ANDRES VILLAR MUÑOZ">JORGE ANDRES VILLAR MUÑOZ</option>
                                <option value="LABORATORIOS LBC LTDA.">LABORATORIOS LBC LTDA.</option>
                                <option value="LINDE GAS CHILE S.A.">LINDE GAS CHILE S.A.</option>
                                <option value="LUIS ALBERTO MEDEL RIVAS">LUIS ALBERTO MEDEL RIVAS</option>
                                <option value="MANANTIAL S.A.">MANANTIAL S.A.</option>
                                <option value="MANTENGINEER SPA">MANTENGINEER SPA</option>
                                <option value="MEDIPLEX S.A.">MEDIPLEX S.A.</option>
                                <option value="MEDLAND INGENIERIA SPA">MEDLAND INGENIERIA SPA</option>
                                <option value="MISAEL FERNANDO FUENTES PAREDES INGENIERIA EIRL">MISAEL FERNANDO FUENTES PAREDES INGENIERIA EIRL</option>
                                <option value="MORENO ASOCIADOS LTDA">MORENO ASOCIADOS LTDA</option>
                                <option value="NOVENTA GRADOS SPA">NOVENTA GRADOS SPA</option>
                                <option value="OPENFAB SPA">OPENFAB SPA</option>
                                <option value="PENTAFARMA S.A">PENTAFARMA S.A</option>
                                <option value="PHILIPS CHILENA S.A">PHILIPS CHILENA S.A</option>
                                <option value="PROCESOS SANITARIOS SPA">PROCESOS SANITARIOS SPA</option>
                                <option value="PROJECTA LTDA">PROJECTA LTDA</option>
                                <option value="PV EQUIP S.A.">PV EQUIP S.A.</option>
                                <option value="QCLASS SPA">QCLASS SPA</option>
                                <option value="RAUL OYARZUN MENDEZ (VAMPRODEM)">RAUL OYARZUN MENDEZ (VAMPRODEM)</option>
                                <option value="RUDOLF CHILE S.A.">RUDOLF CHILE S.A.</option>
                                <option value="SERV. DE BIOINGENIERIA LTDA.">SERV. DE BIOINGENIERIA LTDA.</option>
                                <option value="SERV. INT. DE EQUIPOS MEDICOS E INDUSTRIALES">SERV. INT. DE EQUIPOS MEDICOS E INDUSTRIALES</option>
                                <option value="SERVICIO DE INGENIERIA EN AGUAS CLINICAS SIAC LTDA">SERVICIO DE INGENIERIA EN AGUAS CLINICAS SIAC LTDA</option>
                                <option value="SERVICIO DE REFRIGERACION Y CLIMATIZACION ISABEL GARRIDO EIRL">SERVICIO DE REFRIGERACION Y CLIMATIZACION ISABEL GARRIDO EIRL</option>
                                <option value="SERVICIOS SIMPLES SPA">SERVICIOS SIMPLES SPA</option>
                                <option value="SIEMENS HEALTCARE EQUIPOS MEDICOS SPA">SIEMENS HEALTCARE EQUIPOS MEDICOS SPA</option>
                                <option value="SINAMED Y CIA LTDA.">SINAMED Y CIA LTDA.</option>
                                <option value="SISTEM PLUS S.A.">SISTEM PLUS S.A.</option>
                                <option value="SOC. DE ING. Y SERV HOGG Y SERRANO LTDA (HOSER)">SOC. DE ING. Y SERV HOGG Y SERRANO LTDA (HOSER)</option>
                                <option value="SOC. DE INSUMOS MEDICOS LTDA (AMTEC)">SOC. DE INSUMOS MEDICOS LTDA (AMTEC)</option>
                                <option value="SOC. VENT MEDICAL LTDA">SOC. VENT MEDICAL LTDA</option>
                                <option value="SOCIEDAD AUSTRAL DE ELECTRICIDAD S.A.">SOCIEDAD AUSTRAL DE ELECTRICIDAD S.A.</option>
                                <option value="SOCIEDAD AUTOMOTRIZ MACKENNA LIMITADA.">SOCIEDAD AUTOMOTRIZ MACKENNA LIMITADA.</option>
                                <option value="ST INGENIERIA Y TECNOLOGIA LTDA">ST INGENIERIA Y TECNOLOGIA LTDA</option>
                                <option value="TECNIGEN S.A.">TECNIGEN S.A.</option>
                                <option value="TECNOIMAGEN S.A.">TECNOIMAGEN S.A.</option>
                                <option value="TELEFONICA DEL SUR S.A.">TELEFONICA DEL SUR S.A.</option>
                                <option value="THYSSENKRUPP ELEVADORES S.A.">THYSSENKRUPP ELEVADORES S.A.</option>
                                <option value="TRASLADOS MANTENIMIENTO Y CONSTRUCCIÓN SPA">TRASLADOS MANTENIMIENTO Y CONSTRUCCIÓN SPA</option>
                                <option value="TRULY NOLEN CHILE S.A.">TRULY NOLEN CHILE S.A.</option>
                                <option value="V&V SEGURIDAD LTDA.">V&V SEGURIDAD LTDA.</option>
                                <option value="VIVENDO IBEROAMERICA SERV. ENERGETICOS SPA">VIVENDO IBEROAMERICA SERV. ENERGETICOS SPA</option>
                                <option value="ZERO IMPACTO INGENIERIA TRABAJOS EN ALTURA Y RESCATE SPA">ZERO IMPACTO INGENIERIA TRABAJOS EN ALTURA Y RESCATE SPA</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="numero_acta" class="col-sm-2 control-label">Numero Acta</label>
                            <input type="text" class="form-control" id="numero_acta" name="numero_acta" value="<?php echo $idNew->numero_acta; ?>" placeholder="Numero Acta" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_recepcion_parcial" class="col-sm-2 control-label">F. Recep Parcial</label>
                            <input type="date" class="form-control" id="fecha_recepcion_parcial" name="fecha_recepcion_parcial" value="<?php echo $idNew->fecha_recepcion_parcial; ?>" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_puesta_marcha" class="col-sm-2 control-label">F. Puesta Marcha</label>
                            <input type="date" class="form-control" id="fecha_puesta_marcha" name="fecha_puesta_marcha" value="<?php echo $idNew->fecha_puesta_marcha; ?>" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_recepcion_final" class="col-sm-2 control-label">F. Recepción Final</label>
                            <input type="date" class="form-control" id="fecha_recepcion_final" name="fecha_recepcion_final" value="<?php echo $idNew->fecha_recepcion_final; ?>" required>
                        </div>

                        <div class="form-group col">
                            <label for="capacitacion" class="col-sm-2 control-label">Capacitación</label>
                            <select class="form-select" name="capacitacion" id="capacitacion" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->capacitacion; ?>"><?php echo $idNew->capacitacion; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_capacitacion" class="col-sm-2 control-label">F. Capacitación</label>
                            <input type="date" class="form-control" id="fecha_capacitacion" name="fecha_capacitacion" value="<?php echo $idNew->fecha_capacitacion; ?>" required>
                        </div>

                        <div class="form-group col">
                            <label for="garantia_fabricante" class="col-sm-2 control-label">Garantia Fabricante</label>
                            <input type="text" class="form-control" id="garantia_fabricante" name="garantia_fabricante" value="<?php echo $idNew->garantia_fabricante; ?>" placeholder="Garantia Fabricante" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_inicio_garanti_fabricante" class="col-sm-2 control-label">F. Inic Gtia Fabri</label>
                            <input type="date" class="form-control" id="fecha_inicio_garanti_fabricante" value="<?php echo $idNew->fecha_inicio_garanti_fabricante; ?>" name="fecha_inicio_garanti_fabricante" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_termino_garanti_fabricante" class="col-sm-2 control-label">F. Term Gtia Fabri</label>
                            <input type="date" class="form-control" id="fecha_termino_garanti_fabricante" value="<?php echo $idNew->fecha_termino_garanti_fabricante; ?>" name="fecha_termino_garanti_fabricante" required>
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
                            <label for="mantenciones_en_garantia" class="col-sm-2 control-label">Mantenciones en Gtia</label>
                            <input type="number" class="form-control" id="mantenciones_en_garantia" value="<?php echo $idNew->mantenciones_en_garantia; ?>" name="mantenciones_en_garantia" placeholder="Mantenciones en Garantia" required>
                        </div>

                        <div class="form-group col">
                            <label for="periodo_mantenci_garanti" class="col-sm-2 control-label">Periodo Mantención Gtia</label>
                            <input type="text" class="form-control" id="periodo_mantenci_garanti" value="<?php echo $idNew->periodo_mantenci_garanti; ?>" name="periodo_mantenci_garanti" placeholder="Periodo Mantención Garantia" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="verificable_entrega" class="col-sm-2 control-label">Verificable Entrega</label>
                            <input type="text" class="form-control" id="verificable_entrega" name="verificable_entrega" value="<?php echo $idNew->verificable_entrega; ?>" placeholder="Verificable Entrega" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_verificable" class="col-sm-2 control-label">F. Verificable</label>
                            <input type="date" class="form-control" id="fecha_verificable" value="<?php echo $idNew->fecha_verificable; ?>" name="fecha_verificable" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="ref_tecnico_recepcion" class="col-sm-2 control-label">Ref Tec Recep</label>
                            <input type="text" class="form-control" id="ref_tecnico_recepcion" name="ref_tecnico_recepcion" value="<?php echo $idNew->ref_tecnico_recepcion; ?>" placeholder="Ref Tecnico Recepción" required>
                        </div>

                        <div class="form-group col">
                            <label for="ref_tecnico_clinico" class="col-sm-2 control-label">Ref Tec Clinico</label>
                            <input type="text" class="form-control" id="ref_tecnico_clinico" name="ref_tecnico_clinico" value="<?php echo $idNew->ref_tecnico_clinico; ?>" placeholder="Ref Tecnico Clinico" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="ref_tecnico_mantencion_1" class="col-sm-2 control-label">Ref Tec Manten 1</label>
                            <select class="form-select" name="ref_tecnico_mantencion_1" id="ref_tecnico_mantencion_1" required>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->ref_tecnico_mantencion_1; ?>"><?php echo $idNew->ref_tecnico_mantencion_1; ?></option>
                                <option value="NARUTO UZUMAKI">NARUTO UZUMAKI</option>
                                <option value="SENKU ISHIGAMI">SENKU ISHIGAMI</option>
                                <option value="IPPO MAKUNOUCHI">IPPO MAKUNOUCHI</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="ref_tecnico_mantencion_2" class="col-sm-2 control-label">Ref Tec Manten 2</label>
                            <select class="form-select" name="ref_tecnico_mantencion_2" id="ref_tecnico_mantencion_2" required>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->ref_tecnico_mantencion_2; ?>"><?php echo $idNew->ref_tecnico_mantencion_2; ?></option>
                                <option value="NARUTO UZUMAKI">NARUTO UZUMAKI</option>
                                <option value="SENKU ISHIGAMI">SENKU ISHIGAMI</option>
                                <option value="IPPO MAKUNOUCHI">IPPO MAKUNOUCHI</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="ref_tecnico_mantencion_3" class="col-sm-2 control-label">Ref Tec Manten 3</label>
                            <select class="form-select" name="ref_tecnico_mantencion_3" id="ref_tecnico_mantencion_3" required>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->ref_tecnico_mantencion_3; ?>"><?php echo $idNew->ref_tecnico_mantencion_3; ?></option>
                                <option value="NARUTO UZUMAKI">NARUTO UZUMAKI</option>
                                <option value="SENKU ISHIGAMI">SENKU ISHIGAMI</option>
                                <option value="IPPO MAKUNOUCHI">IPPO MAKUNOUCHI</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="ref_tecnico_externo" class="col-sm-2 control-label">Ref Tec Externo</label>
                            <input type="text" class="form-control" id="ref_tecnico_externo" name="ref_tecnico_externo" value="<?php echo $idNew->ref_tecnico_externo; ?>" placeholder="Ref Tecnico Externo" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="otro_referente_1" class="col-sm-2 control-label">Otro Referente</label>
                            <input type="text" class="form-control" id="otro_referente_1" name="otro_referente_1" value="<?php echo $idNew->otro_referente_1; ?>" placeholder="Ref" required>
                        </div>

                        <div class="form-group col">
                            <label for="otro_referente_2" class="col-sm-2 control-label">Otro Referente</label>
                            <input type="text" class="form-control" id="otro_referente_2" name="otro_referente_2" value="<?php echo $idNew->otro_referente_2; ?>" placeholder="Ref" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="accesorio_1" class="col-sm-2 control-label">Accesorio 1</label>
                            <input type="text" class="form-control" id="accesorio_1" name="accesorio_1" value="<?php echo $idNew->accesorio_1; ?>" placeholder="Accesorio" min="0">
                        </div>

                        <div class="form-group col">
                            <label for="accesorio_2" class="col-sm-2 control-label">Accesorio 2</label>
                            <input type="text" class="form-control" id="accesorio_2" name="accesorio_2" value="<?php echo $idNew->accesorio_2; ?>" placeholder="Accesorio" min="0">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="accesorio_3" class="col-sm-2 control-label">Accesorio 3</label>
                            <input type="text" class="form-control" id="accesorio_3" name="accesorio_3" value="<?php echo $idNew->accesorio_3; ?>" placeholder="Accesorio" min="0">
                        </div>

                        <div class="form-group col">
                            <label for="accesorio_4" class="col-sm-2 control-label">Accesorio 4</label>
                            <input type="text" class="form-control" id="accesorio_4" name="accesorio_4" value="<?php echo $idNew->accesorio_4; ?>" placeholder="Accesorio" min="0">
                        </div>
                    </div><br>

                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="button" id="myForm3At" class="btn btn-primary" style="width: 10em; margin-right: 1em;">Anterior</button>
                            <button type="button" id="myForm3" class="btn btn-success" style="width: 10em;">Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form 4 -->
            <div class="card form-4" id="form-4">
                <h5 class="card-header">Modificar</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="accesorio_5" class="col-sm-2 control-label">Accesorio 5</label>
                            <input type="text" class="form-control" id="accesorio_5" name="accesorio_5" value="<?php echo $idNew->accesorio_5; ?>" placeholder="Accesorio" min="0">
                        </div>

                        <div class="form-group col">
                            <label for="accesorio_6" class="col-sm-2 control-label">Accesorio 6</label>
                            <input type="text" class="form-control" id="accesorio_6" name="accesorio_6" value="<?php echo $idNew->accesorio_6; ?>" placeholder="Accesorio" min="0">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="accesorio_7" class="col-sm-2 control-label">Accesorio 7</label>
                            <input type="text" class="form-control" id="accesorio_7" name="accesorio_7" value="<?php echo $idNew->accesorio_7; ?>" placeholder="Accesorio" min="0">
                        </div>

                        <div class="form-group col">
                            <label for="accesorio_8" class="col-sm-2 control-label">Accesorio 8</label>
                            <input type="text" class="form-control" id="accesorio_8" name="accesorio_8" value="<?php echo $idNew->accesorio_8; ?>" placeholder="Accesorio" min="0">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="accesorio_9" class="col-sm-2 control-label">Accesorio 9</label>
                            <input type="text" class="form-control" id="accesorio_9" name="accesorio_9" value="<?php echo $idNew->accesorio_9; ?>" placeholder="Accesorio" min="0">
                        </div>

                        <div class="form-group col">
                            <label for="accesorio_10" class="col-sm-2 control-label">Accesorio 10</label>
                            <input type="text" class="form-control" id="accesorio_10" name="accesorio_10" value="<?php echo $idNew->accesorio_10; ?>" placeholder="Accesorio" min="0">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="observaciones" class="col-sm-2 control-label">Observaciones</label>
                            <input type="text" class="form-control" id="observaciones" name="observaciones" value="<?php echo $idNew->observaciones; ?>" placeholder="Ingrese Observaciones">
                        </div>
                    </div><br>

                    <input type="hidden" name="oculto" value="1"> <!-- Validacion -->
                    <input type="hidden" name="envioID" value="<?php echo $idNew->id_recepcion; ?>">

                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="button" id="myForm4At" class="btn btn-primary" style="width: 10em; margin-right: 1em;">Anterior</button>

                            <button type="submit" class="btn btn-success" style="width: 10em; margin-right: 1em;">Guardar</button>
                            <a href="../../recepcion_equipo.php" class="btn btn-danger" style="width: 10em;">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form><br><br>
    </div>

    <!-- Jquery and Bootstrap -->
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

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

        $("#myForm3").click(function() {
            $("#form-3").css("display", "none");
            $("#form-4").css("display", "block");
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

        $("#myForm4At").click(function() {
            $("#form-3").css("display", "block");
            $("#form-4").css("display", "none");
        });
    </script>
</body>

</html>