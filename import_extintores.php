<?php

include 'config/conexion.php';

$fileContacts = $_FILES['fileContacts'];
$fileContacts = file_get_contents($fileContacts['tmp_name']);

$fileContacts = explode("\n", $fileContacts);
$fileContacts = array_filter($fileContacts);


// Convertir datos en array

foreach ($fileContacts as $contact) {
    $contactList[] = explode(";", $contact);                         // (" ; ") esto es el buscador de coincidencias de CSV UTF8 
}                                                                    // El error que tuve se provoco por estar el explode en  (",") siendo el CSV delimitado por ";"


// Insertar datos

foreach ($contactList as $contactData) {
    $bd->query("INSERT INTO extintores (cod_nui, n_inventario, recinto, edificio, piso, sala_pasillo, servicio_usuario, sector, tipo_extintor, kg, fecha_mantencion, estado, preg_nanometro, 
    preg_certificacion, preg_sello_garantia, preg_ident_cilindro, preg_mants_vigentes, preg_lugar_visible, preg_senaletica_ubic, preg_facil_acceso, preg_altura_no_mayor, preg_etiqueta_frontal, 
    preg_activado, preg_buena_fijacion, preg_pintura, preg_estado_general, preg_etiqueta_posterior, preg_etiqueta_serv_tec) 
    VALUES 
    ('{$contactData[0]}', 
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
    '{$contactData[27]}')");
}
