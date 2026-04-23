<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_logueado'])) {
    die("No autorizado");
}

$nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
$precio = floatval($_POST['precio']);
$categoria = mysqli_real_escape_string($conexion,$_POST['categoria']);
$disponible = intval($_POST['disponible']);

if(empty($nombre) || $precio <= 0){
    die("Datos inválidos");
}

$sql = "INSERT INTO productos(nombre,precio,categoria,disponible)
VALUES('$nombre',$precio,'$categoria',$disponible)";

$conexion->query($sql);

header("Location:index.php");
?>