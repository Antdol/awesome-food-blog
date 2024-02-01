<?php
session_start();
require_once "connection.php";
include_once "./displayMsg.php";
if (!isset($_SESSION["loggedIn"])) {
    header("location: index.php");
    exit;
}

$selectQuery = "SELECT * FROM recipes WHERE user_id = :id";
$selectStatement = $mysqlClient->prepare($selectQuery);
$selectStatement->bindValue("id", $_SESSION["loggedIn"]["id"], PDO::PARAM_INT);
$selectStatement->execute();
$recipes = $selectStatement->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My recipes</title>
    <?php include_once "./style.php"; ?>
</head>

<body>
    <header>
        <?php include_once("./header.php"); ?>
    </header>
    <main>
        <a href="createRecipe.php">Post a new recipe</a>
        <div class="container">
            <h2><?php echo $_SESSION["loggedIn"]["name"] . "'s recipes" ?></h2>
            <?php if (isset($_SESSION["msg"])) : ?>
                <p class="feedback">
                    <?php echo $_SESSION["msg"]; ?>
                </p>
            <?php endif; ?>

            <?php if ($recipes) : ?>
                <?php foreach ($recipes as $recipe) : ?>
                    <article class="recipe">
                        <h3><?php echo $recipe["title"]; ?></h3>
                        <p><?php echo $recipe["content"]; ?></p>
                        <div class="controls">
                            <a href="<?php echo "updateRecipe.php?id=" . $recipe["recipe_id"]; ?>">Update</a>
                            <button type="button" class="del-btn" data-id="<?php echo $recipe["recipe_id"]; ?>">Delete</button>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <p>You currently don't have posted any recipe.</p>
            <?php endif; ?>
        </div>
        <div id="modal-container">
            <div id="modal-header">
                <img src="./assets/img/xmark-solid.svg" alt="Close Button" id="close-btn">
                <h2>Delete Form</h2>
            </div>
            <div id="modal-body">
                <form action="deleteRecipe.php" method="post">
                    <p>Are you sure you want to delete this recipe?</p>
                    <p>It cannot be undone.</p>
                    <input type="hidden" name="recipe_id" id="recipe_id">
                    <button type="submit" name="submit">Confirm Deletion</button>
                </form>
            </div>
        </div>
    </main>
    <script src="delete.js"></script>

</body>

</html>