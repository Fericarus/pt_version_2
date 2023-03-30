<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
$id_cita = $_GET['id_cita'];
?>
<div class="main__container--table title_table">

    <form class='formulario' action='../../funciones/reagendarCita.php' method='POST'>";

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Reagendar cita</h1>
            <p>Elige una nueva fecha para la cita</p>
        </div>

        <!-- Fecha -->
        <div class="campo">
            <label for="Fecha">Fecha</label>
            <input id="fecha" name="fecha" type="date" oninput="validarEmail(this.id)">
        </div>

        <!-- Campo Hora -->
        <div class="campo">
            <label for="hora">Hora</label>
            <select id="myTimeInput" name="hora" class="hora">

                <option value="">Seleccione una opción</option>
                <option value="09:00">09:00 a 10:00</option>
                <option value="10:00">10:00 a 11:00</option>
                <option value="11:00">11:00 a 12:00</option>
                <option value="12:00">12:00 a 13:00</option>
                <option value="13:00">13:00 a 14:00</option>
                <option value="14:00">14:00 a 15:00</option>
                <option value="15:00">15:00 a 16:00</option>
                <option value="16:00">16:00 a 17:00</option>

            </select>
        </div>

        <!-- Input oculto donde almaceno el valor de la variable $id_cita -->
        <input name="id_cita" class="hidden" value="<?php echo $id_cita; ?>">

        <!-- Botón -->
        <input name="submitAsesores" type="submit" value="Actualizar datos" class="boton">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>
