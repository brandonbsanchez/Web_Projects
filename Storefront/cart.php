<?php
    require 'header.php';
?>

<main>
    <h1>Your Cart</h1>
    <div id="container">
        <?php
            include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

            $sql = 'SELECT * FROM carts JOIN items ON carts.item_id = items.item_id WHERE user_id=?;'; //Gets only for user logged in
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
                        <p class="item_descr unit_price">Price: '.$row['unit_price'].'</p>
                        <form method="POST" action="Includes/removeitem_inc.php">
                        <button class="button delete" type="submit" name="remove_item" value='.$row['item_id'].'>Remove Item</button>
                        </form>
                    </div>
                    </div>';

                    $cart_total += $row['quantity'] * $row['unit_price'];
                }
                $_SESSION['cart_total'] = $cart_total;
            }
        ?>
    </div>
    <?php 
        echo '<p>Your Balance: $'.$_SESSION['balance'].'</p>';
        echo '<p>Cart Total:   $'.$_SESSION['cart_total'].'</p>'; 
    ?>
    <h3>Add Balance</h3>
    <form method="POST" action="Includes/addbalance_inc.php">
        <input type="text" name="dollars"><br>
        <button type="submit" name="add_balance">Add To Balance</button>
    </form>
    <form method="POST" action="Includes/purchase_inc.php">
        <button type="submit" name="purchase">Purchase Items</button>
    </form>
    <a href="pastorders.php">View Past Orders</a>
</main>

<?php
    require 'footer.php';
?>