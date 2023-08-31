<?php
$pageTitle = "Perfil del Empleado";
require_once 'app/views/layouts/header.php'; ?>
<div class="pagina">
    <div class="employee-card">
        <div class="employee-image">
            <img src="public/media/fotoPerfil.png" alt="Foto del Empleado">
        </div>
        <div class="employee-details">
            <?php if (isset($errorMessage)) : ?>
                <p style="color: red;"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            <?php
            if (isset($userData)) {
                echo '<h2>' . $userData['nombre'] . ' ' . $userData['apellidos'] . '</h2>';
                echo '<p>Nombre de Usuario: ' . $userData['nombreUsuario'] . '</p>';
                echo '<p>Email: ' . $userData['email'] . '</p>';
                echo '<p>Teléfono: ' . $userData['telefono'] . '</p>';
                if ($userData['rol'] == 1)
                    echo '<p>Rol: Administrador</p>';
                else {
                    echo '<p>Rol: Empleado</p>';
                }
            }
            ?>
        </div>
    </div>
</div>
</main>

<?php require_once 'app/views/layouts/footer.php'; ?>