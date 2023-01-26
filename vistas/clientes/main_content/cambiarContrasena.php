<div class="main__container--table">

    <form class="formulario" action="../../funciones/cambiarContrasena.php" method="POST">

        <div class="main__container--title title_table">
            <h1>Cambiar contraseña</h1>
            <p>Cambia tu contraseña</p>
        </div>

        <div class="campo">
            <label for="password">Contraseña actual: </label>
            <input type="password" name="oldPassword" placeholder="Ingresa tu contraseña actual" required />
        </div>

        <div class="campo">
            <label for="password">Contraseña nueva: </label>
            <input type="password" name="password" placeholder="Ingresa tu nueva contraseña" required />
        </div>

        <div class="campo">
            <label for="newPassword_confirm">Repetir contraseña nueva: </label>
            <input type="password" name="passwordConfirm" placeholder="Confirma la nueva contraseña" required />
        </div>

        <input type="submit" value="Guardar" class="boton">

    </form>

</div>