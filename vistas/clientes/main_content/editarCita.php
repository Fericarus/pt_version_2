<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_cita = $_GET['id_cita'];

?>

<div class="main__container--table title_table">

    <!-- Mensaje de error por hora -->
    <div id="msjErrorHora" class="hidden">
        <p>La hora seleccionada no está permitida. Por favor, seleccione una hora entre las 09:00 y las 17:00.</p>
    </div>

    <!-- Mensaje de error por día -->
    <div id="msjErrorDia" class="hidden">
        <p>El día seleccionado no está permitido. Por favor, seleccione un día de la semana hábil.</p>
    </div>

    <form class='formulario' action='../../funciones/editarCita.php' method='POST'>

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Editar cita</h1>
            <p>Edita la información de la cita</p>
        </div>

        <!-- Fecha -->
        <div class="campo">
            <label for="Fecha">Fecha</label>
            <input id="myDateInput" name="fecha" type="date">
        </div>

        <!-- Hora -->
        <div class="campo">
            <label for="Hora">Hora</label>
            <input id="myTimeInput" name="hora" type="time">
        </div>

        <!-- Input oculto donde almaceno el valor de la variable $id_cita -->
        <input name="id_cita" class="hidden" value="<?php echo $id_cita; ?>">

        <!-- Botón -->
        <input name="submitClientes" type="submit" value="Actualizar datos" class="boton">

    </form>

</div>

<script>
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
</script>