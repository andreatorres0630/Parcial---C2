<?php
include 'conexion.php';
session_start();


if (!isset($_SESSION['usuario_logueado'])) {
    die("No tienes permiso para realizar esta acción.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $precio = floatval($_POST['precio']);
    $categoria = mysqli_real_escape_string($conexion, $_POST['categoria']);
    $disponible = intval($_POST['disponible']);

    if (!empty($nombre) && $precio > 0) {
        $sql = "INSERT INTO productos (nombre, precio, categoria, disponible) 
                VALUES ('$nombre', $precio, '$categoria', $disponible)";
        
        if ($conexion->query($sql)) {
            header("Location: index.php"); 
        } else {
            echo "Error al insertar: " . $conexion->error;
        }
    } else {
        echo "Validación fallida: Verifique que el precio sea mayor a 0.";
    }
}
?>