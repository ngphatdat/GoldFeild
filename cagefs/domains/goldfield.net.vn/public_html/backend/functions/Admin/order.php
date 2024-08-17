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

// Xác định số lượng đơn hàng trên mỗi trang
$itemsPerPage = 10;

// Lấy số trang hiện tại từ URL
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = ($page > 0) ? $page : 1;

// Tính toán offset
$offset = ($page - 1) * $itemsPerPage;

// Lấy tổng số đơn hàng
$sqlCount = "SELECT COUNT(*) AS total FROM orders";
$resultCount = $conn->query($sqlCount);
$totalItems = $resultCount->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

if ($showContent) {
    // Lấy đơn hàng cho trang hiện tại
    $sqlOrders = "SELECT * FROM orders ORDER BY order_date DESC LIMIT ?, ?";
    $stmtOrders = $conn->prepare($sqlOrders);
    $stmtOrders->bind_param("ii", $offset, $itemsPerPage);
    $stmtOrders->execute();
    $resultOrders = $stmtOrders->get_result();
    $orders = $resultOrders->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đơn Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-4">
    <?php if (!$showContent): ?>
        <div class="alert alert-warning"><?php echo htmlspecialchars($message); ?></div>
    <?php else: ?>
        <h1>Danh Sách Đơn Hàng</h1>
        <?php if ($orders): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ và Tên</th>
                        <th>Email</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th>Ngày Đặt Hàng</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($order['email']); ?></td>
                            <td><?php echo htmlspecialchars($order['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($order['address']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><?php echo number_format($order['total_money'], 2); ?> VNĐ</td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td><a href="order_detail.php?id=<?php echo htmlspecialchars($order['id']); ?>" class="btn btn-info btn-sm">Xem Chi Tiết</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Phân trang -->
            <nav>
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

        <?php else: ?>
            <p>Không có đơn hàng nào.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>

<?php
$conn->close();
?>
