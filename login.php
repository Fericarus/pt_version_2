<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="index.php"><h2>Inicio /</h2></a>
                <h2>Ingresar</h2>
            </div>

            <div class="details_index">

                <div class="main__container--form">

                    <form class="formulario" action="funciones/validarLogin.php" method="POST">

                        <div class="main__container--title">
                            <h1>Inicio de sesión</h1>
                            <p>Inicia sesión con tus datos</p>
                        </div>

                        <div class="campo__container">
                            <div class="campo">
                                <label for="nombre">Correo:</label>
                                <input type="text" id="email" name="email" placeholder="usuario@empresa.com" required />
                            </div>

                            <div class="campo">
                                <label for="nombre">Contraseña:</label>
                                <input type="password" id="passwordLogin" name="passwordLogin" placeholder="Ingresa tu contraseña" required />
                            </div>
                        </div>

                        <div class="captcha__container">
                            <input type="submit" value="Iniciar Sesión" class="boton">
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</body>

</html>