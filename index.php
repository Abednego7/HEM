<?php

session_start();

if (isset($_SESSION['tipo'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        header('Location: home.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">
    <title>Iniciar Sesión</title>

    <style>
        /* Waves */

        section {
            position: relative;
            width: 100%;
            height: 100vh;
            background: #3586ff;
            overflow: hidden;
        }

        section .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url("img/wave.png");
            background-size: 1000px 100px;
        }

        section .wave.wave1 {
            animation: animate 30s linear infinite;
            z-index: 1000;
            opacity: 1;
            animation-delay: 0s;
            bottom: 0;
        }

        section .wave.wave2 {
            animation: animate2 15s linear infinite;
            z-index: 999;
            opacity: 0.5;
            animation-delay: -5s;
            bottom: 10px;
        }

        section .wave.wave3 {
            animation: animate 30s linear infinite;
            z-index: 998;
            opacity: 0.2;
            animation-delay: -2s;
            bottom: 15;
        }

        section .wave.wave4 {
            animation: animate2 5s linear infinite;
            z-index: 997;
            opacity: 0.7;
            animation-delay: -5s;
            bottom: 20px;
        }

        @keyframes animate {
            0% {
                background-position-x: 0;
            }

            100% {
                background-position-x: 1000px;
            }
        }

        @keyframes animate2 {
            0% {
                background-position-x: 0;
            }

            100% {
                background-position-x: -1000px;
            }
        }
    </style>
</head>

<body>
    <section>
        <div class="container vh-100">
            <div class="row align-items-center vh-100">
                <div class="col-lg-5 mx-auto">
                    <div class="bg-white p-5 rounded shadow">
                        <form action="procesos/login_proceso.php" method="POST">
                            <h3 style="text-align: center; margin-bottom: 1em;">Iniciar Sesión</h3>
                            <div class="mb-3">
                                <label for="emailUser" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="emailUser" id="emailUser" aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">Inicio Seguro.</div>
                            </div>

                            <label for="passUser" class="form-label">Contraseña</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="passUser" id="passUser">
                                </div>
                            </div><br>
                            <button type="submit" class="btn btn-primary" name="botonlg">Iniciar Sesión</button>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Información
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Información</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Estimado visitante,</p>

                        <p>
                            Me complace mucho que visite mi proyecto. Este fue un trabajo de aproximadamente un año en el que trabajé
                            intensamente con el <strong>Hospital Base de Valdivia</strong> como <strong>único</strong> programador. Durante este tiempo, se realizaron
                            diferentes pruebas para el desarrollo de un sistema aún más avanzado. Por lo tanto, este es un proyecto "demo" que tiene muchas funcionalidades,
                            pero que aún está en desarrollo. Espero que pueda ver todo lo que ofrece.
                        </p>

                        <p>Si tiene alguna duda sobre las tecnologías que utilizo, aquí le dejo un listado:</p>

                        <ul>
                            <li>PHP (puro)</li>
                            <li>HTML5</li>
                            <li>CSS3</li>
                            <li>Bootstrap 5</li>
                            <li>JS</li>
                            <li>jQuery</li>
                            <li>AJAX</li>
                            <li>MySQL</li>
                        </ul>

                        <p>Librerías y herramientas adicionales:</p>
                        <ul>
                            <li>Generado de PDF: FPDF</li>
                            <li>Tablas dinámicas: Datatables</li>
                        </ul>

                        <p><strong>Credenciales:</strong></p>
                        <div class="alert alert-danger" role="alert">
                            <strong>Correo: </strong>usuario@pruebas.cl <br>
                            <strong>Contraseña: </strong>123
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
    </section>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>