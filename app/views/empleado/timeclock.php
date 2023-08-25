<?php $pageTitle = "Login";
require_once 'app/views/layouts/header.php'; ?>


<h1>Timeclock</h1>

<?php if (isset($errorMessage)) : ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
<?php endif; ?>

<form method="post">
    <?php if ($canRegisterEntryTime) : ?>
        <input type="hidden" name="horaEntrada" value="<?php echo date('Y-m-d H:i:s'); ?>">
        <button type="submit" name="action" value="register_entry">Clock In</button>
        <button type="submit" disabled ="action" value="register_exit">Clock Out</button>
    <?php endif; ?>

    <?php if ($canRegisterExitTime) : ?>
        <input type="hidden" name="horaSalida" value="<?php echo date('Y-m-d H:i:s'); ?>">
        <button type="submit" disabled name="action" value="register_entry">Clock In</button>
        <button type="submit" name="action" value="register_exit">Clock Out</button>

    <?php endif; ?>
</form>


<?php require_once 'app/views/layouts/footer.php'; ?>