<?php
    require 'header.php';
?>

<main>
    <h1>Your Stores</h1>
    <?php
        include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

        $sql = 'SELECT * FROM stores WHERE user_id=?;'; //Gets only for user logged in
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) {
            echo "Failed sql";
        }
        else {
            mysqli_stmt_bind_param($statement, 'i', $_SESSION['user_id']);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            while($row = mysqli_fetch_assoc($result)) { //Each one is a store card
                echo '<div class="store_card" id="store_'.$row['store_id'].'">
                <h2>'.$row['name'].'</h2>
                <p>'.$row['description'].'</p>
                <img src="Uploads/Store/'.$row['img_dest'].'" height=50px><br>
                <button class="edit_store" type="button" value='.$row['store_id'].'>Edit Store</button>
                <form method="POST" action="additems.php">
                <button class="add_item" type="submit" name="add_item" value='.$row['store_id'].'>Add Items</button>
                </form>
                <form method="POST" action="Includes/deletestore_inc.php">
                <button type="submit" name="delete_store" value='.$row['store_id'].'>Delete Store</button>
                </form>
                </div>';
            }
        }
    ?>
    <p>Add Store</p>
    <form method="POST" action="Includes/addstore_inc.php" enctype="multipart/form-data">
        <p>Store Name:</p>
        <input type="text" name="store_name">
        <p>Description:</p>
        <input type="text" name="description">
        <p>Add Image (png, jpg, jpeg):</p>
        <input type="file" name="file"><br>
        <input type="submit" value="Add Store" name="store_submit">
    </form>

    <script src="Javascript/editstore.js"></script>
</main>

<?php
    require 'footer.php';
?>