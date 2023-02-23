<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table">

    <form class="formulario" action="../../funciones/editarCuenta.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title title_table">
            <h1>Editar cuenta</h1>
            <p>Edita la información de tu cuenta</p>
        </div>

        <!-- Campo nombre -->
        <div>
            <span id="errorMessageNombre" style="display: none;"></span>
            <div class="campo">
                <label for="nombre">Nombre: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = 'SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"];

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
            <span id="errorMessagePaterno" style="display: none;"></span>
            <div class="campo">
                <label for="nombre">Apellido paterno: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT * FROM asesores WHERE id_asesor = " . $_SESSION['id'];

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='paterno' name='apellido_paterno' value='" . $row['apellido_paternoA'] . "' oninput='validarPaterno(this.id)'/>";
                }

                ?>

            </div>
        </div>

        <!-- Campo apellido materno -->
        <div>
            <span id="errorMessageMaterno" style="display: none;"></span>
            <div class="campo">
                <label for="nombre">Apellido materno: </label>

                <?php

                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = 'SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"];

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='materno' name='apellido_materno' value='" . $row['apellido_maternoA'] . "' oninput='validarMaterno(this.id)'/>";
                }
                ?>

            </div>
        </div>


        <!-- Campo apellido Email -->
        <div>
            <span id="errorMessageEmail" style="display: none;"></span>
            <div class="campo">
                <label for="nombre">Correo electrónico: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = 'SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"];

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='email' name='email' value='" . $row['email'] . "' oninput='validarEmail(this.id)'/>";
                }
                ?>

            </div>
        </div>


        <!-- Campo apellido Telefono -->
        <div>
            <span id="errorMessageTelefono" style="display: none;"></span>
            <div class="campo">
                <label for="nombre">Teléfono: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = 'SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"];

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='telefono' name='telefono' value='" . $row['telefono'] . "' oninput='validarTelefono(this.id)'/>";
                }
                ?>

            </div>
        </div>


        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Actualizar datos" class="boton" name="submitAsesores">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>