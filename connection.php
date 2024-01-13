<?php
// credentials for database connection
define("HOST", "localhost");
define("DB", "food-blog");
define("USER", "antoine");
define("PASSWORD", "");

// create DB connection
try {
    $mysqlClient = new PDO(
        "mysql:host=" . HOST . ";dbname=" . DB . ";charset=utf8",
        USER,
        PASSWORD
    );
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
