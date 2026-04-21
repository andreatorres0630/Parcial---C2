<?php
$host = "localhost";
$username = "root";
$pass = "";
$db = "bdwalmart";
$port = 3307;

$conexion = new mysqli($host,$username,$pass,$db,$port);

if ($conexion->connect_error) {
    die("Error de conexion". $conexion->connect_error);
}

?>