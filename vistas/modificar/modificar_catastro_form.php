<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION") {
        if (!isset($_GET['id_relacion_key'])) {
            header('Location: ../../catastro.php');
        }

        include '../../config/conexion.php';

        $id_relacion_key = $_GET['id_relacion_key'];

        $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
        $sentencia->execute([$id_relacion_key]);

        $idNew = $sentencia->fetch(PDO::FETCH_OBJ);
    } elseif ($_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL") {
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
    <title>Modificar Catastro</title>

    <style>
        .form-2 {
            display: none;
        }
    </style>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="btn btn-primary" href="../../catastro.php">HOME</a>
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
            <h3 style="text-align:center; margin-top: 20px;">Modificar Catastro</h3>
        </div><br>

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/modificar/modificar_catastro_proceso.php" autocomplete="off">
            <!-- Form 1 -->
            <div class="card" id="form-1">
                <h5 class="card-header">Modificar</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="equipos_instalaciones" class="col-sm-2 control-label">Eqs/Insta</label>
                            <select class="form-select" name="equipos_instalaciones" id="equipos_instalaciones">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->equipos_instalaciones; ?>"><?php echo $idNew->equipos_instalaciones; ?></option>
                                <option value="EQ.MEDICO">EQ.MEDICO</option>
                                <option value="EQ.INDUSTRIAL">EQ.INDUSTRIAL</option>
                                <option value="COMPONENTE">COMPONENTE</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="servicio" class="col-sm-2 control-label">Servicio</label>
                            <select class="form-select" name="servicio" id="servicio">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->servicio; ?>"><?php echo $idNew->servicio; ?></option>
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
                            <input type="text" class="form-control" id="sector" name="sector" placeholder="Sector" value="<?php echo $idNew->sector; ?>">
                        </div>

                        <div class="form-group col">
                            <label for="clase" class="col-sm-2 control-label">Clase</label>
                            <select class="form-select" name="clase" id="clase">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->clase; ?>"><?php echo $idNew->clase; ?></option>
                                <option value="APOYO DIAGNÓSTICO">APOYO DIAGNÓSTICO</option>
                                <option value="APOYO ENDOSCÓPICO">APOYO ENDOSCÓPICO</option>
                                <option value="APOYO INDUSTRIAL">APOYO INDUSTRIAL</option>
                                <option value="APOYO QUIRÚRGICO">APOYO QUIRÚRGICO</option>
                                <option value="APOYO TERAPÉUTICO">APOYO TERAPÉUTICO</option>
                                <option value="ESTERILIZACIÓN">ESTERILIZACIÓN</option>
                                <option value="IMAGENOLOGÍA">IMAGENOLOGÍA</option>
                                <option value="LABORATORIO/FARMAC">LABORATORIO/FARMAC</option>
                                <option value="MED.FÍS.REHABILITACIÓN">MED.FÍS.REHABILITACIÓN</option>
                                <option value="MONITOREO">MONITOREO</option>
                                <option value="ODONTOLOGÍA">ODONTOLOGÍA</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="subclase" class="col-sm-2 control-label">Sub Clase</label>
                            <select class="form-select" name="subclase" id="subclase">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->subclase; ?>"><?php echo $idNew->subclase; ?></option>
                                <option value="ALTO COSTO">ALTO COSTO</option>
                                <option value="MEDIANO COSTO">MEDIANO COSTO</option>
                                <option value="BAJO COSTO">BAJO COSTO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="def_ley_pres" class="col-sm-2 control-label">Def_Ley_Presu</label>
                            <select class="form-select" name="def_ley_pres" id="def_ley_pres">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->def_ley_presupuesto; ?>"><?php echo $idNew->def_ley_presupuesto; ?></option>
                                <option value="EQUIPO">EQUIPO</option>
                                <option value="EQUIPAMIENTO">EQUIPAMIENTO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="equipo" class="col-sm-2 control-label">Equipo</label>
                            <input type="text" class="form-control" id="equipo" name="equipo" placeholder="Equipo" value="<?php echo $idNew->equipo; ?>">
                        </div>

                        <div class="form-group col">
                            <label for="marca" class="col-sm-2 control-label">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" placeholder="Marca" value="<?php echo $idNew->marca; ?>">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="modelo" class="col-sm-2 control-label">Modelo</label>
                            <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo" value="<?php echo $idNew->modelo; ?>">
                        </div>

                        <div class="form-group col">
                            <label for="serie" class="col-sm-2 control-label">Serie</label>
                            <input type="text" class="form-control" id="serie" name="serie" placeholder="Serie" value="<?php echo $idNew->serie; ?>">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="valor" class="col-sm-2 control-label">Valor</label>
                            <input type="number" class="form-control" id="valor" name="valor" placeholder="Valor" value="<?php echo $idNew->valor; ?>">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="num_inventario" class="col-sm-2 control-label">Número Inventario</label>
                            <input type="text" class="form-control" id="num_inventario" name="num_inventario" placeholder="Ingrese Número Inventario con Precaución" value="<?php echo $idNew->num_inventario; ?>">
                        </div>

                        <div class="form-group col">
                            <label for="ano_instalacion" class="col-sm-2 control-label">Año Insta</label>
                            <input type="number" class="form-control" id="ano_instalacion" name="ano_instalacion" placeholder="Año Instalación" min="1939" max="9999" value="<?php echo $idNew->ano_instalacion; ?>">
                        </div>
                    </div><br>

                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="button" id="myForm1" class="btn btn-primary" style="width: 10em;">Siguiente</button>
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
                            <label for="vida_util" class="col-sm-2 control-label">Vida Util</label>
                            <input type="number" class="form-control" id="vida_util" name="vida_util" placeholder="Vida Util" min="1" value="<?php echo $idNew->vida_util; ?>">
                        </div>

                        <div class="form-group col">
                            <label for="vida_util_residual" class="col-sm-2 control-label">V.U Residual</label>
                            <input type="number" class="form-control" id="vida_util_residual" name="vida_util_residual" placeholder="Vida Util Residual" value="<?php echo $idNew->vida_util_residual; ?>">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="vida_ur_estandarizada" class="col-sm-2 control-label">V.U.R Estandarizada</label>
                            <input type="number" class="form-control" id="vida_ur_estandarizada" name="vida_ur_estandarizada" placeholder="Vida Util Residual Estandarizada" min="0" value="<?php echo $idNew->vida_ur_estandarizada; ?>">
                        </div>

                        <div class="form-group col">
                            <label for="estado_conservacion" class="col-sm-2 control-label">Estado</label>
                            <select class="form-select" name="estado_conservacion" id="estado_conservacion">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->estado_conservacion; ?>"><?php echo $idNew->estado_conservacion; ?></option>
                                <option value="BUENO">BUENO</option>
                                <option value="MALO">MALO</option>
                                <option value="REGULAR">REGULAR</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="propiedad" class="col-sm-2 control-label">Propiedad</label>
                            <select class="form-select" name="propiedad" id="propiedad">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->propiedad; ?>"><?php echo $idNew->propiedad; ?></option>
                                <option value="HBV">HBV</option>
                                <option value="SSV">SSV</option>
                                <option value="MINSAL">MINSAL</option>
                                <option value="GORE">GORE</option>
                                <option value="UACH">UACH</option>
                                <option value="PRESTAMO">PRESTAMO</option>
                                <option value="ARRIENDO">ARRIENDO</option>
                                <option value="COMODATO">COMODATO</option>
                                <option value="DEMOSTRACIÓN">DEMOSTRACIÓN</option>
                                <option value="DONACION">DONACION</option>
                                <option value="LEY RICARTE SOTO">LEY RICARTE SOTO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="progr_mantenimiento" class="col-sm-2 control-label">Progr de Mant</label>
                            <select class="form-select" name="progr_mantenimiento" id="progr_mantenimiento">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->progr_mantenimiento; ?>"><?php echo $idNew->progr_mantenimiento; ?></option>
                                <option value="EQ-2.1">EQ-2.1</option>
                                <option value="EQ-2.2">EQ-2.2</option>
                                <option value="INS-3.1">INS-3.1</option>
                                <option value="INS-3.2">INS-3.2</option>
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="caracteristicas_acredi" class="col-sm-2 control-label">Carac Acreditación</label>
                            <select class="form-select" name="caracteristica_acredi" id="caracteristica_acredi">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->caracteristica_acredi; ?>"><?php echo $idNew->caracteristica_acredi; ?></option>
                                <option value="INCUBADORAS">INCUBADORAS</option>
                                <option value="MONITORES DESFIBRILADORES">MONITORES DESFIBRILADORES</option>
                                <option value="MAQUINAS DE ANESTESIA">MAQUINAS DE ANESTESIA</option>
                                <option value="VENTILADORES MECANICOS">VENTILADORES MECANICOS</option>
                                <option value="EQUIPOS DE MONITORIZACION HEMODINAMICA">EQUIPOS DE MONITORIZACION HEMODINAMICA</option>
                                <option value="AUTOCLAVES">AUTOCLAVES</option>
                                <option value="REFRIGERADORES DE SANGRE Y HEMODERIVADOS">REFRIGERADORES DE SANGRE Y HEMODERIVADOS</option>
                                <option value="CAMPANAS DE FLUJO LAMINAR">CAMPANAS DE FLUJO LAMINAR</option>
                                <option value="EQUIPOS DE DIALISIS">EQUIPOS DE DIALISIS</option>
                                <option value="EQUIPOS DE LABORATORIO">EQUIPOS DE LABORATORIO</option>
                                <option value="EQUIPOS DE IMAGENOLOGIA">EQUIPOS DE IMAGENOLOGIA</option>
                                <option value="EQUIPOS DE RADIOTERAPIA">EQUIPOS DE RADIOTERAPIA</option>
                                <option value="EQUIPOS DE PLANTA DE TRATAMIENTO DE AGUA">EQUIPOS DE PLANTA DE TRATAMIENTO DE AGUA</option>
                                <option value="SISTEMAS DE ASPIRACION Y GASES CLINICOS">SISTEMAS DE ASPIRACION Y GASES CLINICOS</option>
                                <option value="CALDERAS">CALDERAS</option>
                                <option value="ASCENSORES">ASCENSORES</option>
                                <option value="SISTEMAS DE CLIMATIZACION PARA UNIDADES Y AREAS CLINICAS RELEVANTES">SISTEMAS DE CLIMATIZACION PARA UNIDADES Y AREAS CLINICAS RELEVANTES</option>
                                <option value="GRUPOS ELECTROGENOS">GRUPOS ELECTROGENOS</option>
                                <option value="SISTEMAS DE PRESURIZACION DE AGUA POTABLE">SISTEMAS DE PRESURIZACION DE AGUA POTABLE</option>
                                <option value="N/A">N/A</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="uni_mantenimiento_hbv" class="col-sm-2 control-label">Uni de Mant</label>
                            <select class="form-select" name="uni_mantenimiento_hbv" id="uni_mantenimiento_hbv">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->unid_mante_hbv; ?>"><?php echo $idNew->unid_mante_hbv; ?></option>
                                <option value="EQUIPOS MEDICOS">EQUIPOS MEDICOS</option>
                                <option value="EQUIPOS INDUSTRIALES">EQUIPOS INDUSTRIALES</option>
                                <option value="REDES ELECTRICAS">REDES ELECTRICAS</option>
                                <option value="SERV. LOGISTICA">SERV. LOGISTICA</option>
                                <option value="MOVILIZACION">MOVILIZACION</option>
                                <option value="INFRAESTRUCTURA">INFRAESTRUCTURA</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="ref_tecnico" class="col-sm-2 control-label">Ref Tecnico</label>
                            <select class="form-select" name="ref_tecnico" id="ref_tecnico">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->referente_tecnico; ?>"><?php echo $idNew->referente_tecnico; ?></option>
                                <option value="NARUTO UZUMAKI">NARUTO UZUMAKI</option>
                                <option value="SENKU ISHIGAMI">SENKU ISHIGAMI</option>
                                <option value="IPPO MAKUNOUCHI">IPPO MAKUNOUCHI</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="periodicidad_mp" class="col-sm-2 control-label">Periodicidad MP</label>
                            <select class="form-select" name="periodicidad_mp" id="periodicidad_mp">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->periodicidad_mp; ?>"><?php echo $idNew->periodicidad_mp; ?></option>
                                <option value="SEMANAL">SEMANAL</option>
                                <option value="MENSUAL">MENSUAL</option>
                                <option value="BIMESTRAL">BIMESTRAL</option>
                                <option value="TRIMESTRAL">TRIMESTRAL</option>
                                <option value="CUATRIMESTRAL">CUATRIMESTRAL</option>
                                <option value="SEMESTRAL">SEMESTRAL</option>
                                <option value="ANUAL">ANUAL</option>
                                <option value="BIENAL">BIENAL</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="id_licitacion" class="col-sm-2 control-label">ID Licitacion</label>
                            <input type="text" class="form-control" id="id_licitacion" name="id_licitacion" placeholder="ID Licitacion" value="<?php echo $idNew->id_licitacion; ?>">
                        </div>

                        <div class="form-group col">
                            <label for="inicio_garantia" class="col-sm-2 control-label">Inic Gtia</label>
                            <input type="date" class="form-control" id="inicio_garantia" name="inicio_garantia" placeholder="Inicio Garantia" value="<?php echo $idNew->inicio_garantia; ?>">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="termi_garantia" class="col-sm-2 control-label">Term Gtia</label>
                            <input type="date" class="form-control" id="termi_garantia" name="termi_garantia" placeholder="Termino Garantia" value="<?php echo $idNew->termino_garantia; ?>">
                        </div>

                        <div class="form-group col">
                            <label for="empresa" class="col-sm-2 control-label">Empresa</label>
                            <select class="form-select" name="empresa" id="empresa">
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->empresa; ?>"><?php echo $idNew->empresa; ?></option>
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
                            </select>
                        </div>
                    </div><br>

                    <!-- Validacion -->
                    <input type="hidden" name="oculto" value="1">
                    <input type="hidden" name="envioID" value="<?php echo $idNew->id_relacion; ?>">


                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="button" id="myForm2At" class="btn btn-primary" style="width: 10em; margin-right: 1em;">Anterior</button>


                            <button type="submit" class="btn btn-success" style="width: 10em; margin-right: 1em;">Modificar</button>
                            <a href="../../catastro.php" class="btn btn-danger" style="width: 10em;">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form><br><br>
    </div>

    <!-- Jquery and Bootstrap -->
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/bootstrap.js"></script>

    <!-- Display Forms -->
    <script>
        $("#myForm1").click(function() {
            $("#form-1").css("display", "none");
            $("#form-2").css("display", "block");
        });

        // Backs
        $("#myForm2At").click(function() {
            $("#form-1").css("display", "block");
            $("#form-2").css("display", "none");
        });
    </script>
</body>

</html>