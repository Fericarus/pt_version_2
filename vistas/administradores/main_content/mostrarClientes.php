<?php
session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "administrador")) {
    header("location: ../../login.php");
}
?>
<div class="main__container--table title_table">

    <form class="formulario" action="" method="GET">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Mostrar Clientes</h1>
        </div>

        <table class="table-9-col tableMostrarClientesAdmin">
            <tr>
                <td class="title">ID</td>
                <td class="title">Nombre</td>
                <td class="title">Email</td>
                <td class="title">Telefono</td>
                <td class="title">Alcaldía</td>
                <td class="title">Colonia</td>
                <td class="title">Giro</td>
                <td></td>
                <td></td>
            </tr>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Esta variables indica cuantos registros veremos por página
            $tamano_paginas = 5;

            // Este bloque de código solo se ejecutará si se le ha dado click a la paginación
            if (isset($_GET['pagina'])) {
                if ($_GET["pagina"] == 0) {
                    header("Location:main_content/mostrarCliente.php");
                } else {
                    $pagina = $_GET['pagina'];
                }
            } else {
                // Esta variable indica la página que se carga al inicio
                $pagina = 1;
            }

            echo "<input id='pagina' class='hidden' value='$pagina'></input>";

            // Almacenamos en esta variable desde que página queremos que cargué la páginación
            $empezar_desde = ($pagina - 1) * $tamano_paginas;

            // Sentencia sql
            $sql = "SELECT * FROM clientes 
            JOIN alcaldias ON clientes.id_alcaldia1 = alcaldias.id_alcaldia 
            JOIN colonias ON clientes.id_colonia1 = colonias.id_colonia 
            JOIN giros ON clientes.id_giro1 = giros.id_giro
            ORDER BY id_cliente 
            ";

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            // Este método nos devuelve el número de registros de la consulta
            $num_filas = $stmt->rowCount();

            // Dividimos el total de registros de la consulta entre el numero de paginas y lo redondeamos con el método ceil
            $total_paginas = ceil($num_filas / $tamano_paginas);

            // Mostramos cuantos resultados se encontraron en la consulta
            echo "<div>";
            echo "<p>Se encontraron " . $num_filas . " resultados</p>";
            echo "</div>";

            $stmt->closeCursor();

            $sql_limite = "SELECT * FROM clientes 
            JOIN alcaldias ON clientes.id_alcaldia1 = alcaldias.id_alcaldia 
            JOIN colonias ON clientes.id_colonia1 = colonias.id_colonia 
            JOIN giros ON clientes.id_giro1 = giros.id_giro
            ORDER BY id_cliente 
            LIMIT $empezar_desde, $tamano_paginas";

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql_limite);

            // Ejecutamos la sentencia
            $stmt->execute();

            $n = 1;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id_cliente'] . "</td>";
                echo "<td>" . $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['telefono'] . "</td>";
                echo "<td>" . $row['alcaldia'] . "</td>";
                echo "<td>" . $row['colonia'] . "</td>";
                echo "<td>" . $row['giro_comercial'] . "</td>";
                echo "<input class='hidden' id='id_cliente" . $n . "' value='" . $row['id_cliente'] . "'></input>";
                echo "<td><a onclick='editar(" . $n . ")' class='boton boton-editar' href='javascript:void(0)' code-val='+val.codigo+''>Editar</a></td>";
                echo "<td><a onclick='eliminar(" . $n . ")'class='boton boton-eliminar' href='javascript:void(0)' code-val='+val.codigo+''>Eliminar</a></td>";
                echo "</tr>";
                $n++;
            }

            ?>

        </table>

        <?php

        // Mostramos la página en la que nos encontramos y el número total de páginas
        echo "<div>";
        echo "<p>Página " . $pagina . " de " . $total_paginas . "</p>";
        echo "</div>";

        // ------------------------------------------------ Paginación -------------------------------------------------------
        echo "<div class='paginacion'>";
        for ($i = 1; $i <= $total_paginas; $i++) {
            // href='javascript:void(0)' code-val='+val.codigo+'
            echo " <a id='page" . $i . "' name='" . $i . "' onclick='mostrar(" . $i . ")' href='javascript:void(0)' code-val='+val.codigo+'>$i</a> ";
            // echo " <a href='?pagina=" . $i . "'> " . $i . " </a> ";
        }
        echo "</div>";

        ?>

    </form>

</div>

<script>
    // Paginación
    function mostrar($i) {
        let pagina = document.getElementById('pagina');
        let page = document.getElementById('page' + $i);

        // console.log(page.name);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/mostrarClientes.php?pagina=" + page.name,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    // Botón Editar
    function editar($i) {
        let id_cliente = document.getElementById('id_cliente' + $i);
        console.log(id_cliente.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarCliente.php?id_cliente=" + id_cliente.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    // Botón Eliminar
    function eliminar($i) {
        let id_cliente = document.getElementById('id_cliente' + $i);
        console.log(id_cliente.value);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/eliminarCliente.php?id_cliente=" + id_cliente.value,
            success: function(details) {
                $("#details").html(details);
            }
        })

    }
</script>