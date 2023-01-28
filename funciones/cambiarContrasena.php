<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

// Cambiar contraseña Asesor
if ($_SESSION["tipoUsuario"] == "asesor") {
    $redirect = '<script type="text/javascript" >window.location.href="../vistas/asesores/asesores.php";</script>';
    cambiarContrasena($dbh, "asesor", "asesores", "id_asesor", $redirect);
}

// Cambiar contraseña Cliente
if ($_SESSION["tipoUsuario"] == "cliente") {
    $redirect = '<script type="text/javascript" >window.location.href="../vistas/clientes/clientes.php";</script>';
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
    $oldPassword = htmlentities(addslashes($_POST["oldPassword"]));
    $password = htmlentities(addslashes($_POST["password"]));
    $passwordConfirm = htmlentities(addslashes($_POST["passwordConfirm"]));

    // Preparamos las sentencias sql
    $sqlConsulta = "SELECT * FROM " . $tabla . " WHERE " . $idTipoUsuario . " = " . $_SESSION["id"];
    $sqlUpdate = "UPDATE " . $tabla . " SET password = :password WHERE " . $idTipoUsuario . " = " . $_SESSION["id"];

    // Validamos los input
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $oldPassword)) {
        echo '<script>alert("La contraseña se compone de al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial (@$!%*#?&).")</script>';
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
        echo '<script>alert("La contraseña anterior es incorrecta")</script>';
        echo $redirect;
    } else {
        // Preparamos la sentencia sql de Update
        $stmt = $dbh->prepare($sqlUpdate);

        // bind params
        $stmt->bindParam(':password', $password);

        // Mensaje de éxito / Ups, falló algo
        if ($stmt->execute()) {
            echo '<script>alert("¡Cambios guardados con éxito!")</script>';
            $dbh = null;
            echo $redirect;
        } else {
            echo '<script>alert("Ups, falló algo")</script>';
            echo $redirect;
        }
    }
}
