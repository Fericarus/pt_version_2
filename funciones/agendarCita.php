<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$id_asesor1 = $_POST['id_asesor'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

// Sentencia sql
$sql = "INSERT INTO citas (id_asesor1, id_cliente1, fecha, hora) VALUES (:id_asesor1, :id_cliente1, :fecha, :hora)";

// Preparamos la sentencia
$stmt = $dbh->prepare($sql);

// Bind Params
$stmt->bindParam(':id_asesor1', $id_asesor1);
$stmt->bindParam(':id_cliente1', $_SESSION["id"]);
$stmt->bindParam(':fecha', $fecha);
$stmt->bindParam(':hora', $hora);

// Mensaje de éxito
if ($stmt->execute()) {
    mensajeGoodJob("¡Cita agendada con éxito!", "../vistas/clientes/clientes.php");
} else {
    // echo "Código de error SQLSTATE: " . $stmt->errorInfo()[0] . "<br>";
    // echo "Código de error específico de la base de datos: " . $stmt->errorInfo()[1] . "<br>";
    // echo "Descripción del error: " . $stmt->errorInfo()[2];
    mensajeError("Ups, falló algo", "../vistas/clientes/clientes.php");
}