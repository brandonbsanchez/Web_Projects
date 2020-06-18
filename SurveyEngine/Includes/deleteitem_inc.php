<?php

if(isset($_POST['delete_item'])) { //User got here legitimately
    include_once 'dbh_inc.php';

    $question_id = $_POST['delete_item'];

    $sql = 'DELETE FROM bsanchez_se_questions WHERE question_id=?;';
    $statement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
        header('Location: ../additems.php?error=sqlerror');
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, 'i', $question_id);
        mysqli_stmt_execute($statement);

        header('Location: ../additems.php?delete=success');
        exit();
    }
}