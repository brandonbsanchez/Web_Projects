<?php

//Verifies signup data and inserts into database

if(isset($_POST['signup_submit'])) { //Prevents user typing file in browser
    require 'dbh_inc.php'; //$conn

    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    if(empty($username) || empty($password) || empty($repeat_password)) {
        header('Location: ../signup.php?error=emptyfields&username='.$username); //Sends back username
        exit();
    }
    else if(!preg_match('/^[a-zA-Z0-9]*$/', $username)) { //Username can only have letters/numbers
        header('Location: ../signup.php?error=invalidusername');
        exit();
    }
    else if($password != $repeat_password) {
        header('Location: ../signup.php?error=passwordcheck&username='.$username); //Sends back username
        exit();
    }
    else {
        $sql = 'SELECT username FROM users WHERE username=?;';
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
            header('Location: ../signup.php?error=sqlerror');
            exit();
        }
        else {
            mysqli_stmt_bind_param($statement, 's', $username); //Inserts username string into $sql
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement); //Stores results in statement

            $result = mysqli_stmt_num_rows($statement);

            if($result > 0) { //Rows > 0 means username taken
                header('Location: ../signup.php?error=nametaken');
                exit();
            }
            else {
                $sql = "INSERT INTO users VALUES (DEFAULT, ?, ?, DEFAULT);"; //(id, username, password, balance=0)
                $statement = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($statement, $sql)) { //If connection fails
                    header('Location: ../signup.php?error=sqlerror');
                    exit();
                }
                else {
                    $hashed_pw = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($statement, 'ss', $username, $hashed_pw); //Inserts username/hashed pw string into $sql
                    mysqli_stmt_execute($statement);

                    header('Location: ../index.php?signup=success');
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);
}
else { //If user typed in this link
    header('Location: ../signup.php');
    exit();
}