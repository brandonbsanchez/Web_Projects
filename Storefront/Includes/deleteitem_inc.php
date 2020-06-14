<?php

if(isset($_POST['delete_item'])) { //User got here legitimately
    include_once 'dbh_inc.php';

    $item_id = $_POST['delete_item'];

    $sql = 'SELECT * FROM bsanchez_items WHERE item_id=?;';
    $statement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
        header('Location: ../manage.php?error=sqlerror');
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, 'i', $item_id); //Binds $item_id into ?
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        if($row = mysqli_fetch_assoc($result)) { //Puts results into array
            $img_dest = '../Uploads/Item/'.$row['img_dest'];

            if($img_dest != '../Uploads/Item/default.jpg')
            {
                if(!unlink($img_dest)) { //If image doesn't delete
                    header('Location: ../additems.php?error=notdeleted');
                    exit();
                }
            }

            $sql = 'DELETE FROM bsanchez_items WHERE item_id=?;';
            $statement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
                header('Location: ../additems.php?error=sqlerror');
                exit();
            }
            else {
                mysqli_stmt_bind_param($statement, 'i', $item_id);
                mysqli_stmt_execute($statement);

                header('Location: ../additems.php?delete=success');
                exit();
            }
        }
        else {
            header('Location: ../additems.php?error=notfound');
            exit();
        }
    }
}