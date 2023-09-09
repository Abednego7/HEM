<?php

$contrasena = '';
$usuario = 'root';
$nombrebd = 'hbv_proyecto';

try {
    $bd = new PDO(
        'mysql:host=localhost;
          dbname=' . $nombrebd,
        $usuario,
        $contrasena
    );
} catch (Exception $e) {
    echo "Error de conexion " . $e->getMessage();
}
