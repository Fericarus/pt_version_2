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
            INNER JOIN roles ON roles.id_roles = roles_asesores.id_roles1
            
            ";

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);

        // Ejecutamos la sentencia
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='tarjeta_asesor'>";
                echo "<div>";
                    echo "<h3>" . $row['nombre_rol'] . "</h3>";
                    echo "<p>" . $row['descripcion_rol'] . "</p>";
                    echo "<p>Correo electrónico: " . $row['email'] . "</p>";
                    echo "<p>Teléfono: " . $row['telefono'] . "</p>";
                echo "</div>";
                echo "<h2 class='tarjeta_servicio--title marketing_digital--title'>" . $row['nombreA'] . " " . $row['apellido_paternoA'] . "</h2>";
            echo "</div>";
        }

        ?>

    </div>

</div>