<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}
$id_servicio = $_GET['id_servicio'];
?>
<div class="main__container--table">

    <form class="formulario" action="../../funciones/admin__editarServicio.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title title_table">
            <h1>Editar servicio</h1>
            <p>Modifica la información del servicio</p>
            <span id="errorMessageLetras" style="display: none;"></span>
        </div>

        <!-- Campo Servicio -->
        <div>
            <div class="campo">
                <label for="nombre">Servicio: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT servicio FROM servicios WHERE id_servicio = " . $id_servicio;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='servicio' name='servicio' value='" . $row['servicio'] . "' oninput='validarLetras(this.id)'/>";
                }

                ?>

            </div>
        </div>

        <!-- Campo Descripción -->
        <div>
            <div class="campo">
                <label for="nombre">Descripción: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT descripcion FROM servicios WHERE id_servicio = " . $id_servicio;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<textarea id='descripcion' name='descripcion' value='" . $row['descripcion'] . "' />" . $row['descripcion'] . "</textarea>";
                }
                ?>

            </div>
        </div>

        <input name="id_servicio" class="hidden" value="<?php echo $id_servicio ?>">

        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Actualizar datos" class="boton" name="submit">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>