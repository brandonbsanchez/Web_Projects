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
                        <img src="Uploads/Store/'.$row['img_dest'].'" height=80px><br>
                        <button class="edit_store button" type="button" value='.$row['survey_id'].'>Edit Survey</button><br>
                        <form method="POST" action="additems.php">
                        <button class="add_item button" type="submit" name="add_item" value='.$row['survey_id'].'>Add Questions</button>
                        </form>
                        <form method="POST" action="Includes/deletestore_inc.php">
                        <button type="submit" name="delete_store" value='.$row['survey_id'].' class="delete button">Delete Survey</button>
                        </form>
                    </div>
                    </div>';
                }
            }
        ?>
        <div id="add_store">
            <h2>Add Survey</h2>
            <form method="POST" action="Includes/addstore_inc.php" enctype="multipart/form-data" class="form">
                <p class="store_name">Survey Name</p>
                <input type="text" name="store_name" class="input">
                <p class="store_descr">Description</p>
                <input type="text" name="description" class="input">
                <p class="add_image">Add Image (Optional)</p>
                <input type="file" name="file"><br>
                <input type="submit" value="Add Survey" name="store_submit" class="button" id="your_stores">
            </form>
        </div>
    </div>

    <script src="Javascript/editstore.js"></script>
</main>

<?php
    require 'footer.php';
?>