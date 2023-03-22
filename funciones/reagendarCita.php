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

    // Primero verificamos si no existe una cita agendada a la misma hora, fecha y con el mismo asesor
    // Sentencia sql
    $sql = "SELECT * FROM citas WHERE fecha = '$fecha' AND hora = '$hora'";

    // Preparamos la sentencia
    $stmt = $dbh->prepare($sql);

    // Ejecutamos la sentencia
    $stmt->execute();

    // Comprobamos que la consulta devuelva algún resultado
    if ($stmt->rowCount() > 0) {

        // Ya hay una cita reservada en la misma fecha y hora, mostrar un mensaje de error
        mensajeError("Lo sentimos, ya hay una cita reservada en la misma fecha y hora.", $redirect);
    } else {

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
}

echo "</body>";
