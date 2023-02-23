<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "asesor")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table title_table">

    <form class="formulario" action="" method="GET">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Mostrar Clientes</h1>
        </div>

        <table class="table-7-col tableMostrarClientes">
            <tr>
                <td class="title">ID</td>
                <td class="title">Nombre</td>
                <td class="title">Email</td>
                <td class="title">Telefono</td>
                <td class="title">Alcaldía</td>
                <td class="title">Colonia</td>
                <td class="title">Giro</td>
            </tr>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Esta variables indica cuantos registros veremos por página
            $tamano_paginas = 6;

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

    <!-- <button id="load-more-button" onclick="loadData()">Mostrar más</button> -->

</div>



<script>
    // Botón Editar
    function mostrar($i) {
        let pagina = document.getElementById('pagina');
        let page = document.getElementById('page' + $i);

        console.log(page.name);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/mostrarClientes.php?pagina=" + page.name,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    // function loadData(page) {
    //     $.ajax({
    //         url: "mostrarCliente.php?pagina=" + page,
    //         type: "GET",
    //         dataType: "json",
    //         data: {
    //             page: page
    //         },
    //         success: function(data) {
    //             if (data.rows.length > 0) {
    //                 var html = "";
    //                 $.each(data.rows, function(index, row) {
    //                     html += "<div>" + row.name + "</div>";
    //                 });
    //                 $("#details").html(html);
    //             } else {
    //                 $("#details").html("No hay resultados.");
    //             }
    //             // Agrega los botones de paginación
    //             var pagination = "";
    //             if (data.previous_page !== null) {
    //                 pagination += "<button onclick='loadData(" + data.previous_page + ")'>Anterior</button>";
    //             }
    //             if (data.next_page !== null) {
    //                 pagination += "<button onclick='loadData(" + data.next_page + ")'>Siguiente</button>";
    //             }
    //             $("#pagination").html(pagination);
    //         },
    //         error: function(xhr, status, error) {
    //             console.error(xhr.responseText);
    //             $("#details").html("Error al cargar los datos.");
    //         }
    //     });
    // }












    /*
    // Botón Eliminar
    function eliminar($i) {
        let id_cita = document.getElementById('id_cita' + $i);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/eliminarCita.php?id_cita=" + id_cita.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
        
    }

    //let id_asesorEducacion = document.getElementById('id_asesorEducacion');
    //let id_educacion = document.getElementById('id_educacion');

    //console.log(id_asesorEducacion.value);
    //console.log(id_educacion.value);

    // Boton Editar
    
    $(".boton-editar").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarEducacion.php?id_asesorEducacion=" + id_asesorEducacion.value + "&id_educacion=" + id_educacion.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    })
    

    // Boton Eliminar
    $(".boton-eliminar").click(function() {
        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/eliminarEducacion.php?id_asesorEducacion=" + id_educacion.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    })
    */
</script>