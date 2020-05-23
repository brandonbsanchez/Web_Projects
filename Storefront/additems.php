<?php
    require 'header.php';

    if(isset($_POST['add_item'])) {
        $_SESSION['store_id'] = $_POST['add_item'];
    }
?>

<main>
    <h1>Items</h1>
    <?php

        include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

        $sql = 'SELECT * FROM items WHERE store_id=?;'; //Gets only for user logged in
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) {
            echo "Failed sql";
        }
        else {
            mysqli_stmt_bind_param($statement, 'i', $_SESSION['store_id']);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);

            while($row = mysqli_fetch_assoc($result)) { //Each one is a store card
                echo '<div class="item_card" id="item_'.$row['item_id'].'">
                <h2>'.$row['name'].'</h2>
                <p>'.$row['description'].'</p>
                <p>'.$row['num_in_stock'].'</p>
                <p>$'.$row['unit_price'].'</p>
                <img src="Uploads/Item/'.$row['img_dest'].'" height=50px><br>
                <button class="edit_item" type="button" value='.$row['item_id'].'>Edit Item</button>
                <form method="POST" action="Includes/deleteitem_inc.php">
                <button type="submit" name="delete_item" value='.$row['item_id'].'>Delete Item</button>
                </form>
                </div>';
            }
        }
    ?>
    <p>Add Item</p>
    <form method="POST" action="Includes/additem_inc.php" enctype="multipart/form-data">
        <p>Item Name:</p>
        <input type="text" name="item_name">
        <p>Description:</p>
        <input type="text" name="description">
        <p>Quantity:</p>
        <input type="text" name="num_in_stock">
        <p>Unit Price:</p>
        <input type="text" name="unit_price">
        <p>Add Image (png, jpg, jpeg):</p>
        <input type="file" name="file"><br>
        <input type="submit" value="Add Item" name="item_submit">
    </form>

    <!-- <script src="Javascript/edititem.js"></script> -->
</main>

<?php
    require 'footer.php';
?>