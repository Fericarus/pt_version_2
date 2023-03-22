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

<div class="main__container--table">

    <form class="formulario" action="../../funciones/admin__editarAsesor.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title title_table">
            <h1>Editar cuenta</h1>
            <p>Modifica la información personal del asesor</p>
            <span id="errorMessageNombre" style="display: none;"></span>
            <span id="errorMessagePaterno" style="display: none;"></span>
            <span id="errorMessageMaterno" style="display: none;"></span>
            <span id="errorMessageEmail" style="display: none;"></span>
            <span id="errorMessageTelefono" style="display: none;"></span>
        </div>

        <!-- Campo Nombre -->
        <div>
            <div class="campo">
                <label for="nombre">Nombre: </label>

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
                    echo "<input id='nombre' name='nombre' value='" . $row['nombreA'] . "' oninput='validarNombre(this.id)'/>";
                }

                ?>

            </div>
        </div>

        <!-- Campo apellido paterno -->
        <div>
            <div class="campo">
                <label for="nombre">Paterno: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT apellido_paternoA FROM asesores WHERE id_asesor = " . $id_asesor;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='apellido_paterno' name='apellido_paterno' value='" . $row['apellido_paternoA'] . "' oninput='validarPaterno(this.id)'/>";
                }
                ?>

            </div>
        </div>

        <!-- Campo apellido materno -->
        <div>
            <div class="campo">
                <label for="nombre">Materno: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT apellido_maternoA FROM asesores WHERE id_asesor = " . $id_asesor;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='apellido_materno' name='apellido_materno' value='" . $row['apellido_maternoA'] . "' oninput='validarMaterno(this.id)'/>";
                }
                ?>

            </div>
        </div>

        <!-- Campo Email -->
        <div>
            <div class="campo">
                <label for="nombre">Email: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT email FROM asesores WHERE id_asesor = " . $id_asesor;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='email' name='email' value='" . $row['email'] . "'oninput='validarEmail(this.id)'/>";
                }
                ?>

            </div>
        </div>

        <!-- Campo Teléfono -->
        <div>
            <div class="campo">
                <label for="nombre">Teléfono: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT telefono FROM asesores WHERE id_asesor = " . $id_asesor;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='telefono' name='telefono' value='" . $row['telefono'] . "'oninput='validarTelefono(this.id)'/>";
                }
                ?>

            </div>
        </div>

        <input name="id_asesor" class="hidden" value="<?php echo $id_asesor ?>">

        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Actualizar datos" class="boton" name="submit">

    </form>

</div>

<script>
    $(document).ready(function() {
        $("#id_alcaldia1").change(function() {
            var id_alcaldia1 = $(this).val();

            $.ajax({
                url: "../../ajax.php",
                type: "POST",
                data: {
                    id_alcaldia1: id_alcaldia1
                },
                success: function(data) {
                    $("#id_colonia1").html(data);
                }
            });
        });
    });
</script>

<script src="../../funciones/funciones.js"></script>