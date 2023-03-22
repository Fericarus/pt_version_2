<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_asesorServicio = $_GET['id_asesorServicio'];

?>

<div class="main__container--table title_table">

    <form class='formulario' action="../../funciones/asesor__eliminarServicio.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Eliminar Servicio</h1>
            <p>¿Realmente desea eliminar los siguientes datos?</p>
        </div>

        <table class="table-3-col tableMostrarServicios">

            <!-- Cabeceras de la tabla -->
            <tr>
                <td class="title">Servicio</td>
                <td class="title">Descripción del servicio</td>
                <td class="title"></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM asesoresservicios INNER JOIN servicios ON servicios.id_servicio = asesoresservicios.id_servicio2 WHERE id_asesorServicio = " . $id_asesorServicio;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();


            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['servicio'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<input class='hidden' name='id_asesorServicio' value='" . $row['id_asesorServicio'] . "'></input>";
                echo "<td><input type='submit' value='Eliminar' class='boton boton-eliminar'></td>";
                echo "</tr>";
            }

            ?>

        </table>

    </form>

</div>

<!-- <script>
    // Botón Eliminar
    function eliminar($i) {
        let id_asesorServicio = document.getElementById('id_asesorServicio' + $i);
        //console.log(id_asesorEducacion.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "../../funciones/eliminarServicio.php?id_asesorServicio=" + id_asesorServicio.value,
            success: function(details) {
                $("#details").html(details);
            }
        })

    }
</script> -->