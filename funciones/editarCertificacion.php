<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$entidad_certificadora = htmlentities(addslashes($_POST["entidad_certificadora"]));
$certificado = htmlentities(addslashes($_POST["certificado"]));
$id_asesorCertificacion = htmlentities(addslashes($_POST["id_asesorCertificacion"]));
$id_certificacion = htmlentities(addslashes($_POST["id_certificacion"]));

// Validación de formularios
if (soloLetras($entidad_certificadora, "../vistas/asesores/asesores.php")) {
    if (soloLetras($certificado, "../vistas/asesores/asesores.php")) {

        // Sentencia sql
        $sql = "UPDATE certificaciones SET entidad_certificadora = :entidad_certificadora WHERE id_certificacion = " . $id_certificacion;

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);

        // bind params
        $stmt->bindParam(':entidad_certificadora', $entidad_certificadora);

        // Sentencia sql 2
        $sql2 = "UPDATE asesorescertificaciones SET certificado = :certificado WHERE id_asesorCertificacion = " . $id_asesorCertificacion;

        // Preparamos la sentencia 2
        $stmt2 = $dbh->prepare($sql2);

        // bind params
        $stmt2->bindParam(':certificado', $certificado);

        // Ejecutamos la sentencia y Mensaje de éxito / Ups, falló algo
        if ($stmt2->execute() && $stmt->execute()) {
            echo '<script>alert("¡Cambios guardados con éxito!")</script>';
            $dbh = null;
            echo '<script type="text/javascript">window.location.href="../vistas/asesores/asesores.php";</script>';
        } else {
            echo '<script>alert("Ups, falló algo!")</script>';

            echo "<pre>";
            var_dump($stmt->execute());
            echo "</pre>";

            echo "<pre>";
            var_dump($stmt2->execute());
            echo "</pre>";

            echo "<pre>";
             echo $id_asesorCertificacion;
            echo "</pre>";

            



            //echo '<script type="text/javascript">window.location.href="../vistas/asesores/asesores.php";</script>';
        }
    }
}
