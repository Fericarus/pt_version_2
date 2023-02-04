<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$entidad_certificadora = htmlentities(addslashes($_POST["entidad_certificadora"]));
$certificacion = htmlentities(addslashes($_POST["certificacion"]));

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

        // Ejecutamos la sentencia
        $stmt->execute();

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
            echo '<script>alert("¡Cambios guardados con éxito!")</script>';
            echo '<script type="text/javascript">window.location.href="../vistas/asesores/asesores.php";</script>';
            $dbh = null;
        } else {
            echo "<script>alert('Ups, falló algo')</script>";
            echo "<script type='text/javascript'>window.location.href='../vistas/asesores/asesores.php';</script>";
        }
    }
}
