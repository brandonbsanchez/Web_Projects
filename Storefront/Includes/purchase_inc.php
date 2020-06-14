<?php

if(isset($_POST['purchase'])){ //User got here legitimately
    include_once 'dbh_inc.php'; //So it doesn't called called twice
    session_start();

    $user_id = $_SESSION['user_id'];

    if($_SESSION['cart_total'] === 0) {
        header('Location: ../cart.php?error=noitems');
        exit();
    }
    $sql = 'INSERT INTO bsanchez_orders VALUES (DEFAULT, ?, NOW());'; //(order_id, user_id, date_time)
    $statement = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
        echo 'SQL Failed';
        exit();
    }
    else {
        mysqli_stmt_bind_param($statement, 'i', $user_id); //Inputs variables into ?
        mysqli_stmt_execute($statement);
        $_SESSION['balance'] -= $_SESSION['cart_total'];
        $_SESSION['cart_total'] = 0;
        $sql = 'SELECT order_id FROM bsanchez_orders ORDER BY order_id DESC LIMIT 1;'; //Selects last order id
        $statement = mysqli_stmt_init($conn);
    
        if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
            echo 'SQL Failed';
            exit();
        }
        else {
            mysqli_stmt_execute($statement);

            $result = mysqli_stmt_get_result($statement);

            if($row = mysqli_fetch_assoc($result)) { //Puts result into array
                $order_id = $row['order_id']; //Checks if passwords match
                
                $sql = 'INSERT INTO bsanchez_order_items SELECT o.order_id, c.item_id, c.quantity FROM bsanchez_carts c JOIN bsanchez_orders o
                ON o.user_id = c.user_id WHERE c.user_id=? AND o.order_id=?'; //Copies cart items into order items
                $statement = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                    echo 'SQL Failed';
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($statement, 'ii', $user_id, $order_id); //Inputs variables into ?
                    mysqli_stmt_execute($statement);

                    $sql = 'DELETE FROM bsanchez_carts WHERE user_id=?'; //(order_id, user_id, date_time)
                    $statement = mysqli_stmt_init($conn);
                    
                    if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                        echo 'SQL Failed';
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($statement, 'i', $user_id); //Inputs variables into ?
                        mysqli_stmt_execute($statement);
                        
                        header('Location: ../cart.php?purchase=successful');
                        exit();
                    }
                }
            }
        }
    }
}