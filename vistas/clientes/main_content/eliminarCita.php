<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
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
                <td class="title">Asesor</td>
                <td class="title">Fecha</td>
                <td class="title">Hora</td>
                <td class="title"></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM citas INNER JOIN asesores ON asesores.id_asesor = citas.id_asesor1 WHERE id_cita = " . $id_cita;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['nombre'] . " " . $row['apellido_paternoA'] . " " . $row['apellido_maternoA'] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>" . $row['hora'] . "</td>";
                echo "<input class='hidden' name='id_cita' value='" . $row['id_cita'] . "'></input>";
                echo "<td><input name='submitClientes' type='submit' value='Eliminar' class='boton boton-eliminar'></td>";
                echo "</tr>";
            }

            ?>

        </table>

    </form>

</div>
