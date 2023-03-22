<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_asesorEducacion = $_GET['id_asesorEducacion'];
$id_educacion = $_GET['id_educacion'];

?>

<div class="main__container--table title_table">

    <form class='formulario' action='../../funciones/asesor__editarEducacion.php' method='POST'>";

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Editar educación</h1>
            <p>Edita tu información:</p>
            <span id="errorMessageLetras" style="display: none;"></span>
        </div>

        <!-- Institución -->
        <div class="campo">
            <label for="nombre">Institución</label>
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

                // Mostramos los resultados de la consulta en un Select-Option
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $row['id_educacion'] . ">" . $row['institucion'] . "</option>";
                }

                ?>

            </select>
        </div>

        <!-- Título -->
        <div>
            <div class="campo">
                <label for="nombre">Título obtenido:</label>

                <?php

                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT * FROM asesoresEducaciones WHERE id_asesorEducacion = " . $id_asesorEducacion;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                // Mostramos los resultados de la consulta en un input
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='titulo' class='campo' name='titulo' value='" . $row['titulo'] . "' oninput='validarLetras(this.id, 1)'/>";
                }

                ?>
            </div>

        </div>

        <input name="id_asesorEducacion" class="hidden" type="text" value="<?php echo $id_asesorEducacion; ?>">

        <input type="submit" value="Actualizar datos" class="boton">

    </form>

</div>

<!-- <script>
    function validadescripcion2(valor) {
        if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(valor)) {
            console.log("ERROR");
        }
        else {
            console.log("SUCCESS");
        }
    }
</script> -->

<script src="../../funciones/funciones.js"></script>