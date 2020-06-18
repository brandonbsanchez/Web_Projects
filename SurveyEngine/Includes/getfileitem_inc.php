<?php

include_once 'dbh_inc.php';
session_start();
$item_id = $_POST['edit_item'];
$sql = 'SELECT * FROM bsanchez_items WHERE item_id=?;';
$statement = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
    header('Location: ../additems.php?error=sqlerror');
    exit();
}
else {
    mysqli_stmt_bind_param($statement, 'i', $item_id); //Binds $item_id into ?
    mysqli_stmt_execute($statement);

    $result = mysqli_stmt_get_result($statement);

    if($row = mysqli_fetch_assoc($result)) { //Puts results into array
        $_SESSION['img_dest'] = $row['img_dest']; //Sets session to file name to be preserved
    }
    else {
        header('Location: ../additems.php?error=notfound');
        exit();
    }
}