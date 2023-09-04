<div class="vertical-menu">
    <div class="fila">
        <img src="public/media/reloj.png" class="reloj" alt="registro horario">
        <a href="index.php?route=empleado/fichaje">Fichaje</a>
    </div>
    <div class="fila">
        <img src="public/media/iconoPerfil.png" class="iconoPerfil" alt="perfil">
        <a href="index.php?route=empleado/perfil">Perfil del empleado</a>
    </div>
    <?php if ($_SESSION['rol'] == 1) : ?>
        <div class="fila">
            <img src="public/media/candado.png" class="candado" alt="administrador">
            <a href="index.php?route=administrador/administrar">Administrador</a>
        </div>
    <?php endif; ?>
</div>