<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_asesorEducacion = $_GET['id_asesorEducacion'];

?>

<div class="main__container--table title_table">

    <form class='formulario' action="../../funciones/eliminarEducacion.php" method="POST">";

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Eliminar educación</h1>
            <p>¿Realmente desea eliminar los siguientes datos?</p>
        </div>

        <table class="tableEliminar">

            <!-- Cabeceras de la tabla -->
            <tr>
                <td class="title">Institución</td>
                <td class="title">Título obtenido</td>
                <td class="title"></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM asesoreseducaciones INNER JOIN educaciones ON educaciones.id_educacion = asesoreseducaciones.id_educacion1 WHERE id_asesorEducacion = " . $id_asesorEducacion;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['institucion'] . "</td>";
                echo "<td>" . $row['titulo'] . "</td>";
                echo "<input class='hidden' name='id_asesorEducacion' id='id_asesorEducacion' value='" . $row['id_asesorEducacion'] . "'></input>";
                echo "<td><input type='submit' value='Eliminar' class='boton boton-eliminar'></td>";
                echo "</tr>";
            }

            ?>

        </table>

    </form>

</div>

<!--
<script>
    // Botón Eliminar
    function eliminar($i) {
        let id_asesorEducacion = document.getElementById('id_asesorEducacion' + $i);
        //console.log(id_asesorEducacion.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "../../funciones/eliminarEducacion.php?id_asesorEducacion=" + id_asesorEducacion.value,
            success: function(details) {
                $("#details").html(details);
            }
        })

    }
-->
</script>