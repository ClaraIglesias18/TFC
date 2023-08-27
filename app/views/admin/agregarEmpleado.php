<?php
$pageTitle = "Admin - Manage Employees";
require_once 'app/views/layouts/header.php';
?>
<div class="pagina">
    <h2>Creación de empleado</h2>
    <!-- Formulario para la creación de empleado -->
    <form method="post">
            <input type="hidden" name="action" value="create_employee">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" required><br>
            <label for="nombreUsuario">nombreUsuario</label>
            <input type="text" name="nombreUsuario" required><br>
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required><br>
            <label for="rol">Rol:</label>
            <select name="rol" required>
                <option value="0">Empleado</option>
                <option value="1">Administrador</option>
            </select><br>
            <button type="submit">Crear Empleado</button>
        </form>
</div>
</main>
<?php
require_once 'app/views/layouts/footer.php';
?>