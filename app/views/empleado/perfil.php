<?php
// Verificar si no está definida la sesión de usuario
/*if (!isset($_SESSION['idEmpleado'])) {
    header('Location: index.php?route=auth/login');
    exit();
}*/
$pageTitle = "Perfil";
require_once 'app/views/layouts/header.php'; ?>
<div class="pagina">
    <h1>Perfil</h1>
    <?php if (isset($errorMessage)) : ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <?php
    // Aquí debes recuperar los datos del usuario desde la base de datos
    // y mostrarlos en la página.
    // Supongamos que $userData es un arreglo con los datos del usuario.
    if (isset($userData)) {
        echo '<p>Nombre: ' . $userData->nombre . '</p>';
        echo '<p>Apellido: ' . $userData->apellidos . '</p>';
        echo '<p>Email: ' . $userData->email . '</p>';
        // ... otros campos del perfil ...
    }
    ?>



</div>
</main>

<?php require_once 'app/views/layouts/footer.php'; ?>