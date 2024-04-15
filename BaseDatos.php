<?php

// Configuración de la conexión a la base de datos

$host = "127.0.0.1"; // 127.0.0.1
$basedatos = "web";
$username = "root";
$password = "123456";


    $conexion = new mysqli($host, $username, $password, $basedatos);
    // Check connection
    if ($conexion->connect_error) {
      die("Connection failed: " . $conexion->connect_error);
    }

?>
