<?php
$host = "localhost";
$user = "root";       
$pass = "milox642";           
$db   = "tecno_high"; 

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Error de conexión con MySQL: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>