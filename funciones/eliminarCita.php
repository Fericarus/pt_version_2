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

    // Primero eliminamos de citasServicios
    // Sentencia sql
    $sql = "DELETE FROM citasservicios WHERE id_cita1 = " . $id_cita;

    // Aquí preparo la sentencia sql DELETE
    $stmt = $dbh->prepare($sql);

    // Ejecutamos la sentencia
    $stmt->execute();

    // Ahora si eliminamos la cita
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
        // echo "Código de error SQLSTATE: " . $stmt->errorInfo()[0] . "<br>";
        // echo "Código de error específico de la base de datos: " . $stmt->errorInfo()[1] . "<br>";
        // echo "Descripción del error: " . $stmt->errorInfo()[2];
        // echo "<pre>";
        // echo var_dump($stmt);
        // echo "</pre>";
        mensajeError("Ups, algo salió mal", $redirect);
    }
}

echo "</body>";
