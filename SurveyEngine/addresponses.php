<?php
    require 'header.php';

    if(isset($_POST['add_item'])) {
        $_SESSION['question_id'] = $_POST['add_item'];
    }
?>

<main>
    <h1>Your Responses</h1>
    <a href="additems.php" id="questions">Back to Questions</a>
    <div id="container" class="space_fix">
        <?php
            include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

            $sql = 'SELECT * FROM bsanchez_se_responses WHERE question_id=?;'; //Gets only for user logged in
            $statement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($statement, $sql)) {
                echo "Failed sql";
            }
            else {
                mysqli_stmt_bind_param($statement, 'i', $_SESSION['question_id']);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);

                while($row = mysqli_fetch_assoc($result)) { //Each one is a store card
                    echo '<div class="store_card" id="store_'.$row['response_id'].'">
                    <h2>Response</h2>
                    <div class="bottom_card">
                        <p class="manage_descr">'.$row['response'].'</p>
                        <form method="POST" action="Includes/deleteresponse_inc.php">
                        <button type="submit" name="delete_store" value='.$row['response_id'].' class="delete button delete_response">Delete Response</button>
                        </form>
                    </div>
                    </div>';
                }
            }
        ?>
        <div id="add_store">
            <h2>Add Response</h2>
            <form method="POST" action="Includes/addresponse_inc.php" class="form">
                <p class="store_name">Response</p>
                <input type="text" name="item_name" class="input">
                <input class="button" type="submit" value="Add Response" name="item_submit" id="add_button">
            </form>
        </div>
    </div>

    <script src="Javascript/editstore.js"></script>
</main>

<?php
    require 'footer.php';
?>