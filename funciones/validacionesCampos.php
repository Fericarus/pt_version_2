<?php

// Función para validar el campo nombre. Redirige a href en caso de error
function validarNombre($nombre, $href) 
{
    
    if (empty(trim($nombre))) {
        mensajeError('El campo nombre es requerido.', $href);
        // echo "<script>alert('El campo nombre es requerido.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $nombre)) {
        mensajeError('Solo se permiten letras y espacios en el nombre', $href);
        // echo "<script>alert('Solo se permiten letras y espacios en el nombre.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo apellido paterno. Redirige a href en caso de error
function validarApellidoPaterno($apellido_paterno, $href)
{
    if (empty(trim($apellido_paterno))) {
        mensajeError('El campo Apellido paterno es requerido', $href);
        // echo "<script>alert('El campo Apellido paterno es requerido.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $apellido_paterno)) {
        mensajeError('Solo se permiten letras y espacios en el apellido paterno', $href);
        // echo "<script>alert('Solo se permiten letras y espacios en el apellido paterno.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo apellido paterno. Redirige a href en caso de error
function validarApellidoMaterno($apellido_materno, $href)
{
    if (empty(trim($apellido_materno))) {
        mensajeError('El campo Apellido Materno es requerido', $href);
        // echo "<script>alert('El campo Apellido Materno es requerido.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $apellido_materno)) {
        mensajeError('Solo se permiten letras y espacios en el apellido materno', $href);
        // echo "<script>alert('Solo se permiten letras y espacios en el apellido materno.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo Email. Redirige a href en caso de error
function validarEmail($email, $href)
{
    if (empty(trim($email))) {
        mensajeError('El correo electrónico es requerido.', $href);
        // echo "<script>alert('El correo electrónico es requerido.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        mensajeError('Ingrese un correo electrónico válido', $href);
        // echo "<script>alert('Ingrese un correo electrónico válido.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo Teléfono. Redirige a href en caso de error
function validarTelefono($telefono, $href)
{
    if (empty(trim($telefono))) {
        mensajeError('El telefono es requerido.', $href);
        // echo "<script>alert('El telefono es requerido.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else if (!preg_match("/^\d{10}$/", $telefono)) {
        mensajeError('Solo se permiten números en el teléfono y mínimo deben ser 10 dígitos', $href);
        // echo "<script>alert('Solo se permiten números en el teléfono y mínimo deben ser 10 dígitos.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para validar el campo Password. Redirige en a href caso de error
function validarPassword($password, $href)
{
    if (empty(trim($password))) {
        mensajeError('La contraseña es requerida.', $href);
        // echo "<script>alert('La contraseña es requerida.')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    }
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
        mensajeError('La contraseña debe tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial', $href);
        // echo "<script>alert('La contraseña debe tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial (@$!%*#?&).')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

// Función para comparar password. Redirige en caso a href de error
function compararPasword($password1, $password2, $href)
{
    if ($password1 != $password2) {
        mensajeError('Los password deben coincidir', $href);
        // echo "<script>alert('Los password deben coincidir')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
}

function soloLetras($campo, $href)
{

     if (empty($campo)) {
        mensajeError('No puedes dejar espacios en blanco', $href);
        // echo "<script>alert('No puedes dejar espacios en blanco')</script>";
        // echo "<script type='text/javascript'>window.location.href='" . $href . "';</script>";
        return false;
    } else if(!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $campo)) {
        mensajeError('El campo contiene caracteres no permitidos', $href);
        // echo "<script>alert('El campo contiene caracteres no permitidos')</script>";
        // echo "<script type='text/javascript' >window.location.href='" . $href . "';</script>";
        return false;
    } else {
        return true;
    }
    
}

?>


</html>