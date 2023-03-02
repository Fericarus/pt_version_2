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
$id_servicio = $_GET['id_servicio'];

?>

<div class="main__container--table table_confirmar_cita">

    <div class="card2">

        <?php

        // Incluimos la conexión a la base de datos
        include "../../../includes/config/database.php";

        // Sentencia sql
        $sql = "SELECT * FROM asesores WHERE id_asesor = " . $id_asesor;
        $sql_servicio = "SELECT servicio FROM servicios WHERE id_servicio = " . $id_servicio;

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);
        $stmt_servicio = $dbh->prepare($sql_servicio);

        // Ejecutamos la sentencia
        $stmt->execute();
        $stmt_servicio->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $row_servicio = $stmt_servicio->fetch(PDO::FETCH_ASSOC);

        ?>

        <form action='../../funciones/agendarCita.php' method='POST'>

            <h3>Estimado/a <?php echo $_SESSION['nombre']; ?></h3>
            <p>
                Este mensaje es para confirmar su cita con el asesor
                <strong><?php echo $row['nombre'] ?></strong>
                <strong><?php echo $row['apellido_paternoA'] ?></strong>
                <strong><?php echo $row['apellido_paternoA'] ?></strong>
                para el servicio de
                <strong><?php echo $row_servicio['servicio'] ?></strong>
                el día
                <strong><?php echo $fecha ?></strong>
                a las
                <strong><?php echo $hora ?></strong>
                El asesor se comunicará con usted próximamente para confirmar la
                dirección de la reunión y cualquier otra información relevante.
            </p>
            <p>
                Por favor, asegúrese de estar disponible para la llamada del asesor y de tener
                consigo cualquier documentación o información relevante para la reunión.
                Si necesita reprogramar o cancelar la cita, por favor háganos saber con al menos
                24 horas de anticipación para poder hacer los arreglos necesarios.
            </p>
            <p>
                Si tiene alguna pregunta o inquietud, por favor no dude en ponerse en contacto con nosotros.
            </p>
            <br>
            <p>Atentamente,</p>
            <p>Gerardo Javier García Ruíz</p>
            <p>Kreativika</p>

            <div class="contenedorBotones2">
                <input type="submit" value="Confirmar Cita" class="boton boton-confirmar">
                <a onclick="volver()" href="javascript:void(0)" code-val="+val.codigo+" class="boton boton-eliminar">Volver</a>
            </div>

            <input name="id_asesor" class="hidden" value="<?php echo $id_asesor ?>"></input>
            <input name="fecha" class="hidden" value="<?php echo $fecha ?>"></input>
            <input name="hora" class="hidden" value="<?php echo $hora ?>"></input>
            <input name="id_servicio" class="hidden" value="<?php echo $id_servicio ?>"></input>

        </form>

    </div>

</div>

<script>
    function volver() {
        window.location.href = "../clientes/clientes.php";
    }
</script>