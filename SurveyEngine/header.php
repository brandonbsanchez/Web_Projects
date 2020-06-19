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
        <title>Survey Engine</title>
        <link href="CSS/reset.css" rel="stylesheet">
        <link href="CSS/header.css" rel="stylesheet">
        <link href="CSS/footer.css" rel="stylesheet">
        <link href="CSS/main.css" rel="stylesheet">
    </head>
    <body>

    <header>
        <nav>
            <ul>
                <li id="title">Survey Engine</li>
                <li id="dash">|</li>
                <li class="color"><a href="home.php">Surveys</a></li>
                <li class="color"><a href="stats.php">Stats</a></li>
                <li class="color" id="manage"><a href="manage.php">Manage</a></li>
                <?php echo '<li class="color" id="header_name">'.$_SESSION['username'].'</li>'; ?>
                <li class="color" id="button"><button onclick="location.href='Includes/logout_inc.php'" type="button">Logout</button></li>
            </ul>
        </nav>
    </header>