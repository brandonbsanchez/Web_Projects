<?php

if(isset($_POST['item_submit'])){ //User got here legitimately
    include_once 'dbh_inc.php'; //So it doesn't called called twice
    session_start();

    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $num_in_stock = $_POST['num_in_stock'];
    $unit_price = $_POST['unit_price'];

    $file = $_FILES['file']; //Array of all image data uploaded
    $is_default = true;

    if($file['error'] === 0){
            $file_name = $file['name'];
            $file_type = $file['type'];
            $file_temp_name = $file['tmp_name'];
            $file_error = $file['error'];
            $file_size = $file['size'];
            $file_ext = explode('.', $file_name); //Splits into array
            $file_end_ext = strtolower(end($file_ext)); //Gets the end extension name
            $is_default = false;   
            $file_ext = explode('.', $file_name); //Splits into array
            $file_end_ext = strtolower(end($file_ext)); //Gets the end extension name
    }
    else {
        $file_error = 0;
        $file_size = 0;
        $file_end_ext = 'jpg';
        $file_error = 0;
    }

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($file_end_ext, $allowed)) { //If Proper file type
        if($file_error === 0) { //No errors
            if($file_size < 1000000) { //Less than 1mb
                if($is_default) {
                    $image_full_name = 'default.jpg';
                }
                else {
                    $image_full_name = uniqid('', true) . '.'. $file_end_ext;
                }

                $file_destination = '../Uploads/Item/' . $image_full_name;
                if(empty($item_name) || empty($description) || empty($num_in_stock) || empty($unit_price)) {
                    header('Location: ../additems.php?error=emptyfields');
                    exit();
                }
                else {
                    $sql = 'INSERT INTO items VALUES (DEFAULT, ?, ?, ?, ?, ?, ?);'; 
                    //(item_id, store_id, name, descr, img_dest, num_in_stock, unit_price)
                    $statement = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                        echo 'SQL Failed';
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($statement, 'issssd', $_SESSION['store_id'], $item_name, 
                                                $description, $image_full_name, $num_in_stock, $unit_price); //Inputs variables into ?
                        mysqli_stmt_execute($statement);

                        move_uploaded_file($file_temp_name, $file_destination); //Upload image

                        header('Location: ../additems.php?upload=success');
                    }
                }
            }
            else {
                header('Location: ../additems.php?error=sizeerror');
                exit();
            }
        }
        else {
            header("Location: ../additems.php?error=file");
            exit();
        }
    }
    else {
        header("Location: ../additems.php?error=fileext");
        exit();
    }
}