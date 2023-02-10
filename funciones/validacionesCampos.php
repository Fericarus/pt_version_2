

<?php

use JetBrains\PhpStorm\Language;

header('Content-Type: text/html; charset=UTF-8 lang=es');


// Función para validar el campo nombre. Redirige a href en caso de error
function validarNombre($nombre, $href)
{
    if (empty(trim($nombre))) {
        echo "<script>alert('El campo nombre es requerido.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $nombre)) {
        echo "<script>alert('Solo se permiten letras y espacios en el nombre.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo apellido paterno. Redirige a href en caso de error
function validarApellidoPaterno($apellido_paterno, $href)
{
    if (empty(trim($apellido_paterno))) {
        echo "<script>alert('El campo Apellido paterno es requerido.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $apellido_paterno)) {
        echo "<script>alert('Solo se permiten letras y espacios en el apellido paterno.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo apellido paterno. Redirige a href en caso de error
function validarApellidoMaterno($apellido_materno, $href)
{
    if (empty(trim($apellido_materno))) {
        echo "<script>alert('El campo Apellido Materno es requerido.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $apellido_materno)) {
        echo "<script>alert('Solo se permiten letras y espacios en el apellido materno.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo Email. Redirige a href en caso de error
function validarEmail($email, $href)
{
    if (empty(trim($email))) {
        echo "<script>alert('El correo electrónico es requerido.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Ingrese un correo electrónico válido.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo Teléfono. Redirige a href en caso de error
function validarTelefono($telefono, $href)
{
    if (empty(trim($telefono))) {
        echo "<script>alert('El telefono es requerido.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!preg_match("/^\d{10}$/", $telefono)) {
        echo "<script>alert('Solo se permiten números en el teléfono y mínimo deben ser 10 dígitos.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo Password. Redirige en a href caso de error
function validarPassword($password, $href)
{
    if (empty(trim($password))) {
        echo "<script>alert('La contraseña es requerida.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    }
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
        echo "<script>alert('La contraseña debe tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial (@$!%*#?&).')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para comparar password. Redirige en caso a href de error
function compararPasword($password1, $password2, $href)
{
    if ($password1 != $password2) {
        echo "<script>alert('Los password deben coincidir')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

function soloLetras($campo, $href)
{
    if (empty(trim($campo))) {
        echo "<script>alert('No puedes dejar espacios en blanco')</script>";
        echo "<script type='text/javascript'>window.location.href='" . $href . "';</script>";
        return false;
    } else if(!preg_match("/^[A-Za-zÁÉÍÓÚéóúÑñ\s]+$/", $campo)) {
        echo "<script>alert('El campo contiene caracteres no permitidos')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
        // '/^[a-z][a-z0-9_#*$]{3,}/i'
    } else {
        return true;
    }
}

?>


</html>