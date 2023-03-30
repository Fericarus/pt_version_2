<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}
?>
<div class="details" id="details">

    <div class="cliente_dashboard">

        <!-- Servicio Marketing Digital -->
        <?php

        // Incluimos la conexión a la base de datos
        include "../../../includes/config/database.php";

        // Sentencia sql
        $sql =
            "SELECT * FROM asesores
            INNER JOIN roles_asesores ON asesores.id_asesor = roles_asesores.id_asesor5
            INNER JOIN roles ON roles.id_roles = roles_asesores.id_roles1";

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);

        // Ejecutamos la sentencia
        $stmt->execute();

        $n = 1;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<a onclick='seleccionar(" . $n . ")' class='tarjeta_asesor' href='javascript:void(0)' code-val='+val.codigo+'>";
                echo "<div>";
                    echo "<div>";
                        echo "<h3>" . $row['nombre_rol'] . "<hr></h3>";
                        echo "<p>" . $row['descripcion_rol'] . "</p>";
                    echo "</div>";
                    echo "<div>";
                        echo "<p>Correo electrónico: " . $row['email'] . "</p>";
                        echo "<p>Teléfono: " . $row['telefono'] . "</p>";
                    echo "</div>";
                    echo "<input class='hidden' id='id_asesor" . $n . "' value='" . $row['id_asesor'] . "'></input>";
                echo "</div>";
                echo "<h2 class='tarjeta_servicio--title marketing_digital--title'>" . $row['nombreA'] . " " . $row['apellido_paternoA'] . "</h2>";
            echo "</a>";
            $n++;
        }

        ?>

    </div>

</div>

<script>
    // Botón Seleccionar
    function seleccionar($i) {
        let id_asesor = document.getElementById('id_asesor' + $i);
        console.log(id_asesor.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/agendarCita2.php?id_asesor=" + id_asesor.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }
</script>