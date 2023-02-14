<?php

// Incluimos la conexión a la BD
include "../includes/config/database.php";

// Incluimos las funciones almacenadas en validacionesCampos.php
include "./validacionesCampos.php";

// Mandamos llamar la libreria de sweetalert2
include "./mensajesSweetAlert.php";

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();

session_destroy();

mensajeGoodJob("Sesión cerrada correctamente", "../../login.php");
// echo '<script>alert("Sesión cerrada correctamente")</script>';
// echo '<script type="text/javascript" >window.location.href="../../login.php";</script>';
