<?php
    require 'header.php';

    if(isset($_POST['add_item'])) {
        $_SESSION['survey_id'] = $_POST['add_item'];
    }
?>

<main>
    <h1 id="balance_title">Survey</h1>
    <?php
        include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

        $sql = 'SELECT * FROM bsanchez_se_surveys WHERE survey_id=?;';//Gets only for user logged in
        $statement = mysqli_stmt_init($conn);
        $survey_responses;

        if(!mysqli_stmt_prepare($statement, $sql)) {
            echo "Failed sql";
        }
        else {
            mysqli_stmt_bind_param($statement, 'i', $_SESSION['survey_id']);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            $row = mysqli_fetch_assoc($result);
            $survey_responses = $row['num_responses'];
        }

        $sql = 'SELECT * FROM bsanchez_se_questions q JOIN bsanchez_se_responses r ON q.question_id = r.question_id 
        WHERE q.survey_id=?;'; //Gets only for user logged in
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
                        echo '<h3>'.$row['question'].'</h3>';
                    }
                }
                else {
                    echo '<h3>'.$row['question'].'</h3>';
                }
                $percent = $row['num_responses'] / $survey_responses;
                $percent_format = number_format((float)$percent, 2, '.', '');
                echo '<p>'.$row['response'].' (Frequency = '.$row['num_responses'].', '.$percent_format.'%)</p>';
                $past_question_id = $question_id;
                $i++;
            }
            $_SESSION['num_questions'] = $i;
        }
    ?>
    <button type="submit" class="button" name="survey_taken">Submit Survey</button>
</main>

<?php
    require 'footer.php';
?>