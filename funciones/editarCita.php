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
    editarCita($dbh, "../vistas/clientes/clientes.php");
}

// Si queremos editar citas desde un perfil del tipo asesor
if (isset($_POST['submitAsesores'])) {
    editarCita($dbh, "../vistas/asesores/asesores.php");
}

// Función para editar Citas
function editarCita($dbh, $redirect)
{
    // Capturamos la información de los formularios
    $id_cita = $_POST["id_cita"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];

    // Sentencia sql
    $sql = "UPDATE citas SET fecha = :fecha, hora = :hora WHERE id_cita = " . $id_cita;

    // Preparamos la sentencia sql
    $stmt = $dbh->prepare($sql);

    // bind params
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':hora', $hora);

    // Ejecutamos la sentencia y Mensaje de éxito / Ups, falló algo
    if ($stmt->execute()) {
        mensajeGoodJob("¡Cambios guardados con éxito!", $redirect);
    } else {
        mensajeError("Ups, algo falló", $redirect);
    }
}
