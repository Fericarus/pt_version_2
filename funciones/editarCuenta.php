<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Si mandamos llamar desde un perfil de Asesor
if (isset($_POST['submitAsesores'])) {

    $redirect = "../vistas/asesores/asesores--perfil.php";
    $tabla = "asesores";
    $paterno = "apellido_paternoA";
    $materno = "apellido_maternoA";
    $idTipo = "id_asesor";

    editarCuenta($dbh, $redirect, $tabla, $paterno, $materno, $idTipo);

}

// Si mandamos llamar desde un perfil de Cliente
if (isset($_POST['submitClientes'])) {

    $redirect = "../vistas/clientes/clientes--perfil.php";
    $tabla = "clientes";
    $paterno = "apellido_paterno";
    $materno = "apellido_materno";
    $idTipo = "id_cliente";

    editarCuenta($dbh, $redirect, $tabla, $paterno, $materno, $idTipo);

}

function editarCuenta($dbh, $redirect, $tabla, $paterno, $materno, $idTipo) {

    // Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
    $nombre = $_POST["nombre"];
    $apellido_paterno = $_POST["apellido_paterno"];
    $apellido_materno = $_POST["apellido_materno"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];

    // ---------------------------- Validación de formularios ------------------------------------------ //

    // Si todas las validaciones pasan, actualizamos los datos en la BD
    if (validarNombre($nombre, $redirect)) {
        if (validarApellidoPaterno($apellido_paterno, $redirect)) {
            if (validarApellidoPaterno($apellido_materno, $redirect)) {
                if (validarEmail($email, $redirect)) {
                    if (validarTelefono($telefono, $redirect)) {

                        // Sentencia sql
                        $sql = "UPDATE " . $tabla . " SET nombre = :nombre, " . $paterno . " = :apellido_paterno, " . $materno . " = :apellido_materno, email = :email, telefono = :telefono WHERE " . $idTipo . " = " . $_SESSION["id"];

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
                            mensajeGoodJob('¡Cambios guardados con éxito!', $redirect);
                            // echo "<script>alert('¡Cambios guardados con éxito!')</script>";
                            // $dbh = null;
                            // echo "<script type='text/javascript'>window.location.href='" . $redirect . "';</script>";
                        } else {
                            mensajeError('Ups, falló algo', $redirect);
                            // echo "<script>alert('Ups, falló algo')</script>";
                            // echo "<script type='text/javascript'>window.location.href='" . $redirect . "';</script>";
                        }
                    }
                }
            }
        }
    }
}

echo "</body>";