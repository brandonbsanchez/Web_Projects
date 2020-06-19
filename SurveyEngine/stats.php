<?php
    require 'header.php';
?>

<main>
    <h1>Your Surveys</h1>
    <div id="container">
        <?php
            include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

            $sql = 'SELECT * FROM bsanchez_se_surveys WHERE user_id=?;'; //Gets only for user logged in
            $statement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($statement, $sql)) {
                echo "Failed sql";
            }
            else {
                mysqli_stmt_bind_param($statement, 'i', $_SESSION['user_id']);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);

                while($row = mysqli_fetch_assoc($result)) { //Each one is a store card
                    echo '<div class="store_card" id="store_'.$row['survey_id'].'">
                    <h2>'.$row['name'].'</h2>
                    <div class="bottom_card">
                        <p class="manage_descr">'.$row['description'].'</p>
                        <p> Number of Responses: '.$row['num_responses'].'</p>
                        <form method="POST" action="viewstats.php">
                        <button class="add_item button" type="submit" name="view_stats" value='.$row['survey_id'].'>View Stats</button>
                        </form>
                    </div>
                    </div>';
                }
            }
        ?>
    </div>

    <script src="Javascript/editstore.js"></script>
</main>

<?php
    require 'footer.php';
?>