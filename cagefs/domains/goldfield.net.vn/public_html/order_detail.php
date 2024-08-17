<?php
include_once('connectdb.php'); // Kết nối cơ sở dữ liệu

session_start();

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập để xem chi tiết đơn hàng.";
    exit();
}

// Kiểm tra xem order_id có được truyền và hợp lệ không
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    echo "Đơn hàng không tồn tại.";
    exit();
}

$order_id = intval($_GET['order_id']);
$user_id = $_SESSION['user_id'];

// Truy vấn thông tin đơn hàng
$orderSql = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
$orderStmt = $conn->prepare($orderSql);

if (!$orderStmt) {
    die('Lỗi chuẩn bị câu lệnh SQL: ' . $conn->error);
}

$orderStmt->bind_param("ii", $order_id, $user_id);
$orderStmt->execute();
$orderResult = $orderStmt->get_result();

if ($orderResult->num_rows === 0) {
    echo "Đơn hàng không tồn tại hoặc bạn không có quyền xem đơn hàng này.";
    exit();
}

$order = $orderResult->fetch_assoc();

// Truy vấn chi tiết đơn hàng
$detailsSql = "SELECT od.*, p.name, p.thumbnail FROM order_details od
               JOIN products p ON od.product_id = p.id
               WHERE od.order_id = ?";
$detailsStmt = $conn->prepare($detailsSql);

if (!$detailsStmt) {
    die('Lỗi chuẩn bị câu lệnh SQL: ' . $conn->error);
}

$detailsStmt->bind_param("i", $order_id);
$detailsStmt->execute();
$detailsResult = $detailsStmt->get_result();

$orderDetails = [];
while ($row = $detailsResult->fetch_assoc()) {
    $orderDetails[] = $row;
}

// Đóng kết nối
$orderStmt->close();
$detailsStmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        table th {
            background-color: #007bff;
            color: white;
        }
        .back-link {
            margin-top: 20px;
            text-align: center;
        }
        .back-link a {
            text-decoration: none;
            color: #007bff;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include_once('header.php'); ?>
    <div class="container">
        <h1 class="text-center">Chi Tiết Đơn Hàng</h1>
        
        <p><strong>Ngày Đặt Hàng:</strong> <?php echo htmlspecialchars($order['order_date']); ?></p>
        <p><strong>Tổng Tiền:</strong> <?php echo number_format($order['total_money'], 0, '.', ','); ?> VND</p>
        <p><strong>Trạng Thái:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
        
        <?php if (!empty($orderDetails)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Hình Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderDetails as $detail): ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($detail['thumbnail']); ?>" alt="<?php echo htmlspecialchars($detail['name']); ?>" style="width: 100px; height: auto;"></td>
                            <td><?php echo htmlspecialchars($detail['name']); ?></td>
                            <td><?php echo number_format($detail['price'], 0, '.', ','); ?> VND</td>
                            <td><?php echo htmlspecialchars($detail['number_of_products']); ?></td>
                            <td><?php echo number_format($detail['total_money'], 0, '.', ','); ?> VND</td>
                            <!-- <td><?php echo htmlspecialchars($detail['color']); ?></td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có chi tiết đơn hàng nào.</p>
        <?php endif; ?>
        
        <div class="back-link">
            <a href="order.php">Quay lại danh sách đơn hàng</a>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>
