<?php
session_start();
include 'conexion.php';


if (isset($_POST['login'])) {
    $user = $_POST['usuario'];
    $pass = $_POST['clave'];
    
    $query = "SELECT * FROM usuarios WHERE usuario = '$user' AND clave = '$pass' AND rol = 'Administrador'";
    $resultado = $conexion->query($query);

    if ($resultado->num_rows > 0) {
        $_SESSION['usuario_logueado'] = $user;
    } else {
        echo "<script>alert('Acceso denegado: Solo administradores registrados');</script>";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

?>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success text-center">
        <?php 
            echo $_SESSION['mensaje']; 
            unset($_SESSION['mensaje']); 
        ?>
    </div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Walmart SV - Tienda en línea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        background-color: #f8f9fa;
    }

    .navbar-custom {
        background-color: #0055BB;
    }

    .logo {
        height: 40px;
    }
    </style>

</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-custom px-4">
    <div class="container-fluid">

       
        <a class="navbar-brand d-flex align-items-center text-white" href="#">
            <img src="Walmart1.png" class="logo me-2">
        </a>

    </div>
</nav>

<div class="container py-5">
    <h1 class="text-center text-primary mb-4">Walmart El Salvador - Tienda en Línea</h1>

    <?php if (!isset($_SESSION['usuario_logueado'])): ?>
        <div class="card mx-auto shadow-sm" style="max-width: 400px;">
            <div class="card-body">
                <h4 class="card-title">Login</h4>
                <form method="POST">
                    <input type="text" name="usuario" class="form-control mb-2" placeholder="Usuario" required>
                    <input type="password" name="clave" class="form-control mb-2" placeholder="Contraseña" required>
                    <button type="submit" name="login" class="btn btn-primary w-100">Ingresar</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-success d-flex justify-content-between align-items-center">
            <span>Bienvenido/a, <strong><?php echo $_SESSION['usuario_logueado']; ?></strong></span>
            <a href="?logout=true" class="btn btn-sm btn-danger">Cerrar Sesión</a>
        </div>

        <div class="card mb-5 shadow-sm">
            <div class="card-header bg-dark text-white">Registrar Producto Nuevo</div>
            <form action="procesar.php" method="POST" class="card-body row g-3">
                <div class="col-md-4">
                    <label class="form-label">Nombre del Producto:</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Precio ($):</label>
                    <input type="number" step="0.01" name="precio" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Categoría:</label>
                    <select name="categoria" class="form-select" required>
                        <option value="Electrónica">Electrónica</option>
                        <option value="Abarrotes">Abarrotes</option>
                        <option value="Hogar">Hogar</option>
                        <option value="Cuidado Personal">Cuidado Personal</option>
                    </select>
                </div>
                <div class="col-md-2 text-center">
                    <label class="form-label d-block">Disponible:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="disponible" value="1" checked> Sí
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="disponible" value="0"> No
                    </div>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success px-4">Guardar en Base de Datos</button>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <h3 class="mb-3">Catálogo General</h3>
    <div class="table-responsive bg-white p-3 shadow-sm rounded">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT * FROM productos ORDER BY nombre ASC";
                $res = $conexion->query($sql);
                while ($p = $res->fetch_assoc()):
                ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo $p['nombre']; ?></td>
                    <td>$<?php echo number_format($p['precio'], 2); ?></td>
                    <td><?php echo $p['categoria']; ?></td>
                    <td>
                        <?php echo $p['disponible'] ? '<span class="badge bg-success">En Stock</span>' : '<span class="badge bg-secondary">Agotado</span>'; ?>
                    </td>
                    <td>
                        <?php if ($p['disponible']): ?>
                            <form action="carrito.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                                <input type="hidden" name="nombre" value="<?php echo $p['nombre']; ?>">
                                <input type="hidden" name="precio" value="<?php echo $p['precio']; ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                            </form>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Agotado</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>