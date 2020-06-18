<?php
    require 'header.php';
?>

<main>
    <h1>Your Cart</h1>
    <div id="container">
        <?php
            include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

            $sql = 'SELECT * FROM bsanchez_carts c JOIN bsanchez_items i ON c.item_id = i.item_id WHERE user_id=?;'; //Gets only for user logged in
            $statement = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($statement, $sql)) {
                echo "Failed sql";
            }
            else {
                mysqli_stmt_bind_param($statement, 'i', $_SESSION['user_id']);
                mysqli_stmt_execute($statement);
                $result = mysqli_stmt_get_result($statement);
                $cart_total = 0;
                
                while($row = mysqli_fetch_assoc($result)) { //Each one is an item card
                    echo '<div class="store_card" id="item_'.$row['item_id'].'">
                    <h2>'.$row['name'].'</h2>
                    <div class="bottom_card">
                        <img src="Uploads/Item/'.$row['img_dest'].'" height=80px>
                        <p class="item_descr top description">'.$row['description'].'</p>
                        <p class="item_descr num_in_stock">Number in Stock: '.$row['quantity'].'</p>
                        <p class="item_descr unit_price">Price: $'.$row['unit_price'].'</p>
                        <form method="POST" action="Includes/removeitem_inc.php">
                        <button class="button delete" type="submit" name="remove_item" value='.$row['item_id'].'>Remove Item</button>
                        </form>
                    </div>
                    </div>';

                    $cart_total += $row['quantity'] * $row['unit_price'];
                }
                $format_cart = number_format((float)$cart_total, 2, '.', '');
                $_SESSION['cart_total'] = $cart_total;
            }
        ?>
        <div class="store_card">
            <h2>Add Balance</h2>
            <div class="bottom_card">
                <form method="POST" action="Includes/addbalance_inc.php">
                    <p id="amount_add">Amount to Add</p>
                    <input class="input" type="text" name="dollars"><br>
                    <?php echo '<p id="current_balance">Current Balance: $'. number_format((float)$_SESSION['balance'], 2, '.', '').'</p>'; ?>
                    <button class="button" id="add_balance" type="submit" name="add_balance">Add To Balance</button><br>
                </form>
            </div>
        </div>

        <div class="store_card">
            <h2>Purchase Items</h2>
            <div class="bottom_card">
                <a href="pastorders.php">View Past Orders</a>
                <?php echo '<p id="cart_total">Cart Total:   $'.$format_cart.'</p>'; ?>
                <form method="POST" action="Includes/purchase_inc.php">
                    <button class="button" id="purchase" type="submit" name="purchase">Purchase</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
    require 'footer.php';
?>