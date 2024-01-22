<?php
session_start();
require_once "/config/connection.php";

if (isset($_GET["id"])) {
    $selectQuery = "SELECT * FROM recipes WHERE recipe_id = :id";
    $selectStatement = $mysqlClient->prepare($selectQuery);
    $selectStatement->bindValue('id', $_GET["id"], PDO::PARAM_INT);
    $selectStatement->execute();
    $recipe = $selectStatement->fetch(PDO::FETCH_ASSOC);

    if (!$recipe || !isset($_SESSION["loggedIn"])) {
        header("location: index.php");
    }
}

if (isset($_POST["submit"])) {
    $data = [];
    foreach ($_POST as $key => $value) {
        $data[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    $updateQuery = "UPDATE recipes SET title = :title, content = :content WHERE recipe_id = :id";
    $updateStatement = $mysqlClient->prepare($updateQuery);
    $updateStatement->bindValue("title", $data["title"], PDO::PARAM_STR);
    $updateStatement->bindValue("content", $data["content"], PDO::PARAM_STR);
    $updateStatement->bindValue("id", $data["recipe_id"], PDO::PARAM_INT);
    $updateStatement->execute();
    header("location: myrecipes.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a recipe</title>
    <?php require_once "./style.php"; ?>
</head>

<body>
    <?php require_once "./header.php"; ?>
    <div class="container">
        <form action="updateRecipe.php" method="post">
            <input type="hidden" name="recipe_id" value="<?php echo $recipe["recipe_id"]; ?>">
            <label for="title">Name</label>
            <input type="text" name="title" id="title" value="<?php echo $recipe["title"]; ?>">
            <label for="content">Ingredients and instructions</label>
            <textarea name="content" id="contennt" cols="50" rows="20"><?php echo $recipe["content"]; ?></textarea>
            <button type="submit" name="submit">Update recipe</button>
        </form>
    </div>

</body>

</html>