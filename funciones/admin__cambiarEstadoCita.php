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
$estado_cita = $_POST["estado"];
$id_cita = $_POST["id_cita"];
$redirect = "../vistas/administradores/administradores.php";

// Sentencia sql
$sql = "UPDATE citas SET estado_cita = :estado_cita WHERE id_cita = " . $id_cita;

// Preparamos la sentencia sql
$stmt = $dbh->prepare($sql);

// bind params
$stmt->bindParam(':estado_cita', $estado_cita);

// Ejecutamos la sentencia y Mensaje de éxito / Ups, falló algo
if ($stmt->execute()) {
    mensajeGoodJob("¡Cambios guardados con éxito!", $redirect);
} else {
    mensajeError("Ups, algo falló", $redirect);
}

echo "</body>";