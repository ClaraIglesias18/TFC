<?php
define('DB_HOST', 'tfc');
define('DB_NAME', 'tfc');
define('DB_USER', 'tfc');
define('DB_PASS', 'abc123.');

try {
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    var_dump($db);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>