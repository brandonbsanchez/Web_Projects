<?php
    require 'header.php';
?>

<main>
    <?php echo '<li>Balance: $'.$_SESSION['balance'].'</li>'; ?>
    <?php echo '<li>Hello '.$_SESSION['username'].'!</li>'; ?>
</main>

<?php
    require 'footer.php';
?>