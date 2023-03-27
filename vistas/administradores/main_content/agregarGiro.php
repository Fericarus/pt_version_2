<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table title_table">

    <form class="formulario" action="../../funciones/admin__agregarGiro.php" method="POST" onsubmit="return validateForm()">

        <!-- Título del formulario -->
        <div class="main__container--title title_table">
            <h1>Agregar Giro comercial</h1>
            <p>Ingresa la información del nuevo giro comercial</p>
        </div>

        <!-- Campo Servicio -->
        <div>
            <span id="errorMessageLetras" style="display: none;"></span>
            <div class="campo">
                <label for="nombre">Nombre del giro: </label>
                <input id='giro_comercial' name='giro_comercial' placeholder="Restaurante, farmacia, ferretería..." oninput='validarLetras(this.id)' />
            </div>
        </div>

        <input name=" id_giro" class="hidden" value="<?php echo $id_giro ?>">

        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Agregar Giro" class="boton" name="submit">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>