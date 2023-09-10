<?php

session_start();

if (!isset($_SESSION['nombre'])) {
	header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
	if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS") {

		if (!isset($_POST['oculto'])) {
			exit;
		}

		include '../../config/conexion.php';

		$equipos_instalaciones = $_POST['equipos_instalaciones'];
		$servicio = $_POST['servicio'];
		$sector = $_POST['sector'];
		$clase = $_POST['clase'];
		$subclase = $_POST['subclase'];
		$def_ley_pres = $_POST['def_ley_pres'];
		$equipo = $_POST['equipo'];
		$marca = $_POST['marca'];
		$modelo = $_POST['modelo'];
		$serie = $_POST['serie'];
		$valor = $_POST['valor'];
		$num_inventario = $_POST['num_inventario'];
		$ano_instalacion = $_POST['ano_instalacion'];
		$vida_util = $_POST['vida_util'];
		$vida_util_residual = $_POST['vida_util_residual'];
		$vida_ur_estandarizada = $_POST['vida_ur_estandarizada'];
		$estado_conservacion = $_POST['estado_conservacion'];
		$propiedad = $_POST['propiedad'];
		$progr_mantenimiento = $_POST['progr_mantenimiento'];
		$caracteristica_acredi = $_POST['caracteristica_acredi'];
		$uni_mantenimiento_hbv = $_POST['uni_mantenimiento_hbv'];
		$ref_tecnico = $_POST['ref_tecnico'];
		$periodicidad_mp = $_POST['periodicidad_mp'];
		$id_licitacion = $_POST['id_licitacion'];
		$inicio_garantia = $_POST['inicio_garantia'];
		$termi_garantia = $_POST['termi_garantia'];
		$empresa = $_POST['empresa'];


		$sentencia = $bd->prepare("INSERT INTO equipamiento(equipos_instalaciones, servicio, sector, clase, subclase, 
										def_ley_presupuesto, equipo, marca, modelo, serie, valor, num_inventario, ano_instalacion, vida_util,
										vida_util_residual, vida_ur_estandarizada, estado_conservacion, propiedad, progr_mantenimiento, caracteristica_acredi, 
										unid_mante_hbv, referente_tecnico, periodicidad_mp, id_licitacion, inicio_garantia, termino_garantia, empresa) VALUES
										(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


		$resultado = $sentencia->execute([
			$equipos_instalaciones, $servicio, strtoupper($sector), $clase, $subclase, $def_ley_pres, strtoupper($equipo), strtoupper($marca), strtoupper($modelo),
			strtoupper($serie), $valor, strtoupper($num_inventario), $ano_instalacion, $vida_util, $vida_util_residual, $vida_ur_estandarizada,
			$estado_conservacion, $propiedad, $progr_mantenimiento, $caracteristica_acredi, $uni_mantenimiento_hbv, strtoupper($ref_tecnico),
			$periodicidad_mp, strtoupper($id_licitacion), $inicio_garantia, $termi_garantia, strtoupper($empresa)
		]);

		if ($resultado === TRUE) {
			header('Location: ../../catastro.php?catastro_guardar=1');
		} else {
			echo "Error";
		}
	} elseif (
		$_SESSION['tipo'] === "MANTENCION" ||
		$_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
	) {
		header('Location: ../../catastro.php');
	}
} else {
	echo "Error de Sistema";
}
