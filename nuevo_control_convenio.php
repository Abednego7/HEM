<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "MANTENCION"
    ) {
        include 'config/conexion.php';

        $sentencia = $bd->query("SELECT * FROM equipamiento ORDER BY id_relacion;");
        $equipamiento = $sentencia->fetchAll(PDO::FETCH_OBJ);
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: home_catastro');
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
    <title>Equipos en Convenios</title>

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
                <a class="btn btn-primary" href="home.php">HOME</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="control_convenio.php">Control Convenio</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="procesos/cerrar_sesion.php" class="btn btn-outline-success">Cerrar Sesión</a>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <h2 style="text-align:center; margin-top: 20px;">EQUIPOS EN CONVENIOS</h2>
            </div><br><br>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row table-responsive-sm">
                        <table id="myTable" class="table table-bordered nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Servicio</th>
                                    <th>Sector</th>
                                    <th>Equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th style="color: blue;">Serie</th>
                                    <th style="color: blue;">N Inventario</th>
                                    <th>Año Instalacion</th>
                                    <th>V.U.R Estand</th>
                                    <th>Estado</th>
                                    <th>Propiedad</th>
                                    <th>Acreditacion</th>
                                    <th>Uni.Mmto</th>
                                    <th>Inicio Gtia</th>
                                    <th>Termino Gtia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($equipamiento as $dato) {
                                    $inicio_garantia_F = date("d-m-Y", strtotime($dato->inicio_garantia));
                                    $termino_garantia_F = date("d-m-Y", strtotime($dato->termino_garantia)); ?>
                                    <tr>
                                        <td>
                                            <?php

                                            $id_relacion_key = $dato->id_relacion;


                                            // Validacion Datos Repetidos

                                            $sentenciaR = $bd->prepare("SELECT id_control_convenio_relacion FROM control_convenio WHERE id_control_convenio_relacion = ?;");      // Compara relacion_id con la variable $id_recepcion_key
                                            $sentenciaR->execute([$id_relacion_key]);                                                    // para ver si existe coincidencia

                                            $idsRecepcion = $sentenciaR->fetch(PDO::FETCH_OBJ);      // AL HACER UNA CONSULTA WHERE SE DEBE TRANSFORMAR LA SENTENCIA EN OBJETO PARA PODER TRANAJAR CON ELLA

                                            if (empty($idsRecepcion)) {                                      // VALIDA SI relacion_id ESTA VACIA
                                                echo '<a href="vistas/ingreso/ingreso_control_convenio.php?id_relacion_key=' . $dato->id_relacion . '"><i class="fas fa-handshake fa-2x" style="color: firebrick;"></i></i></a>';

                                                $idNew = $sentencia->fetch(PDO::FETCH_OBJ);
                                            } else {
                                                echo '<a href="vistas/ingreso/ingreso_control_convenio.php?id_relacion_key=' . $dato->id_relacion . '"><i class="fas fa-handshake fa-2x" style="color: mediumseagreen;"></i></i></a>';
                                            }

                                            ?>

                                        </td>
                                        <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_relacion; ?></td>
                                        <td><?php echo $dato->servicio; ?></td>
                                        <td><?php echo $dato->sector; ?></td>
                                        <td><?php echo $dato->equipo; ?></td>
                                        <td><?php echo $dato->marca; ?></td>
                                        <td><?php echo $dato->modelo; ?></td>
                                        <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->serie; ?></td>
                                        <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->num_inventario; ?></td>
                                        <td><?php echo $dato->ano_instalacion; ?></td>
                                        <td><?php echo $dato->vida_ur_estandarizada; ?></td>
                                        <td><?php echo $dato->estado_conservacion; ?></td>
                                        <td><?php echo $dato->propiedad; ?></td>
                                        <td><?php echo $dato->caracteristica_acredi; ?></td>
                                        <td><?php echo $dato->unid_mante_hbv; ?></td>
                                        <td><?php if ($dato->inicio_garantia === "0000-00-00" || $dato->inicio_garantia === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $inicio_garantia_F;
                                            }; ?></td>
                                        <td><?php if ($dato->termino_garantia === "0000-00-00" || $dato->termino_garantia === NULL) {
                                                echo 'NO APLICA';
                                            } else {
                                                echo $termino_garantia_F;
                                            }; ?></td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- DataTables JS-->

    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</body>

</html>