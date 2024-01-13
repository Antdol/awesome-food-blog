<?php
session_start();
?>
<h1>Awesome food blog</h1>
<nav>
    <div class="left">
        <a href="index.php">Home</a>
    </div>
    <div class="right">
        <?php if (isset($_SESSION["loggedIn"])) : ?>
            <a href="logout.php">Log out</a>
        <?php else : ?>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</nav>