<?php
session_start();
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Incluimos las configuraciones de Control
include "./control.php";


echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Capturamos la información de los formularios y depuramos los datos con htmlentities y addslashes
$id_asesor1 = $_POST['id_asesor'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$id_servicio = $_POST['id_servicio'];
$redirect = "../vistas/clientes/clientes--citas.php";

// Primero verificamos si no existe una cita agendada a la misma hora, fecha y con el mismo asesor
// Sentencia sql
$sql = "SELECT * FROM citas WHERE fecha = '$fecha' AND hora = '$hora' AND id_asesor1 = '$id_asesor1'";

// Preparamos la sentencia
$stmt = $dbh->prepare($sql);

// Ejecutamos la sentencia
$stmt->execute();

// Comprobamos que la consulta devuelva algún resultado
if ($stmt->rowCount() > 0) {

    // Ya hay una cita reservada en la misma fecha y hora, mostrar un mensaje de error
    mensajeError("Lo sentimos, ya hay una cita reservada en la misma fecha y hora.", $redirect);

} else {

    // Validamos que la cita se encuentre entre la hora de apertura y la hora de cierre del establecimiento
    if ($hora >= $hora_de_apertura && $hora <= $hora_de_cierre) {

        // Sentencia sql
        $sql = 
            "INSERT INTO citas (id_asesor1, id_cliente1, fecha, hora, estado_cita) 
            VALUES (:id_asesor1, :id_cliente1, :fecha, :hora, 'pendiente')";

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);

        // Bind Params
        $stmt->bindParam(':id_asesor1', $id_asesor1);
        $stmt->bindParam(':id_cliente1', $_SESSION["id"]);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);

        // Mensaje de éxito
        if ($stmt->execute()) {

            //////////////////// PRIMERO VAMOS A OBTENER EL ID DEL REGISTRO INSERT ///////////////////////
            // Sentencia sql
            $last_id = $dbh->lastInsertId();

            /////////////////////// DESPUÉS AGREGAMOS EL REGISTRO A CITASSERVICIOS /////////////////////////
            $sql_citasservicios = "INSERT INTO citasservicios (id_cita1, id_servicio1) VALUES (:id_cita1, :id_servicio1)";

            // Preparamos la sentencia
            $stmt_citasservicios = $dbh->prepare($sql_citasservicios);

            // Bind Params
            $stmt_citasservicios->bindParam(':id_cita1', $last_id);
            $stmt_citasservicios->bindParam(':id_servicio1', $id_servicio);

            if ($stmt_citasservicios->execute()) {
                // Mostrar mensaje de éxito
                mensajeGoodJob("¡Cita agendada con éxito!", $redirect);
            } else {
                // Mostrar mensaje de error
                mensajeError("Ups, falló algo", $redirect);
                // echo "Código de error SQLSTATE: " . $stmt_citasservicios->errorInfo()[0] . "<br>";
                // echo "Código de error específico de la base de datos: " . $stmt_citasservicios->errorInfo()[1] . "<br>";
                // echo "Descripción del error: " . $stmt_citasservicios->errorInfo()[2];
            }
        } else {
            mensajeError("Ups, falló algo", $redirect);
            // echo "Código de error SQLSTATE: " . $stmt->errorInfo()[0] . "<br>";
            // echo "Código de error específico de la base de datos: " . $stmt->errorInfo()[1] . "<br>";
            // echo "Descripción del error: " . $stmt->errorInfo()[2];
        }
    } else {
        mensajeError("Lo sentimos, verifique su información", $redirect);
        // echo $hora;
        // echo "<br>";
        // echo $hora_de_apertura;
        // echo "<pre>";
        // var_dump($hora == $hora_de_apertura); 
        // echo "</pre>";
    }
}

echo "</body>";
?>