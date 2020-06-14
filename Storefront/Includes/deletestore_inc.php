<?php

if(isset($_POST['delete_store'])) { //User got here legitimately
    include_once 'dbh_inc.php';
    include_once 'deletestoreitems_inc.php';
    
    $store_id = $_POST['delete_store'];

    $sql = 'SELECT * FROM bsanchez_stores WHERE store_id=?;';
    $statement = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
        header('Location: ../manage.php?error=sqlerror');
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, 'i', $store_id); //Binds $store_id into ?
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);

        if($row = mysqli_fetch_assoc($result)) { //Puts results into array
            $img_dest = '../Uploads/Store/'.$row['img_dest'];

            if($img_dest != '../Uploads/Store/default.jpg')
            {
                if(!unlink($img_dest)) { //If image doesn't delete
                    header('Location: ../manage.php?error=notdeleted');
                    exit();
                }
            }

            $sql = 'DELETE FROM bsanchez_stores WHERE store_id=?;';
            $statement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
                header('Location: ../manage.php?error=sqlerror');
                exit();
            }
            else {
                mysqli_stmt_bind_param($statement, 'i', $store_id);
                mysqli_stmt_execute($statement);

                header('Location: ../manage.php?delete=success');
                exit();
            }
        }
        else {
            header('Location: ../manage.php?error=notfound');
            exit();
        }
    }
}