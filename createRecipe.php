<?php
session_start();
require_once "/config/connection.php";
include_once("./displayMsg.php");

// Redirect if user not logged in
if (!isset($_SESSION["loggedIn"])) {
    header("location: index.php");
    exit;
}

// Check for form submission
if (isset($_POST["submitRecipe"])) {
    $data = [];

    // Sanitize data posted by user
    foreach ($_POST as $key => $value) {
        $data[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    // Check if both fields are not empty
    if (!empty($data["title"]) && !empty($data["content"])) {
        // Insert new recipe into db
        $insertQuery = "INSERT INTO recipes(title, content, user_id) 
                        VALUES(:title, :content, :user_id)";
        $insertStatement = $mysqlClient->prepare($insertQuery);
        $insertStatement->bindValue("title", $data["title"], PDO::PARAM_STR);
        $insertStatement->bindValue("content", $data["content"], PDO::PARAM_STR);
        $insertStatement->bindValue("user_id", $_SESSION["loggedIn"]["id"], PDO::PARAM_INT);
        $insertStatement->execute();

        header("location: myrecipes.php");
        exit;
    } else {
        $_SESSION["msg"] = "You must fill in both fiels";
        header("location: createRecipe.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a new recipe</title>
    <?php include_once("./style.php"); ?>
</head>

<body>
    <header>
        <?php include_once("./header.php"); ?>
    </header>
    <main>
        <div class="container">
            <p id="feedback">
                <?php
                if (isset($_SESSION["msg"])) {
                    echo $_SESSION["msg"];
                }
                ?>
            </p>
            <form action="createRecipe.php" method="post">
                <h2>Add a new recipe</h2>
                <label for="title">Name of the recipe</label>
                <input type="text" name="title" id="title" autofocus autocomplete="off">
                <label for="content">Ingredients and instructions</label>
                <textarea name="content" id="content" cols="50" rows="20"></textarea>
                <button type="submit" name="submitRecipe">Add recipe</button>
            </form>
        </div>
    </main>

</body>

</html>