<?php
$pageTitle = "Fichaje";
require_once 'app/views/layouts/header.php'; ?>
<div class="pagina">
    <div class="fichaje">
        <h1>Fichaje</h1>

        <?php if (isset($errorMessage)) : ?>
            <p style="color: red;"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <form method="post" class="fichajeForm">
            <?php if ($puedeRegistrarEntrada) : ?>
                <input type="hidden" name="horaEntrada" value="<?php echo date('Y-m-d H:i'); ?>">
                <button type="submit" name="action" value="registrarEntrada" class="botonRegistroInicio">Registrar inicio</button>
                <button type="submit" disabled="action" value="registrarSalida" class="botonRegistroFin">Registrar fin</button>
            <?php endif; ?>

            <?php if ($puedeRegistrarSalida) : ?>
                <input type="hidden" name="horaSalida" value="<?php echo date('Y-m-d H:i'); ?>">
                <button type="submit" disabled name="action" value="registrarEntrada" class="botonRegistroInicio">Registrar inicio</button>
                <button type="submit" name="action" value="registrarSalida" class="botonRegistroFin">Registrar fin</button>

            <?php endif; ?>

            <?php if (!$puedeRegistrarSalida && !$puedeRegistrarEntrada) : ?>
                <p>Ya has registrado tu entrada y salida de hoy.</p>
            <?php endif; ?>
        </form>
        <table class="tablaFichajes">
            <caption>Últimos 7 fichajes</caption>
            <tr>
                <th>Fecha</th>
                <th>Hora de Entrada</th>
                <th>Hora de Salida</th>
                <th>Acciones</th>
            </tr>
            <?php
            foreach ($ultimosFichajes as $registro) {
                
                echo '<tr>';
                echo '<form method="post" action="index.php?route=empleado/editarFichaje">';
                echo '<input type="hidden" name="idFichaje" value="' . $registro['idFichaje'] . '">';
                echo '<input type="hidden" name="fecha" value="' . $registro['fecha'] . '">';
                echo '<td>' . $registro['fecha'] . '</td>';
                echo '<td><input type="time" name="horaEntrada" value="' . $registro['horaEntrada'] . '"></td>';
                echo '<td><input type="time" name="horaSalida" value="' . $registro['horaSalida'] . '"></td>';
                echo '<td><button type="submit" class="editar">Editar</button></form></td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>

</div>
</main>

<?php require_once 'app/views/layouts/footer.php'; ?>