<?php

session_start();

if (!isset($_SESSION['nombre'])) {                                                              // Sino existe la variable Session
    header('Location: ../index.php');
} elseif (isset($_SESSION['nombre'])) {
    if ($_SESSION['tipo'] === "ADMINISTRADOR" || $_SESSION['tipo'] === "PROYECTOS") {

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
            $bd->query("INSERT INTO equipamiento (equipos_instalaciones, servicio, sector, clase, subclase, def_ley_presupuesto, equipo, marca, modelo, serie, 
            valor, num_inventario, ano_instalacion, vida_util, vida_util_residual, vida_ur_estandarizada, estado_conservacion, propiedad, progr_mantenimiento, 
            caracteristica_acredi, unid_mante_hbv, referente_tecnico, periodicidad_mp, id_licitacion, inicio_garantia, termino_garantia, empresa) 
            VALUES 
            ('{$contactData[0]}', '{$contactData[1]}', '{$contactData[2]}', '{$contactData[3]}', '{$contactData[4]}', '{$contactData[5]}', '{$contactData[6]}', 
            '{$contactData[7]}', '{$contactData[8]}', '{$contactData[9]}', '{$contactData[10]}', '{$contactData[11]}', '{$contactData[12]}', '{$contactData[13]}', 
            '{$contactData[14]}', '{$contactData[15]}', '{$contactData[16]}', '{$contactData[17]}', '{$contactData[18]}', '{$contactData[19]}', '{$contactData[20]}', 
            '{$contactData[21]}', '{$contactData[22]}', '{$contactData[23]}', '{$contactData[24]}', '{$contactData[25]}', '{$contactData[26]}')");
        }
    } elseif (
        $_SESSION['tipo'] === "MANTENCION" ||
        $_SESSION['tipo'] === "TECNICOS" || $_SESSION['tipo'] === "SECRETARIA" || $_SESSION['tipo'] === "SECRETARIA GENERAL"
    ) {
        echo 'Acceso no permitido';
    }
} else {
    echo "Error de Sistema";
}
