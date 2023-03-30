<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
$id_asesorCertificacion = $_GET['id_asesorCertificacion'];
?>
<div class="main__container--table title_table">

    <form class='formulario' action="../../funciones/asesor__eliminarCertificacion.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Eliminar Certificacion</h1>
            <p>¿Realmente desea eliminar los siguientes datos?</p>
        </div>

        <table class="tableEliminar">

            <!-- Cabeceras de la tabla -->
            <tr>
                <td class="title">Entidad certificadora</td>
                <td class="title">Certificacion</td>
                <td class="title"></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM asesorescertificaciones INNER JOIN certificaciones ON certificaciones.id_certificacion = asesorescertificaciones.id_certificacion1 WHERE id_asesorCertificacion = " . $id_asesorCertificacion;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['entidad_certificadora'] . "</td>";
                echo "<td>" . $row['certificado'] . "</td>";
                echo "<input class='hidden' name='id_asesorCertificacion' value='" . $row['id_asesorCertificacion'] . "'></input>";
                echo "<input class='hidden' name='id_certificacion' value='" . $row['id_certificacion'] . "'></input>";
                echo "<td><input type='submit' value='Eliminar' class='boton boton-eliminar'></td>";
                echo "</tr>";
            }

            ?>

        </table>

    </form>

</div>

</div>
