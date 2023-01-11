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
    // Si la variable email está vacía o el tipo de usuario es diferente a asesor
    if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
        header("location: ../../login.php");
    }
    ?>

    <div class="contenedor">

        <!-- Menu vertical -->
        <?php require('../../layout/layout_asesores/nav_asesores.php') ?>

        <!-- Sección principal -->
        <div class="main" id="main">

            <!-- Toggle, buscador y bienvenida a usuario-->
            <?php require('../../layout/topbar.php') ?>

            <!-- Barra de dirección -->
            <span class="ruta">
                <a href="asesores.php">
                    <h2>Inicio</h2>
                </a>
            </span>

            <div class="details" id="details"></div>

        </div>

    </div>
</body>

</html>
