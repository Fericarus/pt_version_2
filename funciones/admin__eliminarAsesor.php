<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Capturamos el valor de la varible pasada por POST
$id_asesor = $_POST['id_asesor'];

$redirect = '../vistas/administradores/administradores--asesores.php';

/** ------------------ PRIMERO VERIFICAMOS SI EL ASESOR TIENE CITAS AGENDADAS ------------------- */
// 1. Sentencia sql
$sql_citas = "SELECT * FROM citas WHERE id_asesor1 = " . $id_asesor;

// 2. Preparamos la sentencia sql
$stmt = $dbh->prepare($sql_citas);

// 5. Ejecutamos la sentencia
$stmt->execute();

// Obtenemos el número de registros que nos devolvió la consulta
$count = $stmt->rowCount();

// Si el cliente tiene citas agendadas activas se le indicará al administrador que debe eliminarlas primero si desea continuar
if ($count > 0) {
    mensajeError("El asesor tiene citas agendadas. Elimínelas primero", $redirect);
} else {

    // Sentencias sql
    $sql_asesoresservicios = "DELETE FROM asesoresservicios WHERE id_asesor2 = " . $id_asesor;
    $sql_asesoreseducaciones = "DELETE FROM asesoreseducaciones WHERE id_asesor3 = " . $id_asesor;
    $sql_asesorescertificaciones = "DELETE FROM asesorescertificaciones WHERE id_asesor4 = " . $id_asesor;
    $sql_asesores = "DELETE FROM asesores WHERE id_asesor = " . $id_asesor;

    // Preparamos las sentencias
    $stmt_asesoresservicios = $dbh->prepare($sql_asesoresservicios);
    $stmt_asesoreseducaciones = $dbh->prepare($sql_asesoreseducaciones);
    $stmt_asesorescertificaciones = $dbh->prepare($sql_asesorescertificaciones);
    $stmt_asesores = $dbh->prepare($sql_asesores);

    // Ejecutamos la sentencia
    if ($stmt_asesoresservicios->execute()) {
        if ($stmt_asesoreseducaciones->execute()) {
            if ($stmt_asesorescertificaciones->execute()) {
                if ($stmt_asesores->execute()) {
                    mensajeGoodJob("Asesor eliminado exitosamente", $redirect);
                } else {
                    mensajeError("Error 4", $redirect);
                }
            } else {
                mensajeError("Error 3", $redirect);
            }
        } else {
            mensajeError("Error 2", $redirect);
        }
    } else {
        mensajeError("Error 1", $redirect);
    }
}
