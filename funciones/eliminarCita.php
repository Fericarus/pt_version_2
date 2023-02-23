<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Si queremos editar citas desde un perfil del tipo cliente
if (isset($_POST['submitClientes'])) {
    eliminarCita($dbh, "../vistas/clientes/clientes.php");
}

// Si queremos editar citas desde un perfil del tipo asesor
if (isset($_POST['submitAsesores'])) {
    eliminarCita($dbh, "../vistas/asesores/asesores.php");
}



// Función para Eliminar Citas
function eliminarCita($dbh, $redirect)
{
    // Capturamos la información de los formularios
    $id_cita = $_POST["id_cita"];

    // Sentencia sql
    $sql = "DELETE FROM citas WHERE id_cita = " . $id_cita;

    // Aquí preparo la sentencia sql DELETE
    $stmt = $dbh->prepare($sql);

    // Ejecutamos la sentencia
    $stmt->execute();

    // Ejecutamos la sentencia y Mensaje de éxito / Ups, falló algo
    if ($stmt->execute()) {
        mensajeGoodJob("Cita eliminada exitosamente", $redirect);
    } else {
        mensajeError("Ups, algo salió mal", $redirect);
    }
}