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
            <h1>Mostrar educación</h1>
            <p>Educación del asesor:</p>
        </div>

        <table class="table-4-col tableMostrarEducación">
            <tr>
                <td class="title">Institución educativa</td>
                <td class="title">Título obtenido</td>
                <td class="title"></td>
                <td class="title"></td>
            </tr>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM asesoreseducaciones INNER JOIN educaciones ON educaciones.id_educacion = asesoreseducaciones.id_educacion1 WHERE id_asesor3 = " . $_SESSION["id"];

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            $n = 1;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['institucion'] . "</td>";
                echo "<td>" . $row['titulo'] . "</td>";
                echo "<td><a onclick='editar(".$n.")' class='boton boton-editar' href='javascript:void(0)' code-val='+val.codigo+''>Editar</a></td>";
                echo "<td><a onclick='eliminar(".$n.")'class='boton boton-eliminar' href='javascript:void(0)' code-val='+val.codigo+''>Eliminar</a></td>";
                echo "<input class='hidden' id='id_asesorEducacion" . $n . "' value='" . $row['id_asesorEducacion'] . "'></input>";
                echo "<input class='hidden' id='id_educacion" . $n . "' value='" . $row['id_educacion'] . "'></input>";
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
        let id_asesorEducacion = document.getElementById('id_asesorEducacion' + $i);
        let id_educacion = document.getElementById('id_educacion' + $i);
        console.log(id_asesorEducacion.value);
        console.log(id_educacion.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarEducacion.php?id_asesorEducacion=" + id_asesorEducacion.value + "&id_educacion=" + id_educacion.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    // Botón Eliminar
    function eliminar($i) {
        let id_asesorEducacion = document.getElementById('id_asesorEducacion' + $i);
        let id_educacion = document.getElementById('id_educacion' + $i);
        console.log(id_asesorEducacion.value);
        console.log(id_educacion.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/eliminarEducacion.php?id_asesorEducacion=" + id_asesorEducacion.value,
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