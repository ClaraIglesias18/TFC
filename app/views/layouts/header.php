<!DOCTYPE html>
<html>

<head>
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="public/css/style.css">
    <style>

    </style>
</head>

<body>
    <header>
        <h1><img src="public/media/logoWT.png"></h1>
        <?php if (isset($_SESSION['idEmpleado'])) : ?>
            <div class="cerrarSesion">
                <a href="index.php?route=auth/logout" id="cerrar"><img src="public/media/cerrarSesion.png" alt="Cerrar sesion" class="cerrarSesionFoto"></a>
            </div>
        <?php endif; ?>
    </header>
    <main>
        <!-- Aquí coloca el contenido del cuerpo de la página -->
        <?php require_once 'app/views/layouts/menu.php'; ?>