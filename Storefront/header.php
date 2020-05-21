<?php
    session_start();

    if(!isset($_SESSION['user_id'])) { //If user didn't use login screen
        header('Location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Storefront</title>
    </head>
    <body>

    <header>
        <nav>
            <ul>
                <li><a href="home.php">Shop</a></li>
                <li><a href="manage.php">Manage Stores</a></li>
                <?php echo '<li>Hello '.$_SESSION['username'].'!</li>'; ?>
                <li>Cart</li>
                <?php echo '<li>Balance: $'.$_SESSION['balance'].'</li>'; ?>
                <li>Logout</li>
            </ul>
        </nav>
    </header>