<?php
session_start();
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";



echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

if (isset($_POST['submit'])) {

    // Capturamos la información de los formularios. Depuramos los datos con htmlentities y addslashes
    $nombre = $_POST["nombre"];
    $apellido_paterno = $_POST["apellido_paterno"];
    $apellido_materno = $_POST["apellido_materno"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $id_alcaldia1 = $_POST["id_alcaldia1"];
    $id_colonia1 = $_POST["id_colonia1"];
    $id_giro1 = $_POST["id_giro1"];
    $password = $_POST["password"];
    $confirmarPassword = $_POST["confirmarPassword"];

    // Si todas las validaciones pasan, actualizamos los datos en la BD
    if (validarNombre($nombre, "../crearCuenta.php")) {
        if (validarApellidoPaterno($apellido_paterno, "../crearCuenta.php")) {
            if (validarApellidoMaterno($apellido_materno, "../crearCuenta.php")) {
                if (validarEmail($email, "../crearCuenta.php")) {
                    if (validarTelefono($telefono, "../crearCuenta.php")) {
                        if (validarPassword($password, "../crearCuenta.php")) {
                            if (validarPassword($confirmarPassword, "../crearCuenta.php")) {
                                if (compararPasword($password, $confirmarPassword, "../crearCuenta.php")) {

                                    // 1. Sentencia sql
                                    $sql = "SELECT * FROM clientes WHERE email = :email LIMIT 1";

                                    // 2. Preparamos la sentencia sql
                                    $stmt = $dbh->prepare($sql);

                                    // 3. Establecemos la relación entre los marcadores y su correspondiente valor
                                    $stmt->bindValue(':email', $email);

                                    // 4. PDOStatement::setFetchMode — Establece el modo de obtención para esta sentencia
                                    $stmt->setFetchMode(PDO::FETCH_ASSOC);

                                    // 5. Ejecutamos la sentencia
                                    $stmt->execute();

                                    // 6. PDOStatement::fetch — Obtiene la siguiente fila de un conjunto de resultados
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
                                            mensajeGoodJob("¡Registro exitoso!", "../index.php");
                                        } else {
                                            mensajeError("Algo salió mal", "../index.php");
                                        }
                                    } else {
                                        mensajeError("Parece ser que ese correo ya se encuentra registrado.", "../index.php");
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

echo "</body>";
?>