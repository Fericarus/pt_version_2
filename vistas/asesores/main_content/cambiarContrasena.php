<div class="main__container--table">

    <form class="formulario" action="../../funciones/cambiarContrasena.php" method="POST">

        <div class="main__container--title title_table">
            <h1>Cambiar contraseña</h1>
            <p>Cambia tu contraseña</p>
        </div>

        <div>
            <span id="errorMessagePass" style="display: none;"></span>
            <div class="campo">
                <label for="password">Contraseña actual: </label>
                <input id="pass1" name="oldPassword" type="password" placeholder="Ingresa tu contraseña actual" oninput="validarPass(this.id)" required />
            </div>
        </div>

        <div>
            <span id="errorMessagePass2" style="display: none;"></span>
            <div class="campo">
                <label for="password">Contraseña nueva: </label>
                <input id="pass2" name="password" type="password" placeholder="Ingresa tu nueva contraseña" oninput="validarPass2(this.id)" required />
            </div>
        </div>

        <div>
            <span id="errorMessagePass3" style="display: none;"></span>
            <div class="campo">
                <label for="newPassword_confirm">Repetir contraseña nueva: </label>
                <input id="pass3" name="passwordConfirm" type="password" placeholder="Confirma la nueva contraseña" oninput="validarPass3(this.id)" required />
            </div>
        </div>

        <input type="submit" value="Guardar " class="boton">

    </form>

</div>

<script>
    // Función para validar el password
    function validarPass2(id) {
        var password2 = document.getElementById(id).value;
        var errorMessagePass = document.getElementById("errorMessagePass2");
        var Pattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

        // Validamos contra la expresión regular
        if (!Pattern.test(password2)) {
            errorMessagePass.innerHTML =
                "La contraseña debe tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial";
            errorMessagePass.style.color = "red";
            errorMessagePass.style.display = "block";
            errorMessagePass.style.paddingLeft = "14.5rem";
            errorMessagePass.style.paddingBottom = ".5rem";
            return false;
        } else {
            errorMessagePass.innerHTML = "";
            errorMessagePass.style.display = "none";
            return true;
        }
    }

    // Función para validar el password
    function validarPass3(id) {
        var password3 = document.getElementById(id).value;
        var errorMessagePass = document.getElementById("errorMessagePass3");
        var Pattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

        // Validamos contra la expresión regular
        if (!Pattern.test(password3)) {
            errorMessagePass.innerHTML =
                "La contraseña debe tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial";
            errorMessagePass.style.color = "red";
            errorMessagePass.style.display = "block";
            errorMessagePass.style.paddingLeft = "14.5rem";
            errorMessagePass.style.paddingBottom = ".5rem";
            return false;
        } else {
            errorMessagePass.innerHTML = "";
            errorMessagePass.style.display = "none";
            return true;
        }
    }
</script>

<script src="../../funciones/funciones.js"></script>