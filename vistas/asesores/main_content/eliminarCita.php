<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
$id_cita = $_GET['id_cita'];
?>
<div class="main__container--table title_table">

    <form class='formulario' action="../../funciones/eliminarCita.php" method="POST">";

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Eliminar cita</h1>
            <p>¿Realmente desea eliminar los siguientes datos?</p>
        </div>

        <table class="table-4-col">

            <!-- Cabeceras de la tabla -->
            <tr>
                <td class="title">Cliente</td>
                <td class="title">Fecha</td>
                <td class="title">Hora</td>
                <td class="title"></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM citas INNER JOIN clientes ON clientes.id_cliente = citas.id_cliente1 WHERE id_cita = " . $id_cita;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno'] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>" . $row['hora'] . "</td>";
                echo "<input class='hidden' name='id_cita' value='" . $row['id_cita'] . "'></input>";
                echo "<td><input name='submitAsesores' type='submit' value='Eliminar' class='boton boton-eliminar'></td>";
                echo "</tr>";
            }

            ?>

        </table>

    </form>

</div>
