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
$id_asesorServicio = $_GET["id_asesorServicio"];

// Sentencia sql
$sql = "DELETE FROM asesoresservicios WHERE id_asesorServicio = " . $id_asesorServicio;

// Aquí preparo la sentencia sql DELETE
$stmt = $dbh->prepare($sql);

// Ejecutamos la sentencia
$stmt->execute();

// Ejecutamos la sentencia y Mensaje de éxito / Ups, falló algo
if ($stmt->execute()) {
    mensajeGoodJob("¡Cambios guardados con éxito!", "../asesores/asesores.php");
    // echo '<script>alert("¡Cambios guardados con éxito!")</script>';
    // $dbh = null;
    // echo '<script type="text/javascript">window.location.href="../asesores/asesores.php";</script>';
} else {
    mensajeError("Ups, falló algo", "../asesores/asesores.php");
    // echo '<script>alert("Ups, falló algo")</script>';
    //echo '<script type="text/javascript">window.location.href="../asesores/asesores.php";</script>';
}