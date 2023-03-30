<?php
session_start();
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";



echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Capturamos el valor de la varible pasada por POST
$id_cliente = $_POST['id_cliente'];

$redirect = '../vistas/administradores/administradores--clientes.php';


/** ------------------ PRIMERO VERIFICAMOS SI EL CLIENTE TIENE CITAS AGENDADAS ------------------- */
// 1. Sentencia sql
$sql_citas = "SELECT * FROM citas WHERE id_cliente1 = " . $id_cliente;

// 2. Preparamos la sentencia sql
$stmt = $dbh->prepare($sql_citas);

// 5. Ejecutamos la sentencia
$stmt->execute();

// Obtenemos el número de registros que nos devolvió la consulta
$count = $stmt->rowCount();

// Si el cliente tiene citas agendadas activas se le indicará al administrador que debe eliminarlas primero si desea continuar
if ($count > 0) {
    mensajeError("El cliente tiene citas agendadas. Elimínelas primero", $redirect);
} else {

    /** ------------------ AHORA SI PROCEDEMOS A ELIMINAR AL CLIENTE DEL SISTEMA ------------------- */
    // Sentencia sql
    $sql = "DELETE FROM clientes WHERE id_cliente = " . $id_cliente;

    // Preparamos la sentencia
    $stmt = $dbh->prepare($sql);

    // Ejecutamos la sentencia
    if ($stmt->execute()) {
        mensajeGoodJob("Cliente eliminado con éxito", $redirect);
    } else {
        mensajeError("Ups, algo salió mal", $redirect);
    }

}

echo "</body>";
?>