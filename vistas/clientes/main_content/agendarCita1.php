<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}

?>

<!-- Título de la página -->
<div class="main__container--title title__agendarCita">
    <h1>Selecciona un asesor</h1>
</div>


<div class="main__container--table">

    <!-- Contenedor de cards -->
    <div class='card__container'>

        <?php

        // Incluimos la conexión a la base de datos
        include "../../../includes/config/database.php";

        // Sentencia sql
        $sql = "SELECT * FROM asesores";

        // Preparamos la sentencia
        $stmt = $dbh->prepare($sql);

        // Ejecutamos la sentencia
        $stmt->execute();

        // Imprimimos tantas cards como asesores existan en la BD
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            echo "<div class='card' onclick='agregarAsesor(" . $row['id_asesor'] . ")'>";
            echo "<div>";
            echo "<span>Nombre: </span>";
            echo "<span class='cardNombre'><strong>" . $row['nombre'] . " </strong></span>";
            echo "<span class='cardPaterno'><strong>" . $row['apellido_paternoA'] . " </strong></span>";
            echo "<span class='cardMaterno'><strong>" . $row['apellido_maternoA'] . " </strong></span>";
            echo "</div>";
            echo "<div>";
            echo "<span>Email: </span>";
            echo "<span class='cardEmail'><strong>" . $row['email'] . " </strong></span>";
            echo "</div>";
            echo "<div>";
            echo "<span>Teléfono: </span>";
            echo "<span class='cardTelefono'><strong>" . $row['telefono'] . " </strong></span>";
            echo "</div>";
            echo "</div>";
        }
        ?>

    </div>

</div>

<script>
    function agregarAsesor(n) {

        $.ajax({
            url: "main_content/agendarCita2.php?id_asesor=" + n,
            success: function(details) {
                $("#details").html(details);
            }
        })

    }
</script>