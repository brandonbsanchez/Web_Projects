<?php

if(isset($_POST['add_balance'])) { //User got here legitimately
    include_once 'dbh_inc.php';

    if(empty($_POST['dollars'])){
        header('Location: ../cart.php?error=emptyfields');
    }
    else {
        session_start();
        $user_id = $_SESSION['user_id'];
        $new_balance = $_POST['dollars'] + $_SESSION['balance'];

        $sql = 'UPDATE users SET balance=? WHERE user_id=?;'; //(user_id, item_id, quantity)
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
            header('Location: ../cart.php?error=sqlerror');
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, 'di', $new_balance, $user_id);
            mysqli_stmt_execute($statement);
            
            $_SESSION['balance'] = $new_balance;

            header('Location: ../cart.php?addbalance=success');
            exit();
        }
    }
}
else {
    header('Location: ../cart.php?error=notfound');
    exit();
}