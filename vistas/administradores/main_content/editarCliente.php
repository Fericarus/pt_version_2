<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_cliente = $_GET['id_cliente'];

// echo $id_cliente;

?>

<div class="main__container--table">

    <form class="formulario" action="../../funciones/admin__editarCliente.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title title_table">
            <h1>Editar datos del cliente</h1>
            <p>Modifica la información personal del cliente</p>
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
                $sql = "SELECT * FROM clientes WHERE id_cliente = " . $id_cliente;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='nombre' name='nombre' value='" . $row['nombre'] . "' oninput='validarNombre(this.id)'/>";
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
                $sql = "SELECT apellido_paterno FROM clientes WHERE id_cliente = " . $id_cliente;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='apellido_paterno' name='apellido_paterno' value='" . $row['apellido_paterno'] . "' oninput='validarPaterno(this.id)'/>";
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
                $sql = "SELECT apellido_materno FROM clientes WHERE id_cliente = " . $id_cliente;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='apellido_materno' name='apellido_materno' value='" . $row['apellido_materno'] . "' oninput='validarMaterno(this.id)'/>";
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
                $sql = "SELECT email FROM clientes WHERE id_cliente = " . $id_cliente;

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
                $sql = "SELECT telefono FROM clientes WHERE id_cliente = " . $id_cliente;

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

        <!-- Campo Alcaldía -->
        <div class="campo">
            <label for="nombre">Alcaldía</label>
            <select name="id_alcaldia1" id="id_alcaldia1">
                <option value="">Seleccione una opción</option>

                <?php

                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT * FROM alcaldias";

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                // Llenamos el select con los resultados de la consulta
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $row['id_alcaldia'] . ">" . $row['alcaldia'] . "</option>";
                }

                ?>
            </select>
        </div>

        <!-- Colonia -->
        <div class="campo">
            <label for="nombre">Colonia</label>
            <select name="id_colonia1" id="id_colonia1">
                <option value="">Seleccione una opción</option>
            </select>
        </div>

        <!-- Giro -->
        <div class="campo">
            <label for="nombre">Giro<span>*</span></label>
            <select name="id_giro1" id="id_giro1">
                <option value="">Seleccione una opción</option>
                <?php

                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = 'SELECT * FROM giros';

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $row['id_giro'] . ">" . $row['giro_comercial'] . "</option>";
                }

                ?>
            </select>
        </div>

        <input name="id_cliente" class="hidden" value="<?php echo $id_cliente ?>">

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