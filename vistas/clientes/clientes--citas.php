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

    <?php
    // Reanudamos sesión en caso de que se haya iniciado antes
    session_start();
    // Si no hay nada en la variable de sesión usuario
    if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
        header("location: ../../login.php");
    }
    ?>

    <div class="contenedor">

        <!-- Menu vertical -->
        <?php require('../../layout/layout_clientes/nav_clientes--citas.php') ?>

        <!-- Sección principal -->
        <div class="main" id="main">

            <!-- Toggle, buscador y bienvenida a usuario-->
            <?php require('../../layout/topbar.php') ?>

            <!-- Barra de dirección -->
            <div class="ruta">
                <a href="clientes.php"><h2>Inicio</h2></a>
                <h2>/ Citas</h2>
            </div>

            <!-- Sección que se recargará con la función ajax -->
            <div class="details" id="details"></div>

        </div>

    </div>
</body>

</html>

<!-- script para recargar una sección de la página sin renderizar todo el html -->
<script>
    // Mostrar cuenta
    $(".agendar_cita").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/agendarCita1.php",
            success: function(details) {
                $("#details").html(details);
            }
        })
    })

    // Cerrar sesión
    $(".mostrar_cita").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/mostrarCita.php",
            success: function(details) {
                $("#details").html(details);
            }
        })
    })
</script>