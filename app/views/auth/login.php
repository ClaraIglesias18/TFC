<?php
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="public/css/loginStyle.css">
    <link rel="icon" href="public/media/logoReducido.png" type="image/x-icon">
    <link rel="shortcut icon" href="public/media/logoReducido.png" type="image/x-icon">
</head>

<body class="login">
    <div id="contenedor">
        <div id="contenedorcentrado">
            <div id="login">
                <form id="loginform" method="post">
                <label for="username">Usuario</label>
                        <input id="usuario" type="text" name="username" required>
                        
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" name="password" required>
                        
                        <button type="submit" title="Ingresar" name="Ingresar">Login</button>
                    <?php if (isset($errorMessage)) : ?>
                        
                        <p><?php echo $errorMessage; ?></p>
                    <?php endif; ?>
                </form>
            </div>
            <div id="derecho">
                    <div class="titulo">
                    <img src="public/media/logoWT.png" >
                    </div>
                    <hr>
                </div>
        </div>

    </div>


</body>

</html>