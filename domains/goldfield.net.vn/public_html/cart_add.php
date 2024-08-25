<?php
session_start();
include_once('connectdb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['soluong']);

    // Kiểm tra xem giỏ hàng đã tồn tại hay chưa
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    if (isset($_SESSION['cart'][$product_id])) {
        // Nếu sản phẩm đã tồn tại, tăng số lượng
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Nếu sản phẩm chưa tồn tại, thêm mới vào giỏ hàng
        $sql = "SELECT id, name, price FROM products WHERE id = $product_id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($result);

        if ($product) {
            $_SESSION['cart'][$product_id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity
            ];
        }
    }

    // Chuyển hướng về trang chi tiết sản phẩm hoặc trang giỏ hàng
    header("Location: cart.php");
    exit();
}
?>
