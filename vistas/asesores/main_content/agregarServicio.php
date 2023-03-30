<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
?>
<div class="main__container--table title_table">

    <form class="formulario" action="../../funciones/asesor__agregarServicio.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Agregar servicio</h1>
            <p>Ingresa los datos del servicio:</p>
        </div>

        <!-- Campo Institución -->
        <div class="campo">
            <label for="nombre">Elige un servicio:</label>
            <select name="asesorServicio" id="asesorServicios" class="form_educacion">
                <option value="">Seleccione una opción</option>

                <?php

                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT * FROM servicios";

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $row['id_servicio'] . ">" . $row['servicio'] . "</option>";
                }

                ?>

            </select>

        </div>

        <!-- Boton para actualizar cambios -->
        <input type="submit" value="Guardar cambios" class="boton">

    </form>

</div>