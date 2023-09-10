<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION") {

        if (!isset($_POST['oculto'])) {
            header('Location: ../../extintores.php');
        }

        include '../../config/conexion.php';

        $envioID = $_POST['envioID'];

        $cod_nui = $_POST['cod_nui'];
        $n_inventario = $_POST['n_inventario'];
        $recinto = $_POST['recinto'];
        $edificio = $_POST['edificio'];
        $piso = $_POST['piso'];
        $sala_pasillo = $_POST['sala_pasillo'];
        $servicio_usuario = $_POST['servicio_usuario'];
        $sector = $_POST['sector'];
        $tipo_extintor = $_POST['tipo_extintor'];
        $kg = $_POST['kg'];
        $fecha_mantencion = $_POST['fecha_mantencion'];
        $estado = $_POST['estado'];
        $preg_nanometro = $_POST['preg_nanometro'];
        $preg_certificacion = $_POST['preg_certificacion'];
        $preg_sello_garantia = $_POST['preg_sello_garantia'];
        $preg_ident_cilindro = $_POST['preg_ident_cilindro'];
        $preg_mants_vigentes = $_POST['preg_mants_vigentes'];
        $preg_lugar_visible = $_POST['preg_lugar_visible'];
        $preg_senaletica_ubic = $_POST['preg_senaletica_ubic'];
        $preg_facil_acceso = $_POST['preg_facil_acceso'];
        $preg_altura_no_mayor = $_POST['preg_altura_no_mayor'];
        $preg_etiqueta_frontal = $_POST['preg_etiqueta_frontal'];
        $preg_activado = $_POST['preg_activado'];
        $preg_buena_fijacion = $_POST['preg_buena_fijacion'];
        $preg_pintura = $_POST['preg_pintura'];
        $preg_estado_general = $_POST['preg_estado_general'];
        $preg_etiqueta_posterior = $_POST['preg_etiqueta_posterior'];
        $preg_etiqueta_serv_tec = $_POST['preg_etiqueta_serv_tec'];



        $sentencia = $bd->prepare("UPDATE extintores SET cod_nui = ?, n_inventario = ?, recinto = ?, edificio = ?, piso = ?, sala_pasillo = ?, servicio_usuario = ?, sector = ?, 
                                    tipo_extintor = ?, kg = ?, fecha_mantencion = ?, estado = ?, preg_nanometro = ?, preg_certificacion = ?, preg_sello_garantia = ?, 
                                    preg_ident_cilindro = ?, preg_mants_vigentes = ?, preg_lugar_visible = ?, preg_senaletica_ubic = ?, preg_facil_acceso = ?, 
                                    preg_altura_no_mayor = ?, preg_etiqueta_frontal = ?, preg_activado = ?, preg_buena_fijacion = ?, preg_pintura = ?, preg_estado_general = ?, 
                                    preg_etiqueta_posterior = ?, preg_etiqueta_serv_tec = ? WHERE id_extintor = ?;");


        $resultado = $sentencia->execute([
            $cod_nui, $n_inventario, $recinto, $edificio, $piso, $sala_pasillo, $servicio_usuario, $sector, $tipo_extintor, $kg, $fecha_mantencion,
            $estado, $preg_nanometro, $preg_certificacion, $preg_sello_garantia, $preg_ident_cilindro, $preg_mants_vigentes, $preg_lugar_visible,
            $preg_senaletica_ubic, $preg_facil_acceso, $preg_altura_no_mayor, $preg_etiqueta_frontal, $preg_activado, $preg_buena_fijacion,
            $preg_pintura, $preg_estado_general, $preg_etiqueta_posterior, $preg_etiqueta_serv_tec, $envioID
        ]);


        if ($resultado === TRUE) {
            header('Location: ../../extintores.php');
        } else {
            echo "Error";
        }



        // IMPORTAR ARCHIVOS
        $plano_ubicacion = $_FILES['plano_ubicacion']['name'];
        $guardardo_1 = $_FILES['plano_ubicacion']['tmp_name'];


        if ($plano_ubicacion != null) {
            if (!file_exists('../../planos/' . $envioID . '/Adjunto')) {
                mkdir('../../planos/' . $envioID . '/Adjunto', 0777, true);
                if (file_exists('../../planos/' . $envioID . '/Adjunto')) {
                    if (move_uploaded_file($guardardo_1, '../../planos/' . $envioID . '/Adjunto' . '/' . $plano_ubicacion)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_1, '../../planos/' . $envioID . '/Adjunto' . '/' . $plano_ubicacion)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }


    } elseif ($_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL") {
        header('Location: ../../catastro.php');
    }
} else {
    echo "Error de Sistema";
}
