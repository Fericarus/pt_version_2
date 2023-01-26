<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

if (isset($_POST['submit'])) {

    // Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
    $nombre = htmlentities(addslashes($_POST["nombre"]));
    $apellido_paterno = htmlentities(addslashes($_POST["apellido_paterno"]));
    $apellido_materno = htmlentities(addslashes($_POST["apellido_materno"]));
    $email = htmlentities(addslashes($_POST["email"]));
    $telefono = htmlentities(addslashes($_POST["telefono"]));

    // ---------------------------- Validación de formularios ------------------------------------------ //
    // Si todas las validaciones pasan, actualizamos los datos en la BD
    if (validarNombre($nombre, "../vistas/asesores/asesores--perfil.php")) {
        if (validarApellidoPaterno($apellido_paterno, "../vistas/asesores/asesores--perfil.php")) {
            if (validarApellidoPaterno($apellido_materno, "../vistas/asesores/asesores--perfil.php")) {
                if (validarEmail($email, "../vistas/asesores/asesores--perfil.php")) {
                    if (validarTelefono($telefono, "../vistas/asesores/asesores--perfil.php")) {

                        // Sentencia sql
                        $sql = "UPDATE asesores SET nombre = :nombre, apellido_paternoA = :apellido_paterno, apellido_maternoA = :apellido_materno, email = :email, telefono = :telefono WHERE id_asesor = " . $_SESSION["id"];

                        // Preparamos la sentencia sql
                        $stmt = $dbh->prepare($sql);

                        // Establecemos la relación entre los marcadores y su correspondiente valor
                        $stmt->bindParam(':nombre', $nombre);
                        $stmt->bindParam(':apellido_paterno', $apellido_paterno);
                        $stmt->bindParam(':apellido_materno', $apellido_materno);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':telefono', $telefono);

                        // Ejecutamos la sentencia
                        if ($stmt->execute()) {
                            echo '<script>alert("¡Cambios guardados con éxito!")</script>';
                            $dbh = null;
                            echo '<script type="text/javascript">window.location.href="../vistas/asesores/asesores.php";</script>';
                        } else {
                            echo '<script>alert("Ups, falló algo")</script>';
                            echo '<script type="text/javascript">window.location.href="../vistas/asesores/asesores.php";</script>';
                        }

                    }
                }
            }
        }
    }
}
