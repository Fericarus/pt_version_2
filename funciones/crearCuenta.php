<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./scripts.php";

if (isset($_POST['submit'])) {

    // Capturamos la información de los formularios. Depuramos los datos con htmlentities y addslashes
    $nombre = htmlentities(addslashes($_POST["nombre"]));
    $apellido_paterno  = htmlentities(addslashes($_POST["apellido_paterno"]));
    $apellido_materno = htmlentities(addslashes($_POST["apellido_materno"]));
    $email = htmlentities(addslashes($_POST["email"]));
    $telefono = htmlentities(addslashes($_POST["telefono"]));
    $id_alcaldia1 = htmlentities(addslashes($_POST["id_alcaldia1"]));
    $id_colonia1 = htmlentities(addslashes($_POST["id_colonia1"]));
    $id_giro1 = htmlentities(addslashes($_POST["id_giro1"]));
    $password = htmlentities(addslashes($_POST["password"]));
    $confirmarPassword = htmlentities(addslashes($_POST["confirmarPassword"]));

    // Si todas las validaciones pasan, actualizamos los datos en la BD
    if (validarNombre($nombre, "../crearCuenta.php")) {
        if (validarApellidoPaterno($apellido_paterno, "../crearCuenta.php")) {
            if (validarApellidoMaterno($apellido_materno, "../crearCuenta.php")) {
                if (validarEmail($email, "../crearCuenta.php")) {
                    if (validarTelefono($telefono, "../crearCuenta.php")) {
                        if (validarPassword($password, "../crearCuenta.php")) {
                            if (validarPassword($confirmarPassword, "../crearCuenta.php")) {
                                if (compararPasword($password, $confirmarPassword, "../crearCuenta.php")) {

                                    // Sentencia sql
                                    $sql = "SELECT * FROM clientes WHERE email = :email LIMIT 1";

                                    // Preparamos la sentencia sql
                                    $stmt = $dbh->prepare($sql);

                                    // Establecemos la relación entre los marcadores y su correspondiente valor
                                    $stmt->bindValue(':email', $email);

                                    // PDOStatement::setFetchMode — Establece el modo de obtención para esta sentencia
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                    // Ejecutamos la sentencia
                                    $stmt->execute();

                                    // PDOStatement::fetch — Obtiene la siguiente fila de un conjunto de resultados
                                    $datos = $stmt->fetch();

                                    // Si no se encuentra una coincidencia en la BD
                                    if ($datos['email'] != $email) {

                                        // Preparamos la sentencia
                                        $stmt = $dbh->prepare("INSERT INTO clientes (nombre, apellido_paterno, apellido_materno, email, telefono, id_alcaldia1, id_colonia1, id_giro1, password )
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                                        // Bind params
                                        $stmt->bindParam(1, $nombre);
                                        $stmt->bindParam(2, $apellido_paterno);
                                        $stmt->bindParam(3, $apellido_materno);
                                        $stmt->bindParam(4, $email);
                                        $stmt->bindParam(5, $telefono);
                                        $stmt->bindParam(6, $id_alcaldia1);
                                        $stmt->bindParam(7, $id_colonia1);
                                        $stmt->bindParam(8, $id_giro1);
                                        $stmt->bindParam(9, $password);

                                        // Ejecutamos la sentencia
                                        if ($stmt->execute()) {
                                            echo "
                                                <script>
                                                    Swal.fire({
                                                        'Good job!',
                                                        '¡Registro exitoso!',
                                                        'success'
                                                    }) .then(function() {
                                                        window.location.href='../index.php'
                                                    });
                                                </script>
                                            ";
                                            // echo '<script>alert("Registro exitoso")</script>';
                                            // echo '<script type="text/javascript" >window.location.href="../index.php";</script>';
                                        } else {
                                            echo "
                                            <script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Ups...',
                                                    text: 'Algo salió mal'
                                                }) .then(function() {
                                                    window.location.href='../index.php'
                                                });
                                            </script>
                                            ";

                                            // echo '<script>alert("Ups, algo salió mal")</>';
                                            // echo '<script type="text/javascript" >window.location.href="../index.php";</script>';
                                        }
                                    } else {
                                        echo "
                                            <script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Ups...',
                                                    text: 'Parece ser que ese correo ya se encuentra registrado.'
                                                }) .then(function() {
                                                    window.location.href='../index.php'
                                                });
                                            </script>
                                            ";
                                        // echo '<script>alert("Parece ser que ese correo ya se encuentra registrado.")</script>';
                                        // echo '<script type="text/javascript" >window.location.href="../index.php";</script>';
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    
}
