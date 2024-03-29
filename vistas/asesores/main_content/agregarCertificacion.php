<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
?>
<div class="main__container--table title_table">

    <form class="formulario" action="../../funciones/asesor__agregarCertificacion.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Agregar Certificacion</h1>
            <p>Ingresa los datos de tu Certificacion:</p>
            <span id="errorMessageLetras" style="display: none;"></span>
        </div>

        <!-- Campo Entidad certificadora -->
        <div class="campo">
            <label for="nombre">Entidad certificadora:</label>
            <input type="text" id="entidad_certificadora" name="entidad_certificadora" placeholder="Entidad que emite la certificación" class="form_educacion" oninput="validarLetras(this.id, 1)" required />
        </div>

        <!-- Certificación -->
        <div class="campo">
            <label for="nombre">Certificado obtenido:</label>
            <input type="text" id="certificacion" name="certificacion" placeholder="Ingresa el certificado obtenido" class="form_educacion" oninput="validarLetras(this.id, 1)" required />
        </div>

        <!-- Boton para actualizar cambios -->
        <input type="submit" value="Guardar cambios" class="boton">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>