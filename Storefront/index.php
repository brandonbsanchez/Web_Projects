<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Storefront Login</title>
        <link href="CSS/reset.css" rel="stylesheet">
        <link href="CSS/index.css" rel="stylesheet">
    </head>
    <body>
        <header>
        <h1>Storefront</h1>

        </header>
        <main>
            <h2>Login</h2>
            <div id="form">
                <form method="POST" action="Includes/login_inc.php">
                    <p id="username">Username</p>
                    <input type="text" name="username" class="input">
                    <p id="password">Password</p>
                    <input type="password" name="password" class="input"><br>
                    <input type="submit" value="Login" name="login_submit" id="submit">
                </form>
                <a href="signup.php">Sign Up</a>
            </div>
        </main>

        <footer>
            <p>Copyright 2020 | Brandon Sanchez</p>
        </footer>
    </body>
</html>