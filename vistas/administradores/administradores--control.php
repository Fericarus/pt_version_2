<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>

    <div class="contenedor">

        <!-- Menu vertical -->
        <?php require('../../layout/layout_admin/nav_admin--control.php') ?>

        <!-- Sección principal -->
        <div class="main" id="main">

            <!-- Toggle, buscador y bienvenida a usuario-->
            <?php require('../../layout/topbar.php') ?>

            <!-- Barra de dirección -->
            <span class="ruta">
                <a href="administradores.php">
                    <h2>Inicio</h2>
                </a>
                <a href="administradores--control.php">
                    <h2>/ Control</h2>
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
    // Para ir a la sección agregar Días de descanso
    $(".agregar_dias_de_descanso").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            // Insertamos en #details el contenido de main_content/agregarEducacion.php
            url: "main_content/agregarDiasDeDescanso.php",
            success: function(details) {
                $("#details").html(details);
            }
        })

        // Adjuntamos la el nombre a la barra de dirección ruta
        let ruta = document.getElementById('ruta');
        ruta.innerHTML = "/ Agregar dias de descanso";
    })

    // Para ir a la sección mostrar_educacion
    $(".mostrar_dias_de_descanso").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/mostrarDiasDeDescanso.php",
            success: function(details) {
                $("#details").html(details);
            }
        })

        // Adjuntamos la el nombre a la barra de dirección ruta
        let ruta = document.getElementById('ruta');
        ruta.innerHTML = "/ Mostrar dias de descanso";
    })

    // Para ir a la sección agregar_educacion
    $(".definir_horarios_laborables").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            // Insertamos en #details el contenido de main_content/agregarEducacion.php
            url: "main_content/definirHorariosLaborables.php",
            success: function(details) {
                $("#details").html(details);
            }
        })

        // Adjuntamos la el nombre a la barra de dirección ruta
        let ruta = document.getElementById('ruta');
        ruta.innerHTML = "/ Definir horarios laborables";
    })


    $(".cerrar_sesion").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "../../funciones/cerrarSesion.php",
            success: function(details) {
                $("#details").html(details);
            }
        })
    })
</script>

</html>