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

        <?php require('../../layout/layout_clientes/nav_clientes--citas.php') ?>

        <div class="main">

            <!-- Toggle, buscador y bienvenida a usuario-->
            <?php require('../../layout/topbar.php') ?>

            <div class="ruta">
                <a href="clientes.php">
                    <h2>Inicio</h2>
                </a>
            </div>

        </div>

    </div>
</body>

</html>