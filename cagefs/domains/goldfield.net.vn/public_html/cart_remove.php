<?php
session_start();

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    unset($_SESSION['cart'][$product_id]);
}

header("Location: cart.php");
exit();
?>
