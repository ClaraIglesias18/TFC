<?php
// Verificar si no está definida la sesión de usuario
/*if (!isset($_SESSION['idEmpleado'])) {
    header('Location: index.php?route=auth/login');
    exit();
}*/
$pageTitle = "Fichaje";
require_once 'app/views/layouts/header.php'; ?>
<div class="pagina">
    <h1>Timeclock</h1>

    <?php if (isset($errorMessage)) : ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

    <form method="post">
        <?php if ($canRegisterEntryTime) : ?>
            <input type="hidden" name="horaEntrada" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <button type="submit" name="action" value="register_entry">Clock In</button>
            <button type="submit" disabled="action" value="register_exit">Clock Out</button>
        <?php endif; ?>

        <?php if ($canRegisterExitTime) : ?>
            <input type="hidden" name="horaSalida" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <button type="submit" disabled name="action" value="register_entry">Clock In</button>
            <button type="submit" name="action" value="register_exit">Clock Out</button>

        <?php endif; ?>
    </form>
    <table>
            <caption>Últimos fichajes</caption>
            <tr>
                <th>Fecha</th>
                <th>Hora de Entrada</th>
                <th>Hora de Salida</th>
            </tr>
            <?php
            // Iterar a través de los últimos registros de tiempo
            foreach ($ultimosFichajes as $registro) {
                echo '<tr>';
                echo '<td>' . $registro['fecha'] . '</td>';
                echo '<td>' . $registro['horaEntrada'] . '</td>';
                echo '<td>' . $registro['horaSalida'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
</div>
</main>

<?php require_once 'app/views/layouts/footer.php'; ?>