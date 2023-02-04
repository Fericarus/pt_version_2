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
                            <input type="text" id="nombre" name="nombre" placeholder="Juán" oninput="validateForm()" />
                            <span id="errorMessage" style="display: none;"></span>
                        </div>

                        <!-- Campo apellido paterno -->
                        <div class="campo">
                            <label for="nombre">Paterno<span>*</span></label>
                            <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="González" />
                        </div>

                        <!-- Campo apellido materno -->
                        <div class="campo">
                            <label for="nombre">Materno<span>*</span></label>
                            <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Martínez" />
                        </div>

                        <!-- Campo Email -->
                        <div class="campo">
                            <label for="nombre">Correo<span>*</span></label>
                            <input type="email" id="email" name="email" placeholder="usuario@empresa.com" />
                        </div>

                        <!-- Campo Telefono -->
                        <div class="campo">
                            <label for="nombre">Teléfono<span>*</span></label>
                            <input type="number" id="telefono" name="telefono" placeholder="55 1234 1234" />
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
                            <input type="password" id="password" name="password" placeholder="Tu contraseña" />
                        </div>

                        <!-- Confirmar Password -->
                        <div class="campo">
                            <label for="nombre">Confirmación<span>*</span></label>
                            <input type="password" id="confirmarPassword" name="confirmarPassword" placeholder="Confirma tu contraseña" />
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

    function validateForm() {
        var nombre = document.getElementById("nombre").value;
        var errorMessage = document.getElementById("errorMessage");
        var emailPattern = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

        // Validamos si está vació
        if (nombre === "") {
            errorMessage.innerHTML = "El campo no puede estar vacío";
            errorMessage.style.display = "block";
        }

        // Validamos contra la expresión regular
        else if (!emailPattern.test(nombre)) {
            errorMessage.innerHTML = "Solo se permiten letras y espacios en el nombre."
            errorMessage.style.color = "red";
            errorMessage.style.display = "block";
            return false;
        } else {
            errorMessage.innerHTML = "";
            errorMessage.style.display = "none";
            return true;
        }
    }
</script>

</html>