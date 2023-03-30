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
            "SELECT id_giro1, COUNT(id_cliente) as num_clientes 
            FROM clientes 
            WHERE id_giro1 IN (1,4,5,6,7,8)
            GROUP BY id_giro1";

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);

        // Ejecutamos la sentencia
        $stmt->execute();

        // Recorrido de los resultados y visualización de los datos
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<input class='hidden' id='giro" . $row["id_giro1"] . "' value='" . $row["id_giro1"] . "'>";
            echo "<input class='hidden' id='clientes" . $row["id_giro1"] . "' value='" . $row["num_clientes"] . "'>";
        }

        ?>
    </div>

</div>

<script>

    // Declaración de variables
    restaurantes = 0;
    ferreterias = 0;
    consultorias = 0;
    consultorios_dentales = 0;
    farmacias = 0;
    tiendas = 0;

    // Asignamos valor a las variables dependiendo si el valor es nulo o no
    if (document.getElementById('clientes1') != null) {
        restaurantes = document.getElementById('clientes1').value;
    }

    // Asignamos valor a las variables dependiendo si el valor es nulo o no
    if (document.getElementById('clientes4') != null) {
        ferreterias = document.getElementById('clientes4').value;
    }

    // Asignamos valor a las variables dependiendo si el valor es nulo o no
    if (document.getElementById('clientes5') != null) {
        consultorias = document.getElementById('clientes5').value;
    }

    // Asignamos valor a las variables dependiendo si el valor es nulo o no
    if (document.getElementById('clientes6') != null) {
        consultorios_dentales = document.getElementById('clientes6').value;
    }

    // Asignamos valor a las variables dependiendo si el valor es nulo o no
    if (document.getElementById('clientes7') != null) {
        farmacias = document.getElementById('clientes7').value;
    }

    // Asignamos valor a las variables dependiendo si el valor es nulo o no
    if (document.getElementById('clientes8') != null) {
        tiendas = document.getElementById('clientes8').value;
    }

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'Restaurantes',
                'Ferreterias',
                'Consultorías',
                'Consultorios dentales',
                'Farmacias',
                'Tiendas'
            ],
            datasets: [{
                label: 'Mi gráfica Doughnut',
                data: [
                    restaurantes,
                    ferreterias,
                    consultorias,
                    consultorios_dentales,
                    farmacias,
                    tiendas
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ]
            }]
        },
    });




</script>