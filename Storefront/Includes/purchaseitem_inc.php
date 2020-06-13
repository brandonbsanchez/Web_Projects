<?php

if(isset($_POST['purchase_item'])){ //User got here legitimately
    include_once 'dbh_inc.php'; //So it doesn't called called twice
    session_start();

    $item_id = $_POST['purchase_item'];
    $user_id = $_SESSION['user_id'];
    $num_to_buy = $_POST['num_to_purch'];

    if(empty($num_to_buy)) {
        header('Location: ../viewitems.php?error=emptyfields');
        exit();
    }
    else {
        $sql = 'SELECT num_in_stock, unit_price FROM items WHERE item_id=?;'; //(user_id, item_id, quantity)
        $statement = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
            echo 'SQL Failed';
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, 'i', $item_id); //Inputs variables into ?
            mysqli_stmt_execute($statement);

            $result = mysqli_stmt_get_result($statement);

            if($row = mysqli_fetch_assoc($result)) { //Puts results into array
                $num_in_stock = $row['num_in_stock'];
                $order_price = $num_to_buy * $row['unit_price'];

                if($num_in_stock === 0) {
                    header('Location: ../viewitems.php?error=outofstock');
                    exit();
                }
                else if($num_to_buy > $num_in_stock) {
                    header('Location: ../viewitems.php?error=purchaseless');
                    exit();
                }
                // else if($_SESSION['balance'] < $order_price) {
                //     header('Location: ../viewitems.php?error=needmoremoney');
                //     exit();
                // }
                else {
                    $_SESSION['balance'] -= $order_price;
                    $sql = 'INSERT INTO carts VALUES (?, ?, ?);'; //(user_id, item_id, quantity)
                    $statement = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                        echo 'SQL Error';
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($statement, 'iii', $user_id, $item_id, $num_to_buy); //Inputs variables into ?
                        mysqli_stmt_execute($statement);

                        $sql = 'UPDATE items SET num_in_stock=? WHERE item_id=?;'; //(user_id, item_id, quantity)
                        $statement = mysqli_stmt_init($conn);
                        
                        if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                            echo 'SQL Failed 2';
                            exit();
                        }
                        else {
                            $new_stock = $num_in_stock - $num_to_buy;

                            mysqli_stmt_bind_param($statement, 'ii', $new_stock, $item_id); //Inputs variables into ?
                            mysqli_stmt_execute($statement);

                            $sql = 'UPDATE users SET balance=? WHERE user_id=?;';
                            $statement = mysqli_stmt_init($conn);

                            if(!mysqli_stmt_prepare($statement, $sql)) { //If statement fails
                                echo 'SQL Error';
                                exit();
                            }
                            else {
                                mysqli_stmt_bind_param($statement, 'di', $_SESSION['balance'], $user_id); //Inputs variables into ?
                                mysqli_stmt_execute($statement);

                                header('Location: ../viewitems.php?purchase=success');
                                exit();
                            }
                        }
                    }
                }
            }
            else {
                header('Location: ../viewitems.php?error=notfound');
                exit();
            }
        }
    }

}