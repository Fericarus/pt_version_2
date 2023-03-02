<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Capturamos la información de los formularios
$id_giro = $_POST["id_giro"];
$giro_comercial = $_POST["giro_comercial"];

$redirect = '../vistas/administradores/administradores--giros.php';

// Si todas las validaciones pasan, actualizamos los datos en la BD
if (soloLetras($giro_comercial, $redirect)) {

    // Sentencia sql
    $sql = "UPDATE giros SET 
    giro_comercial = :giro_comercial
    WHERE id_giro = " . $id_giro;

    // Preparamos la sentencia sql
    $stmt = $dbh->prepare($sql);

    // Establecemos la relación entre los marcadores y su correspondiente valor
    $stmt->bindParam(':giro_comercial', $giro_comercial);

    // Ejecutamos la sentencia
    if ($stmt->execute()) {
        mensajeGoodJob('¡Cambios guardados con éxito!', $redirect);
    } else {
        echo "Código de error SQLSTATE: " . $stmt->errorInfo()[0] . "<br>";
        echo "Código de error específico de la base de datos: " . $stmt->errorInfo()[1] . "<br>";
        echo "Descripción del error: " . $stmt->errorInfo()[2];
        echo "<pre>";
        echo var_dump($stmt);
        echo "</pre>";
        // mensajeError('Ups, falló algo', $redirect);
    }

}

echo "</body>";