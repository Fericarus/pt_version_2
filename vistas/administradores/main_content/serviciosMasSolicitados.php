<?php
session_start();
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
            "SELECT id_servicio1, COUNT(id_servicio1) as num_servicios 
            FROM citasservicios 
            WHERE id_servicio1 IN (7,11,12,13,14,15,16,17,18,19,20,21,22,23)
            GROUP BY id_servicio1";

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);

        // Ejecutamos la sentencia
        $stmt->execute();

        // Recorrido de los resultados y visualización de los datos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<input class='hidden' id='giro" . $row["id_servicio1"] . "' value='" . $row["id_servicio1"] . "'>";
            echo "<input class='hidden' id='num_servicios" . $row["id_servicio1"] . "' value='" . $row["num_servicios"] . "'>";
        }

        ?>
    </div>

</div>

<script>
    // Declaración de variables
    businessScouting = 0;
    campañas = 0;
    emailMarketing = 0;
    estrategiaDigital = 0;
    imagenEmpresarial = 0;
    fotografiayVideo = 0;
    diseñoGrafico = 0;
    maquetaciónGrafica = 0;
    paginaWeb = 0;
    posicionamientoSEO = 0;
    liveTransmisiones = 0;
    podcast = 0;
    whatsAppStore = 0;
    redesSociales = 0;

    // Asignamos valor a las variables dependiendo si el valor es nulo o no
    if (document.getElementById('num_servicios7') != null) {
        businessScouting = document.getElementById('num_servicios7').value;
    }

    if (document.getElementById('num_servicios11') != null) {
        campañas = document.getElementById('num_servicios11').value;
    }

    if (document.getElementById('num_servicios12') != null) {
        emailMarketing = document.getElementById('num_servicios12').value;
    }

    if (document.getElementById('num_servicios13') != null) {
        estrategiaDigital = document.getElementById('num_servicios13').value;
    }

    if (document.getElementById('num_servicios14') != null) {
        imagenEmpresarial = document.getElementById('num_servicios14').value;
    }

    if (document.getElementById('num_servicios15') != null) {
        fotografiayVideo = document.getElementById('num_servicios15').value;
    }

    if (document.getElementById('num_servicios16') != null) {
        diseñoGrafico = document.getElementById('num_servicios16').value;
    }

    if (document.getElementById('num_servicios17') != null) {
        maquetaciónGrafica = document.getElementById('num_servicios17').value;
    }

    if (document.getElementById('num_servicios18') != null) {
        paginaWeb = document.getElementById('num_servicios18').value;
    }

    if (document.getElementById('num_servicios19') != null) {
        posicionamientoSEO = document.getElementById('num_servicios19').value;
    }

    if (document.getElementById('num_servicios20') != null) {
        liveTransmisiones = document.getElementById('num_servicios20').value;
    }

    if (document.getElementById('num_servicios21') != null) {
        podcast = document.getElementById('num_servicios21').value;
    }

    if (document.getElementById('num_servicios22') != null) {
        whatsAppStore = document.getElementById('num_servicios22').value;
    }

    if (document.getElementById('num_servicios23') != null) {
        redesSociales = document.getElementById('num_servicios23').value;
    }

    // Gráfica de barras
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Business Scouting',
                'Campañas',
                'Email Marketing',
                'Estrategia Digital',
                'Imagen Empresarial',
                'Fotografia y Video',
                'Diseño Grafico',
                'Maquetación Grafica',
                'Pagina Web',
                'Posicionamiento SEO',
                'Live Transmisiones',
                'Podcast',
                'WhatsApp Store',
                'Redes Sociales'
            ],
            datasets: [{
                label: 'Servicios solicitados',
                data: [
                    businessScouting,
                    campañas,
                    emailMarketing,
                    estrategiaDigital,
                    imagenEmpresarial,
                    fotografiayVideo,
                    diseñoGrafico,
                    maquetaciónGrafica,
                    paginaWeb,
                    posicionamientoSEO,
                    liveTransmisiones,
                    podcast,
                    clientesTlalpan,
                    whatsAppStore
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
                    'rgba(0, 216, 255, 0.2)'
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
                    'rgba(0, 216, 255, 1)'
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