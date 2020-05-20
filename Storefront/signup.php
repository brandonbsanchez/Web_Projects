<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Storefront Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Storefront</h1>
        <h2>Signup to Continue</h1>
        <form method="POST" action="Includes/login_inc.php">
            <p>Username:</p>
            <input type="text" name="username">
            <p>Password:</p>
            <input type="password" name="password">
            <p>Retype Password:</p>
            <input type="password" name="retype_password">
            <input type="submit" value="Signup" name="signup_submit">
        </form>
        <a href="login.php">Login</a>
    </body>
</html>