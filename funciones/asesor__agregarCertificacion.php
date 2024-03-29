<?php
session_start();
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";



echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$entidad_certificadora = $_POST["entidad_certificadora"];
$certificacion = $_POST["certificacion"];

// ---------------------------- Validación de formularios ------------------------------------------ //
// Si todas las validaciones pasan, actualizamos los datos en la BD
if (soloLetras($entidad_certificadora, "../vistas/asesores/asesores.php")) {

    if (soloLetras($certificacion, "../vistas/asesores/asesores.php")) {

        // Sentencia sql
        $sql = "INSERT INTO certificaciones (entidad_certificadora) VALUES (?)";

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);

        // Bind Params
        $stmt->bindParam(1, $entidad_certificadora);

        // Si se ejecuta la sentencia preparada
        if ($stmt->execute()) {
            // Recuperamos el último id insertado en la tabla
            $id_certificacion1 = $dbh->lastInsertId();

            // Segunda sentencia sql
            $sql = "INSERT INTO asesorescertificaciones (id_certificacion1,id_asesor4,certificado) VALUES (?,?,?)";

            $stmt2 = $dbh->prepare($sql);

            // Bind Params
            $stmt2->bindParam(1, $id_certificacion1);
            $stmt2->bindParam(2, $_SESSION['id']);
            $stmt2->bindParam(3, $certificacion);

            // Mensaje de éxito
            if ($stmt2->execute()) {
                mensajeGoodJob("¡Cambios guardados con éxito!", "../vistas/asesores/asesores.php");
            } else {
                mensajeError("Ups, falló algo. Por favor inténtelo más tarde", "../vistas/asesores/asesores.php");
            }
        } else {
            mensajeError("Ups, falló algo. Por favor inténtelo más tarde", "../vistas/asesores/asesores.php");
        }
    }
}
echo "</body>";
?>