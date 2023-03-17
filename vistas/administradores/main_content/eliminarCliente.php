<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}

// Recuperamos las variables
$id_cliente = $_GET['id_cliente'];

echo $id_cliente;

?>

<div class="main__container--table title_table">

    <form class='formulario' action="../../funciones/admin__eliminarCliente.php" method="POST">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Eliminar Cliente</h1>
            <p>¿Realmente desea eliminar a este cliente?</p>
        </div>

        <table class="tableEliminarCliente table-8-col">

            <!-- Cabeceras de la tabla -->
            <tr>
                <td class="title">ID</td>
                <td class="title">Nombre</td>
                <td class="title">Email</td>
                <td class="title">Telefono</td>
                <td class="title">Alcaldía</td>
                <td class="title">Colonia</td>
                <td class="title">Giro</td>
                <td></td>
            </tr>

            <?php

            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Sentencia sql
            $sql = "SELECT * FROM clientes 
            JOIN alcaldias ON clientes.id_alcaldia1 = alcaldias.id_alcaldia 
            JOIN colonias ON clientes.id_colonia1 = colonias.id_colonia 
            JOIN giros ON clientes.id_giro1 = giros.id_giro
            WHERE id_cliente = " . $id_cliente;

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id_cliente'] . "</td>";
                echo "<td>" . $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['telefono'] . "</td>";
                echo "<td>" . $row['alcaldia'] . "</td>";
                echo "<td>" . $row['colonia'] . "</td>";
                echo "<td>" . $row['giro_comercial'] . "</td>";
                echo "<input class='hidden' name='id_cliente' value='" . $row['id_cliente'] . "'></input>";
                echo "<td><input type='submit' value='Eliminar' class='boton boton-eliminar'></td>";
                echo "</tr>";
            }

            ?>

        </table>

    </form>

</div>