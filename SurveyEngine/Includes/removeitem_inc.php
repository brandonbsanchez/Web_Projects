<?php

if(isset($_POST['remove_item'])) { //User got here legitimately
    include_once 'dbh_inc.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    $item_id = $_POST['remove_item'];

    $sql = 'DELETE FROM bsanchez_carts WHERE item_id=? AND user_id=?;';
    $statement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
        header('Location: ../cart.php?error=sqlerror');
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, 'ii', $item_id, $user_id);
        mysqli_stmt_execute($statement);

        header('Location: ../cart.php?remove=success');
        exit();
    }
}
else {
    header('Location: ../cart.php?error=notfound');
    exit();
}