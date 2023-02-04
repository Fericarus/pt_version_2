<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$id_asesorCertificacion = htmlentities(addslashes($_GET["id_asesorCertificacion"]));
$id_certificacion = htmlentities(addslashes($_GET["id_certificacion"]));

// Sentencias sql
$sql = "DELETE FROM asesorescertificaciones WHERE id_asesorCertificacion = " . $id_asesorCertificacion;
$sql2 = "DELETE FROM certificaciones WHERE id_certificacion = " . $id_certificacion;

// Aquí preparo la sentencia sql DELETE
$stmt = $dbh->prepare($sql);
$stmt2 = $dbh->prepare($sql2);

// Ejecutamos la sentencia
if ($stmt->execute() && $stmt2->execute()) {
    // Mensaje de éxito
    echo '<script>alert("Registro eliminado exitosamente")</script>';
    echo '<script type="text/javascript">window.location.href="../asesores/asesores.php";</script>';
} else {
    echo '<script>alert("Ups, algo salió mal")</script>';
    echo '<script type="text/javascript">window.location.href="../asesores/asesores.php";</script>';
}
