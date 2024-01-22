<?php
session_start();
require_once "/config/connection.php";
if (isset($_POST["recipe_id"])) {
    $data = [];
    foreach ($_POST as $key => $value) {
        $data[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    $deleteQuery = "DELETE FROM recipes WHERE recipe_id = :id";
    $deleteStatement = $mysqlClient->prepare($deleteQuery);
    $deleteStatement->bindValue("id", $data["recipe_id"], PDO::PARAM_INT);
    $deleteStatement->execute();

    $_SESSION["msg"] = "Recipe has been deleted successfully";
    header("location: myrecipes.php");
    exit;
} else {
    header("location: index.php");
    exit;
}
