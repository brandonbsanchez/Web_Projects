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

            $sql = 'SELECT * FROM bsanchez_items WHERE survey_id=?;'; //Gets only for user logged in
            $statement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($statement, $sql)) {
                echo "Failed sql";
            }
            else {
                mysqli_stmt_bind_param($statement, 'i', $_SESSION['survey_id']);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);

                while($row = mysqli_fetch_assoc($result)) { //Each one is a store card
                    $format_price = number_format((float)$row['unit_price'], 2, '.', '');
                    echo '<div class="store_card" id="item_'.$row['item_id'].'">
                    <h2>'.$row['name'].'</h2>
                    <div class="bottom_card">
                        <img src="Uploads/Item/'.$row['img_dest'].'" height=80px>
                        <p class="item_descr top description">'.$row['description'].'</p>
                        <h3 class="item_titles">Number in Stock</h3>
                        <p class="item_descr num_in_stock">'.$row['num_in_stock'].'</p>
                        <h3 class="item_titles">Price</h3>
                        <p class="item_descr unit_price">'.$format_price.'</p>
                        <button class="edit_item button" type="button" value='.$row['item_id'].'>Edit Item</button>
                        <form method="POST" action="Includes/deleteitem_inc.php">
                        <button class="button delete" type="submit" name="delete_item" value='.$row['item_id'].'>Delete Item</button>
                        </form>
                    </div>
                    </div>';
                }
            }
        ?>
        <div id="add_store">
            <h2>Add Question</h2>
            <form method="POST" action="Includes/additem_inc.php" enctype="multipart/form-data" class="form">
                <p class="store_name">Item Name</p>
                <input type="text" name="item_name" class="input">
                <p class="store_descr">Description</p>
                <input type="text" name="description" class="input">
                <p class="store_descr">Quantity</p>
                <input type="text" name="num_in_stock" class="input">
                <p class="store_descr">Unit Price</p>
                <input type="text" name="unit_price" class="input">
                <p class="add_image">Add Image (Optional)</p>
                <input type="file" name="file"><br>
                <input class="button" type="submit" value="Add Item" name="item_submit" id="add_button">
            </form>
        </div>
    </div>
    <script src="Javascript/edititem.js"></script>
</main>

<?php
    require 'footer.php';
?>