<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table title_table">

    <form class="formulario" action="" method="GET">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Mostrar Mis Citas</h1>
            <p>Citas agendadas</p>
        </div>

        <table class="table-7-col tableMostrarCitas">
            <tr>
                <td class="title">Cliente</td>
                <td class="title">Fecha</td>
                <td class="title">Hora</td>
                <td class="title">Email</td>
                <td class="title">Teléfono</td>
                <td class="title"> </td>
                <td class="title"> </td>
            </tr>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM citas INNER JOIN clientes ON clientes.id_cliente = citas.id_cliente1 WHERE id_asesor1 = " . $_SESSION["id"];

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            $n = 1;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno'] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>" . $row['hora'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['telefono'] . "</td>";
                echo "<td><a onclick='editar(" . $n . ")' class='boton boton-editar' href='javascript:void(0)' code-val='+val.codigo+''>Editar</a></td>";
                echo "<td><a onclick='eliminar(" . $n . ")'class='boton boton-eliminar' href='javascript:void(0)' code-val='+val.codigo+''>Eliminar</a></td>";
                echo "<input class='hidden' id='id_cita" . $n . "' value='" . $row['id_cita'] . "'></input>";
                echo "</tr>";
                $n++;
            }
            ?>

        </table>

    </form>

</div>

<script>

    // Botón Editar
    function editar($i) {
        let id_cita = document.getElementById('id_cita' + $i);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarCita.php?id_cita=" + id_cita.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    // Botón Eliminar
    function eliminar($i) {
        let id_cita = document.getElementById('id_cita' + $i);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/eliminarCita.php?id_cita=" + id_cita.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
        
    }

    //let id_asesorEducacion = document.getElementById('id_asesorEducacion');
    //let id_educacion = document.getElementById('id_educacion');

    //console.log(id_asesorEducacion.value);
    //console.log(id_educacion.value);

    // Boton Editar
    /*
    $(".boton-editar").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarEducacion.php?id_asesorEducacion=" + id_asesorEducacion.value + "&id_educacion=" + id_educacion.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    })
    

    // Boton Eliminar
    $(".boton-eliminar").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/eliminarEducacion.php?id_asesorEducacion=" + id_educacion.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    })
    */
</script>