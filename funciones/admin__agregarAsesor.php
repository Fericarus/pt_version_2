<?php
// $sql = "INSERT INTO asesores (nombre, apellido_paternoA, apellido_maternoA, email, telefono, password) 
// VALUES ('Pepe','Juarez','Juarez','correo2@correo.com','0123456789','Kreativika2#')";
?>


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
$nombre = $_POST["nombre"];
$apellido_paternoA = $_POST["apellido_paternoA"];
$apellido_maternoA = $_POST["apellido_maternoA"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$password = $_POST["password"];
$confirmarPassword = $_POST["confirmarPassword"];

// Variable redirect
$redirect = '../vistas/administradores/administradores--asesores.php';

// Si todas las validaciones pasan, actualizamos los datos en la BD
if (validarNombre($nombre, $redirect)) {
    if (validarApellidoPaterno($apellido_paternoA, $redirect)) {
        if (validarApellidoPaterno($apellido_maternoA, $redirect)) {
            if (validarEmail($email, $redirect)) {
                if (validarTelefono($telefono, $redirect)) {
                    if (validarPassword($password, $redirect)) {
                        if (validarPassword($confirmarPassword, $redirect)) {

                            if ($password == $confirmarPassword) {
                                // Primero validamos que el asesor no esté registrado previamente en la BD
                                // Sentencia sql
                                $sql = "SELECT * FROM asesores WHERE email = $email";

                                // Preparamos la sentencia sql
                                $stmt = $dbh->prepare($sql);

                                // Ejecutamos la sentencia
                                $stmt->execute();

                                // fetch — Obtiene la siguiente fila de un conjunto de resultados
                                $datos = $stmt->fetch();

                                // Si no se encuentra una coincidencia en la BD
                                if ($datos['email'] != $email) {

                                    // Preparamos la sentencia
                                    $stmt = $dbh->prepare("INSERT INTO asesores (nombre, apellido_paternoA, apellido_maternoA, email, telefono, password) VALUES (?, ?, ?, ?, ?, ?)");

                                    // Bind params
                                    $stmt->bindParam(1, $nombre);
                                    $stmt->bindParam(2, $apellido_paternoA);
                                    $stmt->bindParam(3, $apellido_maternoA);
                                    $stmt->bindParam(4, $email);
                                    $stmt->bindParam(5, $telefono);
                                    $stmt->bindParam(6, $password);

                                    // Ejecutamos la sentencia
                                    if ($stmt->execute()) {
                                        mensajeGoodJob("¡Registro de asesor exitoso!", $redirect);
                                    } else {
                                        mensajeError("Ups, algo salió mal", $redirect);
                                    }
                                } else {
                                    mensajeError("Parece ser que ese asesor ya se encuentra registrado.", $redirect);
                                }
                            } else {
                                mensajeError("Las contraseñas deben coincidir", $redirect);
                            }
                        }
                    }
                }
            }
        }
    }
}
