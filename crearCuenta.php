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

        <div class="main">

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

                    <form class="formulario" action="funciones/crearCuenta.php" method="POST">

                        <div class="main__container--title">
                            <h1>Cliente nuevo</h1>
                            <p>Llena el siguiente formulario para crear una cuenta</p>
                        </div>

                        <!-- Nombre -->
                        <div class="campo">
                            <label for="nombre">Nombre<span>*</span></label>
                            <input type="text" id="nombre" name="nombre" placeholder="Juán" required />
                        </div>

                        <!-- Paterno -->
                        <div class="campo">
                            <label for="nombre">Paterno<span>*</span></label>
                            <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="González" required />
                        </div>

                        <!-- Materno -->
                        <div class="campo">
                            <label for="nombre">Materno<span>*</span></label>
                            <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Martínez" required />
                        </div>

                        <!-- Email -->
                        <div class="campo">
                            <label for="nombre">Correo<span>*</span></label>
                            <input type="email" id="email" name="email" placeholder="usuario@empresa.com" required />
                        </div>

                        <!-- Telefono -->
                        <div class="campo">
                            <label for="nombre">Teléfono<span>*</span></label>
                            <input type="number" id="telefono" name="telefono" placeholder="55 1234 1234" required />
                        </div>

                        <!-- Alcaldía -->
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
                            <input type="password" id="password" name="password" placeholder="Tu contraseña" required />
                        </div>

                        <!-- Confirmar Password -->
                        <div class="campo">
                            <label for="nombre">Confirmación<span>*</span></label>
                            <input type="password" id="confirmarPassword" name="confirmarPassword" placeholder="Confirma tu contraseña" required />
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
</script>

</html>