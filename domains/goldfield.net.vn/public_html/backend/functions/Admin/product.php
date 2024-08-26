<?php
session_start();

// Kiểm tra quyền truy cập
if (!isset($_SESSION['admin_id']) || $_SESSION['role_id'] != 99) {
    // Nếu không có quyền truy cập, chuyển hướng người dùng đến trang đăng nhập
    header("Location: admin_login.php");
    exit();
}

include 'connectdb.php';
include 'header.php';

// Xử lý tìm kiếm sản phẩm
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Xử lý phân trang
$itemsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
$offset = $page * $itemsPerPage;

// Xử lý sắp xếp
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
$order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc';
$nextOrder = $order === 'asc' ? 'desc' : 'asc';

// Truy vấn để lấy số lượng sản phẩm
$sqlCount = "SELECT COUNT(*) as total FROM products WHERE name LIKE ?";
$stmtCount = $conn->prepare($sqlCount);
$searchKeyword = '%' . $keyword . '%';
$stmtCount->bind_param("s", $searchKeyword);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$rowCount = $resultCount->fetch_assoc();
$totalItems = $rowCount['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

// Truy vấn để lấy danh sách sản phẩm với sắp xếp
$sql = "SELECT * FROM products WHERE name LIKE ? ORDER BY $sort $order LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $searchKeyword, $itemsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();
$uploadFileDir = '../../assets/uploads/products/';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .rounded-square {
            border-radius: 0.25rem;
        }
        .sortable th a {
            color: black;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h1>Quản lý Sản phẩm</h1>

    <!-- Form tìm kiếm -->
    <div class="row mb-3">
        <div class="col-md-8">
            <form method="get" action="">
                <input type="text" class="form-control search-input" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Tìm sản phẩm">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
        </div>
            </form>
    </div>

    <!-- Thêm sản phẩm mới -->
    <div class="row mb-3">
        <div class="col-md-8">
            <a href="add_product.php" class="btn btn-success">Thêm sản phẩm mới</a>
        </div>
    </div>

    <!-- Bảng sản phẩm -->
    <table class="table">
        <thead class="table-light sortable">
            <tr>
                <th><a href="?keyword=<?php echo urlencode($keyword); ?>&sort=id&order=<?php echo $nextOrder; ?>">ID</a></th>
                <th><a href="?keyword=<?php echo urlencode($keyword); ?>&sort=name&order=<?php echo $nextOrder; ?>">Tên</a></th>
                <th><a href="?keyword=<?php echo urlencode($keyword); ?>&sort=price&order=<?php echo $nextOrder; ?>">Giá</a></th>
                <th><a href="?keyword=<?php echo urlencode($keyword); ?>&sort=old_price&order=<?php echo $nextOrder; ?>">Giá cũ</a></th>
                <th>Khuyến mãi</th>
                <th>Ảnh đại diện</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo number_format($row['price']); ?> VNĐ</td>
                        <td><?php echo number_format($row['old_price']); ?> VNĐ</td>
                        <td>
                            <input type="checkbox" disabled <?php echo $row['promotion'] ? 'checked' : ''; ?>>
                        </td>
                        <td>
                            <?php if ($row['thumbnail']): ?>
                                <img src="<?php echo $uploadFileDir . htmlspecialchars($row['thumbnail']); ?>" class="rounded-square" alt="Thumbnail" width="100" height="100">
                            <?php else: ?>
                                Chưa có ảnh
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="product_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Sửa</a>
                                <a href="product_delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')">Xóa</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Không có sản phẩm nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 0): ?>
                    <li class="page-item"><a class="page-link" href="?keyword=<?php echo urlencode($keyword); ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>&page=0">Đầu</a></li>
                    <li class="page-item"><a class="page-link" href="?keyword=<?php echo urlencode($keyword); ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>&page=<?php echo $page - 1; ?>"><i class="fa fa-chevron-left"></i></a></li>
                <?php endif; ?>
                <?php for ($i = 0; $i < $totalPages; $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?keyword=<?php echo urlencode($keyword); ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>&page=<?php echo $i; ?>"><?php echo $i + 1; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $totalPages - 1): ?>
                    <li class="page-item"><a class="page-link" href="?keyword=<?php echo urlencode($keyword); ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>&page=<?php echo $page + 1; ?>"><i class="fa fa-chevron-right"></i></a></li>
                    <li class="page-item"><a class="page-link" href="?keyword=<?php echo urlencode($keyword); ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>&page=<?php echo $totalPages - 1; ?>">Cuối</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>
