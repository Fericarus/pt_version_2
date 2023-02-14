<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$id_asesorEducacion = $_POST["id_asesorEducacion"];

// Sentencia sql
$sql = "DELETE FROM asesoreseducaciones WHERE id_asesorEducacion = " . $id_asesorEducacion;

// Aquí preparo la sentencia sql DELETE
$stmt = $dbh->prepare($sql);

// Ejecutamos la sentencia
$stmt->execute();

// Ejecutamos la sentencia y Mensaje de éxito / Ups, falló algo
if ($stmt->execute()) {
    mensajeGoodJob("Registro eliminado exitosamente", "../vistas/asesores/asesores.php");
} else {
    mensajeError("Ups, algo salió mal", "../vistas/asesores/asesores.php");
}
