<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_giro = $_GET['id_giro'];

?>

<div class="main__container--table title_table">

    <form class='formulario' action="../../funciones/admin__eliminarGiro.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Eliminar Giro</h1>
            <p>¿Realmente desea eliminar este giro comercial?</p>
        </div>

        <table class="table-3-col tableEliminarGiroAdmin">

            <!-- Cabeceras de la tabla -->
            <tr>
                <td class="title">ID</td>
                <td class="title">Giro comercial</td>
                <td class="title"></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM giros WHERE id_giro = " . $id_giro;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id_giro'] . "</td>";
                echo "<td>" . $row['giro_comercial'] . "</td>";
                echo "<input class='hidden' name='id_giro' value='" . $row['id_giro'] . "'></input>";
                echo "<td><input type='submit' value='Eliminar' class='boton boton-eliminar'></td>";
                echo "</tr>";
            }

            ?>

        </table>

    </form>

</div>