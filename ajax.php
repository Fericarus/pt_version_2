<?php
// Incluimos la conexión a la base de datos
include "./includes/config/database.php";

if(isset($_POST['id_alcaldia1'])){
    $id_alcaldia1 = $_POST['id_alcaldia1'];

    // Sentencia sql
    $query = "SELECT * FROM colonias WHERE id_alcaldia2 = '" . $id_alcaldia1 . "'";

    // Preparamos la sentencia
    $stmt = $dbh->prepare($query);

    // Ejecutamos la sentencia
    $stmt->execute();

    // Llenamos el select con los resultados de la consulta
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<option value=" . $row['id_colonia'] . ">" . $row['colonia'] . "</option>";
    }
}
