<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
	header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
	if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION") {

		if (!isset($_POST['oculto'])) {
			header('Location: ../../catastro.php');
		}

		include '../../config/conexion.php';

		$envioID = $_POST['envioID'];

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
		$valor = $_POST['valor'];
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


		$sentencia = $bd->prepare("UPDATE equipamiento SET equipos_instalaciones = ?, servicio = ?, sector = ?, clase = ?, subclase = ?, 
										def_ley_presupuesto = ?, equipo = ?, marca = ?, modelo = ?, serie = ?, valor = ?, num_inventario = ?, 
										ano_instalacion = ?, vida_util = ?, vida_util_residual = ?, vida_ur_estandarizada = ?, estado_conservacion = ?, 
										propiedad = ?, progr_mantenimiento = ?, caracteristica_acredi = ?, unid_mante_hbv = ?, referente_tecnico = ?, 
										periodicidad_mp = ?, id_licitacion = ?, inicio_garantia = ?, termino_garantia = ?, empresa = ? 
										WHERE id_relacion = ?;");


		$resultado = $sentencia->execute([
			$equipos_instalaciones, $servicio, strtoupper($sector), $clase, $subclase, $def_ley_pres, strtoupper($equipo), strtoupper($marca), strtoupper($modelo),
			strtoupper($serie), $valor, strtoupper($num_inventario), $ano_instalacion, $vida_util, $vida_util_residual, $vida_ur_estandarizada,
			$estado_conservacion, $propiedad, $progr_mantenimiento, $caracteristica_acredi, $uni_mantenimiento_hbv,
			strtoupper($ref_tecnico), $periodicidad_mp, strtoupper($id_licitacion), $inicio_garantia, $termi_garantia, strtoupper($empresa), $envioID
		]);


		if ($resultado === TRUE) {
			header('Location: ../../catastro.php');
		} else {
			echo "Error";
		}
	} elseif ($_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL") {
		header('Location: ../../catastro.php');
	}
} else {
	echo "Error de Sistema";
}
