<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Vista de Login</h1>
    <p><?php $this->showMessages(); ?></p>
    <div id="login-main">
        <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST">
            <div><?php (isset($this->errorMessage)) ?  $this->errorMessage : '' ?></div>
            <h2>Iniciar sesión</h2>
            <p>
                <label for="correo">Correo</label>
                <input type="text" name="correo" id="correo">
            </p>
            <p>
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">
            </p>
            <p>
                <input type="submit" value="Iniciar sesión" />
            </p>
        </form>
    </div>
</body>
</html>