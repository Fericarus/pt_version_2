<?php
session_start();
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";



echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$institucion = $_POST["institucion"];
$titulo = $_POST["titulo"];

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
    if ($stmt->execute()) {
        mensajeGoodJob("¡Cambios guardados con éxito!", "../vistas/asesores/asesores.php");
    } else {
        mensajeError("Ups, falló algo", "../vistas/asesores/asesores.php");
    }

}

echo "</body>";
?>