<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table">

    <form class="formulario" action="../../funciones/agregarCertificacion.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Agregar Certificacion</h1>
            <p>Ingresa los datos de tu Certificacion:</p>
        </div>

        <!-- Campo Entidad certificadora -->
        <div class="campo">
            <label for="nombre">Entidad certificadora:</label>
            <input type="text" id="entidad_certificadora" name="entidad_certificadora" placeholder="Entidad que emite la certificación" class="form_educacion" required />
        </div>

        <!-- Certificación -->
        <div class="campo">
            <label for="nombre">Certificado obtenido:</label>
            <input type="text" id="certificacion" name="certificacion" placeholder="Ingresa el certificado obtenido" class="form_educacion" required />
        </div>

        <!-- Boton para actualizar cambios -->
        <input type="submit" value="Guardar cambios" class="boton">

    </form>


</div>