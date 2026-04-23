<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito</title>
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

    <h2 class="text-center mb-4">Mi Carrito</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <?php if (empty($carrito)): ?>
                <div class="alert alert-warning text-center">
                    Tu carrito está vacío 
                </div>
            <?php else: ?>

            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($carrito as $item): 
                    $total += $item['precio'];
                ?>
                    <tr>
                        <td><?php echo $item['nombre']; ?></td>
                        <td>$<?php echo number_format($item['precio'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <h4>Total: <span class="text-success">$<?php echo number_format($total,2); ?></span></h4>

                <div>
                    <a href="index.php" class="btn btn-secondary">Seguir comprando</a>
                    <a href="comprar.php" class="btn btn-success">Finalizar compra</a>
                </div>
            </div>

            <?php endif; ?>

        </div>
    </div>

</div>

</body>
</html>