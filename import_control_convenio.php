<?php

include 'config/conexion.php';

$fileContacts = $_FILES['fileContacts'];
$fileContacts = file_get_contents($fileContacts['tmp_name']);

$fileContacts = explode("\n", $fileContacts);
$fileContacts = array_filter($fileContacts);


// Convertir datos en array
foreach ($fileContacts as $contact) {
    $contactList[] = explode(";", $contact);
}


// Insertar datos
foreach ($contactList as $contactData) {
    $bd->query("INSERT INTO control_convenio (ejecutivo_compra, correo_ejecutivo, edificio, piso, sala_pasillo, responsable, correo_responsable, 
    grupo, id_licitacion_convenio, empresa_adjudicada, equipo_critico_m_c, ubicacion, fecha_inicio_convenio, fecha_termino_convenio, 
    duracion_en_meses, peridiocidad, n_manten_preventivas, 
    valor_mantencion_1, fecha_mantencion_1, fecha_recep_mant_1, orden_compra_mant_1, fecha_oc_mant_1, observacion_mant_1, verificable_mant_1, 
    valor_mantencion_2, fecha_mantencion_2, fecha_recep_mant_2, orden_compra_mant_2, fecha_oc_mant_2, observacion_mant_2, verificable_mant_2, 
    valor_mantencion_3, fecha_mantencion_3, fecha_recep_mant_3, orden_compra_mant_3, fecha_oc_mant_3, observacion_mant_3, verificable_mant_3, 
    valor_mantencion_4, fecha_mantencion_4, fecha_recep_mant_4, orden_compra_mant_4, fecha_oc_mant_4, observacion_mant_4, verificable_mant_4, 
    valor_mantencion_5, fecha_mantencion_5, fecha_recep_mant_5, orden_compra_mant_5, fecha_oc_mant_5, observacion_mant_5, verificable_mant_5,
    valor_mantencion_6, fecha_mantencion_6, fecha_recep_mant_6, orden_compra_mant_6, fecha_oc_mant_6, observacion_mant_6, verificable_mant_6, 
    valor_mantencion_7, fecha_mantencion_7, fecha_recep_mant_7, orden_compra_mant_7, fecha_oc_mant_7, observacion_mant_7, verificable_mant_7, 
    valor_mantencion_8, fecha_mantencion_8, fecha_recep_mant_8, orden_compra_mant_8, fecha_oc_mant_8, observacion_mant_8, verificable_mant_8, 
    valor_mantencion_9, fecha_mantencion_9, fecha_recep_mant_9, orden_compra_mant_9, fecha_oc_mant_9, observacion_mant_9, verificable_mant_9, 
    valor_mantencion_10, fecha_mantencion_10, fecha_recep_mant_10, orden_compra_mant_10, fecha_oc_mant_10, observacion_mant_10, verificable_mant_10, 
    valor_mantencion_11, fecha_mantencion_11, fecha_recep_mant_11, orden_compra_mant_11, fecha_oc_mant_11, observacion_mant_11, verificable_mant_11, 
    valor_mantencion_12, fecha_mantencion_12, fecha_recep_mant_12, orden_compra_mant_12, fecha_oc_mant_12, observacion_mant_12, verificable_mant_12, 
    id_control_convenio_relacion) 
    VALUES (
        '{$contactData[0]}',
        '{$contactData[1]}',
        '{$contactData[2]}',
        '{$contactData[3]}',
        '{$contactData[4]}',
        '{$contactData[5]}',
        '{$contactData[6]}',
        '{$contactData[7]}', 
        '{$contactData[8]}', 
        '{$contactData[9]}', 
        '{$contactData[10]}', 
        '{$contactData[11]}', 
        '{$contactData[12]}', 
        '{$contactData[13]}', 
        '{$contactData[14]}', 
        '{$contactData[15]}', 
        '{$contactData[16]}', 
        '{$contactData[17]}', 
        '{$contactData[18]}', 
        '{$contactData[19]}', 
        '{$contactData[20]}', 
        '{$contactData[21]}', 
        '{$contactData[22]}', 
        '{$contactData[23]}', 
        '{$contactData[24]}', 
        '{$contactData[25]}', 
        '{$contactData[26]}', 
        '{$contactData[27]}', 
        '{$contactData[28]}', 
        '{$contactData[29]}', 
        '{$contactData[30]}', 
        '{$contactData[31]}', 
        '{$contactData[32]}', 
        '{$contactData[33]}', 
        '{$contactData[34]}', 
        '{$contactData[35]}', 
        '{$contactData[36]}', 
        '{$contactData[37]}', 
        '{$contactData[38]}', 
        '{$contactData[39]}', 
        '{$contactData[40]}', 
        '{$contactData[41]}', 
        '{$contactData[42]}', 
        '{$contactData[43]}', 
        '{$contactData[44]}', 
        '{$contactData[45]}', 
        '{$contactData[46]}', 
        '{$contactData[47]}', 
        '{$contactData[48]}', 
        '{$contactData[49]}', 
        '{$contactData[50]}', 
        '{$contactData[51]}', 
        '{$contactData[52]}', 
        '{$contactData[53]}', 
        '{$contactData[54]}', 
        '{$contactData[55]}', 
        '{$contactData[56]}', 
        '{$contactData[57]}', 
        '{$contactData[58]}', 
        '{$contactData[59]}', 
        '{$contactData[60]}', 
        '{$contactData[61]}', 
        '{$contactData[62]}', 
        '{$contactData[63]}', 
        '{$contactData[64]}', 
        '{$contactData[65]}', 
        '{$contactData[66]}', 
        '{$contactData[67]}', 
        '{$contactData[68]}', 
        '{$contactData[69]}', 
        '{$contactData[70]}', 
        '{$contactData[71]}', 
        '{$contactData[72]}', 
        '{$contactData[73]}', 
        '{$contactData[74]}', 
        '{$contactData[75]}', 
        '{$contactData[76]}', 
        '{$contactData[77]}', 
        '{$contactData[78]}', 
        '{$contactData[79]}', 
        '{$contactData[80]}', 
        '{$contactData[81]}', 
        '{$contactData[82]}', 
        '{$contactData[83]}', 
        '{$contactData[84]}', 
        '{$contactData[85]}', 
        '{$contactData[86]}', 
        '{$contactData[87]}', 
        '{$contactData[88]}', 
        '{$contactData[89]}', 
        '{$contactData[90]}', 
        '{$contactData[91]}', 
        '{$contactData[92]}', 
        '{$contactData[93]}', 
        '{$contactData[94]}', 
        '{$contactData[95]}', 
        '{$contactData[96]}', 
        '{$contactData[97]}', 
        '{$contactData[98]}', 
        '{$contactData[99]}', 
        '{$contactData[100]}', 
        '{$contactData[101]}')");
}
