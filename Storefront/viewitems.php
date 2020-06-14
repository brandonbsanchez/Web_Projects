<?php
    require 'header.php';

    if(isset($_POST['add_item'])) {
        $_SESSION['store_id'] = $_POST['add_item'];
    }
?>

<main>
    <h1 id="balance_title">Items</h1>
    <?php echo '<p id="balance">Balance: $'.$_SESSION['balance'].'</p>'; ?>
    <div id="container">
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

                while($row = mysqli_fetch_assoc($result)) { //Each one is an item card
                    echo '<div class="store_card" id="item_'.$row['item_id'].'">
                    <h2>'.$row['name'].'</h2>
                    <div class="bottom_card">
                        <img src="Uploads/Item/'.$row['img_dest'].'" height=80px>
                        <p class="item_descr top description">'.$row['description'].'</p>
                        <p class="item_descr num_in_stock">Number in Stock: '.$row['num_in_stock'].'</p>
                        <p class="item_descr unit_price">Unit Price: $'.$row['unit_price'].'</p>
                        <p class="num_to_purch">Number to Purchase</p>
                        <form method="POST" action="Includes/purchaseitem_inc.php">
                        <input type="text" name="num_to_purch" class="input">
                        <button class="button" name="purchase_item" type="submit" value='.$row['item_id'].'>Add to Cart</button>
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