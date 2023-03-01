<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}
$id_asesor = $_GET['id_asesor'];

?>

<div class="main__container--table title_table">

    <form class="formulario" action="" method="GET">

        <div class="campo__container fecha__container">

            <!-- Título -->
            <div class="main__container--title">
                <h1>Agenda tu cita eligiendo fecha y hora adecuadas para ti</h1>
            </div>

            <!-- Mensaje de error por hora -->
            <div id="msjErrorHora" class="hidden">
                <p>Lo siento, la hora seleccionada no está disponible. Por favor, elige una hora entre las 09:00 y las 17:00.</p>
            </div>

            <!-- Mensaje de error por día -->
            <div id="msjErrorDia" class="hidden">
                <p>Lo siento, el día seleccionado no está disponible. Por favor, seleccione un día de la semana hábil.</p>
            </div>

            <!-- Campo día -->
            <div class="campo">
                <label for="Fecha">Fecha</label>
                <input id="myDateInput" type="date">
            </div>

            <!-- Campo Hora -->
            <div class="campo">
                <label for="Hora">Hora</label>
                <input id="myTimeInput" type="time" min="09:00:00" max="17:00:00">
            </div>

            <!-- Botón -->
            <a onclick="agregarFechaHora()" href="javascript:void(0)" code-val="+val.codigo+" class="boton" id="boton">Siguiente</a>

        </div>

        <input id="id_asesor" class="hidden" value="<?php echo $id_asesor ?>"></input>

    </form>

</div>

<script>
    var id_asesor = document.getElementById('id_asesor').value;
    var fecha = document.querySelector('input[type="date"]');
    var hora = document.querySelector('input[type="time"]');
    var boton = document.getElementById('boton');

    // Función para pasar por GET los parametros a la siguiente pantalla
    function agregarFechaHora() {
        $.ajax({
            url: "main_content/agendarCita3.php?id_asesor=" + id_asesor + "&fecha=" + fecha.value + "&hora=" + hora.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    // Validar horario
    const timeInput = document.getElementById('myTimeInput');
    const msjErrorHora = document.getElementById('msjErrorHora');

    timeInput.addEventListener('change', function(event) {
        const selectedTime = new Date(`1970-01-01T${event.target.value}`);
        const selectedHours = selectedTime.getHours();
        const selectedMinutes = selectedTime.getMinutes();
        const minHours = 9;
        const maxHours = 17;

        if (selectedHours < minHours || selectedHours > maxHours || (selectedHours === maxHours && selectedMinutes > 0)) {
            // La hora seleccionada está fuera del rango permitido
            msjErrorHora.classList.remove("hidden");
            msjErrorHora.classList.add("msjError");
            timeInput.value = '09:00';
        } else {
            msjErrorHora.classList.add("hidden");
        }
    });

    // Validar Días
    const dateInput = document.getElementById('myDateInput');
    const msjErrorDia = document.getElementById('msjErrorDia');

    dateInput.addEventListener('input', function(event) {
        const selectedDate = new Date(event.target.value);
        const d = sumarDias(selectedDate, 1);
        const selectedDayOfWeek = d.getDay();
        const disabledDays = [6, 0]; // 6 es sábado, 0 es domingo

        const today = new Date();

        if (disabledDays.includes(selectedDayOfWeek) || d < today) {
            // El día seleccionado está inhabilitado
            msjErrorDia.classList.remove("hidden");
            msjErrorDia.classList.add("msjError");
        } else {
            msjErrorDia.classList.add("hidden");
        }
    });

    // Función que suma o resta días a una fecha, si el parámetro días es negativo restará los días
    function sumarDias(fecha, dias) {
        fecha.setDate(fecha.getDate() + dias);
        return fecha;
    }

    // 
</script>