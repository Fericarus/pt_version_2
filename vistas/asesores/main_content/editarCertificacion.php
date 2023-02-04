<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_asesorCertificacion = $_GET['id_asesorCertificacion'];
$id_certificacion = $_GET['id_certificacion'];

?>

<div class="main__container--table title_table">

    <form class='formulario' action='../../funciones/editarCertificacion.php' method='POST'>";

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Editar Certificacion</h1>
            <p>Edita tu información:</p>
        </div>

        <!-- Entidad certificadora -->
        <div class="campo">
            <label for="nombre">Entidad certificadora</label>
            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM asesorescertificaciones INNER JOIN certificaciones ON certificaciones.id_certificacion = asesorescertificaciones.id_certificacion1 WHERE id_asesorCertificacion = " . $id_asesorCertificacion;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input type='text' class='campo' name='entidad_certificadora' value='" . $row['entidad_certificadora'] . "'/>";
            }
            ?>
        </div>

        <!-- Título -->
        <div class="campo">
            <label for="nombre">Certificado obtenido:</label>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM asesorescertificaciones INNER JOIN certificaciones ON certificaciones.id_certificacion = asesorescertificaciones.id_certificacion1 WHERE id_asesorCertificacion = " . $id_asesorCertificacion;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<input type='text' class='campo' name='certificado' value='" . $row['certificado'] . "'/>";
            }

            ?>

        </div>

        <input name="id_asesorCertificacion" class="hidden" type="text" value="<?php echo $id_asesorCertificacion; ?>">
        <input name="id_certificacion" class="hidden" type="text" value="<?php echo $id_certificacion; ?>">

        <input type="submit" value="Actualizar datos" class="boton">

    </form>

</div>