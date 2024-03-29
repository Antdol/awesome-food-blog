<?php
session_start();
include_once("./displayMsg.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            <form action="handleLogin.php" method="post">
                <h2>Login form</h2>
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" autofocus autocomplete="off">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <button type="submit" name="login">Login</button>
            </form>

        </div>
    </main>
</body>

</html>