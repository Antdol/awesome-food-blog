<h1>Awesome food blog</h1>
<nav>
    <div class="left">
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION["loggedIn"])) : ?>
                <li><a href="allRecipes.php">All recipes</a></li>
                <li><a href="myrecipes.php">My recipes</a></li>
            <?php endif; ?>
        </ul>

    </div>
    <div class="right">
        <ul>
            <?php if (isset($_SESSION["loggedIn"])) : ?>
                <li>
                    <a href="logout.php">Log out</a>
                </li>
            <?php else : ?>
                <li>
                    <a href="register.php">Register</a>
                </li>
                <li>
                    <a href="login.php">Login</a>
                </li>
            <?php endif; ?>
        </ul>

    </div>
</nav>