<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_giro = $_GET['id_giro'];

?>

<div class="main__container--table">

    <form class="formulario" action="../../funciones/admin__editarGiro.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title title_table">
            <h1>Editar giro</h1>
            <p>Modifica la información del giro</p>
        </div>

        <!-- Campo Giro -->
        <div>
            <span id="errorMessageLetras" style="display: none;"></span>
            <div class="campo">
                <label for="nombre">Giro: </label>

                <?php
                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT giro_comercial FROM giros WHERE id_giro = " . $id_giro;

                // Preparamos la sentencia
                $stmt = $dbh->prepare($sql);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<input id='giro_comercial' name='giro_comercial' value='" . $row['giro_comercial'] . "' oninput='validarLetras(this.id)'/>";
                }

                ?>

            </div>
        </div>

        <input name="id_giro" class="hidden" value="<?php echo $id_giro ?>">

        <!-- Botón para actuañizar datos -->
        <input type="submit" value="Actualizar datos" class="boton" name="submit">

    </form>

</div>

<script src="../../funciones/funciones.js"></script>