<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
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

<!-- Título -->
<div class="main__container--title title__agendarCita">
    <h1>Verifique los datos de su cita</h1>
</div>

<div class="main__container--table confirmar_cita">

    <div class="card2">

        <?php

        // Incluimos la conexión a la base de datos
        include "../../../includes/config/database.php";

        // Sentencia sql
        $sql = "SELECT * FROM asesores WHERE id_asesor = " . $id_asesor;

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);

        // Ejecutamos la sentencia
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<form action='../../funciones/agendarCita.php' method='POST'>";
        echo "<input name='id_asesor' class='hidden' value='" . $id_asesor . "'></input>";
        echo "<input name='fecha' class='hidden' value='" . $fecha . "'></input>";
        echo "<input name='hora' class='hidden' value='" . $hora . "'></input>";
        echo "<div>";
        echo "<span>Nombre del asesor: </span>";
        echo "<span class='cardNombre'><strong>" . $row['nombre'] . " </strong></span>";
        echo "<span class='cardPaterno'><strong>" . $row['apellido_paternoA'] . " </strong></span>";
        echo "<span class='cardMaterno'><strong>" . $row['apellido_maternoA'] . " </strong></span>";
        echo "</div>";
        echo "<div>";
        echo "<span>Fecha: </span>";
        echo "<span class='cardFecha'><strong>" . $fecha . "</strong></span>";
        echo "</div>";
        echo "<div>";
        echo "<span>Hora: </span>";
        echo "<span class='cardHora'><strong>" . $hora . "</strong></span>";
        echo "</div>";
        //echo "</form>";

        ?>

        <div class="contenedorBotones2">
            <input type="submit" value="Confirmar Cita" class="boton boton-confirmar">
            <a onclick="volver()" href="javascript:void(0)" code-val="+val.codigo+" class="boton boton-eliminar">Volver</a>
        </div>

        </form>


    </div>

</div>

<script>
    function volver() {
        window.location.href = "../clientes/clientes.php";
    }
</script>