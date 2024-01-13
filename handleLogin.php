<?php
session_start();
include_once("connection.php");

// Check for form submission
if (isset($_POST["login"]))
{
    $data = [];
    // clean data
    foreach ($_POST as $key => $value)
    {
        $data[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    // Check if user is in db
    $selectQuery = "SELECT * FROM users WHERE email = :email AND password = :password";
    $selectStatement = $mysqlClient->prepare($selectQuery);
    $selectStatement->execute([
        "email" => $data["email"],
        "password" => hash("sha256", $data["password"])
    ]);
    $user = $selectStatement->fetch(PDO::FETCH_ASSOC);

    if ($user)
    {
        $_SESSION["loggedIn"] = ["id" => $user["id"], "name" => $user["name"]];
        header("location: index.php");
        exit;
    }
    else
    {
        $_SESSION["msg"] = "Wrong email or password";
        header("location: login.php");
    }
}
else
{
    header("location: login.php");
}
