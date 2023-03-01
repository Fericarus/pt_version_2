<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}

?>

<div class="main__container--table title_table">

    <form class="formulario" action="../../funciones/agregarCertificacion.php" method="GET">

        <!-- Título del formulario -->
        <div class="main__container--title">
            <h1>Mis citas programadas</h1>
            <p>Citas agendadas</p>
        </div>

        <table class="table-5-col">
            <tr>
                <td class="title">Asesor</td>
                <td class="title">Fecha de la cita</td>
                <td class="title">Hora</td>
                <td class="title"></td>
                <td class="title"></td>
            </tr>

            <?php
            // Incluimos la conexión a la base de datos
            include "../../../includes/config/database.php";

            // Esta variables indica cuantos registros veremos por página
            $tamano_paginas = 6;

            // Este bloque de código solo se ejecutará si se le ha dado click a la paginación
            if (isset($_GET['pagina'])) {
                if ($_GET["pagina"] == 0) {
                    header("Location:main_content/mostrarAsesores.php");
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
            $sql = "SELECT * FROM citas 
            INNER JOIN asesores ON asesores.id_asesor = citas.id_asesor1 
            WHERE id_cliente1 = " . $_SESSION["id"];

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

            ////////////////////////////////////////////////////////////////////////////////////////////

            // Sentencia sql
            $sql = "SELECT * FROM citas 
            INNER JOIN asesores ON asesores.id_asesor = citas.id_asesor1 
            WHERE id_cliente1 = " . $_SESSION["id"] . 
            " LIMIT $empezar_desde, $tamano_paginas";

            // Preparamos la sentencia
            $stmt = $dbh->prepare($sql);

            // Ejecutamos la sentencia
            $stmt->execute();

            $n = 1;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['nombre'] . " " . $row['apellido_paternoA'] . " " . $row['apellido_maternoA'] . "</td>";
                echo "<td>" . $row['fecha'] . "</td>";
                echo "<td>" . $row['hora'] . "</td>";
                echo "<td><a onclick='editar(" . $n . ")' class='boton boton-editar' href='javascript:void(0)' code-val='+val.codigo+''>Editar</a></td>";
                echo "<td><a onclick='eliminar(" . $n . ")'class='boton boton-eliminar' href='javascript:void(0)' code-val='+val.codigo+''>Eliminar</a></td>";
                echo "<input class='hidden' id='id_cita" . $n . "' value='" . $row['id_cita'] . "'></input>";
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

        console.log(page.name);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/mostrarCita.php?pagina=" + page.name,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

    // Botón Editar
    function editar($i) {
        let id_cita = document.getElementById('id_cita' + $i);

        var dato = $(this).attr("code-val");
        $.ajax({
            url: "main_content/editarCita.php?id_cita=" + id_cita.value,
            success: function(details) {
                $("#details").html(details);
            }
        })
    }

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


    // Obtenemos la fecha actual con el objeto Date
    var fechaActual = new Date();

    var tds = document.getElementsByTagName("td");
    var trs = document.getElementsByTagName("tr");

    var msjError = document.getElementById("msjError");

    // Aquí recorremos el arreglo de elementos <td> que son (5 * n) registros en la tabla
    for (var i = 0; i < tds.length; i++) {

        // Con textContent obtengo el texto que se encuentra dentro de la eiqueta <td> y creamos un objeto del tipo Date
        var fechaCelda = new Date(tds[i].textContent);

        if (fechaCelda < fechaActual) {
            tds[i].style.color = "red";
        }
    }
</script>