<?php
session_start();

unset($_SESSION['carrito']);

$_SESSION['mensaje'] = "Compra realizada con éxito";

header("Location: index.php");
exit();
?>