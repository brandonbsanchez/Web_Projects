<?php

include_once 'dbh_inc.php';

$store_id = $_POST['edit_store'];

$sql = 'SELECT * FROM stores WHERE store_id=?;';
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

        if($img_dest != '../Uploads/Store/default.jpg') //Not the default image
        {
            if(!unlink($img_dest)) { //If image doesn't delete
                header('Location: ../manage.php?error=notdeleted');
                exit();
            }
        }
    }
    else {
        header('Location: ../manage.php?error=notfound?storeid='.$store_id);
        exit();
    }
}