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

    <form class='formulario'>";

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Eliminar educación</h1>
            <p>¿Realmente desea eliminar los siguientes datos?</p>
        </div>

        <table>

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

            $n = 1;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['institucion'] . "</td>";
                echo "<td>" . $row['titulo'] . "</td>";
                echo "<input class='hidden' id='id_asesorEducacion" . $n . "' value='" . $row['id_asesorEducacion'] . "'></input>";
                echo "<td><a onclick='eliminar(" . $n . ")'class='boton boton-eliminar' href='javascript:void(0)' code-val='+val.codigo+'>Eliminar</a></td>";
                echo "</tr>";
                $n++;
            }

            ?>

        </table>

    </form>

</div>

</div>


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
</script>