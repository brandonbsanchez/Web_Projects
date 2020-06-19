<?php

if(isset($_POST['delete_store'])) { //User got here legitimately
    include_once 'dbh_inc.php';

    $response_id = $_POST['delete_store'];

    $sql = 'DELETE FROM bsanchez_se_responses WHERE response_id=?;';
    $statement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
        header('Location: ../addresponses.php?error=sqlerror');
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, 'i', $response_id);
        mysqli_stmt_execute($statement);

        header('Location: ../addresponses.php?delete=success');
        exit();
    }
}