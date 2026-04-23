<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_POST) {
    $producto = [
        "id" => $_POST['id'],
        "nombre" => $_POST['nombre'],
        "precio" => $_POST['precio'],
        "cantidad" => 1
    ];

    $_SESSION['carrito'][] = $producto;
}

header("Location: ver_carrito.php");
?>