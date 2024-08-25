<?php
ob_start(); // Bắt đầu đệm đầu ra
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

// Xử lý cập nhật trạng thái đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $orderId = intval($_POST['order_id']);
    $status = htmlspecialchars($_POST['status']);

    $sqlUpdate = "UPDATE orders SET status = ? WHERE id = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $status, $orderId);
    $stmtUpdate->execute();

    $_SESSION['message'] = 'Cập nhật trạng thái đơn hàng thành công.';
    header('Location: order.php'); // Điều hướng về trang danh sách đơn hàng
    ob_end_flush(); // Kết thúc đệm đầu ra
    exit;
}

// Xác định số lượng đơn hàng trên mỗi trang
$itemsPerPage = 10;

// Lấy số trang hiện tại từ URL
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = ($page > 0) ? $page : 1;

// Tính toán offset
$offset = ($page - 1) * $itemsPerPage;

// Xử lý sắp xếp
$sortColumn = isset($_GET['sort']) ? $_GET['sort'] : 'order_date';
$sortOrder = isset($_GET['order']) ? $_GET['order'] : 'DESC';
$validColumns = ['id', 'fullname', 'email', 'phone_number', 'address', 'order_date', 'total_money', 'status'];
$sortColumn = in_array($sortColumn, $validColumns) ? $sortColumn : 'order_date';
$sortOrder = ($sortOrder === 'ASC' || $sortOrder === 'DESC') ? $sortOrder : 'DESC';

// Lấy tổng số đơn hàng
$sqlCount = "SELECT COUNT(*) AS total FROM orders";
$resultCount = $conn->query($sqlCount);
$totalItems = $resultCount->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

// Lấy đơn hàng cho trang hiện tại
$sqlOrders = "SELECT * FROM orders ORDER BY $sortColumn $sortOrder LIMIT ?, ?";
$stmtOrders = $conn->prepare($sqlOrders);
$stmtOrders->bind_param("ii", $offset, $itemsPerPage);
$stmtOrders->execute();
$resultOrders = $stmtOrders->get_result();
$orders = $resultOrders->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đơn Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .status-pending { background-color: #f0ad4e; }
        .status-processing { background-color: #5bc0de; }
        .status-shipped { background-color: #5cb85c; }
        .status-delivered { background-color: #d9534f; }
        .status-cancelled { background-color: #f7f7f7; }
    </style>
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
                        <th><a href="?sort=id&order=<?php echo ($sortColumn == 'id' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">ID</a></th>
                        <th><a href="?sort=fullname&order=<?php echo ($sortColumn == 'fullname' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Họ và Tên</a></th>
                        <th><a href="?sort=email&order=<?php echo ($sortColumn == 'email' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Email</a></th>
                        <th><a href="?sort=phone_number&order=<?php echo ($sortColumn == 'phone_number' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Số Điện Thoại</a></th>
                        <th><a href="?sort=address&order=<?php echo ($sortColumn == 'address' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Địa Chỉ</a></th>
                        <th><a href="?sort=order_date&order=<?php echo ($sortColumn == 'order_date' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Ngày Đặt Hàng</a></th>
                        <th><a href="?sort=total_money&order=<?php echo ($sortColumn == 'total_money' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Tổng Tiền</a></th>
                        <th><a href="?sort=status&order=<?php echo ($sortColumn == 'status' && $sortOrder == 'ASC') ? 'DESC' : 'ASC'; ?>">Trạng Thái</a></th>
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
                            <td class="status-<?php echo htmlspecialchars($order['status']); ?>">
                                <form method="post" action="">
                                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id']); ?>">
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="pending" <?php echo ($order['status'] === 'pending') ? 'selected' : ''; ?>>Chờ xử lý</option>
                                        <option value="processing" <?php echo ($order['status'] === 'processing') ? 'selected' : ''; ?>>Đang xử lý</option>
                                        <option value="shipped" <?php echo ($order['status'] === 'shipped') ? 'selected' : ''; ?>>Đã giao</option>
                                        <option value="delivered" <?php echo ($order['status'] === 'delivered') ? 'selected' : ''; ?>>Hoàn thành</option>
                                        <option value="cancelled" <?php echo ($order['status'] === 'cancelled') ? 'selected' : ''; ?>>Hủy bỏ</option>
                                    </select>
                                </form>
                            </td>
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

<script>
    // Hiển thị thông báo khi có tin nhắn từ phiên
    <?php if (isset($_SESSION['message'])): ?>
        alert('<?php echo htmlspecialchars($_SESSION['message']); ?>');
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</script>
</body>
</html>

<?php
ob_end_flush(); // Kết thúc đệm đầu ra
$conn->close();
?>
