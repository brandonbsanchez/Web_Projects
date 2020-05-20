<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Storefront Signup</title>
    </head>
    <body>
        <h1>Storefront</h1>
        <h2>Signup</h2>
        <form method="POST" action="Includes/signup_inc.php">
            <p>Username:</p>
            <input type="text" name="username">
            <p>Password:</p>
            <input type="password" name="password">
            <p>Retype Password:</p>
            <input type="password" name="repeat_password">
            <input type="submit" value="Signup" name="signup_submit">
        </form>
        <a href="index.php">Login</a>
    </body>
</html>