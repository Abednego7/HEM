<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR") {

        if (!isset($_GET['id_usuario_key'])) {
            header('Location: ../../usuarios.php');
        }

        include '../../config/conexion.php';

        $id_usuario_key = $_GET['id_usuario_key'];

        $sentencia = $bd->prepare("SELECT id_usuario, nombre, correo, contrasena, tipo_usuario FROM usuarios WHERE id_usuario = ?;");
        $sentencia->execute([$id_usuario_key]);

        $idNew = $sentencia->fetch(PDO::FETCH_OBJ);
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
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
    <title>Modificar Usuario</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="btn btn-primary" href="../../usuarios.php">HOME</a>
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
            <h3 style="text-align:center; margin-top: 20px;">Modificar Usuario</h3>
        </div><br>

        <form class="form-horizontal form-bg" method="POST" action="../../procesos/modificar/modificar_usuario_proceso.php" autocomplete="off">
            <div class="card">
                <h5 class="card-header">Modificar</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col">
                            <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $idNew->nombre; ?>" required>
                        </div>

                        <div class="form-group col">
                            <label for="correo" class="col-sm-2 control-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" value="<?php echo $idNew->correo; ?>" required>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="form-group col">
                            <label for="pass" class="col-sm-2 control-label">Contraseña</label>
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                        </div>

                        <div class="form-group col">
                            <label for="tipo_de_usuario" class="col-sm-2 control-label">Tipo_de_Usuario</label>
                            <select class="form-select" name="tipo_de_usuario" id="tipo_de_usuario" require>
                                <option style="background-color: rgb(241, 105, 146);" value="<?php echo $idNew->tipo_usuario; ?>"><?php echo $idNew->tipo_usuario; ?></option>
                                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                <option value="PROYECTOS">PROYECTOS</option>
                                <option value="MANTENCION">MANTENCION</option>
                                <option value="TECNICOS">TECNICOS</option>
                                <option value="SECRETARIA">SECRETARIA</option>
                                <option value="SECRETARIA GENERAL">SECRETARIA GENERAL</option>
                                <option value="CONTABILIDAD">CONTABILIDAD</option>
                            </select>
                        </div>
                    </div><br>

                    <input type="hidden" name="oculto" value="1"> <!-- Validacion -->
                    <input type="hidden" name="envioID" value="<?php echo $idNew->id_usuario; ?>">

                    <div class="form-group d-flex justify-content-center">
                        <div class="col-sm-offset-2 col-sm-10 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success" style="width: 10em; margin-right: 1em;">Modificar</button>
                            <a href="../../usuarios.php" class="btn btn-danger" style="width: 10em;">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="../../js/bootstrap.js"></script>
</body>

</html>