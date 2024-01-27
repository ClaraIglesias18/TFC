<?php
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registro</title>
    <link rel="stylesheet" href="public/css/loginStyle.css">
    <link rel="icon" href="public/media/logoReducido.png" type="image/x-icon">
    <link rel="shortcut icon" href="public/media/logoReducido.png" type="image/x-icon">
</head>

<body class="login">
    <div id="contenedor">
        <div id="contenedorcentrado">
            <div id="login">
                <form id="registerform" method="post">
                    <label for="nombreUsuario">Nombre de usuario</label>
                    <input id="nombreUsuario" type="text" name="nombreUsuario" required>

                    <label for="nombre">Nombre</label>
                    <input id="nombre" type="text" name="nombre" required>

                    <label for="apellidos">Apellidos</label>
                    <input id="apellidos" type="text" name="apellidos" required>

                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required>

                    <label for="telefono">Teléfono</label>
                    <input id="telefono" type="number" name="telefono" required>

                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>

                    <button type="submit" title="Ingresar" name="Ingresar">Login</button>
                    <?php if (isset($errorMessage)) : ?>

                        <p><?php echo $errorMessage; ?></p>
                    <?php endif; ?>
                </form>
            </div>
            <div id="derecho">
                <div class="titulo">
                    <img src="public/media/logoWT.png">
                </div>
                <hr>
            </div>
        </div>

    </div>


</body>

</html>