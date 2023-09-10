<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL") {
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS"
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
    <title>Ingreso RRHH</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="btn btn-primary" href="../../rrhh.php">HOME</a>
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
            <h3 style="text-align:center; margin-top: 20px;">Ingreso RRHH</h3>
        </div><br>

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/guardar/guardar_rrhh.php" autocomplete="off">
            <div class="card">
                <h5 class="card-header">Ingreso</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="dep_subdepto" class="col-sm-2 control-label">Dep y/o Subdepto</label>
                            <select class="form-select" name="dep_subdepto" id="dep_subdepto" require>
                                <option class="select-op-color" value="SELECCIONE">SELECCIONE</option>
                                <option value="OPERACIONES">OPERACIONES</option>
                                <option value="PROYECTOS">PROYECTOS</option>
                                <option value="INFRAESTRUCTURA">INFRAESTRUCTURA</option>
                                <option value="LOGISTICA">LOGISTICA</option>
                                <option value="APOYO HOSPITALARIO">APOYO HOSPITALARIO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="unid_especifica" class="col-sm-2 control-label">Unid Especifica</label>
                            <select class="form-select" name="unid_especifica" id="unid_especifica" require>
                                <option class="select-op-color" value="SELECCIONE">SELECCIONE</option>
                                <option value="EQ MEDICOS">EQ MEDICOS</option>
                                <option value="EQ INDUSTRIALES">EQ INDUSTRIALES</option>
                                <option value="REDES ELECTRICAS">REDES ELECTRICAS</option>
                                <option value="GASES CLINICOS">GASES CLINICOS</option>
                                <option value="GASFITERIA">GASFITERIA</option>
                                <option value="CARPINTERIA">CARPINTERIA</option>
                                <option value="SOLDADURA">SOLDADURA</option>
                                <option value="LAVANDERIA">LAVANDERIA</option>
                                <option value="UCP">UCP</option>
                                <option value="MOVILIZACION">MOVILIZACION</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="nombre" class="col-sm-2 control-label">Nombres</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required>
                        </div>

                        <div class="form-group col">
                            <label for="apellido_paterno" class="col-sm-2 control-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="apellido_materno" class="col-sm-2 control-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno" required>
                        </div>

                        <div class="form-group col">
                            <label for="rut" class="col-sm-2 control-label">RUT</label>
                            <input type="text" class="form-control" maxlength="12" id="rut" name="rut" placeholder="00.000.000-k" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="calidad" class="col-sm-2 control-label">Calidad</label>
                            <select class="form-select" name="calidad" id="calidad" require>
                                <option class="select-op-color" value="SELECCIONE">SELECCIONE</option>
                                <option value="TITULAR">TITULAR</option>
                                <option value="CONTRATA">CONTRATA</option>
                                <option value="SUPLENCIA">SUPLENCIA</option>
                                <option value="HONORARIO">HONORARIO</option>
                                <option value="HONORARIO COVID">HONORARIO COVID</option>
                                <option value="REEMPLAZO">REEMPLAZO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="escalafon" class="col-sm-2 control-label">Escalafon</label>
                            <select class="form-select" name="escalafon" id="escalafon" require>
                                <option class="select-op-color" value="SELECCIONE">SELECCIONE</option>
                                <option value="PROFESIONAL">PROFESIONAL</option>
                                <option value="TECNICO">TECNICO</option>
                                <option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
                                <option value="AUXILIAR">AUXILIAR</option>
                            </select>
                        </div>

                        <div class="form-group col-2">
                            <label for="grado" class="col-sm-2 control-label">Grado</label>
                            <input type="number" min="0" max="100" class="form-control" id="grado" name="grado" placeholder="Grado" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="estudio_titulo" class="col-sm-2 control-label">Estudio - Titulo</label>
                            <input type="text" class="form-control" id="estudio_titulo" name="estudio_titulo" placeholder="Estudio o Titulo" required>
                        </div>

                        <div class="form-group col">
                            <label for="tipo_contrato" class="col-sm-2 control-label">Tipo Contrato</label>
                            <select class="form-select" name="tipo_contrato" id="tipo_contrato" require>
                                <option class="select-op-color" value="SELECCIONE">SELECCIONE</option>
                                <option value="ANUAL">ANUAL</option>
                                <option value="INDEFINIDO">INDEFINIDO</option>
                                <option value="MENSUAL">MENSUAL</option>
                                <option value="COVID">COVID</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="ano_ingreso" class="col-sm-2 control-label">Año Ingreso</label>
                            <input type="number" class="form-control" min="1900" max="2099" step="1" id="ano_ingreso" name="ano_ingreso" placeholder="Año Ingreso" required>
                        </div>

                        <div class="form-group col">
                            <label for="correo" class="col-sm-2 control-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
                        </div>

                        <div class="form-group col">
                            <label for="domicilio" class="col-sm-2 control-label">Domicilio</label>
                            <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Domicilio" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fono_contacto" class="col-sm-2 control-label">Celular</label>
                            <input type="text" maxlength="9" class="form-control" id="fono_contacto" name="fono_contacto" placeholder="Fono Contacto" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_nacimiento" class="col-sm-2 control-label">Fecha Nac</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Fecha Nacimiento" required>
                        </div>

                        <div class="form-group col">
                            <label for="edad" class="col-sm-2 control-label">Edad</label>
                            <input type="text" class="form-control" id="edad" name="edad" readonly>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="enfermedad_cronica" class="col-sm-2 control-label">Enferm Cronica</label>
                            <input type="text" class="form-control" id="enfermedad_cronica" name="enfermedad_cronica" placeholder="Enfermedad Cronica" required>
                        </div>

                        <div class="form-group col">
                            <label for="estado_civil" class="col-sm-2 control-label">Estado Civil</label>
                            <select class="form-select" name="estado_civil" id="estado_civil" require>
                                <option value="SOLTERO">SOLTERO</option>
                                <option value="SOLTERA">SOLTERA</option>
                                <option value="CASADO">CASADO</option>
                                <option value="CASADA">CASADA</option>
                                <option value="VIUDO">VIUDO</option>
                                <option value="VIUDA">VIUDA</option>
                                <option value="DIVORCIADO">DIVORCIADO</option>
                                <option value="DIVORCIADA">DIVORCIADA</option>
                                <option value="CONVIVIENTE CIVIL">CONVIVIENTE CIVIL</option>
                            </select>
                        </div>
                    </div><br>

                    <!-- Validacion -->
                    <input type="hidden" name="oculto" value="1">

                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success" style="width: 10em; margin-right: 1em;">Guardar</button>
                            <a href="../../rrhh.php" class="btn btn-danger" style="width: 10em;">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form><br><br>
    </div>

    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/calculoNacimiento.js"></script>
</body>

</html>