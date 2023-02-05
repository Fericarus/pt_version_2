<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$asesorServicio = htmlentities(addslashes($_POST["asesorServicio"]));

// Sentencia sql
$sql = "INSERT INTO asesoresservicios (id_servicio2, id_asesor2) VALUES (?,?)";

// Preparamos la sentencia
$stmt = $dbh->prepare($sql);

// Establecemos la relación entre los marcadores y su correspondiente valor
$stmt->bindParam(1, $asesorServicio);
$stmt->bindParam(2, $_SESSION["id"]);

// Ejecutamos la sentencia
if ($stmt->execute()) {
    echo "<script>alert('¡Cambios guardados con éxito!')</script>";
    $dbh = null;
    echo "<script type='text/javascript'>window.location.href='../vistas/asesores/asesores.php';</script>";
} else {
    echo "<script>alert('Ups, falló algo')</script>";
    echo "<script type='text/javascript'>window.location.href='../vistas/asesores/asesores.php';</script>";
}
