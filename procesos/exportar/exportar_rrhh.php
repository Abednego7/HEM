<?php

include '../../config/conexion.php';

$sentencia = $bd->query("SELECT * FROM rrhh ORDER BY id_rrhh;");
$equipamiento = $sentencia->fetchAll(PDO::FETCH_OBJ);

header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=RRHH.xls");

$anio = (new DateTime)->format("Y");

?>

<table border="1">
    <h1 style="text-align: center;">RRHH <?php echo $anio; ?></h1>
    <tr>
        <th>ID</th>
        <th>Departamento y/o Subdepto</th>
        <th>Unidad Especifica</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>RUT</th>
        <th>Calidad</th>
        <th>Escalafon</th>
        <th>Grado</th>
        <th>Estudio o Titulo</th>
        <th>Tipo de Contrato</th>
        <th>Año Ingreso</th>
        <th>Correo</th>
        <th>Domicilio</th>
        <th>Fono</th>
        <th>Fecha Nacimiento</th>
        <th>Edad</th>
        <th>Enfermedad Cronica</th>
        <th>Estado Civil</th>
    </tr>
    <?php foreach ($equipamiento as $dato) {
        $fecha_nacimiento_F = date("d-m-Y", strtotime($dato->fecha_nacimiento)); ?>
        <tr>
            <td style="background-color: rgb(247, 84, 84);"><?php echo $dato->id_rrhh; ?></td>
            <td><?php echo $dato->dep_subdepto; ?></td>
            <td><?php echo $dato->unid_especifica; ?></td>
            <td><?php echo $dato->nombre; ?></td>
            <td><?php echo $dato->apellido_paterno; ?></td>
            <td><?php echo $dato->apellido_materno; ?></td>
            <td><?php echo $dato->rut; ?></td>
            <td><?php echo $dato->calidad; ?></td>
            <td><?php echo $dato->escalafon; ?></td>
            <td><?php echo $dato->grado; ?></td>
            <td><?php echo $dato->estudio_titulo; ?></td>
            <td><?php echo $dato->tipo_contrato; ?></td>
            <td><?php echo $dato->ano_ingreso; ?></td>
            <td><?php echo $dato->correo; ?></td>
            <td><?php echo $dato->domicilio; ?></td>
            <td><?php echo $dato->fono_contacto; ?></td>
            <td><?php if ($dato->fecha_nacimiento === "0000-00-00" || $dato->fecha_nacimiento === "0") {
                    echo 'NO APLICA';
                } else {
                    echo $fecha_nacimiento_F;
                }; ?></td>
            <td><?php echo $dato->edad; ?></td>
            <td><?php echo $dato->enfermedad_cronica; ?></td>
            <td><?php echo $dato->estado_civil; ?></td>
        </tr>
    <?php } ?>
</table>