<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table title_table">

    <div class="formulario">

        <div class="main__container--title">
            <h1>Mostrar servicios</h1>
            <p>Servicios actualmente dados de alta</p>
        </div>

        <table class="table-5-col tableMostrarServiciosAdmin">
            <tr>
                <td class="title">ID</td>
                <td class="title">Nombre de servicio</td>
                <td class="title">Descripción del servicio</td>
                <td class="title"></td>
                <td class="title"></td>
            </tr>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM servicios";

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            $n = 1;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id_servicio'] . "</td>";
                echo "<td>" . $row['servicio'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<input class='hidden' id='id_servicio" . $n . "' value='" . $row['id_servicio'] . "'></input>";
                echo "<td><a onclick='editar(" . $n . ")' class='boton boton-editar' href='javascript:void(0)' code-val='+val.codigo+''>Editar</a></td>";
                echo "<td><a onclick='eliminar(" . $n . ")'class='boton boton-eliminar' href='javascript:void(0)' code-val='+val.codigo+''>Eliminar</a></td>";
                echo "</tr>";
                $n++;
            }
            ?>

        </table>

    </div>

</div>

<script>
    // Botón Editar
    function editar($i) {
        let id_servicio = document.getElementById('id_servicio' + $i);
        console.log(id_servicio.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarServicio.php?id_servicio=" + id_servicio.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    // Botón Eliminar
    function eliminar($i) {
        let id_servicio = document.getElementById('id_servicio' + $i);
        console.log(id_servicio.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/eliminarServicio.php?id_servicio=" + id_servicio.value,
            success: function(details) {
                $("#details").html(details);
            }
        })

    }
</script>