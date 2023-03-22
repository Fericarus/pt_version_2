<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>


<div class="admin_dashboard">

    <div class="reportes">
        <div class="contenedor_grafico">
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <div>
    <?php
    // Incluimos la conexión a la base de datos
    include "../../../includes/config/database.php";

    // Sentencia sql para obtener los grupos de clientes por alcaldía
    $sql =
        "SELECT id_alcaldia1, COUNT(id_cliente) as num_clientes 
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


<script>
    // Declaración de variables
    clientesAzcapotzalco = 0;
    clientesAlvaroObregon = 0;
    clientesBenitoJuarez = 0;
    clientesCoyoacan = 0;
    clientesCuajimalpaDeMorelos = 0;
    clientesCuauhtemoc = 0;
    clientesGustavoAMadero = 0;
    clientesIztacalco = 0;
    clientesIztapalapa = 0;
    clientesLaMagdalenaContreras = 0;
    clientesMiguelHidalgo = 0;
    clientesMilpaAlta = 0;
    clientesTlalpan = 0;
    clientesTlahuac = 0;
    clientesVenustianoCarranza = 0;
    clientesXochimilco = 0;

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


    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'Clientes Azcapotzalco',
                'Clientes Alvaro Obregon',
                'Clientes Benito Juarez',
                'Clientes Coyoacan',
                'Clientes Cuajimalpa de Morelos',
                'Clientes Cuauhtemoc',
                'Clientes Gustavo A Madero',
                'Clientes Iztacalco',
                'Clientes Iztapalapa',
                'Clientes La Magdalena Contreras',
                'Clientes Miguel Hidalgo',
                'Clientes Milpa Alta',
                'Clientes Tlalpan',
                'Clientes Tlahuac',
                'Clientes Venustiano Carranza',
                'Clientes Xochimilco'
            ],
            datasets: [{
                label: 'Mi gráfica Doughnut',
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
                ]
            }]
        },
        
        options: {
            //opciones de configuración
            title: {
                display: true,
                text: 'Mi gráfica Doughnut'
            },
            animation: {
                animateScale: true
            },
        }

    });
</script>