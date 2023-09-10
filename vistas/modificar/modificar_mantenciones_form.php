<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "MANTENCION" || $_SESSION['tipo'] === "TECNICOS") {

        if (!isset($_GET['id_mantenciones_key'])) {
            header('Location: ../../catastro.php');
        }

        include '../../config/conexion.php';

        $id_mantenciones_key = $_GET['id_mantenciones_key'];

        $sentencia = $bd->prepare("SELECT * FROM mantenciones WHERE id_mantenciones = ?;");
        $sentencia->execute([$id_mantenciones_key]);

        $idNew = $sentencia->fetch(PDO::FETCH_OBJ);


        // ID CATASTRO
        $id_catastro = $_GET['id_catastro_key'];

        //! CIERRE

    } elseif ($_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL") {
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
    <title>Modificar Mantenciones</title>
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
            <h3 style="text-align:center; margin-top: 20px;">Modificar Mantenciones</h3>
        </div><br>

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/modificar/modificar_mantenciones.php" enctype="multipart/form-data" autocomplete="off">



            <div class="card">
                <h5 class="card-header">Modificar</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="responsable" class="col-sm-2 control-label">Responsable</label>
                            <select class="form-select" name="responsable" id="responsable" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->responsable; ?>"><?php echo $idNew->responsable; ?></option>
                                <option value="ALEX REYES HENRIQUEZ">ALEX REYES HENRIQUEZ</option>
                                <option value="GRECIA SANCHEZ MACHO">GRECIA SANCHEZ MACHO</option>
                                <option value="SEBASTIAN TORRES CARVALLO">SEBASTIAN TORRES CARVALLO</option>
                                <option value="JUAN AGUILA TRIVIÑOS">JUAN AGUILA TRIVIÑOS</option>
                                <option value="ALEJANDRO AMPUERO MUÑOZ">ALEJANDRO AMPUERO MUÑOZ</option>
                                <option value="LUIS DELGADO MACLOAD">LUIS DELGADO MACLOAD</option>
                                <option value="JORGE PINO PINO">JORGE PINO PINO</option>
                                <option value="RODRIGO GUTIERREZ VELIZ">RODRIGO GUTIERREZ VELIZ</option>
                                <option value="RICHARD MARDONES ALVAREZ">RICHARD MARDONES ALVAREZ</option>
                                <option value="FABIAN FLANDEZ FILOZA">FABIAN FLANDEZ FILOZA</option>
                                <option value="FRANCISCO PRADINES">FRANCISCO PRADINES</option>
                                <option value="JOSE CEBALLOS CARCAMO">JOSE CEBALLOS CARCAMO</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="correo_responsable" class="col-sm-2 control-label">Correo</label>
                            <select class="form-select" name="correo_responsable" id="correo_responsable" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->correo_responsable; ?>"><?php echo $idNew->correo_responsable; ?></option>
                                <option value="alex.reyes@redsalud.gov.cl">alex.reyes@redsalud.gov.cl</option>
                                <option value="grecia.sanchez@redsalud.gob.cl">grecia.sanchez@redsalud.gob.cl</option>
                                <option value="sebastian.torres@redsalud.gob.cl">sebastian.torres@redsalud.gob.cl</option>
                                <option value="juan.aguila@redsalug.gov.cl">juan.aguila@redsalug.gov.cl</option>
                                <option value="alejandro.ampuero@redsalud.gov.cl">alejandro.ampuero@redsalud.gov.cl</option>
                                <option value="luis.delgado@redsalud.gob.cl">luis.delgado@redsalud.gob.cl</option>
                                <option value="jorge.pinohb@redsalud.gov.cl">jorge.pinohb@redsalud.gov.cl</option>
                                <option value="rodrigo.gutierrez@redsalud.gov.cl">rodrigo.gutierrez@redsalud.gov.cl</option>
                                <option value="richard.mardones@redsalud.gov.cl">richard.mardones@redsalud.gov.cl</option>
                                <option value="fabian.flandez@redsalud.gov.cl">fabian.flandez@redsalud.gov.cl</option>
                                <option value="francisco.pradines@redsalud.gov.cl">francisco.pradines@redsalud.gov.cl</option>
                                <option value="jose.ceballos@redsalud.gob.cl">jose.ceballos@redsalud.gob.cl</option>
                            </select>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="ubicacion" class="col-sm-2 control-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?php echo $idNew->ubicacion; ?>" placeholder="Ubicacion" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="acreditacion" class="col-sm-2 control-label">Acreditación</label>
                            <select class="form-select" name="acreditacion" id="acreditacion" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->acreditacion; ?>"><?php echo $idNew->acreditacion; ?></option>
                                <option value="EQ-2.1">EQ-2.1</option>
                                <option value="EQ-2.2">EQ-2.2</option>
                                <option value="INS-3.1">INS-3.1</option>
                                <option value="INS-3.2">INS-3.2</option>
                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="estado" class="col-sm-2 control-label">Estado</label>
                            <select class="form-select" name="estado" id="estado" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->estado; ?>"><?php echo $idNew->estado; ?></option>
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
                            <input type="text" class="form-control" id="id_licitacion_convenio" name="id_licitacion_convenio" value="<?php echo $idNew->id_licitacion_convenio; ?>" placeholder="ID Licitación Convenio" required>
                        </div>

                        <div class="form-group col">
                            <label for="empresa_adjudicada" class="col-sm-2 control-label">Empr Adjudicada</label>
                            <input type="text" class="form-control" id="empresa_adjudicada" name="empresa_adjudicada" value="<?php echo $idNew->empresa_adjudicada; ?>" placeholder="Empresa Adjudicada" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="fecha_inicio_convenio" class="col-sm-2 control-label">Inic Convenio</label>
                            <input type="date" class="form-control" id="fecha_inicio_convenio" name="fecha_inicio_convenio" value="<?php echo $idNew->fecha_inicio_convenio; ?>" oninput="months()" placeholder="Inicio Convenio" required>
                        </div><br>

                        <div class="form-group col">
                            <label for="fecha_termino_convenio" class="col-sm-2 control-label">Trm Convenio</label>
                            <input type="date" class="form-control" id="fecha_termino_convenio" name="fecha_termino_convenio" value="<?php echo $idNew->fecha_termino_convenio; ?>" oninput="months()" placeholder="Termino Convenio" required>
                        </div>

                        <div class="form-group col">
                            <label for="duracion_en_meses" class="col-sm-2 control-label">Dura/Meses</label>
                            <input type="text" class="form-control" id="duracion_en_meses" name="duracion_en_meses" value="<?php echo $idNew->duracion_en_meses; ?>" readonly>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="peridiocidad" class="col-sm-2 control-label">Peridiocidad</label>
                            <select class="form-select" name="peridiocidad" id="peridiocidad" oninput="maintenance()" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->peridiocidad; ?>"><?php echo $idNew->peridiocidad; ?></option>
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
                            <input type="text" class="form-control" id="n_manten_preventivas" name="n_manten_preventivas" style="margin-bottom: 0.5rem;" value="<?php echo $idNew->n_mantenciones_p; ?>" readonly>

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
                                    <th>Archivos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="mts mts_1">
                                        <input type="month" class="form-control" id="programado_1" name="programado_1" value="<?php echo $idNew->programado_1; ?>">
                                    </td>
                                    <td class="mts mts_1">
                                        <input type="date" class="form-control" id="fecha_mp_1" name="fecha_mp_1" value="<?php echo $idNew->fecha_mp_1; ?>">
                                    </td>
                                    <td class="mts mts_1">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_1" name="adjunto_1">
                                    </td>
                                    <td class="mts mts_1">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 1")) {
                                            $directorio = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 1");

                                            while ($elemento_1 = readdir($directorio)) {
                                                if ($elemento_1 != '.' && $elemento_1 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 1" . $elemento_1)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 1/$elemento_1' target='_blank'>$elemento_1/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 1/$elemento_1' target='_blank'>$elemento_1</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_2">
                                        <input type="month" class="form-control" id="programado_2" name="programado_2" value="<?php echo $idNew->programado_2; ?>">
                                    </td>
                                    <td class="mts mts_2">
                                        <input type="date" class="form-control" id="fecha_mp_2" name="fecha_mp_2" value="<?php echo $idNew->fecha_mp_2; ?>">
                                    </td>
                                    <td class="mts mts_2">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_2" name="adjunto_2">
                                    </td>
                                    <td class="mts mts_2">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 2")) {
                                            $directorio_2 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 2");

                                            while ($elemento_2 = readdir($directorio_2)) {
                                                if ($elemento_2 != '.' && $elemento_2 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 2" . $elemento_2)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 2/$elemento_2' target='_blank'>$elemento_2/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 2/$elemento_2' target='_blank'>$elemento_2</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_3">
                                        <input type="month" class="form-control" id="programado_3" name="programado_3" value="<?php echo $idNew->programado_3; ?>">
                                    </td>
                                    <td class="mts mts_3">
                                        <input type="date" class="form-control" id="fecha_mp_3" name="fecha_mp_3" value="<?php echo $idNew->fecha_mp_3; ?>">
                                    </td>
                                    <td class="mts mts_3">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_3" name="adjunto_3">
                                    </td>
                                    <td class="mts mts_3">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 3")) {
                                            $directorio_3 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 3");

                                            while ($elemento_3 = readdir($directorio_3)) {
                                                if ($elemento_3 != '.' && $elemento_3 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 3" . $elemento_3)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 3/$elemento_3' target='_blank'>$elemento_3/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 3/$elemento_3' target='_blank'>$elemento_3</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_4">
                                        <input type="month" class="form-control" id="programado_4" name="programado_4" value="<?php echo $idNew->programado_4; ?>">
                                    </td>
                                    <td class="mts mts_4">
                                        <input type="date" class="form-control" id="fecha_mp_4" name="fecha_mp_4" value="<?php echo $idNew->fecha_mp_4; ?>">
                                    </td>
                                    <td class="mts mts_4">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_4" name="adjunto_4">
                                    </td>
                                    <td class="mts mts_4">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 4")) {
                                            $directorio_4 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 4");

                                            while ($elemento_4 = readdir($directorio_4)) {
                                                if ($elemento_4 != '.' && $elemento_4 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 4" . $elemento_4)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 4/$elemento_4' target='_blank'>$elemento_4/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 4/$elemento_4' target='_blank'>$elemento_4</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_5">
                                        <input type="month" class="form-control" id="programado_5" name="programado_5" value="<?php echo $idNew->programado_5; ?>">
                                    </td>
                                    <td class="mts mts_5">
                                        <input type="date" class="form-control" id="fecha_mp_5" name="fecha_mp_5" value="<?php echo $idNew->fecha_mp_5; ?>">
                                    </td>
                                    <td class="mts mts_5">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_5" name="adjunto_5">
                                    </td>
                                    <td class="mts mts_5">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 5")) {
                                            $directorio_5 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 5");

                                            while ($elemento_5 = readdir($directorio_5)) {
                                                if ($elemento_5 != '.' && $elemento_5 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 5" . $elemento_5)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 5/$elemento_5' target='_blank'>$elemento_5/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 5/$elemento_5' target='_blank'>$elemento_5</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_6">
                                        <input type="month" class="form-control" id="programado_6" name="programado_6" value="<?php echo $idNew->programado_6; ?>">
                                    </td>
                                    <td class="mts mts_6">
                                        <input type="date" class="form-control" id="fecha_mp_6" name="fecha_mp_6" value="<?php echo $idNew->fecha_mp_6; ?>">
                                    </td>
                                    <td class="mts mts_6">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_6" name="adjunto_6">
                                    </td>
                                    <td class="mts mts_6">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 6")) {
                                            $directorio_6 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 6");

                                            while ($elemento_6 = readdir($directorio_6)) {
                                                if ($elemento_6 != '.' && $elemento_6 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 6" . $elemento_6)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 6/$elemento_6' target='_blank'>$elemento_6/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 6/$elemento_6' target='_blank'>$elemento_6</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_7">
                                        <input type="month" class="form-control" id="programado_7" name="programado_7" value="<?php echo $idNew->programado_7; ?>">
                                    </td>
                                    <td class="mts mts_7">
                                        <input type="date" class="form-control" id="fecha_mp_7" name="fecha_mp_7" value="<?php echo $idNew->fecha_mp_7; ?>">
                                    </td>
                                    <td class="mts mts_7">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_7" name="adjunto_7">
                                    </td>
                                    <td class="mts mts_7">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 7")) {
                                            $directorio_7 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 7");

                                            while ($elemento_7 = readdir($directorio_7)) {
                                                if ($elemento_7 != '.' && $elemento_7 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 7" . $elemento_7)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 7/$elemento_7' target='_blank'>$elemento_7/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 7/$elemento_7' target='_blank'>$elemento_7</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_8">
                                        <input type="month" class="form-control" id="programado_8" name="programado_8" value="<?php echo $idNew->programado_8; ?>">
                                    </td>
                                    <td class="mts mts_8">
                                        <input type="date" class="form-control" id="fecha_mp_8" name="fecha_mp_8" value="<?php echo $idNew->fecha_mp_8; ?>">
                                    </td>
                                    <td class="mts mts_8">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_8" name="adjunto_8">
                                    </td>
                                    <td class="mts mts_8">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 8")) {
                                            $directorio_8 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 8");

                                            while ($elemento_8 = readdir($directorio_8)) {
                                                if ($elemento_8 != '.' && $elemento_8 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 8" . $elemento_8)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 8/$elemento_8' target='_blank'>$elemento_8/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 8/$elemento_8' target='_blank'>$elemento_8</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_9">
                                        <input type="month" class="form-control" id="programado_9" name="programado_9" value="<?php echo $idNew->programado_9; ?>">
                                    </td>
                                    <td class="mts mts_9">
                                        <input type="date" class="form-control" id="fecha_mp_9" name="fecha_mp_9" value="<?php echo $idNew->fecha_mp_9; ?>">
                                    </td>
                                    <td class="mts mts_9">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_9" name="adjunto_9">
                                    </td>
                                    <td class="mts mts_9">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 9")) {
                                            $directorio_9 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 9");

                                            while ($elemento_9 = readdir($directorio_9)) {
                                                if ($elemento_9 != '.' && $elemento_9 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 9" . $elemento_9)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 9/$elemento_9' target='_blank'>$elemento_9/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 9/$elemento_9' target='_blank'>$elemento_9</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_10">
                                        <input type="month" class="form-control" id="programado_10" name="programado_10" value="<?php echo $idNew->programado_10; ?>">
                                    </td>
                                    <td class="mts mts_10">
                                        <input type="date" class="form-control" id="fecha_mp_10" name="fecha_mp_10" value="<?php echo $idNew->fecha_mp_10; ?>">
                                    </td>
                                    <td class="mts mts_10">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_10" name="adjunto_10">
                                    </td>
                                    <td class="mts mts_10">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 10")) {
                                            $directorio_10 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 10");

                                            while ($elemento_10 = readdir($directorio_10)) {
                                                if ($elemento_10 != '.' && $elemento_10 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 10" . $elemento_10)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 10/$elemento_10' target='_blank'>$elemento_10/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 10/$elemento_10' target='_blank'>$elemento_10</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_11">
                                        <input type="month" class="form-control" id="programado_11" name="programado_11" value="<?php echo $idNew->programado_11; ?>">
                                    </td>
                                    <td class="mts mts_11">
                                        <input type="date" class="form-control" id="fecha_mp_11" name="fecha_mp_11" value="<?php echo $idNew->fecha_mp_11; ?>">
                                    </td>
                                    <td class="mts mts_11">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_11" name="adjunto_11">
                                    </td>
                                    <td class="mts mts_11">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 11")) {
                                            $directorio_11 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 11");

                                            while ($elemento_11 = readdir($directorio_11)) {
                                                if ($elemento_11 != '.' && $elemento_11 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 11" . $elemento_11)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 11/$elemento_11' target='_blank'>$elemento_11/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 11/$elemento_11' target='_blank'>$elemento_11</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="mts mts_12">
                                        <input type="month" class="form-control" id="programado_12" name="programado_12" value="<?php echo $idNew->programado_12; ?>">
                                    </td>
                                    <td class="mts mts_12">
                                        <input type="date" class="form-control" id="fecha_mp_12" name="fecha_mp_12" value="<?php echo $idNew->fecha_mp_12; ?>">
                                    </td>
                                    <td class="mts mts_12">
                                        <input type="file" accept=".pdf" class="form-control" id="adjunto_12" name="adjunto_12">
                                    </td>
                                    <td class="mts mts_12">
                                        <?php

                                        if (file_exists("../../mantenciones/" . $id_catastro . "/Adjunto 12")) {
                                            $directorio_12 = opendir("../../mantenciones/" . $id_catastro . "/Adjunto 12");

                                            while ($elemento_12 = readdir($directorio_12)) {
                                                if ($elemento_12 != '.' && $elemento_12 != '..') {
                                                    if (is_dir("../../mantenciones/" . $id_catastro . "/Adjunto 12" . $elemento_12)) {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 12/$elemento_12' target='_blank'>$elemento_12/</a></li>";
                                                    } else {
                                                        echo "<li><a href='../../mantenciones/$id_catastro/Adjunto 12/$elemento_12' target='_blank'>$elemento_12</a></li>";
                                                    }
                                                }
                                            }
                                        }

                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Termino Tabla -->


                    <!-- Validacion -->
                    <input type="hidden" name="oculto" value="1">
                    <input type="hidden" name="envioID" value="<?php echo $idNew->id_mantenciones; ?>">
                    <input type="hidden" name="envioIDC" value="<?php echo $id_catastro; ?>"> <!-- Envio ID Catastro -->
                    <br>

                    <!-- Botones -->
                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success" style="width: 10em; margin-right: 1em;">Guardar</button>
                            <a href="../../mantenciones.php" class="btn btn-danger" style="width: 10em;">Cancelar</a>
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