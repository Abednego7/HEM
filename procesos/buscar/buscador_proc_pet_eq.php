<?php

include '../../config/conexion.php';

$buscador = $bd->query("SELECT * FROM equipamiento WHERE id_relacion = '" . $_POST["buscar"] . "'");
$numero = $buscador->fetchAll(PDO::FETCH_OBJ);

$nums = count($numero);     // Conteo de registros iguales a la variable de busqueda con la de la tabla

foreach ($numero as $datos);

if (empty($_POST["buscar"])) {          // Evalua si la variable post "buscar" esta vacia
    echo "";
} else {
    if ($nums > 0) {

        echo $datos->equipo;
    } else {
        echo "Registro No Encontrado";
    }
}
