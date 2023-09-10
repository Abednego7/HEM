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
    $bd->query("INSERT INTO rrhh (dep_subdepto, unid_especifica, nombre, apellido_paterno, apellido_materno, rut, calidad, escalafon, grado, 
    estudio_titulo, tipo_contrato, ano_ingreso, correo, domicilio, fono_contacto, fecha_nacimiento, 
    edad, enfermedad_cronica, estado_civil) 
    VALUES 
    ('{$contactData[0]}', '{$contactData[1]}', '{$contactData[2]}', '{$contactData[3]}', '{$contactData[4]}', '{$contactData[5]}', '{$contactData[6]}', 
    '{$contactData[7]}', '{$contactData[8]}', '{$contactData[9]}', '{$contactData[10]}', '{$contactData[11]}', '{$contactData[12]}', '{$contactData[13]}', 
    '{$contactData[14]}', '{$contactData[15]}', '{$contactData[16]}', '{$contactData[17]}', '{$contactData[18]}')");
}
