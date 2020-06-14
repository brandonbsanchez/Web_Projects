<?php
    require 'header.php';
?>

<main>
    <h1 id="past_title">Your Past Orders</h1>
    <a id="back_link" href="cart.php">Back to Cart</a>
    <?php
        include_once 'includes/dbh_inc.php'; //So it doesn't get called twice

        $sql = 'SELECT * FROM orders o JOIN order_items oi ON o.order_id = oi.order_id JOIN items i ON i.item_id = oi.item_id 
        WHERE user_id=?;'; //Gets only for user logged in
        $statement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($statement, $sql)) {
            echo "Failed sql";
        }
        else {
            mysqli_stmt_bind_param($statement, 'i', $_SESSION['user_id']);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            $i = 0;
            while($row = mysqli_fetch_assoc($result)) { //Each one is an item card
                $order_id = $row['order_id'];
                if($i != 0){
                    if($past_order_id != $order_id) {
                        echo '</div>';
                        echo '<h3 class="order_date">Order On '.$row['date_time'].'</h3>';
                        echo '<div id="container">';
                    }
                }
                else {
                    echo '<h3 id="top_order" class="order_date">Order On '.$row['date_time'].'</h3>';
                    echo '<div id="container">';
                }
                echo '<div class="store_card" id="item_'.$row['item_id'].'">
                <h2>'.$row['name'].'</h2>
                <div class="bottom_card">
                    <img src="Uploads/Item/'.$row['img_dest'].'" height=80px>
                    <p class="item_descr top description">'.$row['description'].'</p>
                    <p class="item_descr num_in_stock">Number Purchased: '.$row['quantity'].'</p>
                    <p class="item_descr unit_price">Unit Price: $'.$row['unit_price'].'</p>
                </div>
                </div>';
                $past_order_id = $order_id;
                $i++;
            }
            echo '</div>';
        }
    ?>
</main>

<?php
    require 'footer.php';
?>