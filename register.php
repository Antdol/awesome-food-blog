<?php
session_start();
include_once("./displayMsg.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                if (isset($_SESSION["msg"]))
                {
                    echo $_SESSION["msg"];
                }
                ?>
            </p>
            <form action="handleRegister.php" method="post">
                <h2>Register form</h2>
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" autofocus autocomplete="off">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" autocomplete="off">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <p id="password-info">
                    Password must contain at least 1 uppercase letter,
                    1 lowercase letter, 1 number and 1 of &#%!:/;.,?$€
                    and be 5 or more characters long.
                </p>
                <label for="passwordConfirm">Confirm password</label>
                <input type="password" name="passwordConfirm" id="passwordConfirm">
                <button type="submit" name="register">Register</button>
            </form>

        </div>
    </main>
</body>

</html>