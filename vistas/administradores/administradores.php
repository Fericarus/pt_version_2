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
    if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
        header("location: ../../login.php");
    }
    ?>

    <div class="contenedor">

        <!-- Menu vertical -->
        <?php require('../../layout/layout_admin/nav_admin.php') ?>

        <!-- Sección principal -->
        <div class="main" id="main">

            <!-- Toggle, buscador y bienvenida a usuario-->
            <?php require('../../layout/topbar.php') ?>

            <!-- Barra de dirección -->
            <span class="ruta">
                <a href="administradores.php">
                    <h2>Inicio</h2>
                </a>
            </span>

            <!-- Sección que se recargará con la función ajax -->
            <div class="details" id="details">

                <div class="contenedor_tarjetas">
                    <a href='administradores--clientes.php' class="tarjeta tarjeta1">
                        <div>

                            <?php
                            // Incluimos la conexión a la base de datos
                            include "../../includes/config/database.php";

                            // Sentencia sql
                            $sql = "SELECT id_cliente FROM clientes";

                            // Preparamos la sentencia
                            $stmt = $dbh->prepare($sql);

                            // Ejecutamos la sentencia
                            $stmt->execute();

                            // Este método nos devuelve el número de registros de la consulta
                            $numero_clientes = $stmt->rowCount();

                            echo "<div class='numeros_tarjeta'>" . $numero_clientes . "</div>";

                            ?>

                            <div class="nombre_tarjeta">Clientes</div>

                        </div>
                        <div class="icono_tarjeta">
                            <!-- Aquí va el ícono -->
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </a>

                    <a href='administradores--asesores.php' class="tarjeta tarjeta2">
                        <div>

                            <?php
                            // Incluimos la conexión a la base de datos
                            include "../../includes/config/database.php";

                            // Sentencia sql
                            $sql = "SELECT id_asesor FROM asesores";

                            // Preparamos la sentencia
                            $stmt = $dbh->prepare($sql);

                            // Ejecutamos la sentencia
                            $stmt->execute();

                            // Este método nos devuelve el número de registros de la consulta
                            $numero_clientes = $stmt->rowCount();

                            echo "<div class='numeros_tarjeta'>" . $numero_clientes . "</div>";

                            ?>

                            <div class="nombre_tarjeta">Asesores</div>

                        </div>
                        <div class="icono_tarjeta">
                            <!-- Aquí va el ícono -->
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </a>

                    <a href='administradores--servicios.php' class="tarjeta tarjeta3">
                        <div>

                            <?php
                            // Incluimos la conexión a la base de datos
                            include "../../includes/config/database.php";

                            // Sentencia sql
                            $sql = "SELECT id_servicio FROM servicios";

                            // Preparamos la sentencia
                            $stmt = $dbh->prepare($sql);

                            // Ejecutamos la sentencia
                            $stmt->execute();

                            // Este método nos devuelve el número de registros de la consulta
                            $numero_clientes = $stmt->rowCount();

                            echo "<div class='numeros_tarjeta'>" . $numero_clientes . "</div>";

                            ?>

                            <div class="nombre_tarjeta">Servicios</div>

                        </div>
                        <div class="icono_tarjeta">
                            <!-- Aquí va el ícono -->
                            <i class="fa-solid fa-bell-concierge"></i>
                        </div>
                    </a>

                    <a href='administradores--citas.php' class="tarjeta tarjeta4">
                        <div>

                            <?php
                            // Incluimos la conexión a la base de datos
                            include "../../includes/config/database.php";

                            // Sentencia sql
                            $sql = "SELECT id_cita FROM citas";

                            // Preparamos la sentencia
                            $stmt = $dbh->prepare($sql);

                            // Ejecutamos la sentencia
                            $stmt->execute();

                            // Este método nos devuelve el número de registros de la consulta
                            $numero_clientes = $stmt->rowCount();

                            echo "<div class='numeros_tarjeta'>" . $numero_clientes . "</div>";

                            ?>

                            <div class="nombre_tarjeta">Citas</div>

                        </div>
                        <div class="icono_tarjeta">
                            <!-- Aquí va el ícono -->
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                    </a>
                </div>



            </div>

        </div>

    </div>

</body>

</html>

<script src="https://kit.fontawesome.com/e5d8247fe1.js" crossorigin="anonymous"></script>