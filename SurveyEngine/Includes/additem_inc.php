<?php

if(isset($_POST['item_submit'])){ //User got here legitimately
    include_once 'dbh_inc.php'; //So it doesn't called called twice
    session_start();

    $question = $_POST['item_name'];


    if(empty($question)) {
        header('Location: ../additems.php?error=emptyfields');
        exit();
    }
    else {
        $sql = 'INSERT INTO bsanchez_se_questions VALUES (DEFAULT, ?, ?);'; //(item_id, store_id, name, descr, img_dest, num_in_stock, unit_price)
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
            echo 'SQL Failed';
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, 'is', $_SESSION['survey_id'], $question); //Inputs variables into ?
            mysqli_stmt_execute($statement);

            header('Location: ../additems.php?upload=success');
        }
    }
}