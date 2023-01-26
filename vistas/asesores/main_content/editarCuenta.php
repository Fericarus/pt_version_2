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
                echo "<input type='text' name='nombre' value='" . $row['nombre'] . "'/>";
            }
            ?>

        </div>

        <!-- Campo apellido paterno -->
        <div class="campo">
            <label for="nombre">Apellido paterno: </label>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Preparamos la sentencia
            $stmt = $dbh->prepare('SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"]);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input type='text' name='apellido_paterno' value='" . $row['apellido_paternoA'] . "'/>";
            }

            ?>

        </div>

        <!-- Campo apellido materno -->
        <div class="campo">
            <label for="nombre">Apellido materno: </label>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Preparamos la sentencia
            $stmt = $dbh->prepare('SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"]);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input type='text' name='apellido_materno' value='" . $row['apellido_maternoA'] . "'/>";
            }
            ?>

        </div>

        <!-- Campo apellido Email -->
        <div class="campo">
            <label for="nombre">Correo electrónico: </label>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Preparamos la sentencia
            $stmt = $dbh->prepare('SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"]);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input type='text' name='email' value='" . $row['email'] . "'/>";
            }
            ?>

        </div>

        <!-- Campo apellido Telefono -->
        <div class="campo">
            <label for="nombre">Teléfono: </label>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Preparamos la sentencia
            $stmt = $dbh->prepare('SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"]);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input type='text' name='telefono' value='" . $row['telefono'] . "'/>";
            }
            ?>

        </div>

        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Actualizar datos" class="boton" name="submit">

    </form>

</div>