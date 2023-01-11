<?php

$dbname = "kreativika";
$user = "root";
$password = "1984Orwell*";
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
);

// Intenta la conexión a la BD
try {

    // Almacenamos el host y el nombre de la BD en la variable $dsn
    $dsn = "mysql:host=localhost;dbname=$dbname";

    // Instanciamos un objeto PDO con los parametros del constructor (host, nombre de BD, pass y opciones)
    $dbh = new PDO($dsn, $user, $password, $options);
}

// Si ocurre un error, captura el error en la variable $e
catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Finalmente vacia los recursos vaciados en la variable de conexión
/*finally {
    $dbh = null;
}
*/
?>