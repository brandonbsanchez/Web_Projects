<?php

if(isset($_POST['login_submit'])) { //Prevents user typing file in browser
    require 'dbh_inc.php'; //$conn

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        header('Location: ../index.php?error=emptyfields&username='.$username);
        exit();
    }
    else {
        $sql = 'SELECT * FROM bsanchez_se_users WHERE username=?';
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
            header('Location: ../index.php?error=sqlerror');
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, 's', $username);
            mysqli_stmt_execute($statement);

            $result = mysqli_stmt_get_result($statement);

            if($row = mysqli_fetch_assoc($result)) { //Puts result into array
                $password_check = password_verify($password, $row['password']); //Checks if passwords match

                if($password_check) {
                    session_start();
                    
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['balance'] = $row['balance'];

                    header('Location: ../home.php?login=success');
                    exit();
                }
                else {
                    header('Location: ../index.php?error=wrongpassword'); //Passwords don't match
                    exit();
                }
            }
            else {
                header('Location: ../index.php?error=nousername'); //Username not found
                exit();
            }
        }
    }
}
else {
    header('Location: ../index.php');
    exit();
}