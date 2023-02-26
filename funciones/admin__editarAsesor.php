<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Capturamos la información de los formularios
$id_asesor = $_POST["id_asesor"];
$nombre = $_POST["nombre"];
$apellido_paternoA = $_POST["apellido_paterno"];
$apellido_maternoA = $_POST["apellido_materno"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];

$redirect = '../vistas/administradores/administradores--asesores.php';

// Si todas las validaciones pasan, actualizamos los datos en la BD
if (validarNombre($nombre, $redirect)) {
    if (validarApellidoPaterno($apellido_paternoA, $redirect)) {
        if (validarApellidoPaterno($apellido_maternoA, $redirect)) {
            if (validarEmail($email, $redirect)) {
                if (validarTelefono($telefono, $redirect)) {

                    // Sentencia sql
                    $sql = "UPDATE asesores SET 
                    nombre = :nombre, 
                    apellido_paternoA = :apellido_paternoA, 
                    apellido_maternoA = :apellido_maternoA, 
                    email = :email, 
                    telefono = :telefono 
                    WHERE id_asesor = " . $id_asesor;

                    // Preparamos la sentencia sql
                    $stmt = $dbh->prepare($sql);

                    // Establecemos la relación entre los marcadores y su correspondiente valor
                    $stmt->bindParam(':nombre', $nombre);
                    $stmt->bindParam(':apellido_paternoA', $apellido_paternoA);
                    $stmt->bindParam(':apellido_maternoA', $apellido_maternoA);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':telefono', $telefono);

                    // Ejecutamos la sentencia
                    if ($stmt->execute()) {
                        mensajeGoodJob('¡Cambios guardados con éxito!', $redirect);
                    } else {
                        echo "Código de error SQLSTATE: " . $stmt->errorInfo()[0] . "<br>";
                        echo "Código de error específico de la base de datos: " . $stmt->errorInfo()[1] . "<br>";
                        echo "Descripción del error: " . $stmt->errorInfo()[2];
                        echo "<pre>";
                        echo var_dump($stmt);
                        echo "</pre>";
                        // mensajeError('Ups, falló algo', $redirect);
                    }
                }
            }
        }
    }
}
