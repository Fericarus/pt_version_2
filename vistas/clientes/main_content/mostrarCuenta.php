<?php
// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}
?>

<div class="main__container--table">

    <div class="formulario">

        <!-- Titulo -->
        <div class="main__container--title title_table">
            <h1>Mostrar cuenta</h1>
            <p>Datos del usuario</p>
        </div>

        <table class="mostrar_cuenta">

            <tr>

                <?php
                // Incluimos la conexión a la BD
                include "../../../includes/config/database.php";

                // Preparamos la sentencia
                $stmt = $dbh->prepare('SELECT * FROM clientes WHERE id_cliente = ' . $_SESSION["id"]);

                // Ejecutamos la sentencia
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<td>Nombre:<strong>" . $row['nombre'] . "</strong></td>";
                    echo "<td>Apellido paterno: <strong>" . $row['apellido_paterno'] . "</strong></td>";
                    echo "<td>Apellido paterno: <strong>" . $row['apellido_materno'] . "</strong></td>";
                    echo "<td>Correo electrónico: <strong>" . $row['email'] . "</strong></td>";
                    echo "<td>Teléfono: <strong>" . $row['telefono'] . "</strong></td>";
                }

                ?>

                <td>
                    <a href='javascript:void(0)' code-val='+val.codigo+' class='boton boton-editar'>Editar</a>
                    <a href='javascript:void(0)' code-val='+val.codigo+' class='boton boton-contrasena'>Cambiar contraseña</a>
                </td>

            </tr>

        </table>

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