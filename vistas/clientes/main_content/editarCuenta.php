<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}
?>
<div class="main__container--table">

    <form class="formulario" action="../../funciones/editarCuenta.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title title_table">
            <h1>Editar cuenta</h1>
            <p>Modifica tu información personal</p>
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
                $sql = "SELECT * FROM clientes WHERE id_cliente = " . $_SESSION['id'];

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
        <div class="campo">
            <label for="nombre">Paterno: </label>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM clientes WHERE id_cliente = " . $_SESSION['id'];

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input id='apellido_paterno' name='apellido_paterno' value='" . $row['apellido_paterno'] . "' oninput='validarPaterno(this.id)'/>";
            }
            ?>

        </div>

        <!-- Campo apellido materno -->
        <div class="campo">
            <label for="nombre">Materno: </label>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM clientes WHERE id_cliente = " . $_SESSION['id'];

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input id='apellido_materno' name='apellido_materno' value='" . $row['apellido_materno'] . "' oninput='validarMaterno(this.id)'/>";
            }
            ?>

        </div>

        <!-- Campo Email -->
        <div class="campo">
            <label for="nombre">Email: </label>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM clientes WHERE id_cliente = " . $_SESSION['id'];

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input id='email' name='email' value='" . $row['email'] . "' oninput='validarEmail(this.id)'/>";
            }
            ?>

        </div>

        <!-- Campo Teléfono -->
        <div class="campo">
            <label for="nombre">Teléfono: </label>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM clientes WHERE id_cliente = " . $_SESSION['id'];

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input id='telefono' name='telefono' value='" . $row['telefono'] . "' oninput='validarTelefono(this.id)'/>";
            }
            ?>

        </div>

        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Actualizar datos" class="boton" name="submitClientes">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>