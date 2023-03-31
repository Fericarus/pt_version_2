<?php
session_start();
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Eliminamos las cookies asociadas a la sesión
setcookie(session_name(), "", time() - 3600, "/");

session_destroy();

salir("../../login.php");

exit();
?>