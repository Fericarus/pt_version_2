<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}

$id_asesor = $_GET['id_asesor'];

?>

<input id="id_asesor" class="hidden" value="<?php echo $id_asesor ?>"></input>

<!-- Título -->
<div class="main__container--title title__agendarCita">
    <h1>Selecciona fecha y hora de tu cita</h1>
</div>

<div class="main__container--table">

    <form class="formulario">
        <div class="campo__container fecha__container">
            <div class="campo">
                <label for="Fecha">Fecha</label>
                <input id="fecha" type="date">
            </div>
            <div class="campo">
                <label for="Hora">Hora</label>
                <input id="hora" type="time">
            </div>
            <a onclick="agregarFechaHora()" href="javascript:void(0)" code-val="+val.codigo+" class="boton">Siguiente</a>
        </div>
    </form>

</div>

<script>

    var id_asesor = document.getElementById('id_asesor').value;
    var fecha = document.querySelector('input[type="date"]');
    var hora = document.querySelector('input[type="time"]');

    function agregarFechaHora() {

        $.ajax({
            url: "main_content/agendarCita3.php?id_asesor=" + id_asesor + "&fecha=" + fecha.value + "&hora=" + hora.value,
            success: function(details) {
                $("#details").html(details);
            }
        })

    }
</script>