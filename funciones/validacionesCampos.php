<?php

// Función para validar el campo nombre. Redirige en caso de error
function validarNombre($nombre, $href)
{
    if (empty($nombre)) {
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

// Función para validar el campo apellido paterno. Redirige en caso de error
function validarApellidoPaterno($apellido_paterno, $href)
{
    if (empty($apellido_paterno)) {
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

// Función para validar el campo apellido paterno. Redirige en caso de error
function validarApellidoMaterno($apellido_materno, $href)
{
    if (empty($apellido_materno)) {
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

// Función para validar el campo Email. Redirige en caso de error
function validarEmail($email, $href)
{
    if (empty($email)) {
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

// Función para validar el campo Teléfono. Redirige en caso de error
function validarTelefono($telefono, $href)
{
    if (empty($telefono)) {
        echo "<script>alert('El telefono es requerido.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!preg_match("/^\d{10}$/", $telefono)) {
        echo "<script>alert('Solo se permiten números en el teléfono.')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo Password. Redirige en caso de error
function validarPassword($password, $href)
{
    if (empty($password)) {
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

// Función para comparar password. Redirige en caso de error
function compararPasword($password1, $password2, $href)
{
    if ($password1 != $password2) {
        echo "<script>alert('Los password deben coincidir')</script>";
        echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    }
    else {
        return true;
    }
}
