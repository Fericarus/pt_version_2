<html lang="es">

<header>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</header>


<?php

function mensajeGoodJob($mensaje, $href)
{
    echo
    "
        <script>
        Swal.fire({
            icon: 'success',
            title: '" . $mensaje . "'
            }).then(function() {
            window.location.href = '" . $href . "';
        });
        </script>
    ";

}

function mensajeError($mensaje, $href)
{
    echo
    "
        <script>
        Swal.fire({
            icon: 'error',
            title: '" . $mensaje . "'
            }).then(function() {
            window.location = '" . $href . "';
        });
        </script>
    ";
}

function salir($href) {
    echo 
    "
        <script>
            window.location = '" . $href . "'
        </script>
    ";
}



?>