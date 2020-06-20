<?php
    require 'header.php';

    if(isset($_POST['add_item'])) {
        $_SESSION['survey_id'] = $_POST['add_item'];
    }
?>

<main>
    <h1>Questions</h1>
    <div id="container">
        <?php
            include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

            $sql = 'SELECT * FROM bsanchez_se_questions WHERE survey_id=?;'; //Gets only for user logged in
            $statement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($statement, $sql)) {
                echo "Failed sql";
            }
            else {
                mysqli_stmt_bind_param($statement, 'i', $_SESSION['survey_id']);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);

                while($row = mysqli_fetch_assoc($result)) { //Each one is a store card
                    echo '<div class="store_card" id="item_'.$row['question_id'].'">
                    <h2>Question</h2>
                    <div class="bottom_card">
                        <p class="item_descr top description">'.$row['question'].'</p>
                        <form method="POST" action="addresponses.php">
                        <button class="add_item button" type="submit" name="add_item" value='.$row['question_id'].'>Add Responses</button>
                        </form>
                        <form method="POST" action="Includes/deleteitem_inc.php">
                        <button class="button delete" type="submit" name="delete_item" value='.$row['question_id'].'>Delete Question</button>
                        </form>
                    </div>
                    </div>';
                }
            }
        ?>
        <div id="add_store">
            <h2>Add Question</h2>
            <form method="POST" action="Includes/additem_inc.php" class="form">
                <p class="store_name">Question</p>
                <input type="text" name="item_name" class="input">
                <input class="button" type="submit" value="Add Question" name="item_submit" id="add_button">
            </form>
        </div>
    </div>
</main>

<?php
    require 'footer.php';
?>