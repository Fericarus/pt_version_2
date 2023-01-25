<?php

    session_start();

    session_destroy();

    echo '<script>alert("Sesión cerrada correctamente")</script>';
    echo '<script type="text/javascript" >window.location.href="../../login.php";</script>';

?>