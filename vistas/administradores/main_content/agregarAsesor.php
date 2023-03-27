<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table title_table">

    <form class="formulario" action="../../funciones/admin__agregarAsesor.php" method="POST" onsubmit="return validateForm()">

        <!-- Titulo -->
        <div class="main__container--title title_table">
            <h1>Asesor nuevo</h1>
            <p>Llena el siguiente formulario para crear una nueva cuenta de asesor</p>
            <span id="errorMessageNombre" style="display: none;"></span>
            <span id="errorMessagePaterno" style="display: none;"></span>
            <span id="errorMessageMaterno" style="display: none;"></span>
            <span id="errorMessageEmail" style="display: none;"></span>
            <span id="errorMessageTelefono" style="display: none;"></span>
            <span id="errorMessagePass" style="display: none;"></span>
            <span id="errorMessagePassConfirm" style="display: none;"></span>
        </div>

        <!-- Campo Nombre -->
        <div>
            <div class="campo">
                <label for="nombre">Nombre<span>*</span></label>
                <input type="text" id="nombre" name="nombre" placeholder="Juán" oninput="validarNombre(this.id)" />
            </div>
        </div>

        <!-- Campo apellido paterno -->
        <div>
            <div class="campo">
                <label for="nombre">Paterno<span>*</span></label>
                <input type="text" id="apellido_paterno" name="apellido_paternoA" placeholder="González" oninput="validarPaterno(this.id)" />
            </div>
        </div>

        <!-- Campo apellido materno -->
        <div>
            <div class="campo">
                <label for="nombre">Materno<span>*</span></label>
                <input type="text" id="apellido_materno" name="apellido_maternoA" placeholder="Martínez" oninput="validarMaterno(this.id)" />
            </div>
        </div>

        <!-- Campo Email -->
        <div>
            <div class="campo">
                <label for="nombre">Correo<span>*</span></label>
                <input type="email" id="email" name="email" placeholder="usuario@empresa.com" oninput="validarEmail(this.id)" />
            </div>
        </div>

        <!-- Campo Telefono -->
        <div>
            <div class="campo">
                <label for="nombre">Teléfono<span>*</span></label>
                <input type="number" id="telefono" name="telefono" placeholder="55 1234 1234" oninput="validarTelefono(this.id)" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <div class="campo">
                <label for="nombre">Contraseña<span>*</span></label>
                <input type="password" id="password" name="password" placeholder="Tu contraseña" oninput="validarPass(this.id)" />
            </div>
        </div>

        <!-- Confirmar Password -->
        <div>
            <div class="campo">
                <label for="nombre">Confirmación<span>*</span></label>
                <input type="password" id="passwordConfirm" name="confirmarPassword" placeholder="Confirma tu contraseña" oninput="validarPass(this.id)" />
            </div>
        </div>

        <input type="submit" value="Crear Cuenta" class="boton" name="submit">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>