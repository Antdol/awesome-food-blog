<?php
session_start();
require_once "/config/connection.php";

$selectQuery = "SELECT * FROM recipes WHERE featured = true";
$selectStatement = $mysqlClient->query($selectQuery);
$featuredRecipe = $selectStatement->fetch(PDO::FETCH_ASSOC);

$date = new DateTime();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awesome Food Blog - Home</title>
    <?php include_once("./style.php"); ?>
</head>

<body>
    <header>
        <?php include_once("./header.php"); ?>
    </header>
    <main>
        <div class="container">
            <?php if (!isset($_SESSION["loggedIn"])) : ?>
                <h2>Welcome to our awesome blog!</h2>
                <p><a href="login.php">Login</a> to be able to see the recipes.</p>
                <p>Not registered yet? Register <a href="register.php">here</a>.</p>
            <?php else : ?>
                <h2>Welcome <?php echo $_SESSION["loggedIn"]["name"]; ?>!</h2>
                <p>Today is <?php echo $date->format("l j F Y"); ?>. The recipe of the day is:</p>
                <article class="recipe">
                    <h3><?php echo $featuredRecipe["title"]; ?></h3>
                    <p><?php echo $featuredRecipe["content"]; ?></p>
                </article>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>