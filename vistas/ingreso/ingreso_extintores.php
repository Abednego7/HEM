<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS") {
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
    <link rel="stylesheet" href="../../general_styles.css"> <!-- Estilos Generales -->
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../img/favicon.png">
    <title>Ingreso Extintor</title>

    <style>
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
                <a class="btn btn-primary" href="../../extintores.php">HOME</a>
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
            <h3 style="text-align:center; margin-top: 20px;">Ingreso Extintor</h3>
        </div><br>

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/guardar/guardar_extintores.php" autocomplete="off">
            <div class="card" id="form-1">
                <h5 class="card-header">Ingreso</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="cod_nui" class="col-sm-2 control-label">Cod Uni</label>
                            <input type="text" class="form-control" id="cod_nui" name="cod_nui" placeholder="COD NUI" required>
                        </div>

                        <div class="form-group col">
                            <label for="n_inventario" class="col-sm-2 control-label">N Invent</label>
                            <input type="text" class="form-control" id="n_inventario" name="n_inventario" placeholder="N Inventario" required>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="recinto" class="col-sm-2 control-label">Recinto</label>
                            <input type="text" class="form-control" id="recinto" name="recinto" placeholder="Recinto" required>
                        </div>

                        <div class="form-group col">
                            <label for="servicio_usuario" class="col-sm-2 control-label">Serv Usuario</label>
                            <input type="text" class="form-control" id="servicio_usuario" name="servicio_usuario" placeholder="Servicio Usuario" required>
                        </div>
                    </div><br>


                    <div class="row">
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
                            <label for="sector" class="col-sm-2 control-label">Sector</label>
                            <input type="text" class="form-control" id="sector" name="sector" placeholder="Sector" required>
                        </div>

                        <div class="form-group col">
                            <label for="tipo_extintor" class="col-sm-2 control-label">Tipo Extintor</label>
                            <input type="text" class="form-control" id="tipo_extintor" name="tipo_extintor" placeholder="Tipo Extintor" required>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="kg" class="col-sm-2 control-label">KG</label>
                            <input type="text" class="form-control" id="kg" name="kg" placeholder="KG" required>
                        </div>

                        <div class="form-group col">
                            <label for="fecha_mantencion" class="col-sm-2 control-label">Fecha Mant</label>
                            <input type="month" class="form-control" id="fecha_mantencion" name="fecha_mantencion" placeholder="Fecha Mantencion" required>
                        </div>

                        <div class="form-group col">
                            <label for="estado" class="col-sm-2 control-label">Estado</label>
                            <select class="form-select" name="estado" id="estado" require>
                                <option value="BUENO">BUENO</option>
                                <option value="MALO">MALO</option>
                                <option value="REGULAR">REGULAR</option>
                            </select>
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
                <h5 class="card-header">Ingreso</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_nanometro" class="col-sm-2 control-label">¿El Manometro del extintor indica una presion normal de carga?</label>
                            <select class="form-select" name="preg_nanometro" id="preg_nanometro" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_certificacion" class="col-sm-2 control-label">¿El extintor esta certificado?</label>
                            <select class="form-select" name="preg_certificacion" id="preg_certificacion" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_sello_garantia" class="col-sm-2 control-label">¿El extintor de incendio, posee sello de garantia platicos, facil de retirar?</label>
                            <select class="form-select" name="preg_sello_garantia" id="preg_sello_garantia" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_ident_cilindro" class="col-sm-2 control-label">¿La etiqueta de identificacion del cilindro corresponde con el tipo del extintor: Clase A, B, C, D, K?</label>
                            <select class="form-select" name="preg_ident_cilindro" id="preg_ident_cilindro" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_mants_vigentes" class="col-sm-2 control-label">¿El agente extintor se encuentra con las mantenciones vigentes segun señala la etiqueta de fechas de carga?</label>
                            <select class="form-select" name="preg_mants_vigentes" id="preg_mants_vigentes" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
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
                <h5 class="card-header">Ingreso</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_lugar_visible" class="col-sm-2 control-label">¿El extintor se encuentra en un lugar visible?</label>
                            <select class="form-select" name="preg_lugar_visible" id="preg_lugar_visible" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_senaletica_ubic" class="col-sm-2 control-label">¿El extintor cuenta con señaletica de su ubicacion?</label>
                            <select class="form-select" name="preg_senaletica_ubic" id="preg_senaletica_ubic" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_facil_acceso" class="col-sm-2 control-label">¿El equipo extintor es de facil acceso y retiro de usuarios?</label>
                            <select class="form-select" name="preg_facil_acceso" id="preg_facil_acceso" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_altura_no_mayor" class="col-sm-2 control-label">¿El extintor se encuentra en una altura no mayor de 1,30 MTS desde la base de este al suelo?</label>
                            <select class="form-select" name="preg_altura_no_mayor" id="preg_altura_no_mayor" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_etiqueta_frontal" class="col-sm-2 control-label">¿El extintor cuenta con la etiqueta frontal, con la informacion minima segun DS 44?</label>
                            <select class="form-select" name="preg_etiqueta_frontal" id="preg_etiqueta_frontal" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
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
                <h5 class="card-header">Ingreso</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_activado" class="col-sm-2 control-label">¿El extintor ha sido activado o utilizado?</label>
                            <select class="form-select" name="preg_activado" id="preg_activado" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_buena_fijacion" class="col-sm-2 control-label">¿Se encuentra bien fijada la manguera o el cono del cilindro a la valvula del extintor?</label>
                            <select class="form-select" name="preg_buena_fijacion" id="preg_buena_fijacion" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_pintura" class="col-sm-2 control-label">¿La pintura del cilindro esta en buenas condiciones?</label>
                            <select class="form-select" name="preg_pintura" id="preg_pintura" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_estado_general" class="col-sm-2 control-label">¿El estado general del extintor, permite seguir utilizandolo en forma segura?</label>
                            <select class="form-select" name="preg_estado_general" id="preg_estado_general" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_etiqueta_posterior" class="col-sm-2 control-label">¿El extintor cuenta con la etiqueta posterior, con la informacion minima segun DS 44?</label>
                            <select class="form-select" name="preg_etiqueta_posterior" id="preg_etiqueta_posterior" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>


                    <div class="row">
                        <div class="form-group col">
                            <label for="preg_etiqueta_serv_tec" class="col-sm-2 control-label">¿El extintor cuenta con la etiqueta del servicio tecnico, segun DS 44?</label>
                            <select class="form-select" name="preg_etiqueta_serv_tec" id="preg_etiqueta_serv_tec" require>
                                <option value="0">SELECCIONE</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div><br>

                    <input type="hidden" name="oculto" value="1"> <!--  Validacion -->

                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="button" id="myForm4At" class="btn btn-primary" style="width: 10em; margin-right: 1em;">Anterior</button>

                            <button type="submit" class="btn btn-success" style="width: 10em; margin-right: 1em;">Guardar</button>
                            <a href="../../extintores.php" class="btn btn-danger" style="width: 10em;">Cancelar</a>
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