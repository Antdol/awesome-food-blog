<?php
session_start();
require_once "./connection.php";
if (!isset($_SESSION["loggedIn"]))
{
    header("location: index.php");
    exit;
}

$selectQuery = "SELECT * FROM recipes";
$selectStatement = $mysqlClient->prepare($selectQuery);
$selectStatement->execute();
$recipes = $selectStatement->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All recipes</title>
    <?php include_once "./style.php"; ?>
</head>

<body>
    <header>
        <?php include_once "./header.php"; ?>
    </header>
    <main>
        <div class="container">
            <h2>Browse recipes</h2>
            <?php if ($recipes) : ?>
                <?php foreach ($recipes as $recipe) : ?>
                    <article class="recipe">
                        <h3><?php echo $recipe["title"]; ?></h3>
                        <p><?php echo $recipe["content"]; ?></p>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <p>There currently is not any recipe in the database.</p>
            <?php endif; ?>
        </div>
    </main>

</body>

</html>