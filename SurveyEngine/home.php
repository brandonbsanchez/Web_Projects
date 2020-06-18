<?php
    require 'header.php';
?>

<main>
    <h1>Stores</h1>
    <div id="container">
    <?php
        include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

        $sql = 'SELECT * FROM bsanchez_stores;'; //Gets only for user logged in
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) {
            echo "Failed sql";
        }
        else {
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            while($row = mysqli_fetch_assoc($result)) { //Each one is a store card
                echo '<div class="store_card" id="store_'.$row['store_id'].'">
                <h2>'.$row['name'].'</h2>
                <div class="bottom_card">
                    <img src="Uploads/Store/'.$row['img_dest'].'" height=80px><br>
                    <p class="store_descr">'.$row['description'].'</p>
                    <form method="POST" action="viewitems.php">
                    <button class="view_items button" type="submit" name="add_item" value='.$row['store_id'].'>View Items</button>
                    </form>
                </div>
                </div>';
            }
        }
    ?>
    </div>
</main>

<?php
    require 'footer.php';
?>