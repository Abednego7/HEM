<?php

session_start();

if (!isset($_SESSION['nombre'])) {
    header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if (
        $_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL" ||
        $_SESSION['tipo'] === "TECNICOS"
    ) {

        include '../../config/conexion.php';

        if (isset($_POST['oculto'])) {

            $envioID = $_POST['envioID'];

            if ($_POST['oculto'] === "1") {

                $exigencia = $_POST['exigencia'];
                $acreditacion = $_POST['acreditacion'];
                $categoria = $_POST['categoria'];
                $covid = $_POST['covid'];
                $sub_depto = $_POST['sub_depto'];
                $unidad = $_POST['unidad'];
                $ref_tec_1 = $_POST['ref_tec_1'];
                $cargo_ref_tec_1 = $_POST['cargo_ref_tec_1'];
                $ref_tec_2 = $_POST['ref_tec_2'];
                $cargo_ref_tec_2 = $_POST['cargo_ref_tec_2'];
                $serv_usuario = $_POST['serv_usuario'];
                $sector = $_POST['sector'];
                $tipo_peticion = $_POST['tipo_peticion'];
                $descr_solicitud = $_POST['descr_solicitud'];
                $obser_pet = $_POST['obser_pet'];
                $orden_trabajo = $_POST['orden_trabajo'];
                $tipo_compra = $_POST['tipo_compra'];
                $doc_adjunta = $_POST['doc_adjunta'];
                $id_contrato_conexo = $_POST['id_contrato_conexo'];
                $plazo_entrega = $_POST['plazo_entrega'];
                $sisq = $_POST['sisq'];
                $mp = $_POST['mp'];
                $mc = $_POST['mc'];
                $eq_2_1 = $_POST['eq_2_1'];
                $eq_2_2 = $_POST['eq_2_2'];
                $ins_3_1 = $_POST['ins_3_1'];
                $ins_3_2 = $_POST['ins_3_2'];
                $plan_expansion = $_POST['plan_expansion'];
                $mal_uso = $_POST['mal_uso'];
                $garantia = $_POST["garantia"];


                // LLAMADO DE REGISTROS DEL CATASTRO #1
                $c_manager_1 = $_POST['c_manager_1'];
                $producto_1 = $_POST['producto_1'];
                $detalle_compra_1 = $_POST['detalle_compra_1'];

                $id_1 = $_POST['id_1'];

                if (empty($id_1)) {
                    $id_1 = null;
                    $equipo_1 = null;
                    $marca_1 = null;
                    $modelo_1 = null;
                    $serie_1 = null;
                    $n_inventario_1 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_1]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_1 = $idNew->equipo;
                    $marca_1 = $idNew->marca;
                    $modelo_1 = $idNew->modelo;
                    $serie_1 = $idNew->serie;
                    $n_inventario_1 = $idNew->num_inventario;
                }

                $u_m_1 = $_POST['u_m_1'];
                $cantidad_1 = $_POST['cantidad_1'];
                $valor_unitario_1 = $_POST['valor_unitario_1'];
                $neto_1 = $_POST['neto_1'];
                $iva_1 = $_POST['iva_1'];
                $total_1 = $_POST['total_1'];


                // LLAMADO DE REGISTROS DEL CATASTRO #2
                $c_manager_2 = $_POST['c_manager_2'];
                $producto_2 = $_POST['producto_2'];
                $detalle_compra_2 = $_POST['detalle_compra_2'];

                $id_2 = $_POST['id_2'];

                if (empty($id_2)) {
                    $id_2 = null;
                    $equipo_2 = null;
                    $marca_2 = null;
                    $modelo_2 = null;
                    $serie_2 = null;
                    $n_inventario_2 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_2]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_2 = $idNew->equipo;
                    $marca_2 = $idNew->marca;
                    $modelo_2 = $idNew->modelo;
                    $serie_2 = $idNew->serie;
                    $n_inventario_2 = $idNew->num_inventario;
                }

                $u_m_2 = $_POST['u_m_2'];
                $cantidad_2 = $_POST['cantidad_2'];
                $valor_unitario_2 = $_POST['valor_unitario_2'];
                $neto_2 = $_POST['neto_2'];
                $iva_2 = $_POST['iva_2'];
                $total_2 = $_POST['total_2'];


                // LLAMADO DE REGISTROS DEL CATASTRO #3
                $c_manager_3 = $_POST['c_manager_3'];
                $producto_3 = $_POST['producto_3'];
                $detalle_compra_3 = $_POST['detalle_compra_3'];

                $id_3 = $_POST['id_3'];

                if (empty($id_3)) {
                    $id_3 = null;
                    $equipo_3 = null;
                    $marca_3 = null;
                    $modelo_3 = null;
                    $serie_3 = null;
                    $n_inventario_3 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_3]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_3 = $idNew->equipo;
                    $marca_3 = $idNew->marca;
                    $modelo_3 = $idNew->modelo;
                    $serie_3 = $idNew->serie;
                    $n_inventario_3 = $idNew->num_inventario;
                }

                $u_m_3 = $_POST['u_m_3'];
                $cantidad_3 = $_POST['cantidad_3'];
                $valor_unitario_3 = $_POST['valor_unitario_3'];
                $neto_3 = $_POST['neto_3'];
                $iva_3 = $_POST['iva_3'];
                $total_3 = $_POST['total_3'];


                // LLAMADO DE REGISTROS DEL CATASTRO #4
                $c_manager_4 = $_POST['c_manager_4'];
                $producto_4 = $_POST['producto_4'];
                $detalle_compra_4 = $_POST['detalle_compra_4'];

                $id_4 = $_POST['id_4'];

                if (empty($id_4)) {
                    $id_4 = null;
                    $equipo_4 = null;
                    $marca_4 = null;
                    $modelo_4 = null;
                    $serie_4 = null;
                    $n_inventario_4 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_4]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_4 = $idNew->equipo;
                    $marca_4 = $idNew->marca;
                    $modelo_4 = $idNew->modelo;
                    $serie_4 = $idNew->serie;
                    $n_inventario_4 = $idNew->num_inventario;
                }

                $u_m_4 = $_POST['u_m_4'];
                $cantidad_4 = $_POST['cantidad_4'];
                $valor_unitario_4 = $_POST['valor_unitario_4'];
                $neto_4 = $_POST['neto_4'];
                $iva_4 = $_POST['iva_4'];
                $total_4 = $_POST['total_4'];


                // LLAMADO DE REGISTROS DEL CATASTRO #5
                $c_manager_5 = $_POST['c_manager_5'];
                $producto_5 = $_POST['producto_5'];
                $detalle_compra_5 = $_POST['detalle_compra_5'];

                $id_5 = $_POST['id_5'];

                if (empty($id_5)) {
                    $id_5 = null;
                    $equipo_5 = null;
                    $marca_5 = null;
                    $modelo_5 = null;
                    $serie_5 = null;
                    $n_inventario_5 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_5]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_5 = $idNew->equipo;
                    $marca_5 = $idNew->marca;
                    $modelo_5 = $idNew->modelo;
                    $serie_5 = $idNew->serie;
                    $n_inventario_5 = $idNew->num_inventario;
                }

                $u_m_5 = $_POST['u_m_5'];
                $cantidad_5 = $_POST['cantidad_5'];
                $valor_unitario_5 = $_POST['valor_unitario_5'];
                $neto_5 = $_POST['neto_5'];
                $iva_5 = $_POST['iva_5'];
                $total_5 = $_POST['total_5'];


                // LLAMADO DE REGISTROS DEL CATASTRO #6
                $c_manager_6 = $_POST['c_manager_6'];
                $producto_6 = $_POST['producto_6'];
                $detalle_compra_6 = $_POST['detalle_compra_6'];

                $id_6 = $_POST['id_6'];

                if (empty($id_6)) {
                    $id_6 = null;
                    $equipo_6 = null;
                    $marca_6 = null;
                    $modelo_6 = null;
                    $serie_6 = null;
                    $n_inventario_6 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_6]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_6 = $idNew->equipo;
                    $marca_6 = $idNew->marca;
                    $modelo_6 = $idNew->modelo;
                    $serie_6 = $idNew->serie;
                    $n_inventario_6 = $idNew->num_inventario;
                }

                $u_m_6 = $_POST['u_m_6'];
                $cantidad_6 = $_POST['cantidad_6'];
                $valor_unitario_6 = $_POST['valor_unitario_6'];
                $neto_6 = $_POST['neto_6'];
                $iva_6 = $_POST['iva_6'];
                $total_6 = $_POST['total_6'];


                // LLAMADO DE REGISTROS DEL CATASTRO #7
                $c_manager_7 = $_POST['c_manager_7'];
                $producto_7 = $_POST['producto_7'];
                $detalle_compra_7 = $_POST['detalle_compra_7'];

                $id_7 = $_POST['id_7'];

                if (empty($id_7)) {
                    $id_7 = null;
                    $equipo_7 = null;
                    $marca_7 = null;
                    $modelo_7 = null;
                    $serie_7 = null;
                    $n_inventario_7 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_7]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_7 = $idNew->equipo;
                    $marca_7 = $idNew->marca;
                    $modelo_7 = $idNew->modelo;
                    $serie_7 = $idNew->serie;
                    $n_inventario_7 = $idNew->num_inventario;
                }

                $u_m_7 = $_POST['u_m_7'];
                $cantidad_7 = $_POST['cantidad_7'];
                $valor_unitario_7 = $_POST['valor_unitario_7'];
                $neto_7 = $_POST['neto_7'];
                $iva_7 = $_POST['iva_7'];
                $total_7 = $_POST['total_7'];


                // LLAMADO DE REGISTROS DEL CATASTRO #8
                $c_manager_8 = $_POST['c_manager_8'];
                $producto_8 = $_POST['producto_8'];
                $detalle_compra_8 = $_POST['detalle_compra_8'];

                $id_8 = $_POST['id_8'];

                if (empty($id_8)) {
                    $id_8 = null;
                    $equipo_8 = null;
                    $marca_8 = null;
                    $modelo_8 = null;
                    $serie_8 = null;
                    $n_inventario_8 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_8]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_8 = $idNew->equipo;
                    $marca_8 = $idNew->marca;
                    $modelo_8 = $idNew->modelo;
                    $serie_8 = $idNew->serie;
                    $n_inventario_8 = $idNew->num_inventario;
                }

                $u_m_8 = $_POST['u_m_8'];
                $cantidad_8 = $_POST['cantidad_8'];
                $valor_unitario_8 = $_POST['valor_unitario_8'];
                $neto_8 = $_POST['neto_8'];
                $iva_8 = $_POST['iva_8'];
                $total_8 = $_POST['total_8'];


                // LLAMADO DE REGISTROS DEL CATASTRO #9
                $c_manager_9 = $_POST['c_manager_9'];
                $producto_9 = $_POST['producto_9'];
                $detalle_compra_9 = $_POST['detalle_compra_9'];

                $id_9 = $_POST['id_9'];

                if (empty($id_9)) {
                    $id_9 = null;
                    $equipo_9 = null;
                    $marca_9 = null;
                    $modelo_9 = null;
                    $serie_9 = null;
                    $n_inventario_9 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_9]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_9 = $idNew->equipo;
                    $marca_9 = $idNew->marca;
                    $modelo_9 = $idNew->modelo;
                    $serie_9 = $idNew->serie;
                    $n_inventario_9 = $idNew->num_inventario;
                }

                $u_m_9 = $_POST['u_m_9'];
                $cantidad_9 = $_POST['cantidad_9'];
                $valor_unitario_9 = $_POST['valor_unitario_9'];
                $neto_9 = $_POST['neto_9'];
                $iva_9 = $_POST['iva_9'];
                $total_9 = $_POST['total_9'];


                // LLAMADO DE REGISTROS DEL CATASTRO #10
                $c_manager_10 = $_POST['c_manager_10'];
                $producto_10 = $_POST['producto_10'];
                $detalle_compra_10 = $_POST['detalle_compra_10'];

                $id_10 = $_POST['id_10'];

                if (empty($id_10)) {
                    $id_10 = null;
                    $equipo_10 = null;
                    $marca_10 = null;
                    $modelo_10 = null;
                    $serie_10 = null;
                    $n_inventario_10 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_10]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_10 = $idNew->equipo;
                    $marca_10 = $idNew->marca;
                    $modelo_10 = $idNew->modelo;
                    $serie_10 = $idNew->serie;
                    $n_inventario_10 = $idNew->num_inventario;
                }

                $u_m_10 = $_POST['u_m_10'];
                $cantidad_10 = $_POST['cantidad_10'];
                $valor_unitario_10 = $_POST['valor_unitario_10'];
                $neto_10 = $_POST['neto_10'];
                $iva_10 = $_POST['iva_10'];
                $total_10 = $_POST['total_10'];


                // LLAMADO DE REGISTROS DEL CATASTRO #11
                $c_manager_11 = $_POST['c_manager_11'];
                $producto_11 = $_POST['producto_11'];
                $detalle_compra_11 = $_POST['detalle_compra_11'];

                $id_11 = $_POST['id_11'];

                if (empty($id_11)) {
                    $id_11 = null;
                    $equipo_11 = null;
                    $marca_11 = null;
                    $modelo_11 = null;
                    $serie_11 = null;
                    $n_inventario_11 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_11]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_11 = $idNew->equipo;
                    $marca_11 = $idNew->marca;
                    $modelo_11 = $idNew->modelo;
                    $serie_11 = $idNew->serie;
                    $n_inventario_11 = $idNew->num_inventario;
                }

                $u_m_11 = $_POST['u_m_11'];
                $cantidad_11 = $_POST['cantidad_11'];
                $valor_unitario_11 = $_POST['valor_unitario_11'];
                $neto_11 = $_POST['neto_11'];
                $iva_11 = $_POST['iva_11'];
                $total_11 = $_POST['total_11'];


                // LLAMADO DE REGISTROS DEL CATASTRO #12
                $c_manager_12 = $_POST['c_manager_12'];
                $producto_12 = $_POST['producto_12'];
                $detalle_compra_12 = $_POST['detalle_compra_12'];

                $id_12 = $_POST['id_12'];

                if (empty($id_12)) {
                    $id_12 = null;
                    $equipo_12 = null;
                    $marca_12 = null;
                    $modelo_12 = null;
                    $serie_12 = null;
                    $n_inventario_12 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_12]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_12 = $idNew->equipo;
                    $marca_12 = $idNew->marca;
                    $modelo_12 = $idNew->modelo;
                    $serie_12 = $idNew->serie;
                    $n_inventario_12 = $idNew->num_inventario;
                }

                $u_m_12 = $_POST['u_m_12'];
                $cantidad_12 = $_POST['cantidad_12'];
                $valor_unitario_12 = $_POST['valor_unitario_12'];
                $neto_12 = $_POST['neto_12'];
                $iva_12 = $_POST['iva_12'];
                $total_12 = $_POST['total_12'];


                // LLAMADO DE REGISTROS DEL CATASTRO #13
                $c_manager_13 = $_POST['c_manager_13'];
                $producto_13 = $_POST['producto_13'];
                $detalle_compra_13 = $_POST['detalle_compra_13'];

                $id_13 = $_POST['id_13'];

                if (empty($id_13)) {
                    $id_13 = null;
                    $equipo_13 = null;
                    $marca_13 = null;
                    $modelo_13 = null;
                    $serie_13 = null;
                    $n_inventario_13 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_13]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_13 = $idNew->equipo;
                    $marca_13 = $idNew->marca;
                    $modelo_13 = $idNew->modelo;
                    $serie_13 = $idNew->serie;
                    $n_inventario_13 = $idNew->num_inventario;
                }

                $u_m_13 = $_POST['u_m_13'];
                $cantidad_13 = $_POST['cantidad_13'];
                $valor_unitario_13 = $_POST['valor_unitario_13'];
                $neto_13 = $_POST['neto_13'];
                $iva_13 = $_POST['iva_13'];
                $total_13 = $_POST['total_13'];


                // LLAMADO DE REGISTROS DEL CATASTRO #14
                $c_manager_14 = $_POST['c_manager_14'];
                $producto_14 = $_POST['producto_14'];
                $detalle_compra_14 = $_POST['detalle_compra_14'];

                $id_14 = $_POST['id_14'];

                if (empty($id_14)) {
                    $id_14 = null;
                    $equipo_14 = null;
                    $marca_14 = null;
                    $modelo_14 = null;
                    $serie_14 = null;
                    $n_inventario_14 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_14]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_14 = $idNew->equipo;
                    $marca_14 = $idNew->marca;
                    $modelo_14 = $idNew->modelo;
                    $serie_14 = $idNew->serie;
                    $n_inventario_14 = $idNew->num_inventario;
                }

                $u_m_14 = $_POST['u_m_14'];
                $cantidad_14 = $_POST['cantidad_14'];
                $valor_unitario_14 = $_POST['valor_unitario_14'];
                $neto_14 = $_POST['neto_14'];
                $iva_14 = $_POST['iva_14'];
                $total_14 = $_POST['total_14'];


                // LLAMADO DE REGISTROS DEL CATASTRO #15
                $c_manager_15 = $_POST['c_manager_15'];
                $producto_15 = $_POST['producto_15'];
                $detalle_compra_15 = $_POST['detalle_compra_15'];

                $id_15 = $_POST['id_15'];

                if (empty($id_15)) {
                    $id_15 = null;
                    $equipo_15 = null;
                    $marca_15 = null;
                    $modelo_15 = null;
                    $serie_15 = null;
                    $n_inventario_15 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_15]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_15 = $idNew->equipo;
                    $marca_15 = $idNew->marca;
                    $modelo_15 = $idNew->modelo;
                    $serie_15 = $idNew->serie;
                    $n_inventario_15 = $idNew->num_inventario;
                }

                $u_m_15 = $_POST['u_m_15'];
                $cantidad_15 = $_POST['cantidad_15'];
                $valor_unitario_15 = $_POST['valor_unitario_15'];
                $neto_15 = $_POST['neto_15'];
                $iva_15 = $_POST['iva_15'];
                $total_15 = $_POST['total_15'];


                // LLAMADO DE REGISTROS DEL CATASTRO #16
                $c_manager_16 = $_POST['c_manager_16'];
                $producto_16 = $_POST['producto_16'];
                $detalle_compra_16 = $_POST['detalle_compra_16'];

                $id_16 = $_POST['id_16'];

                if (empty($id_16)) {
                    $id_16 = null;
                    $equipo_16 = null;
                    $marca_16 = null;
                    $modelo_16 = null;
                    $serie_16 = null;
                    $n_inventario_16 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_16]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_16 = $idNew->equipo;
                    $marca_16 = $idNew->marca;
                    $modelo_16 = $idNew->modelo;
                    $serie_16 = $idNew->serie;
                    $n_inventario_16 = $idNew->num_inventario;
                }

                $u_m_16 = $_POST['u_m_16'];
                $cantidad_16 = $_POST['cantidad_16'];
                $valor_unitario_16 = $_POST['valor_unitario_16'];
                $neto_16 = $_POST['neto_16'];
                $iva_16 = $_POST['iva_16'];
                $total_16 = $_POST['total_16'];


                // LLAMADO DE REGISTROS DEL CATASTRO #17
                $c_manager_17 = $_POST['c_manager_17'];
                $producto_17 = $_POST['producto_17'];
                $detalle_compra_17 = $_POST['detalle_compra_17'];

                $id_17 = $_POST['id_17'];

                if (empty($id_17)) {
                    $id_17 = null;
                    $equipo_17 = null;
                    $marca_17 = null;
                    $modelo_17 = null;
                    $serie_17 = null;
                    $n_inventario_17 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_17]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_17 = $idNew->equipo;
                    $marca_17 = $idNew->marca;
                    $modelo_17 = $idNew->modelo;
                    $serie_17 = $idNew->serie;
                    $n_inventario_17 = $idNew->num_inventario;
                }

                $u_m_17 = $_POST['u_m_17'];
                $cantidad_17 = $_POST['cantidad_17'];
                $valor_unitario_17 = $_POST['valor_unitario_17'];
                $neto_17 = $_POST['neto_17'];
                $iva_17 = $_POST['iva_17'];
                $total_17 = $_POST['total_17'];


                // LLAMADO DE REGISTROS DEL CATASTRO #18
                $c_manager_18 = $_POST['c_manager_18'];
                $producto_18 = $_POST['producto_18'];
                $detalle_compra_18 = $_POST['detalle_compra_18'];

                $id_18 = $_POST['id_18'];

                if (empty($id_18)) {
                    $id_18 = null;
                    $equipo_18 = null;
                    $marca_18 = null;
                    $modelo_18 = null;
                    $serie_18 = null;
                    $n_inventario_18 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_18]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_18 = $idNew->equipo;
                    $marca_18 = $idNew->marca;
                    $modelo_18 = $idNew->modelo;
                    $serie_18 = $idNew->serie;
                    $n_inventario_18 = $idNew->num_inventario;
                }

                $u_m_18 = $_POST['u_m_18'];
                $cantidad_18 = $_POST['cantidad_18'];
                $valor_unitario_18 = $_POST['valor_unitario_18'];
                $neto_18 = $_POST['neto_18'];
                $iva_18 = $_POST['iva_18'];
                $total_18 = $_POST['total_18'];


                // LLAMADO DE REGISTROS DEL CATASTRO #19
                $c_manager_19 = $_POST['c_manager_19'];
                $producto_19 = $_POST['producto_19'];
                $detalle_compra_19 = $_POST['detalle_compra_19'];

                $id_19 = $_POST['id_19'];

                if (empty($id_19)) {
                    $id_19 = null;
                    $equipo_19 = null;
                    $marca_19 = null;
                    $modelo_19 = null;
                    $serie_19 = null;
                    $n_inventario_19 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_19]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_19 = $idNew->equipo;
                    $marca_19 = $idNew->marca;
                    $modelo_19 = $idNew->modelo;
                    $serie_19 = $idNew->serie;
                    $n_inventario_19 = $idNew->num_inventario;
                }

                $u_m_19 = $_POST['u_m_19'];
                $cantidad_19 = $_POST['cantidad_19'];
                $valor_unitario_19 = $_POST['valor_unitario_19'];
                $neto_19 = $_POST['neto_19'];
                $iva_19 = $_POST['iva_19'];
                $total_19 = $_POST['total_19'];


                // LLAMADO DE REGISTROS DEL CATASTRO #20
                $c_manager_20 = $_POST['c_manager_20'];
                $producto_20 = $_POST['producto_20'];
                $detalle_compra_20 = $_POST['detalle_compra_20'];

                $id_20 = $_POST['id_20'];

                if (empty($id_20)) {
                    $id_20 = null;
                    $equipo_20 = null;
                    $marca_20 = null;
                    $modelo_20 = null;
                    $serie_20 = null;
                    $n_inventario_20 = null;
                } else {
                    $sentencia = $bd->prepare("SELECT * FROM equipamiento WHERE id_relacion = ?;");
                    $sentencia->execute([$id_20]);
                    $idNew = $sentencia->fetch(PDO::FETCH_OBJ);

                    $equipo_20 = $idNew->equipo;
                    $marca_20 = $idNew->marca;
                    $modelo_20 = $idNew->modelo;
                    $serie_20 = $idNew->serie;
                    $n_inventario_20 = $idNew->num_inventario;
                }

                $u_m_20 = $_POST['u_m_20'];
                $cantidad_20 = $_POST['cantidad_20'];
                $valor_unitario_20 = $_POST['valor_unitario_20'];
                $neto_20 = $_POST['neto_20'];
                $iva_20 = $_POST['iva_20'];
                $total_20 = $_POST['total_20'];

                $neto_gral = $_POST['neto_gral'];
                $iva_gral = $_POST['iva_gral'];
                $total_gral = $_POST['total_gral'];
                $rut = $_POST["rut"];
                $empresa = $_POST["empresa"];
                $item_ppto_solicitado = $_POST['item_ppto_solicitado'];

                $sentencia = $bd->prepare("UPDATE proceso_peticiones SET exigencia = ?, acreditacion = ?, categoria = ?, covid = ?, sub_depto = ?, unidad = ?, ref_tec_1 = ?, cargo_ref_tec_1 = ?, 
                ref_tec_2 = ?, cargo_ref_tec_2 = ?, serv_usuario = ?, sector = ?, tipo_peticion = ?, descr_solicitud = ?, obser_pet = ?, orden_trabajo = ?, tipo_compra = ?, doc_adjunta = ?, 
                id_contrato_conexo = ?, plazo_entrega = ?, sisq = ?, mp = ?, mc = ?, eq_2_1 = ?, eq_2_2 = ?, ins_3_1 = ?, ins_3_2 = ?, plan_expansion = ?, mal_uso = ?, garantia = ?, 
                c_manager_1 = ?, producto_1 = ?, detalle_compra_1 = ?, id_1 = ?, equipo_1 = ?, marca_1 = ?, modelo_1 = ?, serie_1 = ?, n_inventario_1 = ?, u_m_1 = ?, cantidad_1 = ?, valor_unitario_1 = ?, 
                neto_1 = ?, iva_1 = ?, total_1 = ?, 
                c_manager_2 = ?, producto_2 = ?, detalle_compra_2 = ?, id_2 = ?, equipo_2 = ?, marca_2 = ?, modelo_2 = ?, serie_2 = ?, n_inventario_2 = ?, u_m_2 = ?, cantidad_2 = ?, valor_unitario_2 = ?, 
                neto_2 = ?, iva_2 = ?, total_2 = ?, 
                c_manager_3 = ?, producto_3 = ?, detalle_compra_3 = ?, id_3 = ?, equipo_3 = ?, marca_3 = ?, modelo_3 = ?, serie_3 = ?, n_inventario_3 = ?, u_m_3 = ?, cantidad_3 = ?, valor_unitario_3 = ?, 
                neto_3 = ?, iva_3 = ?, total_3 = ?, 
                c_manager_4 = ?, producto_4 = ?, detalle_compra_4 = ?, id_4 = ?, equipo_4 = ?, marca_4 = ?, modelo_4 = ?, serie_4 = ?, n_inventario_4 = ?, u_m_4 = ?, cantidad_4 = ?, valor_unitario_4 = ?, 
                neto_4 = ?, iva_4 = ?, total_4 = ?, 
                c_manager_5 = ?, producto_5 = ?, detalle_compra_5 = ?, id_5 = ?, equipo_5 = ?, marca_5 = ?, modelo_5 = ?, serie_5 = ?, n_inventario_5 = ?, u_m_5 = ?, cantidad_5 = ?, valor_unitario_5 = ?, 
                neto_5 = ?, iva_5 = ?, total_5 = ?, 
                c_manager_6 = ?, producto_6 = ?, detalle_compra_6 = ?, id_6 = ?, equipo_6 = ?, marca_6 = ?, modelo_6 = ?, serie_6 = ?, n_inventario_6 = ?, u_m_6 = ?, cantidad_6 = ?, valor_unitario_6 = ?, 
                neto_6 = ?, iva_6 = ?, total_6 = ?, 
                c_manager_7 = ?, producto_7 = ?, detalle_compra_7 = ?, id_7 = ?, equipo_7 = ?, marca_7 = ?, modelo_7 = ?, serie_7 = ?, n_inventario_7 = ?, u_m_7 = ?, cantidad_7 = ?, valor_unitario_7 = ?, 
                neto_7 = ?, iva_7 = ?, total_7 = ?, 
                c_manager_8 = ?, producto_8 = ?, detalle_compra_8 = ?, id_8 = ?, equipo_8 = ?, marca_8 = ?, modelo_8 = ?, serie_8 = ?, n_inventario_8 = ?, u_m_8 = ?, cantidad_8 = ?, valor_unitario_8 = ?, 
                neto_8 = ?, iva_8 = ?, total_8 = ?, 
                c_manager_9 = ?, producto_9 = ?, detalle_compra_9 = ?, id_9 = ?, equipo_9 = ?, marca_9 = ?, modelo_9 = ?, serie_9 = ?, n_inventario_9 = ?, u_m_9 = ?, cantidad_9 = ?, valor_unitario_9 = ?, 
                neto_9 = ?, iva_9 = ?, total_9 = ?, 
                c_manager_10 = ?, producto_10 = ?, detalle_compra_10 = ?, id_10 = ?, equipo_10 = ?, marca_10 = ?, modelo_10 = ?, serie_10 = ?, n_inventario_10 = ?, u_m_10 = ?, cantidad_10 = ?, 
                valor_unitario_10 = ?, neto_10 = ?, iva_10 = ?, total_10 = ?, 
                c_manager_11 = ?, producto_11 = ?, detalle_compra_11 = ?, id_11 = ?, equipo_11 = ?, marca_11 = ?, modelo_11 = ?, serie_11 = ?, n_inventario_11 = ?, u_m_11 = ?, cantidad_11 = ?, 
                valor_unitario_11 = ?, neto_11 = ?, iva_11 = ?, total_11 = ?, 
                c_manager_12 = ?, producto_12 = ?, detalle_compra_12 = ?, id_12 = ?, equipo_12 = ?, marca_12 = ?, modelo_12 = ?, serie_12 = ?, n_inventario_12 = ?, u_m_12 = ?, cantidad_12 = ?, 
                valor_unitario_12 = ?, neto_12 = ?, iva_12 = ?, total_12 = ?, 
                c_manager_13 = ?, producto_13 = ?, detalle_compra_13 = ?, id_13 = ?, equipo_13 = ?, marca_13 = ?, modelo_13 = ?, serie_13 = ?, n_inventario_13 = ?, u_m_13 = ?, cantidad_13 = ?, 
                valor_unitario_13 = ?, neto_13 = ?, iva_13 = ?, total_13 = ?, 
                c_manager_14 = ?, producto_14 = ?, detalle_compra_14 = ?, id_14 = ?, equipo_14 = ?, marca_14 = ?, modelo_14 = ?, serie_14 = ?, n_inventario_14 = ?, u_m_14 = ?, cantidad_14 = ?, 
                valor_unitario_14 = ?, neto_14 = ?, iva_14 = ?, total_14 = ?, 
                c_manager_15 = ?, producto_15 = ?, detalle_compra_15 = ?, id_15 = ?, equipo_15 = ?, marca_15 = ?, modelo_15 = ?, serie_15 = ?, n_inventario_15 = ?, u_m_15 = ?, cantidad_15 = ?, 
                valor_unitario_15 = ?, neto_15 = ?, iva_15 = ?, total_15 = ?, 
                c_manager_16 = ?, producto_16 = ?, detalle_compra_16 = ?, id_16 = ?, equipo_16 = ?, marca_16 = ?, modelo_16 = ?, serie_16 = ?, n_inventario_16 = ?, u_m_16 = ?, cantidad_16 = ?, 
                valor_unitario_16 = ?, neto_16 = ?, iva_16 = ?, total_16 = ?, 
                c_manager_17 = ?, producto_17 = ?, detalle_compra_17 = ?, id_17 = ?, equipo_17 = ?, marca_17 = ?, modelo_17 = ?, serie_17 = ?, n_inventario_17 = ?, u_m_17 = ?, cantidad_17 = ?, 
                valor_unitario_17 = ?, neto_17 = ?, iva_17 = ?, total_17 = ?, 
                c_manager_18 = ?, producto_18 = ?, detalle_compra_18 = ?, id_18 = ?, equipo_18 = ?, marca_18 = ?, modelo_18 = ?, serie_18 = ?, n_inventario_18 = ?, u_m_18 = ?, cantidad_18 = ?, 
                valor_unitario_18 = ?, neto_18 = ?, iva_18 = ?, total_18 = ?, 
                c_manager_19 = ?, producto_19 = ?, detalle_compra_19 = ?, id_19 = ?, equipo_19 = ?, marca_19 = ?, modelo_19 = ?, serie_19 = ?, n_inventario_19 = ?, u_m_19 = ?, cantidad_19 = ?, 
                valor_unitario_19 = ?, neto_19 = ?, iva_19 = ?, total_19 = ?, 
                c_manager_20 = ?, producto_20 = ?, detalle_compra_20 = ?, id_20 = ?, equipo_20 = ?, marca_20 = ?, modelo_20 = ?, serie_20 = ?, n_inventario_20 = ?, u_m_20 = ?, cantidad_20 = ?, 
                valor_unitario_20 = ?, neto_20 = ?, iva_20 = ?, total_20 = ?, 
                neto_gral = ?, iva_gral = ?, total_gral = ?, rut = ?, empresa = ?, item_ppto_solicitado = ?
                WHERE id_peticiones = ?;");


                $resultado = $sentencia->execute([
                    $exigencia, $acreditacion, $categoria, $covid, $sub_depto, $unidad, $ref_tec_1, $cargo_ref_tec_1, $ref_tec_2, $cargo_ref_tec_2, $serv_usuario, $sector, $tipo_peticion, $descr_solicitud,
                    $obser_pet, $orden_trabajo, $tipo_compra, $doc_adjunta, $id_contrato_conexo, $plazo_entrega, $sisq, $mp, $mc, $eq_2_1, $eq_2_2, $ins_3_1, $ins_3_2, $plan_expansion, $mal_uso, $garantia,
                    $c_manager_1, $producto_1, $detalle_compra_1, $id_1, $equipo_1, $marca_1, $modelo_1, $serie_1, $n_inventario_1, $u_m_1, $cantidad_1, $valor_unitario_1, $neto_1, $iva_1, $total_1,
                    $c_manager_2, $producto_2, $detalle_compra_2, $id_2, $equipo_2, $marca_2, $modelo_2, $serie_2, $n_inventario_2, $u_m_2, $cantidad_2, $valor_unitario_2, $neto_2, $iva_2, $total_2,
                    $c_manager_3, $producto_3, $detalle_compra_3, $id_3, $equipo_3, $marca_3, $modelo_3, $serie_3, $n_inventario_3, $u_m_3, $cantidad_3, $valor_unitario_3, $neto_3, $iva_3, $total_3,
                    $c_manager_4, $producto_4, $detalle_compra_4, $id_4, $equipo_4, $marca_4, $modelo_4, $serie_4, $n_inventario_4, $u_m_4, $cantidad_4, $valor_unitario_4, $neto_4, $iva_4, $total_4,
                    $c_manager_5, $producto_5, $detalle_compra_5, $id_5, $equipo_5, $marca_5, $modelo_5, $serie_5, $n_inventario_5, $u_m_5, $cantidad_5, $valor_unitario_5, $neto_5, $iva_5, $total_5,
                    $c_manager_6, $producto_6, $detalle_compra_6, $id_6, $equipo_6, $marca_6, $modelo_6, $serie_6, $n_inventario_6, $u_m_6, $cantidad_6, $valor_unitario_6, $neto_6, $iva_6, $total_6,
                    $c_manager_7, $producto_7, $detalle_compra_7, $id_7, $equipo_7, $marca_7, $modelo_7, $serie_7, $n_inventario_7, $u_m_7, $cantidad_7, $valor_unitario_7, $neto_7, $iva_7, $total_7,
                    $c_manager_8, $producto_8, $detalle_compra_8, $id_8, $equipo_8, $marca_8, $modelo_8, $serie_8, $n_inventario_8, $u_m_8, $cantidad_8, $valor_unitario_8, $neto_8, $iva_8, $total_8,
                    $c_manager_9, $producto_9, $detalle_compra_9, $id_9, $equipo_9, $marca_9, $modelo_9, $serie_9, $n_inventario_9, $u_m_9, $cantidad_9, $valor_unitario_9, $neto_9, $iva_9, $total_9,
                    $c_manager_10, $producto_10, $detalle_compra_10, $id_10, $equipo_10, $marca_10, $modelo_10, $serie_10, $n_inventario_10, $u_m_10, $cantidad_10, $valor_unitario_10, $neto_10, $iva_10, $total_10,
                    $c_manager_11, $producto_11, $detalle_compra_11, $id_11, $equipo_11, $marca_11, $modelo_11, $serie_11, $n_inventario_11, $u_m_11, $cantidad_11, $valor_unitario_11, $neto_11, $iva_11, $total_11,
                    $c_manager_12, $producto_12, $detalle_compra_12, $id_12, $equipo_12, $marca_12, $modelo_12, $serie_12, $n_inventario_12, $u_m_12, $cantidad_12, $valor_unitario_12, $neto_12, $iva_12, $total_12,
                    $c_manager_13, $producto_13, $detalle_compra_13, $id_13, $equipo_13, $marca_13, $modelo_13, $serie_13, $n_inventario_13, $u_m_13, $cantidad_13, $valor_unitario_13, $neto_13, $iva_13, $total_13,
                    $c_manager_14, $producto_14, $detalle_compra_14, $id_14, $equipo_14, $marca_14, $modelo_14, $serie_14, $n_inventario_14, $u_m_14, $cantidad_14, $valor_unitario_14, $neto_14, $iva_14, $total_14,
                    $c_manager_15, $producto_15, $detalle_compra_15, $id_15, $equipo_15, $marca_15, $modelo_15, $serie_15, $n_inventario_15, $u_m_15, $cantidad_15, $valor_unitario_15, $neto_15, $iva_15, $total_15,
                    $c_manager_16, $producto_16, $detalle_compra_16, $id_16, $equipo_16, $marca_16, $modelo_16, $serie_16, $n_inventario_16, $u_m_16, $cantidad_16, $valor_unitario_16, $neto_16, $iva_16, $total_16,
                    $c_manager_17, $producto_17, $detalle_compra_17, $id_17, $equipo_17, $marca_17, $modelo_17, $serie_17, $n_inventario_17, $u_m_17, $cantidad_17, $valor_unitario_17, $neto_17, $iva_17, $total_17,
                    $c_manager_18, $producto_18, $detalle_compra_18, $id_18, $equipo_18, $marca_18, $modelo_18, $serie_18, $n_inventario_18, $u_m_18, $cantidad_18, $valor_unitario_18, $neto_18, $iva_18, $total_18,
                    $c_manager_19, $producto_19, $detalle_compra_19, $id_19, $equipo_19, $marca_19, $modelo_19, $serie_19, $n_inventario_19, $u_m_19, $cantidad_19, $valor_unitario_19, $neto_19, $iva_19, $total_19,
                    $c_manager_20, $producto_20, $detalle_compra_20, $id_20, $equipo_20, $marca_20, $modelo_20, $serie_20, $n_inventario_20, $u_m_20, $cantidad_20, $valor_unitario_20, $neto_20, $iva_20, $total_20,
                    $neto_gral, $iva_gral, $total_gral, $rut, $empresa, $item_ppto_solicitado,
                    $envioID
                ]);


                if ($resultado === TRUE) {
                    echo '<script>window.history.go(-2)</script>';
                } else {
                    echo "Error";
                }
            } elseif ($_POST['oculto'] === "2") {

                $ordinario = $_POST['ordinario'];
                $fecha_ordinario = $_POST['fecha_ordinario'];
                $solici_de_compra = $_POST['solici_de_compra'];
                $fecha_soli_compra = $_POST['fecha_soli_compra'];
                $referencia = $_POST['referencia'];
                $fecha_referencia = $_POST['fecha_referencia'];
                $orden_compra = $_POST['orden_compra'];
                $fecha_oc = $_POST['fecha_oc'];
                $monto_oc = $_POST['monto_oc'];
                $resolu_base_tec = $_POST['resolu_base_tec'];
                $fecha_base_tec = $_POST['fecha_base_tec'];
                $resolu_adjudi = $_POST['resolu_adjudi'];
                $fecha_resolu_adjudi = $_POST['fecha_resolu_adjudi'];
                $id_licitacion = $_POST['id_licitacion'];
                $resolu_contrato = $_POST['resolu_contrato'];
                $fecha_resolu_contra = $_POST['fecha_resolu_contra'];
                $diferencia_peti = $_POST['diferencia_peti'];
                $notas = $_POST['notas'];
                $fecha_recep = $_POST['fecha_recep'];
                $fecha_inicio = $_POST['fecha_inicio'];
                $fecha_termino = $_POST['fecha_termino'];
                $fecha_inic_gt_tec = $_POST['fecha_inic_gt_tec'];
                $fecha_term_gt_tec = $_POST['fecha_term_gt_tec'];
                $dias_de_mora = $_POST['dias_de_mora'];
                $obser_recepcion = $_POST['obser_recepcion'];
                $verificable = $_POST['verificable'];
                $fecha_fac = $_POST['fecha_fac'];
                $n_factura = $_POST['n_factura'];
                $n_acta = $_POST['n_acta'];
                $fecha_acta = $_POST['fecha_acta'];
                $folio_core = $_POST['folio_core'];
                $fecha_folio = $_POST['fecha_folio'];
                $estado_peti = $_POST['estado_peti'];

                $sentencia = $bd->prepare("UPDATE proceso_peticiones SET ordinario = ?, fecha_ordinario = ?, solici_de_compra = ?, fecha_soli_compra = ?, referencia = ?, fecha_referencia = ?, orden_compra = ?, 
                fecha_oc = ?, monto_oc = ?, resolu_base_tec = ?, fecha_base_tec = ?, resolu_adjudi = ?, fecha_resolu_adjudi = ?, id_licitacion = ?, resolu_contrato = ?, fecha_resolu_contra = ?, 
                diferencia_peti = ?, notas = ?, fecha_recep = ?, fecha_inicio = ?, fecha_termino = ?, fecha_inic_gt_tec = ?, fecha_term_gt_tec = ?, dias_de_mora = ?, obser_recepcion = ?, verificable = ?, 
                fecha_fac = ?, n_factura = ?, n_acta = ?, fecha_acta = ?, folio_core = ?, fecha_folio = ?, estado_peti = ?
                WHERE id_peticiones = ?;");


                $resultado = $sentencia->execute([
                    $ordinario, $fecha_ordinario, $solici_de_compra, $fecha_soli_compra, $referencia, $fecha_referencia, $orden_compra, $fecha_oc, $monto_oc, $resolu_base_tec, $fecha_base_tec, $resolu_adjudi,
                    $fecha_resolu_adjudi, $id_licitacion, $resolu_contrato, $fecha_resolu_contra, $diferencia_peti, $notas, $fecha_recep, $fecha_inicio, $fecha_termino, $fecha_inic_gt_tec, $fecha_term_gt_tec,
                    $dias_de_mora, $obser_recepcion, $verificable, $fecha_fac, $n_factura, $n_acta, $fecha_acta, $folio_core, $fecha_folio, $estado_peti,
                    $envioID
                ]);

                if ($resultado === TRUE) {
                    echo '<script>window.history.go(-2)</script>';
                } else {
                    echo "Error";
                }
            }
        } else {
            header('Location: ../../consolidado.php');
        }
    } elseif (
        $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION"
    ) {
        header('Location: ../../home_proceso_peticiones.php');
    }
} else {
    echo "Error de Sistema";
}
