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
$id_cliente = $_POST["id_cliente"];
$nombre = $_POST["nombre"];
$apellido_paterno = $_POST["apellido_paterno"];
$apellido_materno = $_POST["apellido_materno"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$id_alcaldia1 = $_POST["id_alcaldia1"];
$id_colonia1 = $_POST["id_colonia1"];
$id_giro1 = $_POST["id_giro1"];

$redirect = '../vistas/administradores/administradores--clientes.php';

// Si todas las validaciones pasan, actualizamos los datos en la BD
if (validarNombre($nombre, $redirect)) {
    if (validarApellidoPaterno($apellido_paterno, $redirect)) {
        if (validarApellidoPaterno($apellido_materno, $redirect)) {
            if (validarEmail($email, $redirect)) {
                if (validarTelefono($telefono, $redirect)) {

                    $sql = "UPDATE clientes SET 
                    nombre = :nombre, 
                    apellido_paterno = :apellido_paterno, 
                    apellido_materno = :apellido_materno, 
                    email = :email, 
                    telefono = :telefono, 
                    id_alcaldia1 = :id_alcaldia1, 
                    id_colonia1 = :id_colonia1, 
                    id_giro1 = :id_giro1 
                    WHERE id_cliente = " . $id_cliente;

                    // Preparamos la sentencia sql
                    $stmt = $dbh->prepare($sql);

                    // Establecemos la relación entre los marcadores y su correspondiente valor
                    $stmt->bindParam(':nombre', $nombre);
                    $stmt->bindParam(':apellido_paterno', $apellido_paterno);
                    $stmt->bindParam(':apellido_materno', $apellido_materno);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':telefono', $telefono);
                    $stmt->bindParam(':id_alcaldia1', $id_alcaldia1);
                    $stmt->bindParam(':id_colonia1', $id_colonia1);
                    $stmt->bindParam(':id_giro1', $id_giro1);

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
