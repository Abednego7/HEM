<?php

include '../../config/conexion.php';

$buscador = $bd->query("SELECT * FROM cod_manager WHERE articulo = '" . $_POST["buscar"] . "'");
$numero = $buscador->fetchAll(PDO::FETCH_OBJ);

$nums = count($numero);     // Conteo de registros iguales a la variable de busqueda con la de la tabla

foreach ($numero as $datos);

if (empty($_POST["buscar"])) {
    echo "";
} else {
    if ($nums > 0) {

        echo $datos->nombre_articulo;
    } else {
        echo "Registro No Encontrado";
    }
}
