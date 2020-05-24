<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Storefront Signup</title>
        <link href="CSS/reset.css" rel="stylesheet">
        <link href="CSS/signup.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <h1>Storefront</h1>
        </header>
        
        <main>
            <h2>Signup</h2>
            <div id="form">
                <form method="POST" action="Includes/signup_inc.php">
                    <p id="username">Username:</p>
                    <input type="text" name="username" class="input">
                    <p id="password">Password:</p>
                    <input type="password" name="password" class="input">
                    <p id="password">Retype Password:</p>
                    <input type="password" name="repeat_password" class="input">
                    <input type="submit" value="Signup" name="signup_submit" id="submit">
                </form>
                <a href="index.php">Login</a>
            </div>
        </main>
        
        <footer>
            <p>Copyright 2020 | Brandon Sanchez</p>
        </footer>
    </body>
</html>