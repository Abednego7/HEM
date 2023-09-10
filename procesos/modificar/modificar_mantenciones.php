<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "MANTENCION" || $_SESSION['tipo'] === "TECNICOS") {

        if (!isset($_POST['oculto'])) {
            header('Location: ../../catastro.php');
        }

        include '../../config/conexion.php';

        $envioID = $_POST['envioID'];


        // ID CATASTRO
        $envioIDC = $_POST['envioIDC'];

        $responsable = $_POST['responsable'];
        $correo_responsable = $_POST['correo_responsable'];
        $ubicacion = $_POST['ubicacion'];
        $acreditacion = $_POST['acreditacion'];
        $estado = $_POST['estado'];
        $id_licitacion_convenio = $_POST['id_licitacion_convenio'];
        $empresa_adjudicada = $_POST['empresa_adjudicada'];
        $fecha_inicio_convenio = $_POST['fecha_inicio_convenio'];
        $fecha_termino_convenio = $_POST['fecha_termino_convenio'];
        $duracion_en_meses = $_POST['duracion_en_meses'];
        $peridiocidad = $_POST['peridiocidad'];
        $n_manten_preventivas = $_POST['n_manten_preventivas'];

        // MANTENCIONES
        $programado_1 = $_POST['programado_1'];
        $fecha_mp_1 = $_POST['fecha_mp_1'];

        $programado_2 = $_POST['programado_2'];
        $fecha_mp_2 = $_POST['fecha_mp_2'];

        $programado_3 = $_POST['programado_3'];
        $fecha_mp_3 = $_POST['fecha_mp_3'];

        $programado_4 = $_POST['programado_4'];
        $fecha_mp_4 = $_POST['fecha_mp_4'];

        $programado_5 = $_POST['programado_5'];
        $fecha_mp_5 = $_POST['fecha_mp_5'];

        $programado_6 = $_POST['programado_6'];
        $fecha_mp_6 = $_POST['fecha_mp_6'];

        $programado_7 = $_POST['programado_7'];
        $fecha_mp_7 = $_POST['fecha_mp_7'];

        $programado_8 = $_POST['programado_8'];
        $fecha_mp_8 = $_POST['fecha_mp_8'];

        $programado_9 = $_POST['programado_9'];
        $fecha_mp_9 = $_POST['fecha_mp_9'];

        $programado_10 = $_POST['programado_10'];
        $fecha_mp_10 = $_POST['fecha_mp_10'];

        $programado_11 = $_POST['programado_11'];
        $fecha_mp_11 = $_POST['fecha_mp_11'];

        $programado_12 = $_POST['programado_12'];
        $fecha_mp_12 = $_POST['fecha_mp_12'];


        $sentencia = $bd->prepare("UPDATE mantenciones SET responsable = ?, correo_responsable = ?, ubicacion = ?, acreditacion = ?, estado = ?, id_licitacion_convenio = ?, 
            empresa_adjudicada = ?, fecha_inicio_convenio = ?, fecha_termino_convenio = ?, duracion_en_meses = ?, peridiocidad = ?, n_mantenciones_p = ?, 
            programado_1 = ?, fecha_mp_1 = ?, programado_2 = ?, fecha_mp_2 = ?, programado_3 = ?, fecha_mp_3 = ?, programado_4 = ?, fecha_mp_4 = ?, programado_5 = ?, fecha_mp_5 = ?, 
            programado_6 = ?, fecha_mp_6 = ?, programado_7 = ?, fecha_mp_7 = ?, programado_8 = ?, fecha_mp_8 = ?, programado_9 = ?, fecha_mp_9 = ?, programado_10 = ?, fecha_mp_10 = ?, 
            programado_11 = ?, fecha_mp_11 = ?, programado_12 = ?, fecha_mp_12 = ? WHERE id_mantenciones = ?;");

        $resultado = $sentencia->execute([
            $responsable, $correo_responsable, $ubicacion, $acreditacion, $estado, $id_licitacion_convenio, $empresa_adjudicada, $fecha_inicio_convenio,
            $fecha_termino_convenio, $duracion_en_meses, $peridiocidad, $n_manten_preventivas,
            $programado_1, $fecha_mp_1, $programado_2, $fecha_mp_2, $programado_3, $fecha_mp_3, $programado_4, $fecha_mp_4, $programado_5, $fecha_mp_5,
            $programado_6, $fecha_mp_6, $programado_7, $fecha_mp_7, $programado_8, $fecha_mp_8, $programado_9, $fecha_mp_9, $programado_10, $fecha_mp_10,
            $programado_11, $fecha_mp_11, $programado_12, $fecha_mp_12,
            $envioID
        ]);

        if ($resultado === TRUE) {
            header('Location: ../../mantenciones.php');
        } else {
            echo "Error";
        }


        // IMPORTAR ARCHIVOS 
        $adjunto_1 = $_FILES['adjunto_1']['name'];
        $guardardo_1 = $_FILES['adjunto_1']['tmp_name'];

        $adjunto_2 = $_FILES['adjunto_2']['name'];
        $guardardo_2 = $_FILES['adjunto_2']['tmp_name'];

        $adjunto_3 = $_FILES['adjunto_3']['name'];
        $guardardo_3 = $_FILES['adjunto_3']['tmp_name'];

        $adjunto_4 = $_FILES['adjunto_4']['name'];
        $guardardo_4 = $_FILES['adjunto_4']['tmp_name'];

        $adjunto_5 = $_FILES['adjunto_5']['name'];
        $guardardo_5 = $_FILES['adjunto_5']['tmp_name'];

        $adjunto_6 = $_FILES['adjunto_6']['name'];
        $guardardo_6 = $_FILES['adjunto_6']['tmp_name'];

        $adjunto_7 = $_FILES['adjunto_7']['name'];
        $guardardo_7 = $_FILES['adjunto_7']['tmp_name'];

        $adjunto_8 = $_FILES['adjunto_8']['name'];
        $guardardo_8 = $_FILES['adjunto_8']['tmp_name'];

        $adjunto_9 = $_FILES['adjunto_9']['name'];
        $guardardo_9 = $_FILES['adjunto_9']['tmp_name'];

        $adjunto_10 = $_FILES['adjunto_10']['name'];
        $guardardo_10 = $_FILES['adjunto_10']['tmp_name'];

        $adjunto_11 = $_FILES['adjunto_11']['name'];
        $guardardo_11 = $_FILES['adjunto_11']['tmp_name'];

        $adjunto_12 = $_FILES['adjunto_12']['name'];
        $guardardo_12 = $_FILES['adjunto_12']['tmp_name'];


        if ($adjunto_1 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 1')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 1', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 1')) {
                    if (move_uploaded_file($guardardo_1, '../../mantenciones/' . $envioIDC . '/Adjunto 1' . '/' . $adjunto_1)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_1, '../../mantenciones/' . $envioIDC . '/Adjunto 1' . '/' . $adjunto_1)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 2
        if ($adjunto_2 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 2')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 2', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 2')) {
                    if (move_uploaded_file($guardardo_2, '../../mantenciones/' . $envioIDC . '/Adjunto 2' . '/' . $adjunto_2)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_2, '../../mantenciones/' . $envioIDC . '/Adjunto 2' . '/' . $adjunto_2)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 3
        if ($adjunto_3 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 3')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 3', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 3')) {
                    if (move_uploaded_file($guardardo_3, '../../mantenciones/' . $envioIDC . '/Adjunto 3' . '/' . $adjunto_3)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_3, '../../mantenciones/' . $envioIDC . '/Adjunto 3' . '/' . $adjunto_3)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 4
        if ($adjunto_4 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 4')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 4', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 4')) {
                    if (move_uploaded_file($guardardo_4, '../../mantenciones/' . $envioIDC . '/Adjunto 4' . '/' . $adjunto_4)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_4, '../../mantenciones/' . $envioIDC . '/Adjunto 4' . '/' . $adjunto_4)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 5
        if ($adjunto_5 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 5')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 5', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 5')) {
                    if (move_uploaded_file($guardardo_5, '../../mantenciones/' . $envioIDC . '/Adjunto 5' . '/' . $adjunto_5)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_5, '../../mantenciones/' . $envioIDC . '/Adjunto 5' . '/' . $adjunto_5)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 6
        if ($adjunto_6 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 6')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 6', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 6')) {
                    if (move_uploaded_file($guardardo_6, '../../mantenciones/' . $envioIDC . '/Adjunto 6' . '/' . $adjunto_6)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_6, '../../mantenciones/' . $envioIDC . '/Adjunto 6' . '/' . $adjunto_6)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 7
        if ($adjunto_7 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 7')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 7', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 7')) {
                    if (move_uploaded_file($guardardo_7, '../../mantenciones/' . $envioIDC . '/Adjunto 7' . '/' . $adjunto_7)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_7, '../../mantenciones/' . $envioIDC . '/Adjunto 7' . '/' . $adjunto_7)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 8
        if ($adjunto_8 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 8')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 8', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 8')) {
                    if (move_uploaded_file($guardardo_8, '../../mantenciones/' . $envioIDC . '/Adjunto 8' . '/' . $adjunto_8)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_8, '../../mantenciones/' . $envioIDC . '/Adjunto 8' . '/' . $adjunto_8)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 9
        if ($adjunto_9 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 9')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 9', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 9')) {
                    if (move_uploaded_file($guardardo_9, '../../mantenciones/' . $envioIDC . '/Adjunto 9' . '/' . $adjunto_9)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_9, '../../mantenciones/' . $envioIDC . '/Adjunto 9' . '/' . $adjunto_9)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 10
        if ($adjunto_10 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 10')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 10', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 10')) {
                    if (move_uploaded_file($guardardo_10, '../../mantenciones/' . $envioIDC . '/Adjunto 10' . '/' . $adjunto_10)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_10, '../../mantenciones/' . $envioIDC . '/Adjunto 10' . '/' . $adjunto_10)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 11
        if ($adjunto_11 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 11')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 11', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 11')) {
                    if (move_uploaded_file($guardardo_11, '../../mantenciones/' . $envioIDC . '/Adjunto 11' . '/' . $adjunto_11)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_11, '../../mantenciones/' . $envioIDC . '/Adjunto 11' . '/' . $adjunto_11)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }

        // Adjunto 12
        if ($adjunto_12 != null) {
            if (!file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 12')) {
                mkdir('../../mantenciones/' . $envioIDC . '/Adjunto 12', 0777, true);
                if (file_exists('../../mantenciones/' . $envioIDC . '/Adjunto 12')) {
                    if (move_uploaded_file($guardardo_12, '../../mantenciones/' . $envioIDC . '/Adjunto 12' . '/' . $adjunto_12)) {
                        echo 'Archivo guardado';
                    } else {
                        echo 'error';
                    }
                }
            } else {
                if (move_uploaded_file($guardardo_12, '../../mantenciones/' . $envioIDC . '/Adjunto 12' . '/' . $adjunto_12)) {
                    echo 'exito';
                } else {
                    echo 'error';
                }
            }
        }
    } elseif ($_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL") {
        header('Location: ../../catastro.php');
    }
} else {
    echo "Error de Sistema";
}
