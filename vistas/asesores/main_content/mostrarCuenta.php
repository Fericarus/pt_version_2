<?php
// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}
?>

<div class="main__container--table">

    <div class="formulario">

        <div class="main__container--title title_table">
            <h1>Mostrar cuenta</h1>
            <p>Datos del usuario</p>
        </div>


        <table>
            <thead>
                <tr>
                    <td class="title">Nombre</td>
                    <td class="title">Apellido paterno</td>
                    <td class="title">Apellido materno</td>
                    <td class="title">Email</td>
                    <td class="title">Teléfono</td>
                    <td class="title"></td>
                    <td class="title"></td>
                </tr>
            </thead>

            <tbody>
                <tr>

                    <?php
                    // Incluimos la conexión a la BD
                    include "../../../includes/config/database.php";

                    // Preparamos la sentencia
                    $stmt = $dbh->prepare('SELECT * FROM asesores WHERE id_asesor = ' . $_SESSION["id"]);

                    // Ejecutamos la sentencia
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['apellido_paternoA'] . "</td>";
                        echo "<td>" . $row['apellido_maternoA'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['telefono'] . "</td>";
                    }
                    ?>
                    <td><a href="javascript:void(0)" code-val="+val.codigo+" class="boton boton-editar">Editar</a></td>
                    <td><a href="javascript:void(0)" code-val="+val.codigo+" class="boton boton-contrasena">Cambiar contraseña</a></td>

                </tr>
            </tbody>

        </table>

    </div>

</div>

</div>

<script>
    // Boton para ir a Cambiar contraseña
    $(".boton-contrasena").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/cambiarContrasena.php",
            success: function(details) {
                $("#details").html(details);
            }
        })
    })

    // Boton para ir a Editar cuenta
    $(".boton-editar").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarCuenta.php",
            success: function(details) {
                $("#details").html(details);
            }
        })
    })
</script>