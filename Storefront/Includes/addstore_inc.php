<?php

if(isset($_POST['store_submit'])){ //User got here legitimately
    include_once 'dbh_inc.php'; //So it doesn't called called twice
    session_start();

    $store_name = $_POST['store_name'];
    $description = $_POST['description'];
    $file = $_FILES['file']; //Array of all image data uploaded

    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_temp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    $file_ext = explode('.', $file_name); //Splits into array
    $file_end_ext = strtolower(end($file_ext)); //Gets the end extension name

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($file_end_ext, $allowed)) { //If Proper file type
        if($file_error === 0) { //No errors
            if($file_size < 1000000) { //Less than 1mb
                $image_full_name = uniqid('', true) . '.'. $file_end_ext;
                $file_destination = '../Uploads/Store' . $image_full_name;

                if(empty($store_name) || empty($description)) {
                    header('Location: ../manage.php?error=emptyfields');
                    exit();
                }
                else {
                    $sql = 'INSERT INTO stores VALUES (DEFAULT, ?, ?, ?, ?);'; //(store_id, user_id, name, description, img_dest)
                    $statement = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                        echo 'SQL Failed';
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($statement, 'isss', $_SESSION['user_id'], $store_name, 
                                                $description, $image_full_name); //Inputs variables into ?
                        mysqli_stmt_execute($statement);

                        move_uploaded_file($file_temp_name, $file_destination); //Upload image

                        header('Location: ../manage.php?upload=success');
                    }
                }
            }
            else {
                header('Location: ../manage.php?error=sizeerror');
                exit();
            }
        }
        else {
            header("Location: ../manage.php?error=file");
            exit();
        }
    }
    else {
        header("Location: ../manage.php?error=fileext");
        exit();
    }
}