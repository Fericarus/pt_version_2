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
        <?php require('../../layout/layout_clientes/nav_clientes--perfil.php') ?>

        <!-- Sección principal -->
        <div class="main">

            <!-- Toggle, buscador y bienvenida a usuario-->
            <?php require('../../layout/topbar.php') ?>

            <!-- Barra de dirección -->
            <span class="ruta">
                <a href="clientes.php">
                    <h2>Inicio</h2>
                </a>
                <h2>/ Mi perfil</h2>
            </span>

            <!-- Sección que se recargará con la función ajax -->
            <div class="details" id="details"></div>

        </div>

    </div>
</body>

<!-- script para recargar una sección de la página sin renderizar todo el html -->
<script>
    // Mostrar cuenta
    $(".mostrar_cuenta").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/mostrarCuenta.php",
            success: function(details) {
                $("#details").html(details);
            }
        })
    })

    // Cerrar sesión
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