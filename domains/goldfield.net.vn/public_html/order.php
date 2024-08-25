<?php
include_once('connectdb.php'); // Kết nối cơ sở dữ liệu

session_start();

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập để xem đơn hàng.";
    exit();
}

$user_id = $_SESSION['user_id'];

// Số đơn hàng mỗi trang
$limit = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Truy vấn đơn hàng của người dùng
$sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

// Tính tổng số đơn hàng của người dùng
$countSql = "SELECT COUNT(*) AS total FROM orders WHERE user_id = ?";
$countStmt = $conn->prepare($countSql);
$countStmt->bind_param("i", $user_id);
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Đóng kết nối
$stmt->close();
$countStmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đơn Hàng</title>
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
            margin-top: 20px;
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
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #007bff;
        }
        .pagination a.active {
            background-color: #007bff;
            color: #fff;
        }
        .pagination a:hover {
            background-color: #0056b3;
            color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border: 3px solid rgba(237, 169, 64, 1);
        }
    </style>
</head>
<body>
    <?php include_once('header.php'); ?>
    <div class="container">
        <h1 class="text-center">Danh Sách Đơn Hàng</h1>
        
        <?php if (!empty($orders)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Ngày Đặt Hàng</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo number_format($order['total_money'], 0, '.', ','); ?> VND</td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td><a href="order_detail.php?order_id=<?php echo htmlspecialchars($order['id']); ?>">Xem Chi Tiết</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Không có đơn hàng nào.</p>
        <?php endif; ?>
        
        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?=($page - 1)?>">« Trang trước</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?=$i?>" class="<?=($i == $page) ? 'active' : ''?>"><?=$i?></a>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?=($page + 1)?>">Trang sau »</a>
            <?php endif; ?>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
</body>
</html>
