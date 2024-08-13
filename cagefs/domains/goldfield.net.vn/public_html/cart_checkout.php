<?php
session_start();
include_once('connectdb.php'); // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment_method'];
    $note = ''; // Nếu có trường ghi chú trong form

    // Tính tổng tiền đơn hàng
    $total_money = 0;
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $total_money += $product['price'] * $product['quantity'];
    }

    // Lưu đơn hàng vào bảng orders
    $query = "INSERT INTO orders (fullname, address, phone_number, email, note, total_money, payment_method, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssds', $fullname, $address, $phone, $email, $note, $total_money, $payment_method);
    $stmt->execute();
    $order_id = $stmt->insert_id; // Lấy ID của đơn hàng mới

    // Lưu chi tiết đơn hàng vào bảng order_details
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $product_name = $product['name'];
        $product_price = $product['price'];
        $product_quantity = $product['quantity'];
        $item_total = $product_price * $product_quantity;

        $query = "INSERT INTO order_details (order_id, product_id, price, number_of_products, total_money) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iidid', $order_id, $product_id, $product_price, $product_quantity, $item_total);
        $stmt->execute();
    }

    // Xóa giỏ hàng sau khi lưu đơn hàng
    unset($_SESSION['cart']);

    // Chuyển hướng đến trang cảm ơn hoặc xác nhận
    header('Location: cart_thankyou.php');
    exit();
}
?>
