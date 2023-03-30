<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}
$id_asesor = $_GET['id_asesor'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];
?>
<input name="id_asesor" class="hidden" value="<?php echo $id_asesor ?>"></input>
<input name="fecha" class="hidden" value="<?php echo $fecha ?>"></input>
<input name="hora" class="hidden" value="<?php echo $hora ?>"></input>

<div class="main__container--table title_table">

    <form class="formulario" action="" method="GET">

        <!-- Título -->
        <div class="main__container--title">
            <h1>Elige el servicio que necesitas</h1>
        </div>

        <!-- Campo día -->
        <div class="campo">
            <label for="Servicios: ">Servicio: </label>
            <select name="id_servicio" id="id_servicio">

                <option value="">Seleccione una opción</option>

                <?php

                // Incluimos la conexión a la base de datos
                include "../../../includes/config/database.php";

                // Sentencia sql
                $sql = "SELECT * FROM servicios";

                // Preparamos la sentencia
                $stmt = $dbh->prepare('SELECT * FROM servicios');

                // Ejecutamos la sentencia
                $stmt->execute();

                // Llenamos el select con los resultados de la consulta
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $row['id_servicio'] . ">" . $row['servicio'] . "</option>";
                }

                ?>

            </select>
        </div>

        <!-- Botón -->
        <a onclick="agregarServicio()" href="javascript:void(0)" code-val="+val.codigo+" class="boton" id="boton">Siguiente</a>

        <input id="id_asesor" class="hidden" value="<?php echo $id_asesor ?>"></input>

    </form>

</div>

<script>
    // Función para pasar por GET los parametros a la siguiente pantalla
    function agregarServicio() {
        $.ajax({
            url: "main_content/agendarCita4.php?id_asesor=" + id_asesor + "&fecha=" + fecha.value + "&hora=" + hora.value + "&id_servicio=" + id_servicio.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    console.log(hora.value);
</script>