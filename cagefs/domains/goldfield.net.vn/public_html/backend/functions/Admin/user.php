<?php
session_start();
// Kiểm tra quyền truy cập
$showContent = true;
$message = '';
if (!isset($_SESSION['admin_id']) || $_SESSION['role_id'] != 99) {
    $showContent = false;
    $message = 'Bạn không có quyền truy cập vào trang này. Vui lòng đăng nhập với quyền truy cập phù hợp.';
}

include 'connectdb.php';
include 'header.php';

// Xác định số lượng người dùng trên mỗi trang
$itemsPerPage = 10;

// Lấy số trang hiện tại từ URL
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$page = ($page > 0) ? $page : 1;

// Lấy từ khóa tìm kiếm từ URL
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Tính toán offset
$offset = ($page - 1) * $itemsPerPage;

// Lấy tổng số người dùng
$sqlCount = "SELECT COUNT(*) AS total FROM users WHERE fullname LIKE ?";
$stmtCount = $conn->prepare($sqlCount);
$searchParam = "%$searchTerm%";
$stmtCount->bind_param("s", $searchParam);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$totalItems = $resultCount->fetch_assoc()['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

// Lấy người dùng cho trang hiện tại
$sqlUsers = "SELECT * FROM users WHERE fullname LIKE ? LIMIT ?, ?";
$stmtUsers = $conn->prepare($sqlUsers);
$stmtUsers->bind_param("sii", $searchParam, $offset, $itemsPerPage);
$stmtUsers->execute();
$resultUsers = $stmtUsers->get_result();
$users = $resultUsers->fetch_all(MYSQLI_ASSOC);

// Xử lý cập nhật role_id
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0; // Sửa tên từ admin_id thành user_id
    $roleId = isset($_POST['role_id']) ? intval($_POST['role_id']) : 0;

    if ($userId > 0 && $roleId >= 0) {
        $sqlUpdate = "UPDATE users SET role_id=? WHERE id=?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("ii", $roleId, $userId);
        $stmtUpdate->execute();
        
        if ($stmtUpdate->affected_rows > 0) {
            $message = 'Cập nhật role thành công!';
        } else {
            $message = 'Cập nhật role không thành công. Vui lòng kiểm tra lại.';
        }
    }
}

// Lấy danh sách các vai trò
$sqlRoles = "SELECT * FROM roles";
$resultRoles = $conn->query($sqlRoles);
$roles = $resultRoles->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-4">
    <?php if (!$showContent): ?>
        <div class="alert alert-warning"><?php echo htmlspecialchars($message); ?></div>
    <?php else: ?>
        <h1>Danh Sách Người Dùng</h1>

        <!-- Form Tìm Kiếm -->
        <form method="get" action="" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Nhập họ và tên để tìm kiếm..." value="<?php echo htmlspecialchars($searchTerm); ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                </div>
            </div>
        </form>

        <?php if ($users): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ và Tên</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th>Ngày Sinh</th>
                        <th>Facebook ID</th>
                        <th>Google ID</th>
                        <th>Role</th>
                        <th>Trạng Thái</th>
                        <th>Cập Nhật</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                            <td><?php echo htmlspecialchars($user['address']); ?></td>
                            <td><?php echo htmlspecialchars($user['date_of_birth']); ?></td>
                            <td><?php echo htmlspecialchars($user['facebook_account_id']); ?></td>
                            <td><?php echo htmlspecialchars($user['google_account_id']); ?></td>
                            <td><?php echo htmlspecialchars($user['role_id']); ?></td>
                            <td><?php echo $user['is_active'] ? 'Đang hoạt động' : 'Không hoạt động'; ?></td>
                            <td>
                                <!-- Form cập nhật role_id -->
                                <form method="post" action="" class="d-inline">
                                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                    <select name="role_id" class="form-control" required>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?php echo htmlspecialchars($role['id']); ?>"
                                                <?php echo $role['id'] == $user['role_id'] ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($role['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Cập Nhật</button>
                                </form>
                                <!-- Nút Sửa -->
                                <a href="user_edit.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-warning btn-sm mt-2">Sửa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Phân trang -->
            <nav>
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($searchTerm); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchTerm); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($searchTerm); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

        <?php else: ?>
            <p>Không có người dùng nào.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>
</body>
</html>

<?php
$conn->close();
?>
