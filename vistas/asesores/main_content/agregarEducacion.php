<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
?>
<div class="main__container--table title_table">

    <form class="formulario" action="../../funciones/asesor__agregarEducacion.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Agregar educación</h1>
            <p>Ingresa los datos de tu educación:</p>
            <span id="errorMessageLetras" style="display: none;"></span>
        </div>

        <!-- Campo Institución -->
        <div class="campo">
            <label for="nombre">Institución educativa:</label>
            <select name="institucion" id="institucion" class="form_educacion">
                <option value="">Seleccione una opción</option>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT * FROM educaciones";

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $row['id_educacion'] . ">" . $row['institucion'] . "</option>";
                }
                ?>

            </select>
        </div>

        <!-- Campo Título -->
        <div>
            <div class="campo">
                <label for="nombre">Título obtenido:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Ingresa el título obtenido" class="form_educacion" oninput="validarLetras(this.id, 1)" required />
            </div>
        </div>

        <!-- Boton para actualizar cambios -->
        <input type="submit" value="Guardar cambios" class="boton">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>