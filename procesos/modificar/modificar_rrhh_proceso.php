<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" ||  $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL") {

        if (!isset($_POST['oculto'])) {
            header('Location: ../../rrhh.php');
        }

        include '../../config/conexion.php';

        $envioID = $_POST['envioID'];

        $dep_subdepto = $_POST['dep_subdepto'];
        $unid_especifica = $_POST['unid_especifica'];
        $nombre = $_POST['nombre'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $apellido_materno = $_POST['apellido_materno'];
        $rut = $_POST['rut'];
        $calidad = $_POST['calidad'];
        $escalafon = $_POST['escalafon'];
        $grado = $_POST['grado'];
        $estudio_titulo = $_POST['estudio_titulo'];
        $tipo_contrato = $_POST['tipo_contrato'];
        $ano_ingreso = $_POST['ano_ingreso'];
        $correo = $_POST['correo'];
        $domicilio = $_POST['domicilio'];
        $fono_contacto = $_POST['fono_contacto'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $edad = $_POST['edad'];
        $enfermedad_cronica = $_POST['enfermedad_cronica'];
        $estado_civil = $_POST['estado_civil'];


        $sentencia = $bd->prepare("UPDATE rrhh SET dep_subdepto = ?, unid_especifica = ?, nombre = ?, apellido_paterno = ?, apellido_materno = ?, rut = ?, 
        calidad = ?, escalafon = ?, grado = ?, estudio_titulo = ?, tipo_contrato = ?, ano_ingreso = ?, correo = ?, domicilio = ?, fono_contacto = ?, 
        fecha_nacimiento = ?, edad = ?, enfermedad_cronica = ?, estado_civil = ? WHERE id_rrhh = ?;");


        $resultado = $sentencia->execute([
            $dep_subdepto, $unid_especifica, $nombre, $apellido_paterno, $apellido_materno, $rut, $calidad, $escalafon, $grado,
            $estudio_titulo, $tipo_contrato, $ano_ingreso, $correo, $domicilio, $fono_contacto, $fecha_nacimiento, $edad, $enfermedad_cronica, $estado_civil,
            $envioID
        ]);


        if ($resultado === TRUE) {
            header('Location: ../../rrhh.php');
        } else {
            echo "Error";
        }
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS"
    ) {
        header('Location: ../../catastro.php');
    }
} else {
    echo "Error de Sistema";
}