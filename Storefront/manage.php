<?php
    require 'header.php';
?>

<main>
    <h1>Your Stores</h1>
    <?php
        include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

        $sql = "SELECT * FROM stores;";
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) {
            echo "Failed sql";
        }
        else {
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            while($row = mysqli_fetch_assoc($result)) {
                echo '<div class="store_card" id="store_'.$row['store_id'].'">
                <h2>'.$row['name'].'</h2>
                <p>'.$row['description'].'</p>
                <img src="Uploads/Store/'.$row['img_dest'].'" height=50px>
                <form method="POST">
                <button class="edit_store" type="button" value='.$row['store_id'].'>Edit Store</button>
                </form>
                <p>Add Items</p>
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
        <input type="file" name="file">
        <input type="submit" value="Add Store" name="store_submit">
    </form>

    <script src="Javascript/editstore.js"></script>
</main>

<?php
    require 'footer.php';
?>