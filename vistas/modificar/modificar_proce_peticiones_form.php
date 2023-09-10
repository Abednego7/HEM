<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL") {

        if (!isset($_GET['id_proceso_peti_key'])) {
            exit();
        }

        include '../../config/conexion.php';

        $id_proceso_peti_key = $_GET['id_proceso_peti_key'];

        $sentencia = $bd->prepare("SELECT * FROM proceso_peticiones WHERE id_peticiones = ?;");
        $sentencia->execute([$id_proceso_peti_key]);

        $idNew = $sentencia->fetch(PDO::FETCH_OBJ);


        // REGISTROS DE CATASTRO
        $sentencia = $bd->query("SELECT * FROM equipamiento ORDER BY id_relacion;");
        $equipamiento = $sentencia->fetchAll(PDO::FETCH_OBJ);
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS"
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

    <!-- DataTables JS-->
    <link rel="stylesheet" href="../../datatables/datatables.min.css">
    <link rel="stylesheet" href="../../datatables/DataTables-1.10.25/css/dataTables.bootstrap5.min.css">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../img/favicon.png">
    <title>Modificar Proceso Peticiones</title>

    <style>
        .sizeT {
            resize: none;
        }

        .select-1 {
            width: 8em;
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
                <a class="btn btn-primary" href="../../proceso_peticiones.php">HOME</a>
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
            <h3 style="text-align:center; margin-top: 20px;">Modificar Proceso Peticiones</h3>
        </div><br>

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/modificar/modificar_proceso_peticiones.php" autocomplete="off">
            <!-- Form 1 -->
            <div class="card" id="form-1">
                <h5 class="card-header">Modificar</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="sub_depto" class="col-sm-2 control-label">Sub Depto</label>
                            <select class="form-select" name="sub_depto" id="sub_depto" onchange="cargarUnidades();" require>
                                <option value="<?php echo $idNew->sub_depto; ?>"><?php echo $idNew->sub_depto; ?></option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="unidad" class="col-sm-2 control-label">Uni Especifica</label>
                            <select class="form-select" name="unidad" id="unidad" require>
                                <option value="<?php echo $idNew->unidad; ?>"><?php echo $idNew->unidad; ?></option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="exigencia" class="col-sm-2 control-label">Exigencia</label>
                            <select class="form-select" name="exigencia" id="exigencia">
                                <option value="<?php echo $idNew->exigencia; ?>"><?php echo $idNew->exigencia; ?></option>
                                <option value="NORMAL">NORMAL</option>
                                <option value="URGENTE">URGENTE</option>
                                <option value="PRIORITARIA">PRIORITARIA</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="acreditacion" class="col-sm-2 control-label">Acreditación</label>
                            <select class="form-select" name="acreditacion" id="acreditacion">
                                <option value="<?php echo $idNew->acreditacion; ?>"><?php echo $idNew->acreditacion; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="categoria" class="col-sm-2 control-label">Categoría</label>
                            <select class="form-select" name="categoria" id="categoria">
                                <option value="<?php echo $idNew->categoria; ?>"><?php echo $idNew->categoria; ?></option>
                                <option value="EQUIPAMIENTO">EQUIPAMIENTO</option>
                                <option value="INSTRUMENTAL">INSTRUMENTAL</option>
                                <option value="MATERIALES">MATERIALES</option>
                                <option value="SERVICIOS">SERVICIOS</option>
                                <option value="ALIMENTOS">ALIMENTOS</option>
                                <option value="LAVANDERIA">LAVANDERIA</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="covid" class="col-sm-2 control-label">Covid</label>
                            <select class="form-select" name="covid" id="covid">
                                <option value="<?php echo $idNew->covid; ?>"><?php echo $idNew->covid; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="" class="col-sm-2 control-label">Ref Tec (R.T)</label>
                            <select class="form-select" name="ref_tec_1" id="ref_tec_1" oninput="refTec1()">
                                <option value="<?php echo $idNew->ref_tec_1; ?>"><?php echo $idNew->ref_tec_1; ?></option>
                                <option value="GRECIA SANCHEZ MACHO">GRECIA SANCHEZ MACHO</option>
                                <option value="FABIAN FLANDEZ">FABIAN FLANDEZ</option>
                                <option value="JOSE LUIS ORELLANA">JOSE LUIS ORELLANA</option>
                                <option value="RICHARD MARDONES">RICHARD MARDONES</option>
                                <option value="RODRIGO GUTIERREZ">RODRIGO GUTIERREZ</option>
                                <option value="ALEX REYES HENRQUEZ">ALEX REYES HENRQUEZ</option>
                                <option value="ALEJANDRO AMPUERO">ALEJANDRO AMPUERO</option>
                                <option value="LUIS DELGADO">LUIS DELGADO</option>
                                <option value="JUAN AGUILA">JUAN AGUILA</option>
                                <option value="JORGE PINO">JORGE PINO</option>
                                <option value="SEBASTIAN TORRES">SEBASTIAN TORRES</option>
                                <option value="JOSE LUIS CEBALLOS">JOSE LUIS CEBALLOS</option>
                                <option value="ANDRES MARTINEZ">ANDRES MARTINEZ</option>
                                <option value="ERWIN FERNANDEZ">ERWIN FERNANDEZ</option>
                                <option value="ABNER BECERRA VIVES">ABNER BECERRA VIVES</option>
                                <option value="SOLANGE SAAVEDRA">SOLANGE SAAVEDRA</option>
                                <option value="JUVENAL SANHUEZA">JUVENAL SANHUEZA</option>
                                <option value="CHRISTIAN FARIAS">CHRISTIAN FARIAS</option>
                                <option value="MARIAJOSE MARIANJEL">MARIAJOSE MARIANJEL</option>
                                <option value="ANITA COTAL">ANITA COTAL</option>
                                <option value="MARIA JOSE GOMEZ">MARIA JOSE GOMEZ</option>
                                <option value="CLAUDIO POZO">CLAUDIO POZO</option>
                                <option value="CARLOS HOFFMAN">CARLOS HOFFMAN</option>
                                <option value="JOCELYN PEREZ">JOCELYN PEREZ</option>
                                <option value="VANNESSA ANDRADE">VANNESSA ANDRADE</option>
                                <option value="CAROLINA TENORIO">CAROLINA TENORIO</option>
                                <option value="RAYER THIELE RUEGER">RAYER THIELE RUEGER</option>
                                <option value="JOSE ALFREDO ARCE REINOSO">JOSE ALFREDO ARCE REINOSO</option>
                                <option value="JOSE MIGUEL SANCHO">JOSE MIGUEL SANCHO</option>
                                <option value="CESAR ESPINA">CESAR ESPINA</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="cargo_ref_tec_1" class="col-sm-2 control-label">Cargo R.T</label>
                            <input style="background-color: rgb(230, 230, 250);" type="text" class="form-control" id="cargo_ref_tec_1" name="cargo_ref_tec_1" value="<?php echo $idNew->cargo_ref_tec_1; ?>" maxlength="30" placeholder="Cargo Ref Tec 1" readonly>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="" class="col-sm-2 control-label">Ref Tec (R.T)</label>
                            <select class="form-select" name="ref_tec_2" id="ref_tec_2" oninput="refTec2()">
                                <option value="<?php echo $idNew->ref_tec_2; ?>"><?php echo $idNew->ref_tec_2; ?></option>
                                <option value="GRECIA SANCHEZ MACHO">GRECIA SANCHEZ MACHO</option>
                                <option value="FABIAN FLANDEZ">FABIAN FLANDEZ</option>
                                <option value="JOSE LUIS ORELLANA">JOSE LUIS ORELLANA</option>
                                <option value="RICHARD MARDONES">RICHARD MARDONES</option>
                                <option value="RODRIGO GUTIERREZ">RODRIGO GUTIERREZ</option>
                                <option value="ALEX REYES HENRQUEZ">ALEX REYES HENRQUEZ</option>
                                <option value="ALEJANDRO AMPUERO">ALEJANDRO AMPUERO</option>
                                <option value="LUIS DELGADO">LUIS DELGADO</option>
                                <option value="JUAN AGUILA">JUAN AGUILA</option>
                                <option value="JORGE PINO">JORGE PINO</option>
                                <option value="SEBASTIAN TORRES">SEBASTIAN TORRES</option>
                                <option value="JOSE LUIS CEBALLOS">JOSE LUIS CEBALLOS</option>
                                <option value="ANDRES MARTINEZ">ANDRES MARTINEZ</option>
                                <option value="ERWIN FERNANDEZ">ERWIN FERNANDEZ</option>
                                <option value="ABNER BECERRA VIVES">ABNER BECERRA VIVES</option>
                                <option value="SOLANGE SAAVEDRA">SOLANGE SAAVEDRA</option>
                                <option value="JUVENAL SANHUEZA">JUVENAL SANHUEZA</option>
                                <option value="CHRISTIAN FARIAS">CHRISTIAN FARIAS</option>
                                <option value="MARIAJOSE MARIANJEL">MARIAJOSE MARIANJEL</option>
                                <option value="ANITA COTAL">ANITA COTAL</option>
                                <option value="MARIA JOSE GOMEZ">MARIA JOSE GOMEZ</option>
                                <option value="CLAUDIO POZO">CLAUDIO POZO</option>
                                <option value="CARLOS HOFFMAN">CARLOS HOFFMAN</option>
                                <option value="JOCELYN PEREZ">JOCELYN PEREZ</option>
                                <option value="VANNESSA ANDRADE">VANNESSA ANDRADE</option>
                                <option value="CAROLINA TENORIO">CAROLINA TENORIO</option>
                                <option value="RAYER THIELE RUEGER">RAYER THIELE RUEGER</option>
                                <option value="JOSE ALFREDO ARCE REINOSO">JOSE ALFREDO ARCE REINOSO</option>
                                <option value="JOSE MIGUEL SANCHO">JOSE MIGUEL SANCHO</option>
                                <option value="CESAR ESPINA">CESAR ESPINA</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="cargo_ref_tec_2" class="col-sm-2 control-label">Cargo R.T</label>
                            <input style="background-color: rgb(230, 230, 250);" type="text" class="form-control" id="cargo_ref_tec_2" name="cargo_ref_tec_2" value="<?php echo $idNew->cargo_ref_tec_2; ?>" maxlength="30" placeholder="Cargo Ref Tec 2" readonly>
                        </div>

                        <div class="form-group col">
                            <label for="serv_usuario" class="col-sm-2 control-label">Servicio</label>
                            <select class="form-select" name="serv_usuario" id="serv_usuario">
                                <option value="<?php echo $idNew->serv_usuario; ?>"><?php echo $idNew->serv_usuario; ?></option>
                                <option value="ABASTECIMIENTO">ABASTECIMIENTO</option>
                                <option value="UNIDAD CENTRAL DE PRODUCCION">UNIDAD CENTRAL DE PRODUCCION</option>
                                <option value="ANATOMIA PATOLOGICA">ANATOMIA PATOLOGICA</option>
                                <option value="ARO - OBSTETRICIA">ARO - OBSTETRICIA</option>
                                <option value="BANCO DE SANGRE">BANCO DE SANGRE</option>
                                <option value="C. DIALISIS VIDADIAL LANCO">C. DIALISIS VIDADIAL LANCO</option>
                                <option value="CAPACITACION">CAPACITACION</option>
                                <option value="CATARATAS Y VITRECTOMIAS">CATARATAS Y VITRECTOMIAS</option>
                                <option value="CENTRO CORTA ESTADIA">CENTRO CORTA ESTADIA</option>
                                <option value="CENTRO SALUD HOSPITAL DE DIA">CENTRO SALUD HOSPITAL DE DIA</option>
                                <option value="CHILE CRECE CONTIGO">CHILE CRECE CONTIGO</option>
                                <option value="CIRUGIA ADULTO">CIRUGIA ADULTO</option>
                                <option value="CIRUGIA INFANTIL">CIRUGIA INFANTIL</option>
                                <option value="CIRUGIA MAYOR AMBULATORIA">CIRUGIA MAYOR AMBULATORIA</option>
                                <option value="CLINICA COSTANERA VALDIVIA">CLINICA COSTANERA VALDIVIA</option>
                                <option value="COMPUTACION">COMPUTACION</option>
                                <option value="CONSULTORIO ADOSADO ESPECIAL">CONSULTORIO ADOSADO ESPECIAL</option>
                                <option value="DENTAL">DENTAL</option>
                                <option value="DEPARTAMENTO FINANZAS">DEPARTAMENTO FINANZAS</option>
                                <option value="DEPARTAMENTO OPERACIONES">DEPARTAMENTO OPERACIONES</option>
                                <option value="DIALISIS AGUDA">DIALISIS AGUDA</option>
                                <option value="DIALISIS HOSPITAL">DIALISIS HOSPITAL</option>
                                <option value="DIRECCION">DIRECCION</option>
                                <option value="EMERGENCIA ADULTOS">EMERGENCIA ADULTOS</option>
                                <option value="EMERGENCIA GINECO-OBSTETRICIA">EMERGENCIA GINECO-OBSTETRICIA</option>
                                <option value="EMERGENCIA NIÑOS">EMERGENCIA NIÑOS</option>
                                <option value="EMERGENCIA SAMU">EMERGENCIA SAMU</option>
                                <option value="EQUIPOS INDUSTRIALES">EQUIPOS INDUSTRIALES</option>
                                <option value="EQUIPOS MEDICOS">EQUIPOS MEDICOS</option>
                                <option value="ESTERILIZACION">ESTERILIZACION</option>
                                <option value="FARMACIA H. REGIONAL">FARMACIA H. REGIONAL</option>
                                <option value="GESTION CENTRALIZADA DE CAMAS">GESTION CENTRALIZADA DE CAMAS</option>
                                <option value="GINECOLOGIA">GINECOLOGIA</option>
                                <option value="I.H.H">I.H.H</option>
                                <option value="IMAGENOLOGIA">IMAGENOLOGIA</option>
                                <option value="JARDIN INFANTIL">JARDIN INFANTIL</option>
                                <option value="KINESITERAPIA">KINESITERAPIA</option>
                                <option value="LAB. DE HISTOCOMPATIBILIDAD">LAB. DE HISTOCOMPATIBILIDAD</option>
                                <option value="LABORATORIO">LABORATORIO</option>
                                <option value="LAVANDERIA">LAVANDERIA</option>
                                <option value="LISTA ESPERA QUIRURGICA Y MACR">LISTA ESPERA QUIRURGICA Y MACR</option>
                                <option value="LOS RIOS VALDIVIA">LOS RIOS VALDIVIA</option>
                                <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                                <option value="MARCAPASOS">MARCAPASOS</option>
                                <option value="MEDICINA">MEDICINA</option>
                                <option value="MEDICINA 3er PISO">MEDICINA 3er PISO</option>
                                <option value="MEDICINA 4to PISO">MEDICINA 4to PISO</option>
                                <option value="MEDICINA NUCLEAR">MEDICINA NUCLEAR</option>
                                <option value="MOVILIZACION">MOVILIZACION</option>
                                <option value="NEONATO CUIDADOS INTERMEDIOS">NEONATO CUIDADOS INTERMEDIOS</option>
                                <option value="NEONATO CUIDADOS BASICOS">NEONATO CUIDADOS BASICOS</option>
                                <option value="NEONATO CUIDADOS INTENSIVOS">NEONATO CUIDADOS INTENSIVOS</option>
                                <option value="NEPHRO CARE LA UNION">NEPHRO CARE LA UNION</option>
                                <option value="NEPHRO CARE VALDIVIA">NEPHRO CARE VALDIVIA</option>
                                <option value="NEUROCIRUGIA">NEUROCIRUGIA</option>
                                <option value="NEONATOLOGIA">NEONATOLOGIA</option>
                                <option value="NUTRICION CLINICA">NUTRICION CLINICA</option>
                                <option value="OFICINA INFOR. Y RECLAMOS OIR">OFICINA INFOR. Y RECLAMOS OIR</option>
                                <option value="OFTALMOLOGIA">OFTALMOLOGIA</option>
                                <option value="ONCOLOGIA">ONCOLOGIA</option>
                                <option value="OTORRINOLARINGOLOGIA">OTORRINOLARINGOLOGIA</option>
                                <option value="OXIGENO TERAPIA">OXIGENO TERAPIA</option>
                                <option value="PABELLON CENTRAL">PABELLON CENTRAL</option>
                                <option value="PABELLON PARTOS">PABELLON PARTOS</option>
                                <option value="PARTO - OBSTETRICIA">PARTO - OBSTETRICIA</option>
                                <option value="PEDIATRIA">PEDIATRIA</option>
                                <option value="PENSIONADO">PENSIONADO</option>
                                <option value="PERITONEODIALISIS">PERITONEODIALISIS</option>
                                <option value="POLI BRONCOPULMONAR">POLI BRONCOPULMONAR</option>
                                <option value="POLI CARDIOLOGIA">POLI CARDIOLOGIA</option>
                                <option value="POLI CIRUGIA ADULTO">POLI CIRUGIA ADULTO</option>
                                <option value="POLI CIRUGIA INFANTIL">POLI CIRUGIA INFANTIL</option>
                                <option value="POLI DE TAC">POLI DE TAC</option>
                                <option value="POLI DERMATOLOGIA">POLI DERMATOLOGIA</option>
                                <option value="POLI ENDOCRINOLOGIA">POLI ENDOCRINOLOGIA</option>
                                <option value="POLI FIBROSIS QUISTICA">POLI FIBROSIS QUISTICA</option>
                                <option value="POLI GASTROENTEROLOGIA">POLI GASTROENTEROLOGIA</option>
                                <option value="POLI GASTROENTEROLOGIA INF.">POLI GASTROENTEROLOGIA INF.</option>
                                <option value="POLI GINECOLOGIA">POLI GINECOLOGIA</option>
                                <option value="POLI HEMATOLOGIA">POLI HEMATOLOGIA</option>
                                <option value="POLI INMUNO-INFECTOLOGIA">POLI INMUNO-INFECTOLOGIA</option>
                                <option value="POLI MEDICINA">POLI MEDICINA</option>
                                <option value="POLI MEDICINA FISICA Y REHABIL">POLI FISICA Y REHABIL</option>
                                <option value="POLI NEFROLOGIA">POLI NEFROLOGIA</option>
                                <option value="POLI NEUROCIRUGIA">POLI NEUROCIRUGIA</option>
                                <option value="POLI NEUROLOGIA INFANTIL">POLI NEUROLOGIA INFANTIL</option>
                                <option value="POLI OFTALMOLOGIA">POLI OFTALMOLOGIA</option>
                                <option value="POLI ONCOLOGIA">POLI ONCOLOGIA</option>
                                <option value="POLI OTORRINOLARINGOLOGIA">POLI OTORRINOLARINGOLOGIA</option>
                                <option value="POLI PATOLOGIA CERVICAL">POLI PATOLOGIA CERVICAL</option>
                                <option value="POLI PATOLOGIA MAMARIA">POLI PATOLOGIA MAMARIA</option>
                                <option value="POLI PEDIATRIA">POLI PEDIATRIA</option>
                                <option value="POLI PERSONAL">POLI PERSONAL</option>
                                <option value="POLI PIE DIABETICO">POLI PIE DIABETICO</option>
                                <option value="POLI PSIQUIATRIA ADULTO">POLI PSIQUIATRIA ADULTO</option>
                                <option value="POLI PSIQUIATRIA INFANTIL">POLI PSIQUIATRIA INFANTIL</option>
                                <option value="POLI RESPIRATORIO INFANTIL">POLI RESPIRTORIO INFANTIL</option>
                                <option value="POLI REUMATOLOGIA">POLI REUMATOLOGIA</option>
                                <option value="POLI TRAUMATOLOGIA">POLI TRAUMATOLOGIA</option>
                                <option value="POLI ULSERAS VENOSAS">POLI ULSERAS VENOSAS</option>
                                <option value="POLI UROLOGIA">POLI UROLOGIA</option>
                                <option value="PRAIS">PRAIS</option>
                                <option value="PROG.ALIVIO DEL DOLOR">PROG.ALIVIO DEL DOLOR</option>
                                <option value="PROGRAMA PRENEC">PROGRAMA PRENEC</option>
                                <option value="PSIQUIATRIA">PSIQUIATRIA</option>
                                <option value="PSIQUIATRIA DIURNO">PSIQUIATRIA DIURNO</option>
                                <option value="PUERPERIO">PUERPERIO</option>
                                <option value="QUIMIO. AMBULATORIA ONCOLOGIA">QUIMIO. AMBULATORIA ONCOLOGIA</option>
                                <option value="QUIMIOTERAPIA INFANTIL AMBULAT">QUIMIOTERAPIA INFANTIL AMBULAT</option>
                                <option value="RADIOLOGIA REGIONAL">RADIOLOGIA REGIONAL</option>
                                <option value="RADIOTERAPIA">RADIOTERAPIA</option>
                                <option value="RECUPERACION PABELLON CENTRAL">RECUPERACION PABELLON CENTRAL</option>
                                <option value="RECURSOS HUMANOS">RECURSOS HUMANOS</option>
                                <option value="REDES ELECTRICAS">REDES ELECTRICAS</option>
                                <option value="RESONANCIA">RESONANCIA</option>
                                <option value="SALA CUNA">SALA CUNA</option>
                                <option value="SERVICIO GENERALES">SERVICIO GENERALES</option>
                                <option value="SERVICIO SOCIAL">SERVICIO SOCIAL</option>
                                <option value="SOU (SALA OBSERVACION ADULTO)">SOU (SALA OBSERVACION ADULTO)</option>
                                <option value="SOU (SALA OBSERVACION INFANTIL)">SOU (SALA OBSERVACION INFANTIL)</option>
                                <option value="SUB DPTO DE SERV.LOGIST">SUB DPTO DE SERV.LOGIST</option>
                                <option value="SUB DPTO INFRAESTRUCTURA">SUB DPTO INFRAESTRUCTURA</option>
                                <option value="SUB DPTO MANTEN.DE EQUIP">SUB DPTO MANTEN.DE EQUIP</option>
                                <option value="SUB DPTO CONTROL DE PRODUCCION">SUB DPTO CONTROL DE PRODUCCION</option>
                                <option value="SUB DPTO DE GEST DE LA DEMA.RED">SUB DPTO DE GEST DE LA DEMA.RED</option>
                                <option value="TOMOGRAFIA">TOMOGRAFIA</option>
                                <option value="TRAUMATOLOGIA ADULTO">TRAUMATOLOGIA ADULTO</option>
                                <option value="TRAUMATOLOGIA INFANTIL">TRAUMATOLOGIA INFANTIL</option>
                                <option value="TRAUMATOLOGIA PROTESIS">TRAUMATOLOGIA PROTESIS</option>
                                <option value="U. EPIDEMIOLOGIA Y REG CANCER">U. EPIDEMIOLOGIA Y REG CANCER</option>
                                <option value="UCI ADULTO">UCI ADULTO</option>
                                <option value="UCI INTERMEDIA">UCI INTERMEDIA</option>
                                <option value="UCI PEDIATRICA">UCI PEDIATRICA</option>
                                <option value="UNI.HOSPIT.DOMICILIARIA">UNI.HOSPIT.DOMICILIARIA</option>
                                <option value="UNIDAD PACIENTE CRITICO ADULTO">UNIDAD PACIENTE CRITICO ADULTO</option>
                                <option value="UNIDAD PACIENTE CRITICO PEDIATRICO">UNIDAD PACIENTE CRITICO PEDIATRICO</option>
                                <option value="UNIDAD ANALISIS REG.CLINICOS">UNIDAD ANALISIS REG.CLINICOS</option>
                                <option value="UNIDAD DE ARCHIVO">UNIDAD DE ARCHIVO</option>
                                <option value="UNIDAD DE COSTOS">UNIDAD DE COSTOS</option>
                                <option value="UNIDAD DE HEMODIALISIS">UNIDAD DE HEMODIALISIS</option>
                                <option value="UNIDAD DE MICROBIOLOGIA">UNIDAD DE MICROBIOLOGIA</option>
                                <option value="UNIDAD HEMATOLOGICA INTENSIVA">UNIDAD HEMATOLOGICA INTENSIVA</option>
                                <option value="UNIDAD ONCO_HEMATOLOGIA INFANT">UNIDAD ONCO_HEMATOLOGIA INFANT</option>
                                <option value="UNIDAD QUIMIOTERAPIA AMBULATOR">UNIDAD QUIMIOTERAPIA AMBULATOR</option>
                                <option value="UNIDAD SALUD OCUPACIONAL">UNIDAD SALUD OCUPACIONAL</option>
                                <option value="UROLOGIA">UROLOGIA</option>
                                <option value="UTI PEDIATRICA">UTI PEDIATRICA</option>
                                <option value="VIDA DIAN PAILLACO">VIDA DIAN PAILLACO</option>
                                <option value="HBV">HBV</option>
                                <option value="EXTERNO">EXTERNO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="sector" class="col-sm-2 control-label">Sector</label>
                            <input type="text" class="form-control" id="sector" name="sector" value="<?php echo $idNew->sector; ?>" maxlength="50" placeholder="Sector">
                        </div>

                        <div class="form-group col">
                            <label for="tipo_peticion" class="col-sm-2 control-label">Tipo Petición</label>
                            <select class="form-select" name="tipo_peticion" id="tipo_peticion">
                                <option value="<?php echo $idNew->tipo_peticion; ?>"><?php echo $idNew->tipo_peticion; ?></option>
                                <option value="PROYECTO">PROYECTO</option>
                                <option value="PRODUCTO">PRODUCTO</option>
                                <option value="SERVICIO">SERVICIO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="tipo_compra" class="col-sm-2 control-label">Tipo Compra</label>
                            <select class="form-select" name="tipo_compra" id="tipo_compra">
                                <option value="<?php echo $idNew->tipo_compra; ?>"><?php echo $idNew->tipo_compra; ?></option>
                                <option value="LICITACION PUBLICA">LICITACION PUBLICA</option>
                                <option value="TRATO DIRECTO">TRATO DIRECTO</option>
                                <option value="COMPRA AGIL">COMPRA AGIL</option>
                                <option value="CONTRATO CONEXO">CONTRATO CONEXO</option>
                                <option value="CONVENIO MARCO">CONVENIO MARCO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="descr_solicitud" class="col-sm-2 control-label">Descripción</label>
                            <textarea class="form-control sizeT" name="descr_solicitud" id="descr_solicitud" rows="3" placeholder="Descripcion Solicitud"><?php echo $idNew->descr_solicitud; ?></textarea>
                        </div>

                        <div class="form-group col">
                            <label for="obser_pet" class="col-sm-2 control-label">Observación</label>
                            <textarea class="form-control sizeT" name="obser_pet" id="obser_pet" rows="3" placeholder="Observacion Peticion"><?php echo $idNew->obser_pet; ?></textarea>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="doc_adjunta" class="col-sm-2 control-label">Doc Adjunta</label>
                            <select class="form-select" name="doc_adjunta" id="doc_adjunta">
                                <option value="<?php echo $idNew->doc_adjunta; ?>"><?php echo $idNew->doc_adjunta; ?></option>
                                <option value="N/A">N/A</option>
                                <option value="BASES TECNICAS">BASES TECNICAS</option>
                                <option value="TERMINOS DE REFERENCIA">TERMINOS DE REFERENCIA</option>
                                <option value="COTIZACION">COTIZACION</option>
                                <option value="TERMINOS DE REFERENCIA Y COTIZACION">TERMINOS DE REFERENCIA Y COTIZACION</option>
                                <option value="SOLICITUD DE COMPRA">SOLICITUD DE COMPRA</option>
                                <option value="ITEMIZADO">ITEMIZADO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="id_contrato_conexo" class="col-sm-2 control-label">ID C.C</label>
                            <input type="text" class="form-control" id="id_contrato_conexo" name="id_contrato_conexo" value="<?php echo $idNew->id_contrato_conexo; ?>" maxlength="20" placeholder="ID Contrato Conexo">
                        </div>

                        <div class="form-group col">
                            <label for="plazo_entrega" class="col-sm-2 control-label">Plazo Etrg</label>
                            <input type="text" class="form-control" id="plazo_entrega" name="plazo_entrega" value="<?php echo $idNew->plazo_entrega; ?>" maxlength="8" placeholder="Plazo Entrega">
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
                            <label for="sisq" class="col-sm-2 control-label">SISQ</label>
                            <select class="form-select" name="sisq" id="sisq">
                                <option value=""></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="mp" class="col-sm-2 control-label">MP</label>
                            <select class="form-select" name="mp" id="mp">
                                <option value="<?php echo $idNew->mp; ?>"><?php echo $idNew->mp; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="mc" class="col-sm-2 control-label">MC</label>
                            <select class="form-select" name="mc" id="mc">
                                <option value="<?php echo $idNew->mc; ?>"><?php echo $idNew->mc; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="mal_uso" class="col-sm-2 control-label">Mal_Uso</label>
                            <select class="form-select" name="mal_uso" id="mal_uso">
                                <option value="<?php echo $idNew->mal_uso; ?>"><?php echo $idNew->mal_uso; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="eq_2_1" class="col-sm-2 control-label">EQ-2.1</label>
                            <select class="form-select" name="eq_2_1" id="eq_2_1">
                                <option value="<?php echo $idNew->eq_2_1; ?>"><?php echo $idNew->eq_2_1; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="eq_2_2" class="col-sm-2 control-label">EQ-2.2</label>
                            <select class="form-select" name="eq_2_2" id="eq_2_2">
                                <option value="<?php echo $idNew->eq_2_2; ?>"><?php echo $idNew->eq_2_2; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="ins_3_1" class="col-sm-2 control-label">INS-3.1</label>
                            <select class="form-select" name="ins_3_1" id="ins_3_1">
                                <option value="<?php echo $idNew->ins_3_1; ?>"><?php echo $idNew->ins_3_1; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="ins_3_2" class="col-sm-2 control-label">INS-3.2</label>
                            <select class="form-select" name="ins_3_2" id="ins_3_2">
                                <option value="<?php echo $idNew->ins_3_2; ?>"><?php echo $idNew->ins_3_2; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="plan_expansion" class="col-sm-2 control-label">Plan Expansión</label>
                            <select class="form-select" name="plan_expansion" id="plan_expansion">
                                <option value="<?php echo $idNew->plan_expansion; ?>"><?php echo $idNew->plan_expansion; ?></option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="empresa" class="col-sm-2 control-label">Proveedor</label>
                            <select class="form-select" name="empresa" id="empresa" onclick="empresas()">
                                <option value="<?php echo $idNew->empresa; ?>"><?php echo $idNew->empresa; ?></option>
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
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="rut" class="col-sm-2 control-label">RUT Empr</label>
                            <input type="text" style="background-color: rgb(230, 230, 250);" class="form-control" id="rut" name="rut" value="<?php echo $idNew->rut; ?>" maxlength="10" placeholder="RUT" readonly>
                        </div>

                        <div class="form-group col">
                            <label for="garantia" class="col-sm-2 control-label">Garantía</label>
                            <input type="text" class="form-control" id="garantia" name="garantia" value="<?php echo $idNew->garantia; ?>" maxlength="15" placeholder="Garantia">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="orden_trabajo" class="col-sm-2 control-label">Orden_Trabajo</label>
                            <input type="number" class="form-control" id="orden_trabajo" name="orden_trabajo" value="<?php echo $idNew->orden_trabajo; ?>" min="0" placeholder="Orden Trabajo">
                        </div>

                        <div class="form-group col">
                            <label for="item_ppto_solicitado" class="col-sm-2 control-label">Item_PPTO_Solic</label>
                            <select class="form-select" name="item_ppto_solicitado" id="item_ppto_solicitado">
                                <option value="<?php echo $idNew->item_ppto_solicitado; ?>"><?php echo $idNew->item_ppto_solicitado; ?></option>
                                <option value="22-01-001-001">22-01-001-001</option>
                                <option value="22-01-001-002">22-01-001-002</option>
                                <option value="22-01-001-003">22-01-001-003</option>
                                <option value="22-02-002-001">22-02-002-001</option>
                                <option value="22-02-002-002">22-02-002-002</option>
                                <option value="22-02-003-000">22-02-003-000</option>
                                <option value="22-03-001-000">22-03-001-000</option>
                                <option value="22-03-002-000">22-03-002-000</option>
                                <option value="22-03-003-000">22-03-003-000</option>
                                <option value="22-03-999-000">22-03-999-000</option>
                                <option value="22-04-001-000">22-04-001-000</option>
                                <option value="22-04-003-001">22-04-003-001</option>
                                <option value="22-04-006-000">22-04-006-000</option>
                                <option value="22-04-007-001">22-04-007-001</option>
                                <option value="22-04-007-002">22-04-007-002</option>
                                <option value="22-04-008-000">22-04-008-000</option>
                                <option value="22-04-010-000">22-04-010-000</option>
                                <option value="22-04-011-000">22-04-011-000</option>
                                <option value="22-04-012-000">22-04-012-000</option>
                                <option value="22-04-013-000">22-04-013-000</option>
                                <option value="22-04-014-000">22-04-014-000</option>
                                <option value="22-05-001-000">22-05-001-000</option>
                                <option value="22-05-002-000">22-05-002-000</option>
                                <option value="22-05-003-000">22-05-003-000</option>
                                <option value="22-05-004-000">22-05-004-000</option>
                                <option value="22-05-005-000">22-05-005-000</option>
                                <option value="22-05-006-000">22-05-006-000</option>
                                <option value="22-06-001-000">22-06-001-000</option>
                                <option value="22-06-002-000">22-06-002-000</option>
                                <option value="22-06-002-001">22-06-002-001</option>
                                <option value="22-06-002-002">22-06-002-002</option>
                                <option value="22-06-002-003">22-06-002-003</option>
                                <option value="22-06-002-004">22-06-002-004</option>
                                <option value="22-06-002-005">22-06-002-005</option>
                                <option value="22-06-002-006">22-06-002-006</option>
                                <option value="22-06-003-000">22-06-003-000</option>
                                <option value="22-06-004-000">22-06-004-000</option>
                                <option value="22-06-005-000">22-06-005-000</option>
                                <option value="22-06-005-001">22-06-005-001</option>
                                <option value="22-06-005-002">22-06-005-002</option>
                                <option value="22-06-006-000">22-06-006-000</option>
                                <option value="22-06-006-003">22-06-006-003</option>
                                <option value="22-06-006-004">22-06-006-004</option>
                                <option value="22-06-999-000">22-06-999-000</option>
                                <option value="22-07-001-000">22-07-001-000</option>
                                <option value="22-07-002-000">22-07-002-000</option>
                                <option value="22-07-003-000">22-07-003-000</option>
                                <option value="22-07-999-000">22-07-999-000</option>
                                <option value="22-08-001-000">22-08-001-000</option>
                                <option value="22-08-002-000">22-08-002-000</option>
                                <option value="22-08-003-000">22-08-003-000</option>
                                <option value="22-08-007-000">22-08-007-000</option>
                                <option value="22-08-999-000">22-08-999-000</option>
                                <option value="22-09-003-000">22-09-003-000</option>
                                <option value="22-00-999-000">22-00-999-000</option>
                            </select>
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
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Ver Catastro
                            </button>
                        </div>

                        <div class="form-group col">
                            <input type="number" min="0" max="15" class="form-control" id="filas" name="filas" placeholder="Número máximo: 16 filas">
                        </div>
                    </div><br>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registros Catastro</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row table-responsive-sm">
                                        <table id="myTable" class="table nowrap" style="width:100%">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Servicio</th>
                                                    <th>Sector</th>
                                                    <th>Equipo</th>
                                                    <th>Marca</th>
                                                    <th>Modelo</th>
                                                    <th style="color: blue;">Serie</th>
                                                    <th style="color: blue;">N Inventario</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($equipamiento as $datos) { ?>
                                                    <tr>
                                                        <td style="background-color: rgb(247, 84, 84);"><?php echo $datos->id_relacion; ?></td>
                                                        <td><?php echo $datos->servicio; ?></td>
                                                        <td><?php echo $datos->sector; ?></td>
                                                        <td><?php echo $datos->equipo; ?></td>
                                                        <td><?php echo $datos->marca; ?></td>
                                                        <td><?php echo $datos->modelo; ?></td>
                                                        <td style="background-color: rgb(123, 123, 247);"><?php echo $datos->serie; ?></td>
                                                        <td style="background-color: rgb(123, 123, 247);"><?php echo $datos->num_inventario; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->


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
                                <tr>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_1" id="detalle_compra_1" rows="3" cols="70" placeholder="Detalle Compra 1"><?php echo $idNew->detalle_compra_1; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo($('#buscar_eq').val());" class="form-control" id="buscar_eq" name="id_1" value="<?php echo $idNew->id_1; ?>" placeholder="ID Equipo 1">
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_1" id="equipo_1" rows="3" cols="70" placeholder="Equipo 1" readonly><?php echo $idNew->equipo_1; ?></textarea>
                                    </td>
                                    <td>
                                        <!-- Buscador -->
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora($('#buscar').val());" class="form-control" id="buscar" name="c_manager_1" value="<?php echo $idNew->c_manager_1; ?>" placeholder="COD Manager 1">
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_1" id="producto_1" rows="3" cols="70" placeholder="Producto 1" readonly><?php echo $idNew->producto_1; ?></textarea>
                                    </td>
                                    <td>
                                        <select class="form-select select-1" name="u_m_1" id="u_m_1">
                                            <option value="<?php echo $idNew->u_m_1; ?>"><?php echo $idNew->u_m_1; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_1" name="cantidad_1" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_1; ?>" placeholder="Cantidad 1" require>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_1" name="valor_unitario_1" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_1; ?>" placeholder="V.Unitario 1" require>
                                    </td>
                                    <td>
                                        <textarea class="form-control sizeT" name="neto_1" id="neto_1" rows="1" cols="40" placeholder="NETO 1" readonly><?php echo $idNew->neto_1; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control sizeT" name="iva_1" id="iva_1" rows="1" cols="40" placeholder="IVA 1" readonly><?php echo $idNew->iva_1; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control sizeT" name="total_1" id="total_1" rows="1" cols="40" placeholder="Total 1" readonly><?php echo $idNew->total_1; ?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_2" id="detalle_compra_2" rows="3" cols="70" placeholder="Detalle Compra 2"><?php echo $idNew->detalle_compra_2; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_2($('#buscar_eq_2').val());" class="form-control" id="buscar_eq_2" name="id_2" value="<?php echo $idNew->id_2; ?>" placeholder="ID Equipo 2">
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_2" id="equipo_2" rows="3" cols="70" placeholder="Equipo 2" readonly><?php echo $idNew->equipo_2; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_2($('#buscar_2').val());" class="form-control" id="buscar_2" name="c_manager_2" value="<?php echo $idNew->c_manager_2; ?>" placeholder="COD Manager 2">
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_2" id="producto_2" rows="3" cols="70" placeholder="Producto 2" readonly><?php echo $idNew->producto_2; ?></textarea>
                                    </td>
                                    <td>
                                        <select class="form-select" name="u_m_2" id="u_m_2">
                                            <option value="<?php echo $idNew->u_m_2; ?>"><?php echo $idNew->u_m_2; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_2" name="cantidad_2" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_2; ?>" placeholder="Cantidad 2">
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_2" name="valor_unitario_2" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_2; ?>" placeholder="V.Unitario 2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="neto_2" name="neto_2" value="<?php echo $idNew->neto_2; ?>" placeholder="NETO 2" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="iva_2" name="iva_2" value="<?php echo $idNew->iva_2; ?>" placeholder="IVA 2" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="total_2" name="total_2" value="<?php echo $idNew->total_2; ?>" placeholder="Total 2" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_3" id="detalle_compra_3" rows="3" cols="70" placeholder="Detalle Compra 3"><?php echo $idNew->detalle_compra_3; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_3($('#buscar_eq_3').val());" class="form-control" id="buscar_eq_3" name="id_3" value="<?php echo $idNew->id_3; ?>" placeholder="ID Equipo 3">
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_3" id="equipo_3" rows="3" cols="70" placeholder="Equipo 3" readonly><?php echo $idNew->equipo_3; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_3($('#buscar_3').val());" class="form-control" id="buscar_3" name="c_manager_3" value="<?php echo $idNew->c_manager_3; ?>" placeholder="COD Manager 3">
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_3" id="producto_3" rows="3" cols="70" placeholder="Producto 3" readonly><?php echo $idNew->producto_3; ?></textarea>
                                    </td>
                                    <td>
                                        <select class="form-select" name="u_m_3" id="u_m_3">
                                            <option value="<?php echo $idNew->u_m_3; ?>"><?php echo $idNew->u_m_3; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_3" name="cantidad_3" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_3; ?>" placeholder="Cantidad 3">
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_3" name="valor_unitario_3" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_3; ?>" placeholder="V.Unitario 3">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="neto_3" name="neto_3" value="<?php echo $idNew->neto_3; ?>" placeholder="NETO 3" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="iva_3" name="iva_3" value="<?php echo $idNew->iva_3; ?>" placeholder="IVA 3" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="total_3" name="total_3" value="<?php echo $idNew->total_3; ?>" placeholder="Total 3" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_4" id="detalle_compra_4" rows="3" cols="70" placeholder="Detalle Compra 4"><?php echo $idNew->detalle_compra_4; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_4($('#buscar_eq_4').val());" class="form-control" id="buscar_eq_4" name="id_4" value="<?php echo $idNew->id_4; ?>" placeholder="ID Equipo 4">
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_4" id="equipo_4" rows="3" cols="70" placeholder="Equipo 4" readonly><?php echo $idNew->equipo_4; ?></textarea>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_4($('#buscar_4').val());" class="form-control" id="buscar_4" name="c_manager_4" value="<?php echo $idNew->c_manager_4; ?>" placeholder="COD Manager 4">
                                    </td>
                                    <td>
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_4" id="producto_4" rows="3" cols="70" placeholder="Producto 4" readonly><?php echo $idNew->producto_4; ?></textarea>
                                    </td>
                                    <td>
                                        <select class="form-select" name="u_m_4" id="u_m_4">
                                            <option value="<?php echo $idNew->u_m_4; ?>"><?php echo $idNew->u_m_4; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_4" name="cantidad_4" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_4; ?>" placeholder="Cantidad 4">
                                    </td>
                                    <td>
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_4" name="valor_unitario_4" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_4; ?>" placeholder="V.Unitario 4">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="neto_4" name="neto_4" value="<?php echo $idNew->neto_4; ?>" placeholder="NETO 4" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="iva_4" name="iva_4" value="<?php echo $idNew->iva_4; ?>" placeholder="IVA 4" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="total_4" name="total_4" value="<?php echo $idNew->total_4; ?>" placeholder="Total 4" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_1">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_5" id="detalle_compra_5" rows="3" cols="70" placeholder="Detalle Compra 5"><?php echo $idNew->detalle_compra_5; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_1">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_5($('#buscar_eq_5').val());" class="form-control" id="buscar_eq_5" name="id_5" value="<?php echo $idNew->id_5; ?>" placeholder="ID Equipo 5">
                                    </td>
                                    <td class="eqs eqs_1">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_5" id="equipo_5" rows="3" cols="70" placeholder="Equipo 5" readonly><?php echo $idNew->equipo_5; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_1">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_5($('#buscar_5').val());" class="form-control" id="buscar_5" name="c_manager_5" value="<?php echo $idNew->c_manager_5; ?>" placeholder="COD Manager 5">
                                    </td>
                                    <td class="eqs eqs_1">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_5" id="producto_5" rows="3" cols="70" placeholder="Producto 5" readonly><?php echo $idNew->producto_5; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_1">
                                        <select class="form-select" name="u_m_5" id="u_m_5">
                                            <option value="<?php echo $idNew->u_m_5; ?>"><?php echo $idNew->u_m_5; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_1">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_5" name="cantidad_5" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_5; ?>" placeholder="Cantidad 5">
                                    </td>
                                    <td class="eqs eqs_1">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_5" name="valor_unitario_5" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_5; ?>" placeholder="V.Unitario 5">
                                    </td>
                                    <td class="eqs eqs_1">
                                        <input type="text" class="form-control" id="neto_5" name="neto_5" value="<?php echo $idNew->neto_5; ?>" placeholder="NETO 5" readonly>
                                    </td>
                                    <td class="eqs eqs_1">
                                        <input type="text" class="form-control" id="iva_5" name="iva_5" value="<?php echo $idNew->iva_5; ?>" placeholder="IVA 5" readonly>
                                    </td>
                                    <td class="eqs eqs_1">
                                        <input type="text" class="form-control" id="total_5" name="total_5" value="<?php echo $idNew->total_5; ?>" placeholder="Total 5" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_2">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_6" id="detalle_compra_6" rows="3" cols="70" placeholder="Detalle Compra 6"><?php echo $idNew->detalle_compra_6; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_2">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_6($('#buscar_eq_6').val());" class="form-control" id="buscar_eq_6" name="id_6" value="<?php echo $idNew->id_6; ?>" placeholder="ID Equipo 6">
                                    </td>
                                    <td class="eqs eqs_2">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_6" id="equipo_6" rows="3" cols="70" placeholder="Equipo 6" readonly><?php echo $idNew->equipo_6; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_2">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_6($('#buscar_6').val());" class="form-control" id="buscar_6" name="c_manager_6" value="<?php echo $idNew->c_manager_6; ?>" placeholder="COD Manager 6">
                                    </td>
                                    <td class="eqs eqs_2">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_6" id="producto_6" rows="3" cols="70" placeholder="Producto 6" readonly><?php echo $idNew->producto_6; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_2">
                                        <select class="form-select" name="u_m_6" id="u_m_6">
                                            <option value="<?php echo $idNew->u_m_6; ?>"><?php echo $idNew->u_m_6; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_2">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_6" name="cantidad_6" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_6; ?>" placeholder="Cantidad 6">
                                    </td>
                                    <td class="eqs eqs_2">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_6" name="valor_unitario_6" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_6; ?>" placeholder="V.Unitario 6">
                                    </td>
                                    <td class="eqs eqs_2">
                                        <input type="text" class="form-control" id="neto_6" name="neto_6" value="<?php echo $idNew->neto_6; ?>" placeholder="NETO 6" readonly>
                                    </td>
                                    <td class="eqs eqs_2">
                                        <input type="text" class="form-control" id="iva_6" name="iva_6" value="<?php echo $idNew->iva_6; ?>" placeholder="IVA 6" readonly>
                                    </td>
                                    <td class="eqs eqs_2">
                                        <input type="text" class="form-control" id="total_6" name="total_6" value="<?php echo $idNew->total_6; ?>" placeholder="Total 6" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_3">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_7" id="detalle_compra_7" rows="3" cols="70" placeholder="Detalle Compra 7"><?php echo $idNew->detalle_compra_7; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_3">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_7($('#buscar_eq_7').val());" class="form-control" id="buscar_eq_7" name="id_7" value="<?php echo $idNew->id_7; ?>" placeholder="ID Equipo 7">
                                    </td>
                                    <td class="eqs eqs_3">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_7" id="equipo_7" rows="3" cols="70" placeholder="Equipo 7" readonly><?php echo $idNew->equipo_7; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_3">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_7($('#buscar_7').val());" class="form-control" id="buscar_7" name="c_manager_7" value="<?php echo $idNew->c_manager_7; ?>" placeholder="COD Manager 7">
                                    </td>
                                    <td class="eqs eqs_3">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_7" id="producto_7" rows="3" cols="70" placeholder="Producto 7" readonly><?php echo $idNew->producto_7; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_3">
                                        <select class="form-select" name="u_m_7" id="u_m_7">
                                            <option value="<?php echo $idNew->u_m_7; ?>"><?php echo $idNew->u_m_7; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_3">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_7" name="cantidad_7" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_7; ?>" placeholder="Cantidad 7">
                                    </td>
                                    <td class="eqs eqs_3">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_7" name="valor_unitario_7" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_7; ?>" placeholder="V.Unitario 7">
                                    </td>
                                    <td class="eqs eqs_3">
                                        <input type="text" class="form-control" id="neto_7" name="neto_7" value="<?php echo $idNew->neto_7; ?>" placeholder="NETO 7" readonly>
                                    </td>
                                    <td class="eqs eqs_3">
                                        <input type="text" class="form-control" id="iva_7" name="iva_7" value="<?php echo $idNew->iva_7; ?>" placeholder="IVA 7" readonly>
                                    </td>
                                    <td class="eqs eqs_3">
                                        <input type="text" class="form-control" id="total_7" name="total_7" value="<?php echo $idNew->total_7; ?>" placeholder="Total 7" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_4">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_8" id="detalle_compra_8" rows="3" cols="70" placeholder="Detalle Compra 8"><?php echo $idNew->detalle_compra_8; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_4">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_8($('#buscar_eq_8').val());" class="form-control" id="buscar_eq_8" name="id_8" value="<?php echo $idNew->id_8; ?>" placeholder="ID Equipo 8">
                                    </td>
                                    <td class="eqs eqs_4">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_8" id="equipo_8" rows="3" cols="70" placeholder="Equipo 8" readonly><?php echo $idNew->equipo_8; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_4">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_8($('#buscar_8').val());" class="form-control" id="buscar_8" name="c_manager_8" value="<?php echo $idNew->c_manager_8; ?>" placeholder="COD Manager 8">
                                    </td>
                                    <td class="eqs eqs_4">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_8" id="producto_8" rows="3" cols="70" placeholder="Producto 8" readonly><?php echo $idNew->producto_8; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_4">
                                        <select class="form-select" name="u_m_8" id="u_m_8">
                                            <option value="<?php echo $idNew->u_m_8; ?>"><?php echo $idNew->u_m_8; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_4">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_8" name="cantidad_8" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_8; ?>" placeholder="Cantidad 8">
                                    </td>
                                    <td class="eqs eqs_4">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_8" name="valor_unitario_8" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_8; ?>" placeholder="V.Unitario 8">
                                    </td>
                                    <td class="eqs eqs_4">
                                        <input type="text" class="form-control" id="neto_8" name="neto_8" value="<?php echo $idNew->neto_8; ?>" placeholder="NETO 8" readonly>
                                    </td>
                                    <td class="eqs eqs_4">
                                        <input type="text" class="form-control" id="iva_8" name="iva_8" value="<?php echo $idNew->iva_8; ?>" placeholder="IVA 8" readonly>
                                    </td>
                                    <td class="eqs eqs_4">
                                        <input type="text" class="form-control" id="total_8" name="total_8" value="<?php echo $idNew->total_8; ?>" placeholder="Total 8" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_5">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_9" id="detalle_compra_9" rows="3" cols="70" placeholder="Detalle Compra 9"><?php echo $idNew->detalle_compra_9; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_5">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_9($('#buscar_eq_9').val());" class="form-control" id="buscar_eq_9" name="id_9" value="<?php echo $idNew->id_9; ?>" placeholder="ID Equipo 9">
                                    </td>
                                    <td class="eqs eqs_5">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_9" id="equipo_9" rows="3" cols="70" placeholder="Equipo 9" readonly><?php echo $idNew->equipo_9; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_5">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_9($('#buscar_9').val());" class="form-control" id="buscar_9" name="c_manager_9" value="<?php echo $idNew->c_manager_9; ?>" placeholder="COD Manager 9">
                                    </td>
                                    <td class="eqs eqs_5">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_9" id="producto_9" rows="3" cols="70" placeholder="Producto 9" readonly><?php echo $idNew->producto_9; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_5">
                                        <select class="form-select" name="u_m_9" id="u_m_9">
                                            <option value="<?php echo $idNew->u_m_9; ?>"><?php echo $idNew->u_m_9; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_5">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_9" name="cantidad_9" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_9; ?>" placeholder="Cantidad 9">
                                    </td>
                                    <td class="eqs eqs_5">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_9" name="valor_unitario_9" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_9; ?>" placeholder="V.Unitario 9">
                                    </td>
                                    <td class="eqs eqs_5">
                                        <input type="text" class="form-control" id="neto_9" name="neto_9" value="<?php echo $idNew->neto_9; ?>" placeholder="NETO 9" readonly>
                                    </td>
                                    <td class="eqs eqs_5">
                                        <input type="text" class="form-control" id="iva_9" name="iva_9" value="<?php echo $idNew->iva_9; ?>" placeholder="IVA 9" readonly>
                                    </td>
                                    <td class="eqs eqs_5">
                                        <input type="text" class="form-control" id="total_9" name="total_9" value="<?php echo $idNew->total_9; ?>" placeholder="Total 9" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_6">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_10" id="detalle_compra_10" rows="3" cols="70" placeholder="Detalle Compra 10"><?php echo $idNew->detalle_compra_10; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_6">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_10($('#buscar_eq_10').val());" class="form-control" id="buscar_eq_10" name="id_10" value="<?php echo $idNew->id_10; ?>" placeholder="ID Equipo 10">
                                    </td>
                                    <td class="eqs eqs_6">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_10" id="equipo_10" rows="3" cols="70" placeholder="Equipo 10" readonly><?php echo $idNew->equipo_10; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_6">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_10($('#buscar_10').val());" class="form-control" id="buscar_10" name="c_manager_10" value="<?php echo $idNew->c_manager_10; ?>" placeholder="COD Manager 10">
                                    </td>
                                    <td class="eqs eqs_6">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_10" id="producto_10" rows="3" cols="70" placeholder="Producto 10" readonly><?php echo $idNew->producto_10; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_6">
                                        <select class="form-select" name="u_m_10" id="u_m_10">
                                            <option value="<?php echo $idNew->u_m_10; ?>"><?php echo $idNew->u_m_10; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_6">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_10" name="cantidad_10" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_10; ?>" placeholder="Cantidad 10">
                                    </td>
                                    <td class="eqs eqs_6">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_10" name="valor_unitario_10" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_10; ?>" placeholder="V.Unitario 10">
                                    </td>
                                    <td class="eqs eqs_6">
                                        <input type="text" class="form-control" id="neto_10" name="neto_10" value="<?php echo $idNew->neto_10; ?>" placeholder="NETO 10" readonly>
                                    </td>
                                    <td class="eqs eqs_6">
                                        <input type="text" class="form-control" id="iva_10" name="iva_10" value="<?php echo $idNew->iva_10; ?>" placeholder="IVA 10" readonly>
                                    </td>
                                    <td class="eqs eqs_6">
                                        <input type="text" class="form-control" id="total_10" name="total_10" value="<?php echo $idNew->total_10; ?>" placeholder="Total 10" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_7">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_11" id="detalle_compra_11" rows="3" cols="70" placeholder="Detalle Compra 11"><?php echo $idNew->detalle_compra_11; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_7">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_11($('#buscar_eq_11').val());" class="form-control" id="buscar_eq_11" name="id_11" value="<?php echo $idNew->id_11; ?>" placeholder="ID Equipo 11">
                                    </td>
                                    <td class="eqs eqs_7">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_11" id="equipo_11" rows="3" cols="70" placeholder="Equipo 11" readonly><?php echo $idNew->equipo_11; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_7">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_11($('#buscar_11').val());" class="form-control" id="buscar_11" name="c_manager_11" value="<?php echo $idNew->c_manager_11; ?>" placeholder="COD Manager 11">
                                    </td>
                                    <td class="eqs eqs_7">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_11" id="producto_11" rows="3" cols="70" placeholder="Producto 11" readonly><?php echo $idNew->producto_11; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_7">
                                        <select class="form-select" name="u_m_11" id="u_m_11">
                                            <option value="<?php echo $idNew->u_m_11; ?>"><?php echo $idNew->u_m_11; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_7">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_11" name="cantidad_11" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_11; ?>" placeholder="Cantidad 11">
                                    </td>
                                    <td class="eqs eqs_7">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_11" name="valor_unitario_11" value="<?php echo $idNew->valor_unitario_11; ?>" oninput="calculoPorCantidad()" placeholder="V.Unitario 11">
                                    </td>
                                    <td class="eqs eqs_7">
                                        <input type="text" class="form-control" id="neto_11" name="neto_11" value="<?php echo $idNew->neto_11; ?>" placeholder="NETO 11" readonly>
                                    </td>
                                    <td class="eqs eqs_7">
                                        <input type="text" class="form-control" id="iva_11" name="iva_11" value="<?php echo $idNew->iva_11; ?>" placeholder="IVA 11" readonly>
                                    </td>
                                    <td class="eqs eqs_7">
                                        <input type="text" class="form-control" id="total_11" name="total_11" value="<?php echo $idNew->total_11; ?>" placeholder="Total 11" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_8">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_12" id="detalle_compra_12" rows="3" cols="70" placeholder="Detalle Compra 12"><?php echo $idNew->detalle_compra_12; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_8">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_12($('#buscar_eq_12').val());" class="form-control" id="buscar_eq_12" name="id_12" value="<?php echo $idNew->id_12; ?>" placeholder="ID Equipo 12">
                                    </td>
                                    <td class="eqs eqs_8">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_12" id="equipo_12" rows="3" cols="70" placeholder="Equipo 12" readonly><?php echo $idNew->equipo_12; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_8">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_12($('#buscar_12').val());" class="form-control" id="buscar_12" name="c_manager_12" value="<?php echo $idNew->c_manager_12; ?>" placeholder="COD Manager 12">
                                    </td>
                                    <td class="eqs eqs_8">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_12" id="producto_12" rows="3" cols="70" placeholder="Producto 12" readonly><?php echo $idNew->producto_12; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_8">
                                        <select class="form-select" name="u_m_12" id="u_m_12">
                                            <option value="<?php echo $idNew->u_m_12; ?>"><?php echo $idNew->u_m_12; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_8">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_12" name="cantidad_12" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_12; ?>" placeholder="Cantidad 12">
                                    </td>
                                    <td class="eqs eqs_8">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_12" name="valor_unitario_12" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_12; ?>" placeholder="V.Unitario 12">
                                    </td>
                                    <td class="eqs eqs_8">
                                        <input type="text" class="form-control" id="neto_12" name="neto_12" value="<?php echo $idNew->neto_12; ?>" placeholder="NETO 12" readonly>
                                    </td>
                                    <td class="eqs eqs_8">
                                        <input type="text" class="form-control" id="iva_12" name="iva_12" value="<?php echo $idNew->iva_12; ?>" placeholder="IVA 12" readonly>
                                    </td>
                                    <td class="eqs eqs_8">
                                        <input type="text" class="form-control" id="total_12" name="total_12" value="<?php echo $idNew->total_12; ?>" placeholder="Total 12" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_9">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_13" id="detalle_compra_13" rows="3" cols="70" placeholder="Detalle Compra 13"><?php echo $idNew->detalle_compra_13; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_9">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_13($('#buscar_eq_13').val());" class="form-control" id="buscar_eq_13" name="id_13" value="<?php echo $idNew->id_13; ?>" placeholder="ID Equipo 13">
                                    </td>
                                    <td class="eqs eqs_9">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_13" id="equipo_13" rows="3" cols="70" placeholder="Equipo 13" readonly><?php echo $idNew->equipo_13; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_9">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_13($('#buscar_13').val());" class="form-control" id="buscar_13" name="c_manager_13" value="<?php echo $idNew->c_manager_13; ?>" placeholder="COD Manager 13">
                                    </td>
                                    <td class="eqs eqs_9">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_13" id="producto_13" rows="3" cols="70" placeholder="Producto 13" readonly><?php echo $idNew->producto_13; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_9">
                                        <select class="form-select" name="u_m_13" id="u_m_13">
                                            <option value="<?php echo $idNew->u_m_13; ?>"><?php echo $idNew->u_m_13; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_9">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_13" name="cantidad_13" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_13; ?>" placeholder="Cantidad 13">
                                    </td>
                                    <td class="eqs eqs_9">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_13" name="valor_unitario_13" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_13; ?>" placeholder="V.Unitario 13">
                                    </td>
                                    <td class="eqs eqs_9">
                                        <input type="text" class="form-control" id="neto_13" name="neto_13" value="<?php echo $idNew->neto_13; ?>" placeholder="NETO 13" readonly>
                                    </td>
                                    <td class="eqs eqs_9">
                                        <input type="text" class="form-control" id="iva_13" name="iva_13" value="<?php echo $idNew->iva_13; ?>" placeholder="IVA 13" readonly>
                                    </td>
                                    <td class="eqs eqs_9">
                                        <input type="text" class="form-control" id="total_13" name="total_13" value="<?php echo $idNew->total_13; ?>" placeholder="Total 13" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_10">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_14" id="detalle_compra_14" rows="3" cols="70" placeholder="Detalle Compra 14"><?php echo $idNew->detalle_compra_14; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_10">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_14($('#buscar_eq_14').val());" class="form-control" id="buscar_eq_14" name="id_14" value="<?php echo $idNew->id_14; ?>" placeholder="ID Equipo 14">
                                    </td>
                                    <td class="eqs eqs_10">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_14" id="equipo_14" rows="3" cols="70" placeholder="Equipo 14" readonly><?php echo $idNew->equipo_14; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_10">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_14($('#buscar_14').val());" class="form-control" id="buscar_14" name="c_manager_14" value="<?php echo $idNew->c_manager_14; ?>" placeholder="COD Manager 14">
                                    </td>
                                    <td class="eqs eqs_10">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_14" id="producto_14" rows="3" cols="70" placeholder="Producto 14" readonly><?php echo $idNew->producto_14; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_10">
                                        <select class="form-select" name="u_m_14" id="u_m_14">
                                            <option value="<?php echo $idNew->u_m_14; ?>"><?php echo $idNew->u_m_14; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_10">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_14" name="cantidad_14" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_14; ?>" placeholder="Cantidad 14">
                                    </td>
                                    <td class="eqs eqs_10">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_14" name="valor_unitario_14" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_14; ?>" placeholder="V.Unitario 14">
                                    </td>
                                    <td class="eqs eqs_10">
                                        <input type="text" class="form-control" id="neto_14" name="neto_14" value="<?php echo $idNew->neto_14; ?>" placeholder="NETO 14" readonly>
                                    </td>
                                    <td class="eqs eqs_10">
                                        <input type="text" class="form-control" id="iva_14" name="iva_14" value="<?php echo $idNew->iva_14; ?>" placeholder="IVA 14" readonly>
                                    </td>
                                    <td class="eqs eqs_10">
                                        <input type="text" class="form-control" id="total_14" name="total_14" value="<?php echo $idNew->total_14; ?>" placeholder="Total 14" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_11">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_15" id="detalle_compra_15" rows="3" cols="70" placeholder="Detalle Compra 15"><?php echo $idNew->detalle_compra_15; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_11">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_15($('#buscar_eq_15').val());" class="form-control" id="buscar_eq_15" name="id_15" value="<?php echo $idNew->id_15; ?>" placeholder="ID Equipo 15">
                                    </td>
                                    <td class="eqs eqs_11">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_15" id="equipo_15" rows="3" cols="70" placeholder="Equipo 15" readonly><?php echo $idNew->equipo_15; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_11">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_15($('#buscar_15').val());" class="form-control" id="buscar_15" name="c_manager_15" value="<?php echo $idNew->c_manager_15; ?>" placeholder="COD Manager 15">
                                    </td>
                                    <td class="eqs eqs_11">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_15" id="producto_15" rows="3" cols="70" placeholder="Producto 15" readonly><?php echo $idNew->producto_15; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_11">
                                        <select class="form-select" name="u_m_15" id="u_m_15">
                                            <option value="<?php echo $idNew->u_m_15; ?>"><?php echo $idNew->u_m_15; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_11">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_15" name="cantidad_15" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_15; ?>" placeholder="Cantidad 15">
                                    </td>
                                    <td class="eqs eqs_11">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_15" name="valor_unitario_15" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_15; ?>" placeholder="V.Unitario 15">
                                    </td>
                                    <td class="eqs eqs_11">
                                        <input type="text" class="form-control" id="neto_15" name="neto_15" value="<?php echo $idNew->neto_15; ?>" placeholder="NETO 15" readonly>
                                    </td>
                                    <td class="eqs eqs_11">
                                        <input type="text" class="form-control" id="iva_15" name="iva_15" value="<?php echo $idNew->iva_15; ?>" placeholder="IVA 15" readonly>
                                    </td>
                                    <td class="eqs eqs_11">
                                        <input type="text" class="form-control" id="total_15" name="total_15" value="<?php echo $idNew->total_15; ?>" placeholder="Total 15" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_12">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_16" id="detalle_compra_16" rows="3" cols="70" placeholder="Detalle Compra 16"><?php echo $idNew->detalle_compra_16; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_12">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_16($('#buscar_eq_16').val());" class="form-control" id="buscar_eq_16" name="id_16" value="<?php echo $idNew->id_16; ?>" placeholder="ID Equipo 16">
                                    </td>
                                    <td class="eqs eqs_12">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_16" id="equipo_16" rows="3" cols="70" placeholder="Equipo 16" readonly><?php echo $idNew->equipo_16; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_12">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_16($('#buscar_16').val());" class="form-control" id="buscar_16" name="c_manager_16" value="<?php echo $idNew->c_manager_16; ?>" placeholder="COD Manager 16">
                                    </td>
                                    <td class="eqs eqs_12">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_16" id="producto_16" rows="3" cols="70" placeholder="Producto 16" readonly><?php echo $idNew->producto_16; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_12">
                                        <select class="form-select" name="u_m_16" id="u_m_16">
                                            <option value="<?php echo $idNew->u_m_16; ?>"><?php echo $idNew->u_m_16; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_12">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_16" name="cantidad_16" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_16; ?>" placeholder="Cantidad 16">
                                    </td>
                                    <td class="eqs eqs_12">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_16" name="valor_unitario_16" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_16; ?>" placeholder="V.Unitario 16">
                                    </td>
                                    <td class="eqs eqs_12">
                                        <input type="text" class="form-control" id="neto_16" name="neto_16" value="<?php echo $idNew->neto_16; ?>" placeholder="NETO 16" readonly>
                                    </td>
                                    <td class="eqs eqs_12">
                                        <input type="text" class="form-control" id="iva_16" name="iva_16" value="<?php echo $idNew->iva_16; ?>" placeholder="IVA 16" readonly>
                                    </td>
                                    <td class="eqs eqs_12">
                                        <input type="text" class="form-control" id="total_16" name="total_16" value="<?php echo $idNew->total_16; ?>" placeholder="Total 16" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_13">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_17" id="detalle_compra_17" rows="3" cols="70" placeholder="Detalle Compra 17"><?php echo $idNew->detalle_compra_17; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_13">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_17($('#buscar_eq_17').val());" class="form-control" id="buscar_eq_17" name="id_17" value="<?php echo $idNew->id_17; ?>" placeholder="ID Equipo 17">
                                    </td>
                                    <td class="eqs eqs_13">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_17" id="equipo_17" rows="3" cols="70" placeholder="Equipo 17" readonly><?php echo $idNew->equipo_17; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_13">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_17($('#buscar_17').val());" class="form-control" id="buscar_17" name="c_manager_17" value="<?php echo $idNew->c_manager_17; ?>" placeholder="COD Manager 17">
                                    </td>
                                    <td class="eqs eqs_13">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_17" id="producto_17" rows="3" cols="70" placeholder="Producto 17" readonly><?php echo $idNew->producto_17; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_13">
                                        <select class="form-select" name="u_m_17" id="u_m_17">
                                            <option value="<?php echo $idNew->u_m_17; ?>"><?php echo $idNew->u_m_17; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_13">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_17" name="cantidad_17" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_17; ?>" placeholder="Cantidad 17">
                                    </td>
                                    <td class="eqs eqs_13">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_17" name="valor_unitario_17" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_17; ?>" placeholder="V.Unitario 17">
                                    </td>
                                    <td class="eqs eqs_13">
                                        <input type="text" class="form-control" id="neto_17" name="neto_17" value="<?php echo $idNew->neto_17; ?>" placeholder="NETO 17" readonly>
                                    </td>
                                    <td class="eqs eqs_13">
                                        <input type="text" class="form-control" id="iva_17" name="iva_17" value="<?php echo $idNew->iva_17; ?>" placeholder="IVA 17" readonly>
                                    </td>
                                    <td class="eqs eqs_13">
                                        <input type="text" class="form-control" id="total_17" name="total_17" value="<?php echo $idNew->total_17; ?>" placeholder="Total 17" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_14">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_18" id="detalle_compra_18" rows="3" cols="70" placeholder="Detalle Compra 18"><?php echo $idNew->detalle_compra_18; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_14">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_18($('#buscar_eq_18').val());" class="form-control" id="buscar_eq_18" name="id_18" value="<?php echo $idNew->id_18; ?>" placeholder="ID Equipo 18">
                                    </td>
                                    <td class="eqs eqs_14">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_18" id="equipo_18" rows="3" cols="70" placeholder="Equipo 18" readonly><?php echo $idNew->equipo_18; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_14">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_18($('#buscar_18').val());" class="form-control" id="buscar_18" name="c_manager_18" value="<?php echo $idNew->c_manager_18; ?>" placeholder="COD Manager 18">
                                    </td>
                                    <td class="eqs eqs_14">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_18" id="producto_18" rows="3" cols="70" placeholder="Producto 18" readonly><?php echo $idNew->producto_18; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_14">
                                        <select class="form-select" name="u_m_18" id="u_m_18">
                                            <option value="<?php echo $idNew->u_m_18; ?>"><?php echo $idNew->u_m_18; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_14">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_18" name="cantidad_18" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_18; ?>" placeholder="Cantidad 18">
                                    </td>
                                    <td class="eqs eqs_14">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_18" name="valor_unitario_18" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_18; ?>" placeholder="V.Unitario 18">
                                    </td>
                                    <td class="eqs eqs_14">
                                        <input type="text" class="form-control" id="neto_18" name="neto_18" value="<?php echo $idNew->neto_18; ?>" placeholder="NETO 18" readonly>
                                    </td>
                                    <td class="eqs eqs_14">
                                        <input type="text" class="form-control" id="iva_18" name="iva_18" value="<?php echo $idNew->iva_18; ?>" placeholder="IVA 18" readonly>
                                    </td>
                                    <td class="eqs eqs_14">
                                        <input type="text" class="form-control" id="total_18" name="total_18" value="<?php echo $idNew->total_18; ?>" placeholder="Total 18" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_15">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_19" id="detalle_compra_19" rows="3" cols="70" placeholder="Detalle Compra 19"><?php echo $idNew->detalle_compra_19; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_15">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_19($('#buscar_eq_19').val());" class="form-control" id="buscar_eq_19" name="id_19" value="<?php echo $idNew->id_19; ?>" placeholder="ID Equipo 19">
                                    </td>
                                    <td class="eqs eqs_15">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_19" id="equipo_19" rows="3" cols="70" placeholder="Equipo 19" readonly><?php echo $idNew->equipo_19; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_15">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_19($('#buscar_19').val());" class="form-control" id="buscar_19" name="c_manager_19" value="<?php echo $idNew->c_manager_19; ?>" placeholder="COD Manager 19">
                                    </td>
                                    <td class="eqs eqs_15">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_19" id="producto_19" rows="3" cols="70" placeholder="Producto 19" readonly><?php echo $idNew->producto_19; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_15">
                                        <select class="form-select" name="u_m_19" id="u_m_19">
                                            <option value="<?php echo $idNew->u_m_19; ?>"><?php echo $idNew->u_m_19; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_15">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_19" name="cantidad_19" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_19; ?>" placeholder="Cantidad 19">
                                    </td>
                                    <td class="eqs eqs_15">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_19" name="valor_unitario_19" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_19; ?>" placeholder="V.Unitario 19">
                                    </td>
                                    <td class="eqs eqs_15">
                                        <input type="text" class="form-control" id="neto_19" name="neto_19" value="<?php echo $idNew->neto_19; ?>" placeholder="NETO 19" readonly>
                                    </td>
                                    <td class="eqs eqs_15">
                                        <input type="text" class="form-control" id="iva_19" name="iva_19" value="<?php echo $idNew->iva_19; ?>" placeholder="IVA 19" readonly>
                                    </td>
                                    <td class="eqs eqs_15">
                                        <input type="text" class="form-control" id="total_19" name="total_19" value="<?php echo $idNew->total_19; ?>" placeholder="Total 19" readonly>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="eqs eqs_16">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="detalle_compra_20" id="detalle_compra_20" rows="3" cols="70" placeholder="Detalle Compra 20"><?php echo $idNew->detalle_compra_20; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_16">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="1" onkeyup="buscar_equipo_20($('#buscar_eq_20').val());" class="form-control" id="buscar_eq_20" name="id_20" value="<?php echo $idNew->id_20; ?>" placeholder="ID Equipo 20">
                                    </td>
                                    <td class="eqs eqs_16">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="equipo_20" id="equipo_20" rows="3" cols="70" placeholder="Equipo 20" readonly><?php echo $idNew->equipo_20; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_16">
                                        <input style="background-color: rgb(195, 209, 254);" type="number" min="0" onkeyup="buscar_ahora_20($('#buscar_20').val());" class="form-control" id="buscar_20" name="c_manager_20" value="<?php echo $idNew->c_manager_20; ?>" placeholder="COD Manager 20">
                                    </td>
                                    <td class="eqs eqs_16">
                                        <textarea style="background-color: rgb(230, 230, 250);" class="form-control sizeT" name="producto_20" id="producto_20" rows="3" cols="70" placeholder="Producto 20" readonly><?php echo $idNew->producto_20; ?></textarea>
                                    </td>
                                    <td class="eqs eqs_16">
                                        <select class="form-select" name="u_m_20" id="u_m_20">
                                            <option value="<?php echo $idNew->u_m_20; ?>"><?php echo $idNew->u_m_20; ?></option>
                                            <option value="METROS">METROS</option>
                                            <option value="KILOS">KILOS</option>
                                            <option value="LITROS">LITROS</option>
                                            <option value="TINETAS">TINETAS</option>
                                            <option value="ROLLO">ROLLO</option>
                                            <option value="BOLSA">BOLSA</option>
                                            <option value="KIT">KIT</option>
                                            <option value="SET">SET</option>
                                            <option value="TIRAS">TIRAS</option>
                                            <option value="CAJAS">CAJAS</option>
                                            <option value="RESMA">RESMA</option>
                                            <option value="GALONES">GALONES</option>
                                            <option value="PARES">PARES</option>
                                            <option value="M3">M3</option>
                                            <option value="M2">M2</option>
                                        </select>
                                    </td>
                                    <td class="eqs eqs_16">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="cantidad_20" name="cantidad_20" oninput="calculoPorCantidad()" value="<?php echo $idNew->cantidad_20; ?>" placeholder="Cantidad 20">
                                    </td>
                                    <td class="eqs eqs_16">
                                        <input style="background-color: rgb(230, 230, 250);" type="number" min="0" class="form-control" id="valor_unitario_20" name="valor_unitario_20" oninput="calculoPorCantidad()" value="<?php echo $idNew->valor_unitario_20; ?>" placeholder="V.Unitario 20">
                                    </td>
                                    <td class="eqs eqs_16">
                                        <input type="text" class="form-control" id="neto_20" name="neto_20" value="<?php echo $idNew->neto_20; ?>" placeholder="NETO 20" readonly>
                                    </td>
                                    <td class="eqs eqs_16">
                                        <input type="text" class="form-control" id="iva_20" name="iva_20" value="<?php echo $idNew->iva_20; ?>" placeholder="IVA 20" readonly>
                                    </td>
                                    <td class="eqs eqs_16">
                                        <input type="text" class="form-control" id="total_20" name="total_20" value="<?php echo $idNew->total_20; ?>" placeholder="Total 20" readonly>
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
                                    <th><input type="text" class="form-control" id="totalNetos" name="neto_gral" value="<?php echo $idNew->neto_gral; ?>" placeholder="TOTAL NETO" readonly></th>
                                    <th><input type="text" class="form-control" id="totalIvas" name="iva_gral" value="<?php echo $idNew->iva_gral; ?>" placeholder="TOTAL IVA" readonly></th>
                                    <th><input type="text" class="form-control" id="totales" name="total_gral" value="<?php echo $idNew->total_gral; ?>" placeholder="TOTAL" readonly></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Termino Tabla -->

                    <!-- Validacion -->
                    <input type="hidden" name="oculto" value="1">
                    <input type="hidden" name="envioID" value="<?php echo $idNew->id_peticiones; ?>">

                    <!-- Botones -->
                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="button" id="myForm3At" class="btn btn-primary" style="width: 10em; margin-right: 1em;">Anterior</button>


                            <button type="submit" class="btn btn-success" style="width: 10em; margin-right: 1em;">Guardar</button>
                            <a href="../../proceso_peticiones.php" class="btn btn-danger" style="width: 10em;">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form><br><br>
    </div>

    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <!-- DataTables JS-->
    <script type="text/javascript" src="../../datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../../js/main.js"></script>

    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/selectDinamico.js"></script>

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

    <!-- Ocultar filas -->
    <script src="../../js/ocultarFilasPeticiones.js"></script>

</body>

</html>