<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Capturamos la información de los formularios en las variables $email y $passwordLogin
// La función htmlentities convierte todos los caracteres aplicables a entidades HTML
// La función addslashes — Escapa un string con barras invertidas
$email = htmlentities(addslashes($_POST["email"]));
$passwordLogin = htmlentities(addslashes($_POST["passwordLogin"]));

// Preparamos las distintas sentencias sql
$sqlClientes = "SELECT * FROM clientes WHERE email = :email AND password = :passwordLogin";
$sqlAsesores = "SELECT * FROM asesores WHERE email = :email AND password = :passwordLogin";
$sqlAdministradores = "SELECT * FROM administradores WHERE email = :email AND password = :passwordLogin";

try {

    // Consulta a la tabla Clientes
    login(
        $email,
        $passwordLogin,
        $sqlClientes,
        $dbh,
        "id_cliente",
        "location:../vistas/clientes/clientes.php",
        "cliente"
    );

    // Consulta a la tabla Asesores
    login(
        $email,
        $passwordLogin,
        $sqlAsesores,
        $dbh,
        "id_asesor",
        "location:../vistas/asesores/asesores.php",
        "asesor"
    );

    // Consulta a la tabla Administradores
    login(
        $email,
        $passwordLogin,
        $sqlAsesores,
        $dbh,
        "id_administrador",
        "location:../vistas/administradores/administradores.php",
        "administrador"
    );
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

    // Si se encorntró un registro en la tabla CLIENTE
    if ($datos[$id] != NULL) {

        // Creamos una sesión para el usuario
        session_start();

        // Almacenamos en variables de sesión la información de los resultados
        $_SESSION["id_cliente"] = $datos["id_cliente"];
        $_SESSION["nombre"] = $datos["nombre"];
        $_SESSION["apellido_paterno"] = $datos["apellido_paterno"];
        $_SESSION["apellido_materno"] = $datos["apellido_materno"];
        $_SESSION["email"] = $datos["email"];
        $_SESSION["telefono"] = $datos["telefono"];
        $_SESSION["tipoUsuario"] = $tipoCliente;

        // Redireccionamos a la página clientes
        header($location);
    }
}


















    /*
    // Si el usuario existe:
    if ($numero_registros != 0) {

        // creamos una sesión para el usuario
        session_start();

        // Almacenamos en la variable de sesión 
        $_SESSION["usuario"] = $_POST["email"];

        // Redireccionamos a la página clientes
        header("location:../vistas/clientes/clientes.php");

    } else {

        $sql = "SELECT * FROM asesores WHERE email = :email  AND password = :passwordLogin";
        $resultado = $dbh->prepare($sql);
        $email = htmlentities(addslashes($_POST["email"]));
        $passwordLogin = htmlentities(addslashes($_POST["passwordLogin"]));
        $resultado->bindValue(":email", $email);
        $resultado->bindValue(":passwordLogin", $passwordLogin);
        $resultado->execute();
        $numero_registros = $resultado->rowCount();

        if ($numero_registros != 0) {

            // creamos una sesión para el usuario
            session_start();
            $_SESSION["usuario"] = $_POST["email"];
            header("location:../vistas/asesores/asesores.php");

        } else {
            //header("location:../logn.php");
        }

        
    }
    
} catch (Exception $e) {

    die("Error: " . $e->getMessage());
}
*/
