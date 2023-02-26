<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_servicio = $_GET['id_servicio'];

?>

<div class="main__container--table title_table">

    <form class='formulario' action="../../funciones/admin__eliminarServicio.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Eliminar Servicio</h1>
            <p>¿Realmente desea eliminar este servicio?</p>
        </div>

        <table class="table-4-col tableEliminarServiciosAdmin">

            <!-- Cabeceras de la tabla -->
            <tr>
                <td class="title">ID</td>
                <td class="title">Servicio</td>
                <td class="title">Descripción</td>
                <td class="title"></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM servicios WHERE id_servicio = " . $id_servicio;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id_servicio'] . "</td>";
                echo "<td>" . $row['servicio'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<input class='hidden' name='id_servicio' value='" . $row['id_servicio'] . "'></input>";
                echo "<td><input type='submit' value='Eliminar' class='boton boton-eliminar'></td>";
                echo "</tr>";
            }

            ?>

        </table>

    </form>

</div>