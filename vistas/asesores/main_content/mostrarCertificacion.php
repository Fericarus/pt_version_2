<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table">

    <form class="formulario" action="../../funciones/agregarCertificacion.php" method="GET">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Mostrar certificación</h1>
            <p>Certificaciones del asesor:</p>
        </div>

        <table>
            <tr>
                <td class="title">Entidad certificadora</td>
                <td class="title">Certificado obtenido</td>
                <td class="title"></td>
                <td class="title"></td>
            </tr>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM asesorescertificaciones  INNER JOIN certificaciones ON certificaciones.id_certificacion = asesorescertificaciones.id_certificacion1 WHERE id_asesor4 = " . $_SESSION["id"];

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            $n = 1;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['entidad_certificadora'] . "</td>";
                echo "<td>" . $row['certificado'] . "</td>";
                echo "<td><a onclick='editar(" . $n . ")' class='boton boton-editar' href='javascript:void(0)' code-val='+val.codigo+''>Editar</a></td>";
                echo "<td><a onclick='eliminar(" . $n . ")'class='boton boton-eliminar' href='javascript:void(0)' code-val='+val.codigo+''>Eliminar</a></td>";
                echo "<input class='hidden' id='id_asesorCertificacion" . $n . "' value='" . $row['id_asesorCertificacion'] . "'></input>";
                echo "<input class='hidden' id='id_certificacion" . $n . "' value='" . $row['id_certificacion'] . "'></input>";
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
        let id_asesorCertificacion = document.getElementById('id_asesorCertificacion' + $i);
        let id_certificacion = document.getElementById('id_certificacion' + $i);
        //console.log(id_asesorEducacion.value);
        //console.log(id_educacion.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarCertificacion.php?id_asesorCertificacion=" + id_asesorCertificacion.value + "&id_certificacion=" + id_certificacion.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    // Botón Eliminar
    function eliminar($i) {
        let id_asesorCertificacion = document.getElementById('id_asesorCertificacion' + $i);
        let id_certificacion = document.getElementById('id_certificacion' + $i);
        //console.log(id_asesorEducacion.value);
        //console.log(id_educacion.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/eliminarCertificacion.php?id_asesorCertificacion=" + id_asesorCertificacion.value,
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