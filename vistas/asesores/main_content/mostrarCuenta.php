<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
?>
<div class="main__container--table">

    <div class="formulario">

    <!-- Titulo de la página -->
        <div class="main__container--title title_table">
            <h1>Mostrar cuenta</h1>
            <p>Datos del usuario</p>
        </div>


        <table>

            <tbody class="tableCuenta">

                <!-- Títulos de las columnas -->
                <tr>
                    <td class="title">Nombre</td>
                    <td class="title">Apellido paterno</td>
                    <td class="title child3">Apellido materno</td>
                    <td class="title child4">Email</td>
                    <td class="title">Teléfono</td>
                </tr>

                <tr>

                    <?php
                    // Incluimos la conexión a la BD
                    include "../../../includes/config/database.php";

                    // Preparamos la sentencia
                    $stmt = $dbh->prepare('SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"]);

                    // Ejecutamos la sentencia
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<td>" . $row['nombreA'] . "</td>";
                        echo "<td>" . $row['apellido_paternoA'] . "</td>";
                        echo "<td class='child3'>" . $row['apellido_maternoA'] . "</td>";
                        echo "<td class='child4'>" . $row['email'] . "</td>";
                        echo "<td>" . $row['telefono'] . "</td>";
                    }
                    ?>

                </tr>

            </tbody>

        </table>

        <div class="contenedorBotones">
            <!-- Boton Editar -->
            <a href="javascript:void(0)" code-val="+val.codigo+" class="boton boton-editar boton2">Editar</a>

            <!-- Boton Cambiar contraseña -->
            <a href="javascript:void(0)" code-val="+val.codigo+" class="boton boton-contrasena boton2">Cambiar contraseña</a>
        </div>

    </div>

</div>


<script>
    // Boton Editar
    $(".boton-editar").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarCuenta.php",
            success: function(details) {
                $("#details").html(details);
            }
        })
    })

    // Boton Cambiar contraseña
    $(".boton-contrasena").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/cambiarContrasena.php",
            success: function(details) {
                $("#details").html(details);
            }
        })
    })
</script>