<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="contenedor">

        <?php require('./layout/nav_index.php') ?>

        <div class="main" id="main">

            <!-- Toggle, buscador y bienvenida a usuario-->
            <?php require('./layout/topbar_index.php') ?>

            <div class="ruta">
                <a href="index.php">
                    <h2>Inicio /</h2>
                </a>
                <h2>Crear cuenta</h2>
            </div>

            <div class="details_index">

                <div class="main__container--form">

                    <form class="formulario" action="funciones/crearCuenta.php" method="POST" onsubmit="return validateForm()">

                        <!-- Titulo -->
                        <div class="main__container--title">
                            <h1>Cliente nuevo</h1>
                            <p>Llena el siguiente formulario para crear una cuenta</p>
                        </div>

                        <!-- Campo Nombre -->
                        <div class="campo">
                            <label for="nombre">Nombre<span>*</span></label>
                            <input type="text" id="nombre" name="nombre" placeholder="Juán" oninput="validarNombre()" />
                            <span id="errorMessageNombre" style="display: none;"></span>
                        </div>

                        <!-- Campo apellido paterno -->
                        <div class="campo">
                            <label for="nombre">Paterno<span>*</span></label>
                            <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="González" oninput="validarPaterno()"/>
                            <span id="errorMessagePaterno" style="display: none;"></span>
                        </div>

                        <!-- Campo apellido materno -->
                        <div class="campo">
                            <label for="nombre">Materno<span>*</span></label>
                            <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Martínez" oninput="validarMaterno()"/>
                            <span id="errorMessageMaterno" style="display: none;"></span>
                        </div>

                        <!-- Campo Email -->
                        <div class="campo">
                            <label for="nombre">Correo<span>*</span></label>
                            <input type="email" id="email" name="email" placeholder="usuario@empresa.com" oninput="validarEmail()"/>
                            <span id="errorMessageEmail" style="display: none;"></span>
                        </div>

                        <!-- Campo Telefono -->
                        <div class="campo">
                            <label for="nombre">Teléfono<span>*</span></label>
                            <input type="number" id="telefono" name="telefono" placeholder="55 1234 1234" oninput="validarTelefono()"/>
                            <span id="errorMessageTelefono" style="display: none;"></span>
                        </div>

                        <!-- Campo Alcaldía -->
                        <div class="campo">
                            <label for="nombre">Alcaldía</label>
                            <select name="id_alcaldia1" id="id_alcaldia1">
                                <option value="">Seleccione una opción</option>

                                <?php

                                // Incluimos la conexión a la base de datos
                                include "./includes/config/database.php";

                                // Sentencia sql
                                $sql = "SELECT * FROM alcaldias";

                                // Preparamos la sentencia
                                $stmt = $dbh->prepare('SELECT * FROM alcaldias');

                                // Ejecutamos la sentencia
                                $stmt->execute();

                                // Llenamos el select con los resultados de la consulta
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=" . $row['id_alcaldia'] . ">" . $row['alcaldia'] . "</option>";
                                }

                                ?>
                            </select>
                        </div>

                        <!-- Colonia -->
                        <div class="campo">
                            <label for="nombre">Colonia</label>
                            <!-- SELECT anidado -->
                            <select name="id_colonia1" id="id_colonia1">
                                <option value="">Seleccione una opción</option>
                            </select>
                        </div>


                        <!-- Giro -->
                        <div class="campo">
                            <label for="nombre">Giro<span>*</span></label>
                            <select name="id_giro1" id="id_giro1">
                                <?php
                                include "./includes/config/database.php";
                                $stmt = $dbh->prepare('SELECT * FROM giros');
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=" . $row['id_giro'] . ">" . $row['giro_comercial'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="campo">
                            <label for="nombre">Contraseña<span>*</span></label>
                            <input type="password" id="password" name="password" placeholder="Tu contraseña" oninput="validarPass()"/>
                            <span id="errorMessagePass" style="display: none;"></span>
                        </div>

                        <!-- Confirmar Password -->
                        <div class="campo">
                            <label for="nombre">Confirmación<span>*</span></label>
                            <input type="password" id="passwordConfirm" name="confirmarPassword" placeholder="Confirma tu contraseña" oninput="validarPassConfirm()"/>
                            <span id="errorMessagePassConfirm" style="display: none;"></span>
                        </div>

                        <input type="submit" value="Crear Cuenta" class="boton" name="submit">

                    </form>

                </div>


            </div>

        </div>

    </div>
</body>

<script>
    $(document).ready(function() {
        $("#id_alcaldia1").change(function() {
            var id_alcaldia1 = $(this).val();

            $.ajax({
                url: "ajax.php",
                type: "POST",
                data: {
                    id_alcaldia1: id_alcaldia1
                },
                success: function(data) {
                    $("#id_colonia1").html(data);
                }
            });
        });
    });

    // Validar nombre
    function validarNombre() {
        var nombre = document.getElementById("nombre").value;
        var errorMessageNombre = document.getElementById("errorMessageNombre");
        var nombrePattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

        // Validamos si el campo nombre está vació
        if (nombre === "") {
            errorMessageNombre.innerHTML = "El campo no puede estar vacío";
            errorMessageNombre.style.display = "block";
            errorMessageNombre.style.color = "red";
            errorMessageNombre.style.marginRight = "-152px";
            errorMessageNombre.style.marginLeft = "34px";
        }

        // Validamos contra la expresión regular
        else if (!nombrePattern.test(nombre)) {
            errorMessageNombre.innerHTML = "Solo se permiten letras y espacios."
            errorMessageNombre.style.color = "red";
            errorMessageNombre.style.display = "block";
            errorMessageNombre.style.marginRight = "-152px";
            errorMessageNombre.style.marginLeft = "34px";
            return false;
        } else {
            errorMessageNombre.innerHTML = "";
            errorMessageNombre.style.display = "none";
            return true;
        }
    }

    // Validar apellido paterno
    function validarPaterno() {
        var apellido_paterno = document.getElementById("apellido_paterno").value;
        var errorMessagePaterno = document.getElementById("errorMessagePaterno");
        var nombrePattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

        // Validamos si el campo nombre está vació
        if (apellido_paterno === "") {
            errorMessagePaterno.innerHTML = "El campo no puede estar vacío";
            errorMessagePaterno.style.display = "block";
        }

        // Validamos contra la expresión regular
        else if (!nombrePattern.test(apellido_paterno)) {
            errorMessagePaterno.innerHTML = "Solo se permiten letras y espacios."
            errorMessagePaterno.style.color = "red";
            errorMessagePaterno.style.display = "block";
            errorMessagePaterno.style.marginRight = "-152px";
            errorMessagePaterno.style.marginLeft = "34px";
            return false;
        } else {
            errorMessagePaterno.innerHTML = "";
            errorMessagePaterno.style.display = "none";
            return true;
        }
    }

    // Validar apellido Materno
    function validarMaterno() {
        var apellido_materno = document.getElementById("apellido_materno").value;
        var errorMessageMaterno = document.getElementById("errorMessageMaterno");
        var nombrePattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

        // Validamos si el campo nombre está vació
        if (apellido_materno === "") {
            errorMessageMaterno.innerHTML = "El campo no puede estar vacío";
            errorMessageMaterno.style.display = "block";
        }

        // Validamos contra la expresión regular
        else if (!nombrePattern.test(apellido_materno)) {
            errorMessageMaterno.innerHTML = "Solo se permiten letras y espacios."
            errorMessageMaterno.style.color = "red";
            errorMessageMaterno.style.display = "block";
            errorMessageMaterno.style.marginRight = "-152px";
            errorMessageMaterno.style.marginLeft = "34px";
            return false;
        } else {
            errorMessageMaterno.innerHTML = "";
            errorMessageMaterno.style.display = "none";
            return true;
        }
    }

    // Función para validar el email
    function validarEmail() {
        var email = document.getElementById("email").value;
        var errorMessageEmail = document.getElementById("errorMessageEmail");
        var nombrePattern = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ ;

        // Validamos si el campo nombre está vació
        if (email === "") {
            errorMessageEmail.innerHTML = "El campo no puede estar vacío";
            errorMessageEmail.style.display = "block";
        }

        // Validamos contra la expresión regular
        else if (!nombrePattern.test(email)) {
            errorMessageEmail.innerHTML = "Escriba un correo válido."
            errorMessageEmail.style.color = "red";
            errorMessageEmail.style.display = "block";
            errorMessageEmail.style.marginRight = "-119px";
            errorMessageEmail.style.marginLeft = "34px";
            return false;
        } else {
            errorMessageEmail.innerHTML = "";
            errorMessageEmail.style.display = "none";
            return true;
        }
    }

    // Función para validar el telefono
    function validarTelefono() {
        var telefono = document.getElementById("telefono").value;
        var errorMessageTelefono = document.getElementById("errorMessageTelefono");
        var nombrePattern = /^\d{10}$/;

        // Validamos si el campo nombre está vació
        if (telefono === "") {
            errorMessageTelefono.innerHTML = "El campo no puede estar vacío";
            errorMessageTelefono.style.display = "block";
        }

        // Validamos contra la expresión regular
        else if (!nombrePattern.test(telefono)) {
            errorMessageTelefono.innerHTML = "Escriba un teléfono válido."
            errorMessageTelefono.style.color = "red";
            errorMessageTelefono.style.display = "block";
            errorMessageTelefono.style.marginRight = "-129px";
            errorMessageTelefono.style.marginLeft = "34px";
            return false;
        } else {
            errorMessageTelefono.innerHTML = "";
            errorMessageTelefono.style.display = "none";
            return true;
        }
    }

    // Función para validar el password
    function validarPass() {
        var password = document.getElementById("password").value;
        var errorMessagePass = document.getElementById("errorMessagePass");
        var nombrePattern = /^(?=.[A-Za-z])(?=.\d)(?=.[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

        // Validamos si el campo nombre está vació
        if (password === "") {
            errorMessagePass.innerHTML = "El campo no puede estar vacío";
            errorMessagePass.style.display = "block";
            errorMessagePass.style.marginRight = "-129px";
            errorMessagePass.style.marginLeft = "34px";
        }

        // Validamos contra la expresión regular
        else if (!nombrePattern.test(password)) {
            errorMessagePass.innerHTML = "La contraseña debe tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial"
            errorMessagePass.style.color = "red";
            errorMessagePass.style.display = "block";
            errorMessagePass.style.marginRight = "-431px";
            errorMessagePass.style.marginLeft = "34px";
            return false;
        } else {
            errorMessagePass.innerHTML = "";
            errorMessagePass.style.display = "none";
            return true;
        }
    }

    // Función para validar el password confirm
    function validarPassConfirm() {
        var passwordConfirm = document.getElementById("passwordConfirm").value;
        var errorMessagePassConfirm = document.getElementById("errorMessagePassConfirm");
        var nombrePattern = /^(?=.[A-Za-z])(?=.\d)(?=.[@$!%#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

        // Validamos si el campo nombre está vació
        if (passwordConfirm === "") {
            errorMessagePassConfirm.innerHTML = "El campo no puede estar vacío";
            errorMessagePassConfirm.style.display = "block";
            errorMessagePassConfirm.style.marginRight = "-129px";
            errorMessagePassConfirm.style.marginLeft = "34px";
        }

        // Validamos contra la expresión regular
        else if (!nombrePattern.test(passwordConfirm)) {
            errorMessagePassConfirm.innerHTML = "La contraseña debe tener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un caracter especial."
            errorMessagePassConfirm.style.color = "red";
            errorMessagePassConfirm.style.display = "block";
            errorMessagePassConfirm.style.marginRight = "-431px";
            errorMessagePassConfirm.style.marginLeft = "34px";
            return false;
        } else {
            errorMessagePassConfirm.innerHTML = "";
            errorMessagePassConfirm.style.display = "none";
            return true;
        }
    }
</script>

</html>