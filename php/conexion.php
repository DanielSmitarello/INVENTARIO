<?php
// Conexión a la BD inventario...

function conexion()
{
    $pdo = new PDO('mysql:host=localhost;dbname=inventario', 'root', '');
    return $pdo;
}

?>