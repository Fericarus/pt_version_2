<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_cita = $_GET['id_cita'];

?>

<div class="main__container--table">

    <form class="formulario" action="../../funciones/cambiarEstadoCita.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title title_table">
            <h1>Cambiar estado de cita</h1>
            <p>Modifica el estado de la cita</p>
        </div>

        <!-- Campo Estado -->
        <div class="campo">
            <label for="estado">Estado de la cita</label>
            <select id="estado" name="estado">

                <option value="">Seleccione una opción</option>
                <option value="pendiente">Pendiente</option>
                <option value="atendiendo">Atendiendo</option>
                <option value="completada">Completada</option>

            </select>
        </div>

        <?php
            echo "<input name='id_cita' class='hidden' value='" . $id_cita . "'>";
        ?>

        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Actualizar datos" class="boton" name="submit">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>