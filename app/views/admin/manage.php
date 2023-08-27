<?php
$pageTitle = "Admin - Manage Employees";
require_once 'app/views/layouts/header.php';
?>
<div class="pagina">
    <h2>Administrar Empleados</h2>

    <!-- Tabla de empleados -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Admin</th>
            <th>Acciones</th>
        </tr>
        <?php
        // Aquí debes obtener la lista de empleados desde la base de datos
        // y mostrarlos en la tabla.
        // Supongamos que $employeeList es una lista de empleados.
        $admin = 'checked';
        foreach ($empleados as $empleado) {
            if ($empleado->rol == 1) {
                $admin = 'checked';
            } else {
                $admin = '';
            }
            echo '<tr>';
            echo '<form method="post" action="index.php?route=administrador/editar">';
            echo '<input type="hidden" name="idEmpleado" value="' . $empleado->idEmpleado . '">';
            echo '<td>' . $empleado->idEmpleado . '</td>';
            echo '<td><input type="text" name="nombre" value="' . $empleado->nombre . '"></td>';
            echo '<td><input type="text" name="apellidos" value="' . $empleado->apellidos . '"></td>';
            echo '<td><input type="text" name="email" value="' . $empleado->email . '"></td>';
            echo '<td><input type="checkbox" name="rol" value="admin"' . $admin . '></td>';
            echo '<td>';
            echo '<button type="submit">Guardar</button></form>
            <form method="post" action="index.php?route=administrador/eliminar">
            <input type="hidden" name="idEmpleado" value="' . $empleado->idEmpleado . '">        
            <button type="submit">Eliminar</button>
            </form>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>

    <a href="index.php?route=administrador/crear">Agregar Empleado</a>
</div>
</main>
<?php
require_once 'app/views/layouts/footer.php';
?>