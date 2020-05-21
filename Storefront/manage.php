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
                echo '<h2>'.$row['name'].'</h2>
                <h3>'.$row['description'].'</h3>
                <img src="Uploads/'.$row['img_dest'].'" height=50px>
                <p>Edit Store</p>
                <p>Add Items</p>
                <form method="POST" action="Includes/deletestore_inc.php">
                <button type="submit" name="delete_store" value='.$row['store_id'].'>Delete Store</button>
                </form>';
            }
        }
    ?>
    <p>Add Store</p>
    <form method="POST" action="Includes/addstore_inc.php" enctype="multipart/form-data">
        <p>Store Name:</p>
        <input type="text" name="store_name">
        <p>Description:</p>
        <input type="text" name="description">
        <p>Add Image:</p>
        <input type="file" name="file">
        <input type="submit" value="Add Store" name="store_submit">
    </form>
</main>

<?php
    require 'footer.php';
?>