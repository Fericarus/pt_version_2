<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Capturamos la información de los formularios
$giro_comercial = $_POST["giro_comercial"];

// Variable redirect
$redirect = '../vistas/administradores/administradores--giros.php';

// Si todas las validaciones pasan, actualizamos los datos en la BD
if (soloLetras($giro_comercial, $redirect)) {

    // Preparamos la sentencia
    $stmt = $dbh->prepare("INSERT INTO giros (giro_comercial) VALUES (?)");

    // Bind params
    $stmt->bindParam(1, $giro_comercial);

    // Ejecutamos la sentencia
    if ($stmt->execute()) {
        mensajeGoodJob("¡Registro de servicio exitoso!", $redirect);
    } else {
        mensajeError("Ups, algo salió mal", $redirect);
    }
}
