<?php
// credentials for database connection
$driver = "mysql";
$config = http_build_query(data: [
    "host" => "localhost",
    "port" => 3306,
    "dbname" => "food-blog"
], arg_separator: ";");

$dsn = "{$driver}:{$config}";
$username = "antoine";
$password = "";


// create DB connection
try {
    $mysqlClient = new PDO($dsn, $username, $password);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
