<?php
    require 'header.php';

    if(isset($_POST['add_item'])) {
        $_SESSION['survey_id'] = $_POST['add_item'];
    }
?>

<main>
    <h1 id="balance_title">Survey</h1>
    <form method="POST" action="Includes/surveytaken_inc.php" id="survey_form">
    <?php
        include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

        $sql = 'SELECT * FROM bsanchez_se_questions q JOIN bsanchez_se_responses r ON q.question_id = r.question_id 
        WHERE q.survey_id=? ORDER BY q.question_id;'; //Gets only for user logged in
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) {
            echo "Failed sql";
        }
        else {
            mysqli_stmt_bind_param($statement, 'i', $_SESSION['survey_id']);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            $i = 0;

            while($row = mysqli_fetch_assoc($result)) { //Each one is an item card
                $question_id = $row['question_id'];
                if($i != 0) {
                    if($past_question_id != $question_id) {
                        echo '<h3 class="h3_question">'.$row['question'].'</h3>';
                        $i++;
                    }
                }
                else {
                    echo '<h3 class="h3_question">'.$row['question'].'</h3>';
                    $i++;
                }
                    echo '<input type="radio" name='.($i - 1).' value='.$row['response_id'].' class="radio_button" required>';
                    echo '<span>'.$row['response'].'</span><br>';
                $past_question_id = $question_id;
            }
            $_SESSION['num_questions'] = $i;
        }
    ?>
    <button type="submit" class="button" name="survey_taken">Submit Survey</button>
    </form>
</main>

<?php
    require 'footer.php';
?>