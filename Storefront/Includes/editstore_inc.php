<?php

if(isset($_POST['edit_store'])){ //User got here legitimately
    include_once 'dbh_inc.php'; //So it doesn't called called twice
    include_once 'getfilename_inc.php'; //Sets original file name in session

    //session_start();

    $store_name = $_POST['store_name'];
    $description = $_POST['descr'];
    $file = $_FILES['file']; //Array of all image data uploaded

    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_temp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];
    $is_default = true;

    if($file['error'] === 0){ //If file is selected
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
    else { //File not selected
        $file_error = 0;
        $file_size = 0;
        $file_end_ext = 'jpg';
        $file_error = 0;
    }

    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($file_end_ext, $allowed)) { //If Proper file type
        if($file_error === 0) { //No errors
            if($file_size < 1000000) { //Less than 1mb
                if($is_default) { //File not selected
                    $image_full_name = $_SESSION['img_dest'];
                }
                else {
                    $image_full_name = uniqid('', true) . '.'. $file_end_ext;
                }
                $file_destination = '../Uploads/Store/' . $image_full_name;

                if(empty($store_name) || empty($description)) {
                    header('Location: ../manage.php?error=emptyfields');
                    exit();
                }
                else {
                    if(!$is_default && $_SESSION['img_dest'] != 'default.jpg') { //If image changed and not default image
                        include_once 'deletefile_inc.php'; //Deletes previous image
                    }
                    $sql = 'UPDATE stores SET name=?, description=?, img_dest=? WHERE store_id=?;';
                    $statement = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                        echo 'SQL Failed';
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($statement, 'sssi', $store_name, $description, 
                        $image_full_name, $_POST['edit_store']); //Inputs variables into ?
                        mysqli_stmt_execute($statement);
                        
                        if(!$is_default){
                            move_uploaded_file($file_temp_name, $file_destination); //Upload image
                        }

                        header('Location: ../manage.php?upload=success');
                        exit();
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
else {
    header("Location: ../index.php");
    exit();
}