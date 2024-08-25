<?php
session_start(); // Khởi động phiên

// Kiểm tra quyền truy cập
$showContent = true;
$message = '';
if (!isset($_SESSION['admin_id']) || $_SESSION['role_id'] != 99) {
    $showContent = false;
    $message = 'Bạn không có quyền truy cập vào trang này. Vui lòng đăng nhập với quyền truy cập phù hợp.';
}

include 'connectdb.php';
include 'header.php';

// Lấy ID đơn hàng từ URL
$orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Kiểm tra nếu ID hợp lệ
if ($orderId <= 0) {
    $showContent = false;
    $message = 'ID đơn hàng không hợp lệ.';
}

// Lấy thông tin đơn hàng
$sqlOrder = "SELECT * FROM orders WHERE id = ?";
$stmtOrder = $conn->prepare($sqlOrder);
$stmtOrder->bind_param("i", $orderId);
$stmtOrder->execute();
$resultOrder = $stmtOrder->get_result();
$order = $resultOrder->fetch_assoc();

if (!$order) {
    $showContent = false;
    $message = 'Không tìm thấy đơn hàng.';
}

// Lấy chi tiết đơn hàng
$sqlOrderDetails = "SELECT * FROM order_details WHERE order_id = ?";
$stmtOrderDetails = $conn->prepare($sqlOrderDetails);
$stmtOrderDetails->bind_param("i", $orderId);
$stmtOrderDetails->execute();
$resultOrderDetails = $stmtOrderDetails->get_result();
$orderDetails = $resultOrderDetails->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-4">
    <?php if (!$showContent): ?>
        <div class="alert alert-warning"><?php echo htmlspecialchars($message); ?></div>
    <?php else: ?>
        <h1>Chi Tiết Đơn Hàng #<?php echo htmlspecialchars($order['id']); ?></h1>
        <h3>Thông Tin Đơn Hàng</h3>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td><?php echo htmlspecialchars($order['id']); ?></td>
                </tr>
                <tr>
                    <th>Họ và Tên</th>
                    <td><?php echo htmlspecialchars($order['fullname']); ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo htmlspecialchars($order['email']); ?></td>
                </tr>
                <tr>
                    <th>Số Điện Thoại</th>
                    <td><?php echo htmlspecialchars($order['phone_number']); ?></td>
                </tr>
                <tr>
                    <th>Địa Chỉ</th>
                    <td><?php echo htmlspecialchars($order['address']); ?></td>
                </tr>
                <tr>
                    <th>Ngày Đặt Hàng</th>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                </tr>
                <tr>
                    <th>Tổng Tiền</th>
                    <td><?php echo number_format($order['total_money'], 2); ?> VNĐ</td>
                </tr>
                <tr>
                    <th>Trạng Thái</th>
                    <td><?php echo htmlspecialchars($order['status']); ?></td>
                </tr>
            </tbody>
        </table>

        <h3>Chi Tiết Sản Phẩm</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Đơn Hàng</th>
                    <th>ID Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng Tiền</th>
                    <th>Màu Sắc</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($orderDetails): ?>
                    <?php foreach ($orderDetails as $detail): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($detail['id']); ?></td>
                            <td><?php echo htmlspecialchars($detail['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($detail['product_id']); ?></td>
                            <td><?php echo number_format($detail['price'], 2); ?> VNĐ</td>
                            <td><?php echo htmlspecialchars($detail['number_of_products']); ?></td>
                            <td><?php echo number_format($detail['total_money'], 2); ?> VNĐ</td>
                            <td><?php echo htmlspecialchars($detail['color']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Không có chi tiết sản phẩm nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>

<?php
$conn->close();
ob_end_flush(); // Kết thúc đệm đầu ra
?>
