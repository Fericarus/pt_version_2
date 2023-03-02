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

// Cambiar contraseña Asesor
if ($_SESSION["tipoUsuario"] == "asesor") {
    $redirect = "../vistas/asesores/asesores.php";
    cambiarContrasena($dbh, "asesor", "asesores", "id_asesor", $redirect);
}

// Cambiar contraseña Cliente
if ($_SESSION["tipoUsuario"] == "cliente") {
    $redirect = "../vistas/clientes/clientes.php";
    cambiarContrasena($dbh, "cliente", "clientes", "id_cliente", $redirect);
}

// Función para cambiar contraseñas de diferentes tipos de usuarios
function cambiarContrasena($dbh, $tipoUsuario, $tabla, $idTipoUsuario, $redirect)
{
    // Si no hay nada en la variable de sesión usuario
    if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != $tipoUsuario)) {
        header("location: ../../login.php");
    }

    // Capturamos la información de los formularios en las variables $email y $passwordLogin
    $oldPassword = $_POST["oldPassword"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];

    // Preparamos las sentencias sql
    $sqlConsulta = "SELECT * FROM " . $tabla . " WHERE " . $idTipoUsuario . " = " . $_SESSION["id"];
    $sqlUpdate = "UPDATE " . $tabla . " SET password = :password WHERE " . $idTipoUsuario . " = " . $_SESSION["id"];

    // Validamos los input
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $oldPassword)) {
        echo '<script>alert("La contraseña se compone de al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial (@$!%*#?&).")</>';
        echo $redirect;
    }

    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
        echo '<script>alert("La contraseña se compone de al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial (@$!%*#?&).")</script>';
        echo $redirect;
    }

    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $passwordConfirm)) {
        echo '<script>alert("La contraseña se compone de al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial (@$!%*#?&).")</script>';
        echo $redirect;
    }

    // Validamos que los nuevos password coincidan
    if ($password !== $passwordConfirm) {
        echo '<script>alert("Las contraseñas deben coincidir")</script>';
        echo $redirect;
    }

    // Preparamos la sentencia de consulta
    $stmt = $dbh->prepare($sqlConsulta);

    // Ejecutamos la sentencia sql de consulta
    $stmt->execute();

    // Almacenamos en una variable el resultado de la consulta
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $passBD = $row['password'];
    }

    // Si la contraseña de la BD y la contraseña anterior no coincide, mandamos mensaje de error
    if ($passBD != $oldPassword) {
        mensajeError("La contraseña anterior es incorrecta", $redirect);
        // echo '<script>alert("La contraseña anterior es incorrecta")</script>';
        // echo $redirect;
    } else {
        // Preparamos la sentencia sql de Update
        $stmt = $dbh->prepare($sqlUpdate);

        // bind params
        $stmt->bindParam(':password', $password);

        // Mensaje de éxito / Ups, falló algo
        if ($stmt->execute()) {
            mensajeGoodJob("¡Cambios guardados con éxito!", $redirect);
            // echo '<script>alert("¡Cambios guardados con éxito!")</script>';
            // $dbh = null;
            // echo $redirect;
        } else {
            mensajeError("Ups, falló algo", $redirect);
            // echo '<script>alert("Ups, falló algo")</script>';
            // echo $redirect;
        }
    }
}

echo "</body>";