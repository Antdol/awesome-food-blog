<?php
session_start();
// Include connection to db
include_once("connection.php");

// If form is submitted
if (isset($_POST["register"]))
{
    $data = [];

    // Cleaning data
    foreach ($_POST as $key => $value)
    {
        $data[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    // Check that user filled the form correctly
    if (!empty($data["email"]) && !empty($data["name"]))
    {
        // Check if email is of valid format
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL))
        {
            $_SESSION["msg"] = "Please enter a valid email address";
            header("location: register.php");
            exit;
        }

        // Check if password matches confirmation
        $pw = $data["password"];
        if ($pw != $data["passwordConfirm"])
        {
            $_SESSION["msg"] = "Password does not match confirmation";
            header("location: register.php");
            exit;
        }

        // Check if password fits safety requirements
        $symbolRegex = '/[&#%!:\/;.,?$€]+/';
        $upperCaseRegex = "/[A-Z]+/";
        $lowerCaseRegex = "/[a-z]+/";
        $numberRegex = "/[0-9]+/";

        if (!(preg_match($symbolRegex, $pw) && preg_match($upperCaseRegex, $pw)
            && preg_match($lowerCaseRegex, $pw) && preg_match($numberRegex, $pw)
            && strlen($pw) >= 5))
        {
            $_SESSION["msg"] = "Your password does not fit the requirements";
            header("location: register.php");
            exit;
        }

        // Check if email already exists in db
        $selectQuery = "SELECT * FROM users WHERE email = :email";
        $selectStatement = $mysqlClient->prepare($selectQuery);
        $selectStatement->execute(["email" => $data["email"]]);
        $user = $selectStatement->fetch(PDO::FETCH_ASSOC);

        if (!empty($user))
        {
            $_SESSION["msg"] = "The email address you entered is already used";
            header("location: register.php");
            exit;
        }

        // Create user in db as everything checks out
        $insertQuery = "INSERT INTO users(name, email, password) VALUES(:name, :email, :password)";
        $insertStatement = $mysqlClient->prepare($insertQuery);
        $insertStatement->execute([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => hash("sha256", $pw)
        ]);

        // Redirect user to login page
        $_SESSION["msg"] = "You have successfully registered!";
        header("location: login.php");
    }
}
else
{
    header("location: register.php");
}
