<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

// Capturamos la información de los formularios en las variables $email y $passwordLogin
$oldPassword = htmlentities(addslashes($_POST["oldPassword"]));
$password = htmlentities(addslashes($_POST["password"]));
$passwordConfirm = htmlentities(addslashes($_POST["passwordConfirm"]));

// Preparamos las sentencias sql
$sqlConsulta = "SELECT * FROM asesores WHERE id_asesor = " . $_SESSION["id"];
$sqlUpdate = "UPDATE asesores SET password = :password WHERE id_asesor = " . $_SESSION["id"];

// Validamos los input
if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $oldPassword)) {
    echo '<script>alert("La contraseña se compone de al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial (@$!%*#?&).")</script>';
    echo '<script type="text/javascript" >window.location.href="../vistas/asesores/asesores--perfil.php";</script>';
}

if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
    echo '<script>alert("La contraseña se compone de al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial (@$!%*#?&).")</script>';
    echo '<script type="text/javascript" >window.location.href="../vistas/asesores/asesores--perfil.php";</script>';
}

if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $passwordConfirm)) {
    echo '<script>alert("La contraseña se compone de al menos 8 caracteres, una letra   minúscula, una mayúscula, un número y un caracter especial (@$!%*#?&).")</script>';
    echo '<script type="text/javascript" >window.location.href="../vistas/asesores/asesores--perfil.php";</script>';
}

// Validamos que los nuevos password coincidan
if ($password !== $passwordConfirm) {
    echo '<script>alert("Los password deben coincidir")</script>';
    echo '<script type="text/javascript" >window.location.href="../vistas/asesores/asesores.php";</script>';
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
    echo '<script type="text/javascript" >window.location.href="../vistas/asesores/asesores.php";</script>';
}

// Preparamos la sentencia sql de Update
$stmt = $dbh->prepare($sqlUpdate);

// bind params
$stmt->bindParam(':password', $password);

// Mensaje de éxito / Ups, falló algo
if ($stmt->execute()) {
    echo '<script>alert("¡Cambios guardados con éxito!")</script>';
    $dbh = null;
    echo '<script type="text/javascript">window.location.href="../vistas/asesores/asesores.php";</script>';
} else {
    echo '<script>alert("Ups, falló algo")</script>';
    echo '<script type="text/javascript">window.location.href="../vistas/asesores/asesores.php";</script>';
}

