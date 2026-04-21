<?php
session_start();
include 'conexion.php';

if ($_POST) {
    $user = $_POST['usuario'];
    $pass = $_POST['clave'];

    $sql = "SELECT * FROM usuarios WHERE usuario='$user' AND clave='$pass'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $_SESSION['usuario'] = $user;
        header("Location: dashboard.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<form method="POST">
    Usuario: <input type="text" name="usuario" required><br>
    Clave: <input type="password" name="clave" required><br>
    <button type="submit">Ingresar</button>
</form>