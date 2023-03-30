<?php
session_start();
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";



// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$id_asesorServicio = $_POST["id_asesorServicio"];

// Sentencia sql
$sql = "DELETE FROM asesoresservicios WHERE id_asesorServicio = " . $id_asesorServicio;

// Aquí preparo la sentencia sql DELETE
$stmt = $dbh->prepare($sql);

// Ejecutamos la sentencia
$stmt->execute();

echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Ejecutamos la sentencia y Mensaje de éxito / Ups, falló algo
if ($stmt->execute()) {
    // echo "Hola";
    mensajeGoodJob("¡Servicio eliminado con éxito!", "../vistas/asesores/asesores--misServicios.php");
} else {
    mensajeError("Ups, falló algo", "../vistas/asesores/asesores--misServicios.php");
}

echo "</body>";
?>