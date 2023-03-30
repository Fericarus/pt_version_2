<?php
session_start();
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";



echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$asesorServicio = $_POST["asesorServicio"];

// Sentencia sql
$sql = "INSERT INTO asesoresservicios (id_servicio2, id_asesor2) VALUES (?,?)";

// Preparamos la sentencia
$stmt = $dbh->prepare($sql);

// Establecemos la relación entre los marcadores y su correspondiente valor
$stmt->bindParam(1, $asesorServicio);
$stmt->bindParam(2, $_SESSION["id"]);

// Ejecutamos la sentencia
if ($stmt->execute()) {
    mensajeGoodJob('¡Cambios guardados con éxito!', '../vistas/asesores/asesores.php');
} else {
    mensajeError('Ups, falló algo', '../vistas/asesores/asesores.php');
}
echo "</body>";
?>