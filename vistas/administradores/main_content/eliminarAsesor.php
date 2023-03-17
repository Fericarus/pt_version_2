<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_asesor = $_GET['id_asesor'];

?>

<div class="main__container--table title_table">

    <form class='formulario' action="../../funciones/admin__eliminarAsesor.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Eliminar Asesor</h1>
            <p>¿Realmente desea eliminar a este asesor?</p>
        </div>

        <table class="table-5-col tableEliminarAsesor">

            <!-- Cabeceras de la tabla -->
            <tr>
                <td class="title">ID</td>
                <td class="title">Nombre</td>
                <td class="title">Email</td>
                <td class="title">Telefono</td>
                <td></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM asesores WHERE id_asesor = " . $id_asesor;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id_asesor'] . "</td>";
                echo "<td>" . $row['nombre'] . " " . $row['apellido_paternoA'] . " " . $row['apellido_maternoA'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['telefono'] . "</td>";
                echo "<input class='hidden' name='id_asesor' value='" . $row['id_asesor'] . "'></input>";
                echo "<td><input type='submit' value='Eliminar' class='boton boton-eliminar'></td>";
                echo "</tr>";
            }

            ?>

        </table>

    </form>

</div>