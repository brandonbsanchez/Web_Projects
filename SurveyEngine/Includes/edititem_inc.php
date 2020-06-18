<?php

if(isset($_POST['edit_item'])){ //User got here legitimately
    include_once 'dbh_inc.php'; //So it doesn't called called twice
    include_once 'getfileitem_inc.php'; //Sets original file name in session

    //session_start();

    $item_name = $_POST['item_name'];
    $description = $_POST['descr'];
    $num_in_stock = $_POST['num_in_stock'];
    $unit_price = $_POST['unit_price'];

    $file = $_FILES['file']; //Array of all image data uploaded

    $file_name = $file['name'];
    $file_type = $file['type'];
    $file_temp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];
    $is_default = true; //User didn't change picture

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
                $file_destination = '../Uploads/Item/' . $image_full_name;

                if(empty($item_name) || empty($description)) {
                    header('Location: ../additems.php?error=emptyfields');
                    exit();
                }
                else {
                    if(!$is_default && $_SESSION['img_dest'] != 'default.jpg') { //If image changed and not default image
                        include_once 'deletefileitem_inc.php'; //Deletes previous image
                    }
                    $sql = 'UPDATE bsanchez_items SET name=?, description=?, img_dest=?, num_in_stock=?, unit_price=? WHERE item_id=?;';
                    $statement = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                        echo 'SQL Failed';
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($statement, 'sssidi', $item_name, $description, 
                        $image_full_name, $num_in_stock, $unit_price, $_POST['edit_item']); //Inputs variables into ?
                        mysqli_stmt_execute($statement);
                        
                        if(!$is_default){
                            move_uploaded_file($file_temp_name, $file_destination); //Upload image
                        }

                        header('Location: ../additems.php?upload=success');
                        exit();
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
else {
    header("Location: ../index.php");
    exit();
}