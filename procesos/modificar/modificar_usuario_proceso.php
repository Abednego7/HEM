<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
	header('Location: ../../index.php');
} elseif (isset($_SESSION['nombre'])) {
	if ($_SESSION['tipo'] === "ADMINISTRADOR") {

		if (!isset($_POST['oculto'])) {
			header('Location: ../../catastro.php');
		}

		include '../../config/conexion.php';

		$envioID = $_POST['envioID'];

		$nombre = $_POST['nombre'];
		$correo = $_POST['correo'];
		$passwr = $_POST['pass'];
		$tipo_de_usuario = $_POST['tipo_de_usuario'];

		if (empty($passwr)) {
			$sentencia = $bd->prepare("UPDATE usuarios SET nombre = ?, correo = ?, tipo_usuario = ? WHERE id_usuario = ?;");
			$resultado = $sentencia->execute([ucfirst($nombre), $correo, $tipo_de_usuario, $envioID]);
		} else {
			$pass_cifrado = password_hash($passwr, PASSWORD_DEFAULT, array("cost" => 12));

			$sentencia = $bd->prepare("UPDATE usuarios SET nombre = ?, correo = ?, contrasena = ?, tipo_usuario = ? WHERE id_usuario = ?;");
			$resultado = $sentencia->execute([ucfirst($nombre), $correo, $pass_cifrado, $tipo_de_usuario, $envioID]);
		}

		if ($resultado === TRUE) {
			header('Location: ../../usuarios.php');
		} else {
			echo "Error";
		}
	} elseif (
		$_SESSION['tipo'] === "PROYECTOS" || $_SESSION['tipo'] === "MANTENCION" ||
		$_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
	) {
		header('Location: ../../catastro.php');
	}
} else {
	echo "Error de Sistema";
}
