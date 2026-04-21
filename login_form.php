<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['user'];
    $c = $_POST['pass'];

    $res = $conexion->query("SELECT * FROM usuarios WHERE usuario='$u' AND clave='$c'");
    if ($f = $res->fetch_assoc()) {
        $_SESSION['usuario'] = $f['usuario'];
        header("Location: index.php");
    } else {
        echo "Acceso incorrecto";
    }
}
?>
<form method="POST">
    <input type="text" name="user" placeholder="Usuario admin" required>
    <input type="password" name="pass" placeholder="Clave" required>
    <button type="submit">Entrar</button>
</form>