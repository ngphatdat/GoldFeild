<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_ids'])) {
    // Lấy danh sách sản phẩm cần xóa
    $product_ids = $_POST['product_ids'];

    // Xóa các sản phẩm khỏi giỏ hàng
    foreach ($product_ids as $product_id) {
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }
}

// Chuyển hướng lại trang giỏ hàng
header('Location: cart.php');
exit();
?>
