<?php

if(isset($_POST['survey_taken'])){ //User got here legitimately
    include_once 'dbh_inc.php'; //So it doesn't called called twice
    session_start();

    if(false) {
        header('Location: ../addresponses.php?error=emptyfields');
        exit();
    }
    else {
        $sql = 'UPDATE bsanchez_se_surveys SET num_responses = num_responses + 1 WHERE survey_id=?;'; //(response_id, question_id, response, num_responses)
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
            echo mysqli_error($conn);
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, 'i', $_SESSION['survey_id']); //Inputs variables into ?
            mysqli_stmt_execute($statement);

            for($i = 0 ; $i < $_SESSION['num_questions'] ; $i++)
            {
                $sql = 'UPDATE bsanchez_se_responses SET num_responses = num_responses + 1 WHERE response_id=?;'; //(response_id, question_id, response, num_responses)
                $statement = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                    echo mysqli_error($conn);
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($statement, 'i', $_POST[$i]); //Inputs variables into ?
                    mysqli_stmt_execute($statement);
                }
            }
            header('Location: ../home.php?taken=success');
            exit();
        }
    }
}

//UPDATE bsanchez_items SET name=?, description=?, img_dest=?, num_in_stock=?, unit_price=? WHERE item_id=?;