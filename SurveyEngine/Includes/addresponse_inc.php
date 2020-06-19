<?php

if(isset($_POST['item_submit'])){ //User got here legitimately
    include_once 'dbh_inc.php'; //So it doesn't called called twice
    session_start();

    $response = $_POST['item_name'];


    if(empty($response)) {
        header('Location: ../addresponses.php?error=emptyfields');
        exit();
    }
    else {
        $sql = 'INSERT INTO bsanchez_se_responses VALUES (DEFAULT, ?, ?, DEFAULT);'; //(response_id, question_id, response, num_responses)
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
            echo mysqli_error($conn);
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, 'is', $_SESSION['question_id'], $response); //Inputs variables into ?
            mysqli_stmt_execute($statement);

            header('Location: ../addresponses.php?upload=success');
        }
    }
}