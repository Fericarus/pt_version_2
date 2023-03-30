<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
?>
<div class="main__container--table title_table">

    <form class="formulario">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Mostrar mis servicios</h1>
            <p>Servicios que proporciona el asesor:</p>
        </div>

        <table class="table-3-col tableMostrarServicios">
            <tr>
                <td class="title">Servicio</td>
                <td class="title">Descripción del servicio</td>
                <td class="title"></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM asesoresservicios INNER JOIN servicios ON servicios.id_servicio = asesoresservicios.id_servicio2 WHERE id_asesor2 = " . $_SESSION["id"];

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            $n = 1;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['servicio'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td><a onclick='eliminar(".$n.")'class='boton boton-eliminar' href='javascript:void(0)' code-val='+val.codigo+''>Eliminar</a></td>";
                echo "<input class='hidden' id='id_asesorServicio" . $n . "' value='" . $row['id_asesorServicio'] . "'></input>";
                echo "</tr>";
                $n++;
            }
            ?>

        </table>

    </form>

</div>

<script>

    // Botón Eliminar
    function eliminar($i) {
        let id_asesorServicio = document.getElementById('id_asesorServicio' + $i);
        // console.log(id_asesorServicio.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/eliminarServicio.php?id_asesorServicio=" + id_asesorServicio.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
        
    }

</script>