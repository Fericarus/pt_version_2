<?php

// Reanudamos sesión en caso de que se haya iniciado antes
session_start();
// Si no hay nada en la variable de sesión usuario
if (!isset($_SESSION["email"]) || ($_SESSION["tipoUsuario"] != "cliente")) {
    header("location: ../../login.php");
}

?>

<div class="details" id="details">

    <div class="cliente_dashboard">

        <!-- Servicio Marketing Digital -->
        <div class="marketing_digital tarjeta_servicio" onclick="mensaje__marketing_digital()">
            <ul>
                <li>
                    <?php

                    // Incluimos la conexión a la base de datos
                    include "../../../includes/config/database.php";

                    // Sentencia sql
                    $sql = "SELECT * FROM servicios WHERE categorias = 'Marketing Digital'";

                    // Preparamos la sentencia
                    $stmt = $dbh->prepare($sql);

                    // Ejecutamos la sentencia
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<h3>" . $row['servicio'] . "</h3>";
                        echo "<p>" . $row['descripcion'] . "</p><br>";
                    }

                    ?>
                </li>
            </ul>
            <h2 class="tarjeta_servicio--title marketing_digital--title">Marketing Digital</h2>
        </div>

        <!-- Servicio Agencia Creativa -->
        <div class="agencia_creativa tarjeta_servicio" onclick="mensaje__agencia_creativa()">
            <ul>
                <li>
                    <?php

                    // Incluimos la conexión a la base de datos
                    include "../../../includes/config/database.php";

                    // Sentencia sql
                    $sql = "SELECT * FROM servicios WHERE categorias = 'Agencia Creativa'";

                    // Preparamos la sentencia
                    $stmt = $dbh->prepare($sql);

                    // Ejecutamos la sentencia
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<h3>" . $row['servicio'] . "</h3>";
                        echo "<p>" . $row['descripcion'] . "</p><br>";
                    }

                    ?>
                </li>
            </ul>
            <h2 class="tarjeta_servicio--title agencia_creativa--title">Agencia Creativa</h2>
        </div>

        <!-- Servicio Experiencia Web -->
        <div class="experiencia_web tarjeta_servicio" onclick="mensaje__experiencia_web()">
            <ul>
                <li>
                    <?php

                    // Incluimos la conexión a la base de datos
                    include "../../../includes/config/database.php";

                    // Sentencia sql
                    $sql = "SELECT * FROM servicios WHERE categorias = 'Experiencia Web'";

                    // Preparamos la sentencia
                    $stmt = $dbh->prepare($sql);

                    // Ejecutamos la sentencia
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<h3>" . $row['servicio'] . "</h3>";
                        echo "<p>" . $row['descripcion'] . "</p><br>";
                    }

                    ?>
                </li>
            </ul>
            <h2 class="tarjeta_servicio--title experiencia_web--title">Experiencia Web</h2>
        </div>

        <!-- Servicio Comunidad Kreativika -->
        <div class="comunidad_kreativika tarjeta_servicio" onclick="mensaje__comunidad_kreativika()">
            <ul>
                <li>
                    <h3>Solucionamos,compartimos,crecemos.</h3>
                    <p>Generamos una red de asesorescolaboradores en distintas áreas comoinformática, legal, seguridad, recursoshumanos, operación, ingeniería, arquitectura ysistemas de gestión empresarial.</p>
                </li>
                <li>
                    <?php

                    // Incluimos la conexión a la base de datos
                    include "../../../includes/config/database.php";

                    // Sentencia sql
                    $sql = "SELECT * FROM servicios WHERE categorias = 'Comunidad Kreativika'";

                    // Preparamos la sentencia
                    $stmt = $dbh->prepare($sql);

                    // Ejecutamos la sentencia
                    $stmt->execute();

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<h3>" . $row['servicio'] . "</h3>";
                        echo "<p>" . $row['descripcion'] . "</p><br>";
                    }

                    ?>
                </li>
            </ul>
            <h2 class="tarjeta_servicio--title comunidad_kreativika--title">Comunidad Kreativika</h2>
        </div>

    </div>

</div>

<script>
    function mensaje__marketing_digital() {
        alert("Se redirecciona a la pagina 'Marketing Digital'. Es a solicitud del cliente");
    }

    function mensaje__agencia_creativa() {
        alert("Se redirecciona a la pagina 'Agencia Creativa'. Es a solicitud del cliente");
    }

    function mensaje__experiencia_web() {
        alert("Se redirecciona a la pagina 'Experiencia Web'. Es a solicitud del cliente");
    }

    function mensaje__comunidad_kreativika() {
        alert("Se redirecciona a la pagina 'Comunidad Kreativika'. Es a solicitud del cliente");
    }
</script>