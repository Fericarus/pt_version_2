<?php
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <div class="contenedor">

        <!-- Menu vertical -->
        <?php require('../../layout/layout_asesores/nav_asesores--perfilProf.php') ?>

        <!-- Sección principal -->
        <div class="main" id="main">

            <!-- Toggle, buscador y bienvenida a usuario-->
            <?php require('../../layout/topbar.php') ?>

            <!-- Barra de dirección -->
            <span class="ruta">
                <a href="asesores.php">
                    <h2>Inicio</h2>
                </a>
                <a href="asesores--perfilProf.php">
                    <h2>/ Mi perfil profesional</h2>
                </a>
                <h2 id="ruta"></h2>
            </span>




            <!-- Sección que se recargará con la función ajax -->
            <div class="details" id="details"></div>

        </div>

    </div>

</body>

<!-- script para recargar una sección de la página sin renderizar todo el html -->
<script>
    // Para ir a la sección agregar_educacion
    $(".agregar_educación").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            // Insertamos en #details el contenido de main_content/agregarEducacion.php
            url: "main_content/agregarEducacion.php",
            success: function(details) {
                $("#details").html(details);
            }
        })

        // Adjuntamos la el nombre a la barra de dirección ruta
        let ruta = document.getElementById('ruta');
        ruta.innerHTML = "/ Agregar educación";
    })

    // Para ir a la sección mostrar_educacion
    $(".mostrar_educación").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/mostrarEducacion.php",
            success: function(details) {
                $("#details").html(details);
            }
        })

        // Adjuntamos la el nombre a la barra de dirección ruta
        let ruta = document.getElementById('ruta');
        ruta.innerHTML = "/ Mostrar educación";
    })

    // Para ir a la sección agregar_certificación
    $(".agregar_certificacion").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/agregarCertificacion.php",
            success: function(details) {
                $("#details").html(details);
            }
        })

        // Adjuntamos la el nombre a la barra de dirección ruta
        let ruta = document.getElementById('ruta');
        ruta.innerHTML = "/ Agregar certificación";
    })

    // Para ir a la sección mostrar_certificación
    $(".mostrar_certificacion").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/mostrarCertificacion.php",
            success: function(details) {
                $("#details").html(details);
            }
        })

        // Adjuntamos la el nombre a la barra de dirección ruta
        let ruta = document.getElementById('ruta');
        ruta.innerHTML = "/ Mostrar certificación";
    })
</script>

</html>