<?php
$pageTitle = "Login";
require_once 'app/views/layouts/header.php';
?>
<h1>Login</h1>
    <?php if (isset($errorMessage)): ?>
        <p><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
<?php
require_once 'app/views/layouts/footer.php';
?>