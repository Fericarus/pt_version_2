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

                <div class="admin_dashboard">

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

                    <div class="contenedor_detalles">
                        <div class="contenedor_grafico">
                            <canvas id="myChart"></canvas>
                        </div>
                        <div class="contenedor_ultimos_clientes">

                            <!-- Titulo -->
                            <div class="main__container--title title_table">
                                <h1>Clientes recientes</h1>
                            </div>

                            <!-- Lista -->
                            <div class="contenedor_ultimos_clientes--lista">
                                <ul>
                                    <?php
                                    // Incluimos la conexión a la base de datos
                                    include "../../includes/config/database.php";

                                    // Sentencia sql
                                    $sql = "SELECT * FROM clientes 
                                    JOIN alcaldias ON clientes.id_alcaldia1 = alcaldias.id_alcaldia 
                                    ORDER BY id_cliente DESC LIMIT 9";

                                    // Preparamos la sentencia
                                    $stmt = $dbh->prepare($sql);

                                    // Ejecutamos la sentencia
                                    $stmt->execute();

                                    $n = 1;

                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<div>";
                                        echo "<li>" . $row['nombre'] . " " . $row['apellido_paterno'] . "</li>";
                                        echo "<li>" . $row['alcaldia'] . "</li>";
                                        echo "<input class='hidden' id='id_cliente" . $n . "' value='" . $row['id_cliente'] . "'></input>";
                                        echo "</div>";
                                        // echo "<td><a onclick='editar(" . $n . ")' class='boton boton-editar' href='javascript:void(0)' code-val='+val.codigo+''>Editar</a></td>";
                                        // echo "<td><a onclick='eliminar(" . $n . ")'class='boton boton-eliminar' href='javascript:void(0)' code-val='+val.codigo+''>Eliminar</a></td>";
                                        $n++;
                                    }

                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../includes/config/database.php";

            // Sentencia sql para obtener los grupos de clientes por alcaldía
            $sql = "SELECT id_alcaldia1, COUNT(id_cliente) as num_clientes 
                    FROM clientes 
                    WHERE id_alcaldia1 IN (1,2,5,6,7,8,9,10,11,12,13,14,15,16,17,18)
                    GROUP BY id_alcaldia1";

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            // Recorrido de los resultados y visualización de los datos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input class='hidden' id='alcaldia" . $row["id_alcaldia1"] . "' value='" . $row["id_alcaldia1"] . "'>";
                echo "<input class='hidden' id='clientes" . $row["id_alcaldia1"] . "' value='" . $row["num_clientes"] . "'>";
            }

            ?>

        </div>

    </div>

</body>

</html>

<script src="https://kit.fontawesome.com/e5d8247fe1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Declaración de variables
    let clientesAzcapotzalco = 0;
    let clientesAlvaroObregon = 0;
    let clientesBenitoJuarez = 0;
    let clientesCoyoacan = 0;
    let clientesCuajimalpaDeMorelos = 0;
    let clientesCuauhtemoc = 0;
    let clientesGustavoAMadero = 0;
    let clientesIztacalco = 0;
    let clientesIztapalapa = 0;
    let clientesLaMagdalenaContreras = 0;
    let clientesMiguelHidalgo = 0;
    let clientesMilpaAlta = 0;
    let clientesTlalpan = 0;
    let clientesTlahuac = 0;
    let clientesVenustianoCarranza = 0;
    let clientesXochimilco = 0;

    // Asignamos valor a las variables dependiendo si el valor es nulo o no
    if (document.getElementById('clientes1') != null) {
        clientesAzcapotzalco = document.getElementById('clientes1').value;
    }

    if (document.getElementById('clientes2') != null) {
        clientesAlvaroObregon = document.getElementById('clientes2').value;
    }

    if (document.getElementById('clientes5') != null) {
        clientesBenitoJuarez = document.getElementById('clientes5').value;
    }

    if (document.getElementById('clientes6') != null) {
        clientesCoyoacan = document.getElementById('clientes6').value;
    }

    if (document.getElementById('clientes7') != null) {
        clientesCuajimalpaDeMorelos = document.getElementById('clientes7').value;
    }

    if (document.getElementById('clientes8') != null) {
        clientesCuauhtemoc = document.getElementById('clientes8').value;
    }

    if (document.getElementById('clientes9') != null) {
        clientesGustavoAMadero = document.getElementById('clientes9').value;
    }

    if (document.getElementById('clientes10') != null) {
        clientesIztacalco = document.getElementById('clientes10').value;
    }

    if (document.getElementById('clientes11') != null) {
        clientesIztapalapa = document.getElementById('clientes11').value;
    }

    if (document.getElementById('clientes12') != null) {
        clientesLaMagdalenaContreras = document.getElementById('clientes12').value;
    }

    if (document.getElementById('clientes13') != null) {
        clientesMiguelHidalgo = document.getElementById('clientes13').value;
    }

    if (document.getElementById('clientes14') != null) {
        clientesMilpaAlta = document.getElementById('clientes14').value;
    }

    if (document.getElementById('clientes15') != null) {
        clientesTlalpan = document.getElementById('clientes15').value;
    }

    if (document.getElementById('clientes16') != null) {
        clientesTlahuac = document.getElementById('clientes16').value;
    }

    if (document.getElementById('clientes17') != null) {
        clientesVenustianoCarranza = document.getElementById('clientes17').value;
    }

    if (document.getElementById('clientes18') != null) {
        clientesXochimilco = document.getElementById('clientes18').value;
    }


    // Gráfica de barras
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Azcapotzalco',
                'Álvaro Obregón',
                'Benito Juárez',
                'Coyoacán',
                'Cuajimalpa de Morelos',
                'Cuauhtémoc',
                'Gustavo A. Madero',
                'Iztacalco',
                'Iztapalapa',
                'La Magdalena Contreras',
                'Miguel Hidalgo',
                'Milpa Alta',
                'Tlalpan',
                'Tláhuac',
                'Venustiano Carranza',
                'Xochimilco'
            ],
            datasets: [{
                label: 'Clientes por alcaldía',
                data: [
                    clientesAzcapotzalco,
                    clientesAlvaroObregon,
                    clientesBenitoJuarez,
                    clientesCoyoacan,
                    clientesCuajimalpaDeMorelos,
                    clientesCuauhtemoc,
                    clientesGustavoAMadero,
                    clientesIztacalco,
                    clientesIztapalapa,
                    clientesLaMagdalenaContreras,
                    clientesMiguelHidalgo,
                    clientesMilpaAlta,
                    clientesTlalpan,
                    clientesTlahuac,
                    clientesVenustianoCarranza,
                    clientesXochimilco
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(0, 128, 128, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(184, 141, 141, 0.2)',
                    'rgba(60, 144, 136, 0.2)',
                    'rgba(241, 224, 90, 0.2)',
                    'rgba(235, 64, 52, 0.2)',
                    'rgba(170, 68, 101, 0.2)',
                    'rgba(255, 127, 14, 0.2)',
                    'rgba(84, 177, 255, 0.2)',
                    'rgba(0, 216, 255, 0.2)',
                    'rgba(16, 185, 129, 0.2)',
                    'rgba(142, 100, 177, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(0, 128, 128, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(184, 141, 141, 1)',
                    'rgba(60, 144, 136, 1)',
                    'rgba(241, 224, 90, 1)',
                    'rgba(235, 64, 52, 1)',
                    'rgba(170, 68, 101, 1)',
                    'rgba(255, 127, 14, 1)',
                    'rgba(84, 177, 255, 1)',
                    'rgba(0, 216, 255, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(142, 100, 177, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>