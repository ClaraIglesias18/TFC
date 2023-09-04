<?php
$pageTitle = "Administrar Empleados";
require_once 'app/views/layouts/header.php';
?>
<div class="pagina">
    <h2>Administrar Empleados</h2>

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
        $admin = 'checked';
        foreach ($empleados as $empleado) {
            if ($empleado['rol'] == 1) {
                $admin = 'checked';
            } else {
                $admin = '';
            }
            echo '<tr>';
            echo '<form method="post" action="index.php?route=administrador/editar">';
            echo '<input type="hidden" name="idEmpleado" value="' . $empleado['idEmpleado'] . '">';
            echo '<td>' . $empleado['idEmpleado'] . '</td>';
            echo '<td><input type="text" name="nombre" value="' . $empleado['nombre'] . '"></td>';
            echo '<td><input type="text" name="apellidos" value="' . $empleado['apellidos'] . '"></td>';
            echo '<td><input type="text" name="email" value="' . $empleado['email'] . '"></td>';
            echo '<td><input type="checkbox" name="rol" value="admin"' . $admin . '></td>';
            echo '<td>';
            echo '<button type="submit" class="guardar">Guardar</button></form>
            <form method="post" action="index.php?route=administrador/eliminar">
            <input type="hidden" name="idEmpleado" value="' . $empleado['idEmpleado'] . '">        
            <button type="submit" class="eliminar">Eliminar</button>
            </form>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>

    <button ><a href="index.php?route=administrador/crear" class="agregarEmpleado">Agregar Empleado</a></button>
</div>
</main>
<?php
require_once 'app/views/layouts/footer.php';
?>