<?php
session_start();
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";



echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Capturamos la información de los formularios
$institucion = $_POST["institucion"];
$titulo = $_POST["titulo"];
$id_asesorEducacion = $_POST["id_asesorEducacion"];

// Validación de formularios
if (soloLetras($titulo, "../vistas/asesores/asesores.php")) {

    // Sentencia sql
    $sql = "UPDATE asesoreseducaciones SET id_educacion1 = :id_educacion1, titulo = :titulo WHERE id_asesorEducacion = " . $id_asesorEducacion;

    // Preparamos la sentencia sql
    $stmt = $dbh->prepare($sql);

    // bind params
    $stmt->bindParam(':id_educacion1', $institucion);
    $stmt->bindParam(':titulo', $titulo);

    // Ejecutamos la sentencia y Mensaje de éxito / Ups, falló algo
    if ($stmt->execute()) {
        mensajeGoodJob("¡Cambios guardados con éxito!", "../vistas/asesores/asesores.php");
    } else {
        mensajeError("Ups, algo falló. Por favor inténtelo más tarde.", "../vistas/asesores/asesores.php");
    }

}
echo "</body>";
?>