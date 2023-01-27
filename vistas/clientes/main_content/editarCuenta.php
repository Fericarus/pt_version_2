<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
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
        </div>

        <!-- Campo Nombre -->
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
                echo "<input type='text' name='nombre' value='" . $row['nombre'] . "'/>";
            }
            ?>

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
                echo "<input type='text' name='apellido_paterno' value='" . $row['apellido_paterno'] . "'/>";
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
                echo "<input type='text' name='apellido_materno' value='" . $row['apellido_materno'] . "'/>";
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
                echo "<input type='text' name='email' value='" . $row['email'] . "'/>";
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
                echo "<input type='text' name='telefono' value='" . $row['telefono'] . "'/>";
            }
            ?>

        </div>

        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Actualizar datos" class="boton" name="submitClientes">

    </form>

</div>