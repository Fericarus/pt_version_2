<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Capturamos la información de los formularios en las variables $email y $passwordLogin
$email = $_POST["email"];
$passwordLogin = $_POST["passwordLogin"];

// Validar email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    mensajeError("Ingrese un correo electrónico válido.", "../login.php");
}

// Validar contraseña
if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $passwordLogin)) {
    mensajeError("La contraseña se compone de al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial.", "../login.php");
}

// Preparamos las distintas sentencias sql
$sqlClientes = "SELECT * FROM clientes WHERE email = :email AND password = :passwordLogin";
$sqlAsesores = "SELECT * FROM asesores WHERE email = :email AND password = :passwordLogin";
$sqlAdministradores = "SELECT * FROM administradores WHERE email = :email AND password = :passwordLogin";

try {

    // Consulta a la tabla Clientes
    // login($email, $passwordLogin, $sqlClientes, $dbh, "id_cliente", "location:../vistas/clientes/clientes.php", "cliente");

    // // Consulta a la tabla Asesores
    // login($email, $passwordLogin, $sqlAsesores, $dbh, "id_asesor", "location:../vistas/asesores/asesores.php", "asesor");

    // // Consulta a la tabla Administradores
    // login($email, $passwordLogin, $sqlAdministradores, $dbh, "id_administrador", "location:../vistas/administradores/administradores.php", "administrador");
    
    $loginClientes = login($email, $passwordLogin, $sqlClientes, $dbh, "id_cliente", "../vistas/clientes/clientes.php", "cliente");

    // Realizamos el login según el tipo de usuario
    if (
        // Login clientes
        $loginClientes == NULL 
        &&
        // Login asesores
        login($email, $passwordLogin, $sqlAsesores, $dbh, "id_asesor", "location:../vistas/asesores/asesores.php", "asesor") == NULL
        &&
        // Login administradores
        login($email, $passwordLogin, $sqlAdministradores, $dbh, "id_administrador", "location:../vistas/administradores/administradores.php", "administrador") == NULL
    ) {
        mensajeError('Usuario o contraseña incorrectos', '../index.php');
    }
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

// Función que permite loguear dependiendo el tipo de usuario
function login($email, $passwordLogin, $sqlClientes, $dbh, $id, $location, $tipoCliente)
{

    // Realizamos la sentencia preparada
    $stmt = $dbh->prepare($sqlClientes);

    // Establecemos la relación entre los marcadores y su correspondiente valor con la función bindValue()
    // Esta función asigna el valor que tenga en ese momento la variable y aunque ésta cambie a lo 
    // largo de varias ejecuciones de execute() la sustitución permanece invariable.
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':passwordLogin', $passwordLogin);

    // PDOStatement::setFetchMode — Establece el modo de obtención para esta sentencia
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Executamos la sentencia
    $stmt->execute();

    // PDOStatement::fetch — Obtiene la siguiente fila de un conjunto de resultados
    $datos = $stmt->fetch();


    if ($datos["id_cliente"] != NULL) {

        // Creamos una sesión para el usuario
        session_start();

        // Asignamos variables de sesión para cliente
        $_SESSION["id"] = $datos["id_cliente"];
        $_SESSION["nombre"] = $datos["nombre"];
        $_SESSION["apellido_paterno"] = $datos["apellido_paterno"];
        $_SESSION["apellido_materno"] = $datos["apellido_materno"];
        $_SESSION["email"] = $datos["email"];
        $_SESSION["telefono"] = $datos["telefono"];
        $_SESSION["id_alcaldia"] = $datos["id_alcaldia1"];
        $_SESSION["id_colonia"] = $datos["id_colonia1"];
        $_SESSION["id_giro"] = $datos["id_giro1"];
        $_SESSION["tipoUsuario"] = $tipoCliente;

        // Redireccionamos a la página 
        // header('Location: ../vistas/clientes/clientes.php');
        echo "<script> window.location = '../vistas/clientes/clientes.php' </script>";        
        
    }

    if ($datos["id_asesor"] != NULL) {

        // Creamos una sesión para el usuario
        session_start();

        // Asignamos variables de sesión para asesor
        $_SESSION["id"] = $datos["id_asesor"];
        $_SESSION["nombreA"] = $datos["nombreA"];
        $_SESSION["apellido_paterno"] = $datos["apellido_paternoA"];
        $_SESSION["apellido_materno"] = $datos["apellido_maternoA"];
        $_SESSION["email"] = $datos["email"];
        $_SESSION["telefono"] = $datos["telefono"];
        $_SESSION["tipoUsuario"] = $tipoCliente;
        
        // Redireccionamos a la página
        // header($location);
        echo "<script> window.location = '../vistas/asesores/asesores.php' </script>"; 
    }

    if ($datos["id_administrador"] != NULL) {

        // Creamos una sesión para el usuario
        session_start();

        $_SESSION["id"] = $datos["id_administrador"];
        $_SESSION["nombre"] = $datos["nombre"];
        $_SESSION["apellido_paterno"] = $datos["apellido_paternoAd"];
        $_SESSION["apellido_materno"] = $datos["apellido_maternoAd"];
        $_SESSION["email"] = $datos["email"];
        $_SESSION["tipoUsuario"] = $tipoCliente;

        // Redireccionamos a la página 
        // header($location);

        echo "<script> window.location = '../vistas/administradores/administradores.php' </script>"; 
    }

}

echo "</body>";
?>