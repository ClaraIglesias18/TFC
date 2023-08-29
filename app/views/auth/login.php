<?php
/*if ($_SESSION['idEmpleado']) {
    header('Location: index.php?route=empleado/timeclock');
}*/
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="public/css/loginStyle.css">
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
                    <!--<div class="pie-form">
                        <a href="#">¿Perdiste tu contraseña?</a>
                        <a href="#">¿No tienes Cuenta? Registrate</a>
                        <hr id="hrLogin">
                        <a href="#">« Volver</a>
                    </div>-->
                </div>
        </div>

    </div>


</body>

</html>