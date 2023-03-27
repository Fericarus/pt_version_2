<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table title_table">

    <form class="formulario" action="../../funciones/admin__agregarServicio.php" method="POST" onsubmit="return validateForm()">

        <!-- Título del formulario -->
        <div class="main__container--title title_table">
            <h1>Agregar servicio</h1>
            <p>Ingresa la información del nuevo servicio</p>
            <span id="errorMessageLetras" style="display: none;"></span>
        </div>

        <!-- Campo Servicio -->
        <div>
            <div class="campo">
                <label for="nombre">Servicio: </label>
                <input id='servicio' name='servicio' placeholder="Nombre del servicio" oninput='validarLetras(this.id)' />
            </div>
        </div>

        <!-- Campo Descripción -->
        <div>
            <div class="campo">
                <label for="nombre">Descripción: </label>
                <textarea id='descripcion' name='descripcion' placeholder="Escribe las descripción del servicio..."></textarea>
            </div>
        </div>

        <input name=" id_servicio" class="hidden" value="<?php echo $id_servicio ?>">

        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Agregar servicio" class="boton" name="submit">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>