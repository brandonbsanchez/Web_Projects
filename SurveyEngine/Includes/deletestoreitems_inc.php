<?php

if(isset($_POST['delete_store'])) { //User got here legitimately
    include_once 'dbh_inc.php';

    $survey_id = $_POST['delete_store'];

    $sql = 'DELETE r FROM bsanchez_se_responses r JOIN bsanchez_se_questions q ON r.question_id=q.question_id WHERE q.survey_id=?;';
    $statement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
        header('Location: ../manage.php?error=sqlerror');
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, 'i', $survey_id);
        mysqli_stmt_execute($statement);
    }

    $sql = 'DELETE FROM bsanchez_se_questions WHERE survey_id=?;';
    $statement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
        header('Location: ../manage.php?error=sqlerror');
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, 'i', $survey_id);
        mysqli_stmt_execute($statement);
    }
}