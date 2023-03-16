<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

echo "<body style='background: rgb(165, 43, 155); background: linear-gradient(90deg, rgba(165, 43, 155, 1) 0%, rgba(105, 49, 160, 1) 100%);'>";

// Capturamos el valor de la varible pasada por POST
$id_giro = $_POST['id_giro'];

$redirect = '../vistas/administradores/administradores--giros.php';

// Sentencias sql
$sql_clientes = "DELETE id_giro1 FROM clientes WHERE id_giro1 = " . $id_giro;
$sql = "DELETE FROM giros WHERE id_giro = " . $id_giro;

// Preparamos las sentencias
$stmt_clientes = $dbh->prepare($sql_clientes);
$stmt = $dbh->prepare($sql);

// Ejecutamos las sentencias
if ($stmt->execute()) {
    mensajeGoodJob("Giro eliminado correctamente", $redirect);
} else {
    // echo "Código de error SQLSTATE: " . $stmt->errorInfo()[0] . "<br>";
    // echo "Código de error específico de la base de datos: " . $stmt->errorInfo()[1] . "<br>";
    // echo "Descripción del error: " . $stmt->errorInfo()[2];
    // echo "<pre>";
    // echo var_dump($stmt);
    // echo "</pre>";
    mensajeError("Algo falló. Por favor inténtelo más tarde.", $redirect);
}

echo "</body>";

/////////////////////////////// CÓMO SE SOLUCIONÓ EL PROBLEMA /////////////////////////////////////////

/** Esta instrucción se utiliza para eliminar la restricción de clave externa que actualmente 
 * existe en la tabla clientes. El nombre de la restricción de clave externa es 
 * clientes_ibfk_3, que es el nombre que se muestra en el error que recibiste. 
 * Al eliminar esta restricción de clave externa, puedes modificar su configuración.

-> ALTER TABLE clientes
-> DROP FOREIGN KEY clientes_ibfk_3;

*/

