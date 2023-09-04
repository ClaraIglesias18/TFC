<!DOCTYPE html>
<html>

<head>
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="icon" href="public/media/logoReducido.png" type="image/x-icon">
    <link rel="shortcut icon" href="public/media/logoReducido.png" type="image/x-icon">
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
        <?php require_once 'app/views/layouts/menu.php'; ?>