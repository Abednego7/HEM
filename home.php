<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['nombre'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
    }
} else {
    echo "ERROR DE INICIO DE SESION";
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

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <title>Home</title>

    <style>
        .cards {
            position: relative;
            justify-content: center;
            margin: 0 auto;
        }

        .card {
            box-shadow: 4px 4px 7px #D5D8DC;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="text-align: center;">
                        <li>
                            <button class="btn btn-success">¡Hola!, <?php echo $_SESSION['nombre']; ?></button>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <a href="procesos/cerrar_sesion.php" class="btn btn-outline-success">Cerrar Sesión</a>
                    </form>
                </div>
            </div>
        </nav>
    </header><br><br>

    <div class="container-fluid">
        <h2 style="text-align: center; margin-bottom: 1em;">MENÚ DE ACCIONES</h2>

        <div class="container-fluid">
            <div class="row cards">
                <div class="card-group col-md-3">
                    <div class="card" style="width: 20rem;">
                        <i class="fas fa-warehouse fa-2x" style="margin-top: 0.2em; text-align: center; color: seagreen;"></i>
                        <div class="card-body">
                            <h5 class="card-title">CATASTRO DE EQUIPAMIENTO</h5>
                            <p class="card-text">Ingreso de Equipos Asociados al Hospital.</p>
                            <a href="home_catastro.php" class="btn btn-primary">Ir a Catastro</a>
                        </div>
                    </div>
                </div>

                <div class="card-group col-md-3">
                    <div class="card" style="width: 20rem;">
                        <i class="fas fa-fire-extinguisher fa-2x" style="margin-top: 0.2em; text-align: center; color: darkmagenta;"></i>
                        <div class="card-body">
                            <h5 class="card-title">EXTINTORES</h5>
                            <p class="card-text">Ingreso de Extintores Asociados al Hospital.</p>
                            <a href="extintores.php" class="btn btn-primary">Ir a Extintores</a>
                        </div>
                    </div>
                </div>

                <div class="card-group col-md-3">
                    <div class="card" style="width: 20rem;">
                        <i class="fas fa-people-carry fa-2x" style="margin-top: 0.2em; text-align: center; color: maroon;"></i>
                        <div class="card-body">
                            <h5 class="card-title">PERSONAL</h5>
                            <p class="card-text">Ingreso de Personal Asociados al Hospital.</p>
                            <a href="rrhh.php" class="btn btn-primary">Ir a Personal</a>
                        </div>
                    </div>
                </div>
            </div><br>

            <div class="row cards">
                <div class="card-group col-md-3">
                    <div class="card" style="width: 20rem;">
                        <i class="fas fa-users-cog fa-2x" style="margin-top: 0.2em; text-align: center; color: saddlebrown;"></i>
                        <div class="card-body">
                            <h5 class="card-title">USUARIOS</h5>
                            <p class="card-text">Acceso exclusivo de administrador.</p>
                            <a href="usuarios.php" class="btn btn-primary">Ir a Usuarios</a>
                        </div>
                    </div>
                </div>

                <div class="card-group col-md-3">
                    <div class="card" style="width: 20rem;">
                        <i class="fas fa-cogs fa-2x" style="margin-top: 0.2em; text-align: center; color: darkslategray;"></i>
                        <div class="card-body">
                            <h5 class="card-title">PROCESO DE PETICIONES</h5>
                            <p class="card-text">Ingreso de Peticiones Asociados al Hospital.</p>
                            <a href="home_proceso_peticiones.php" class="btn btn-primary">Ir a Proceso Peticiones</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>