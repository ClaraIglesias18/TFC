<div class="vertical-menu">
    <a href="index.php?route=empleado/timeclock">Timeclock</a>
    <a href="index.php?route=empleado/perfil">Perfil del Usuario</a>
    <?php if($_SESSION['rol'] == 1) : ?>
        <a href="index.php?route=administrador/manage">Administrador</a>
    <?php endif; ?>
    <!-- Agrega más enlaces aquí para otras páginas -->
</div>
