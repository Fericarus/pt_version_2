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
$institucion = htmlentities(addslashes($_POST["institucion"]));
$titulo = htmlentities(addslashes($_POST["titulo"]));

// ---------------------------- Validación de formularios ------------------------------------------ //
// Si todas las validaciones pasan, actualizamos los datos en la BD
if (soloLetras($titulo, "../vistas/asesores/asesores.php")) {

    // Sentencia sql
    $sql = "INSERT INTO asesoreseducaciones (id_educacion1,id_asesor3,titulo) VALUES (?,?,?)";

    // Preparamos la sentencia
    $stmt = $dbh->prepare($sql);

    // Establecemos la relación entre los marcadores y su correspondiente valor
    $stmt->bindParam(1, $institucion);
    $stmt->bindParam(2, $_SESSION["id"]);
    $stmt->bindParam(3, $titulo);

    // Ejecutamos la sentencia preparada
    // Ejecutamos la sentencia
    if ($stmt->execute()) {
        mensajeGoodJob("¡Cambios guardados con éxito!", "../vistas/asesores/asesores.php");
        // echo "<script>alert('¡Cambios guardados con éxito!')</script>";
        // $dbh = null;
        // echo "<script type='text/javascript'>window.location.href='../vistas/asesores/asesores.php';</script>";
    } else {
        mensajeError("Ups, falló algo", "../vistas/asesores/asesores.php");
        // echo "<script>alert('Ups, falló algo')</script>";
        // echo "<script type='text/javascript'>window.location.href='../vistas/asesores/asesores.php';</script>";
    }

}
