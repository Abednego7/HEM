<?php

include '../../config/conexion.php';

$sentencia = $bd->query("SELECT * FROM equipamiento ORDER BY id_relacion;");
$equipamiento = $sentencia->fetchAll(PDO::FETCH_OBJ);

header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=CATASTRO.xls");

?>

<table border="1">
    <h1 style="text-align: center;">Catastro 2023</h1>
    <tr>
        <th>ID</th>
        <th>Equipos/Instalaciones</th>
        <th>Servicio</th>
        <th>Sector</th>
        <th>Clase</th>
        <th>SubClase</th>
        <th>Definicion Ley De Presupuesto</th>
        <th>Equipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th style="color: blue;">Serie</th>
        <th>Valor</th>
        <th style="color: blue;">Numero Inventario</th>
        <th>Año Instalacion</th>
        <th>Vida Util</th>
        <th>Vida Residual</th>
        <th>Vida Util Residual Estandarizada</th>
        <th>Estado De Conservacion (B-R-M)</th>
        <th>Propiedad</th>
        <th>Programa de Mantenimiento</th>
        <th>Caracteristicas de Acreditacion</th>
        <th>Unidad De Mantenimiento HBV</th>
        <th>Referente Tecnico</th>
        <th>Periodicidad MP</th>
        <th>ID Licitacion</th>
        <th>Inicio Garantia</th>
        <th>Termino Garantia</th>
        <th>Empresa</th>
    </tr>
    <?php foreach ($equipamiento as $dato) {
        $inicio_garantia_F = date("d-m-Y", strtotime($dato->inicio_garantia));
        $termino_garantia_F = date("d-m-Y", strtotime($dato->termino_garantia)); ?>
        <tr>
            <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_relacion; ?></td>
            <td><?php echo $dato->equipos_instalaciones; ?></td>
            <td><?php echo $dato->servicio; ?></td>
            <td><?php echo $dato->sector; ?></td>
            <td><?php echo $dato->clase; ?></td>
            <td><?php echo $dato->subclase; ?></td>
            <td><?php echo $dato->def_ley_presupuesto; ?></td>
            <td><?php echo $dato->equipo; ?></td>
            <td><?php echo $dato->marca; ?></td>
            <td><?php echo $dato->modelo; ?></td>
            <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->serie; ?></td>
            <td><?php echo number_format($dato->valor); ?></td> <!-- FORMAT NUM -->
            <td style="background-color: rgb(123, 123, 247);"><?php echo $dato->num_inventario; ?></td>
            <td><?php echo $dato->ano_instalacion; ?></td>
            <td><?php echo $dato->vida_util; ?></td>
            <td><?php echo $dato->vida_util_residual; ?></td>
            <td><?php echo $dato->vida_ur_estandarizada; ?></td>
            <td><?php echo $dato->estado_conservacion; ?></td>
            <td><?php echo $dato->propiedad; ?></td>
            <td><?php echo $dato->progr_mantenimiento; ?></td>
            <td><?php echo $dato->caracteristica_acredi; ?></td>
            <td><?php echo $dato->unid_mante_hbv; ?></td>
            <td><?php echo $dato->referente_tecnico; ?></td>
            <td><?php echo $dato->periodicidad_mp; ?></td>
            <td><?php echo $dato->id_licitacion; ?></td>
            <td><?php if ($dato->inicio_garantia === "0000-00-00" || $dato->inicio_garantia === "0") {
                    echo 'NO APLICA';
                } else {
                    echo $inicio_garantia_F;
                }; ?></td>
            <td><?php if ($dato->termino_garantia === "0000-00-00" || $dato->termino_garantia === "0") {
                    echo 'NO APLICA';
                } else {
                    echo $termino_garantia_F;
                }; ?></td>
            <td><?php echo $dato->empresa; ?></td>
        </tr>
    <?php } ?>
</table>