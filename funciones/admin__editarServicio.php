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
$id_servicio = $_POST["id_servicio"];
$servicio = $_POST["servicio"];
$descripcion = $_POST["descripcion"];

$redirect = '../vistas/administradores/administradores--servicios.php';

// Si todas las validaciones pasan, actualizamos los datos en la BD
if (soloLetras($servicio, $redirect)) {

    // Sentencia sql
    $sql = "UPDATE servicios SET 
    servicio = :servicio, 
    descripcion = :descripcion
    WHERE id_servicio = " . $id_servicio;

    // Preparamos la sentencia sql
    $stmt = $dbh->prepare($sql);

    // Establecemos la relación entre los marcadores y su correspondiente valor
    $stmt->bindParam(':servicio', $servicio);
    $stmt->bindParam(':descripcion', $descripcion);

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