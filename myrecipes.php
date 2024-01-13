<?php
session_start();
include_once("./connection.php");
if (!isset($_SESSION["loggedIn"]))
{
    header("location: index.php");
    exit;
}

$selectQuery = "SELECT * FROM recipes WHERE user_id = :id";
$selectStatement = $mysqlClient->prepare($selectQuery);
$selectStatement->execute(["id" => $_SESSION["loggedIn"]["id"]]);
$recipes = $selectStatement->fetchAll();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My recipes</title>
    <?php include_once("./style.php"); ?>
</head>

<body>
    <header>
        <?php include_once("./header.php"); ?>
    </header>
    <main>
        <a href="createRecipe.php">Post a new recipe</a>
        <div class="container">
            <h2><?php echo $_SESSION["loggedIn"]["name"] . "'s recipes" ?></h2>

            <?php if ($recipes) : ?>
                <?php foreach ($recipes as $recipe) : ?>
                    <article class="recipe">
                        <h3><?php echo $recipe["title"]; ?></h3>
                        <p><?php echo $recipe["content"]; ?></p>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <p>You currently don't have posted any recipe.</p>
            <?php endif; ?>
        </div>
    </main>

</body>

</html>