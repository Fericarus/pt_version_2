<?php

// Función para validar el campo nombre. Redirige a href en caso de error
function validarNombre($nombre, $href) 
{
    
    if (empty(trim($nombre))) {
        mensajeError('El campo nombre es requerido.', $href);
        return false;
    } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $nombre)) {
        mensajeError('Solo se permiten letras y espacios en el nombre', $href);
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
        return false;
    } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $apellido_paterno)) {
        mensajeError('Solo se permiten letras y espacios en el apellido paterno', $href);
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
        return false;
    } else if (!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $apellido_materno)) {
        mensajeError('Solo se permiten letras y espacios en el apellido materno', $href);
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
        return false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        mensajeError('Ingrese un correo electrónico válido', $href);
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
        return false;
    } else if (!preg_match("/^\d{10}$/", $telefono)) {
        mensajeError('Solo se permiten números en el teléfono y mínimo deben ser 10 dígitos', $href);
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
        return false;
    }
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
        mensajeError('La contraseña debe tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial', $href);
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
        return false;
    } else {
        return true;
    }
}

function soloLetras($campo, $href)
{

     if (empty($campo)) {
        mensajeError('No puedes dejar espacios en blanco', $href);
        return false;
    } else if(!preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $campo)) {
        mensajeError('El campo contiene caracteres no permitidos', $href);
        return false;
    } else {
        return true;
    }
    
}
?>