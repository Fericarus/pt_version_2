<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_cita = $_GET['id_cita'];

?>

<div class="main__container--table title_table">

    <form class='formulario' action='../../funciones/editarCita.php' method='POST'>";

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Editar cita</h1>
            <p>Edita la información de la cita</p>
        </div>

        <!-- Fecha -->
        <div class="campo">
            <label for="Fecha">Fecha</label>
            <input id="fecha" name="fecha" type="date" oninput="validarEmail(this.id)">
        </div>

        <!-- Hora -->
        <div class="campo">
            <label for="Hora">Hora</label>
            <input name="hora" type="time">
        </div>

        <!-- Input oculto donde almaceno el valor de la variable $id_cita -->
        <input name="id_cita" class="hidden" value="<?php echo $id_cita; ?>">

        <!-- Botón -->
        <input name="submitAsesores" type="submit" value="Actualizar datos" class="boton">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>

<!-- <script>
    function validadescripcion2(valor) {
        if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(valor)) {
            console.log("ERROR");
        } else {
            console.log("SUCCESS");
        }
    }
</script> -->