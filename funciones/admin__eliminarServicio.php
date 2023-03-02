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

// Capturamos el valor de la varible pasada por POST
$id_servicio = $_POST['id_servicio'];

$redirect = '../vistas/administradores/administradores--servicios.php';

// Sentencias sql
$sql_citasservicios = "DELETE FROM citasservicios WHERE id_servicio1 = " . $id_servicio;
$sql_servicios = "DELETE FROM servicios WHERE id_servicio = " . $id_servicio;

// Preparamos las sentencias
$stmt_citasservicios = $dbh->prepare($sql_citasservicios);
$stmt_servicios = $dbh->prepare($sql_servicios);

// Ejecutamos las sentencias
if ($stmt_citasservicios->execute()) {
    if ($stmt_servicios->execute()) {
        mensajeGoodJob("Servicio eliminado correctamente", $redirect);
    } else {
        echo "Código de error SQLSTATE: " . $stmt_servicios->errorInfo()[0] . "<br>";
        echo "Código de error específico de la base de datos: " . $stmt_servicios->errorInfo()[1] . "<br>";
        echo "Descripción del error: " . $stmt_servicios->errorInfo()[2];
        echo "<pre>";
        echo var_dump($stmt_servicios);
        echo "</pre>";
        // mensajeError("Algo falló", $redirect);
    }
}

echo "</body>";