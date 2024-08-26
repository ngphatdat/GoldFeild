<?php
session_start(); // Khởi động phiên
// Kiểm tra xem người dùng đã đăng nhập chưa và có quyền truy cập không
if (!isset($_SESSION['admin_id']) || $_SESSION['role_id'] != 99) {
    // Nếu không có quyền truy cập, chuyển hướng người dùng đến trang đăng nhập
    header("Location: admin_login.php");
    exit();
}
include 'connectdb.php';
include 'header.php';
// Lấy ID sản phẩm từ URL
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Đường dẫn thư mục ảnh
$uploadFileDir = '../../assets/uploads/products/';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý cập nhật sản phẩm
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category'];
    $count = $_POST['count']; // Số lượng tồn kho

    // Xử lý ảnh đại diện
    $thumbnail = $_POST['current_thumbnail']; // Lưu giữ ảnh hiện tại nếu không thay đổi
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['thumbnail']['tmp_name'];
        $fileName = $_FILES['thumbnail']['name'];
        $fileSize = $_FILES['thumbnail']['size'];
        $fileType = $_FILES['thumbnail']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $thumbnail = $newFileName;
        }
    }

    // Xóa các ảnh được chọn
    if (isset($_POST['delete_images'])) {
        foreach ($_POST['delete_images'] as $imgId) {
            $sqlDelete = "SELECT image_url FROM product_images WHERE id=?";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bind_param("i", $imgId);
            $stmtDelete->execute();
            $resultDelete = $stmtDelete->get_result();
            $img = $resultDelete->fetch_assoc();
            if ($img) {
                // Xóa tệp ảnh khỏi thư mục
                $imgPath = $uploadFileDir . basename($img['image_url']);
                if (file_exists($imgPath)) {
                    unlink($imgPath);
                }

                // Xóa bản ghi trong cơ sở dữ liệu
                $sqlDelete = "DELETE FROM product_images WHERE id=?";
                $stmtDelete = $conn->prepare($sqlDelete);
                $stmtDelete->bind_param("i", $imgId);
                $stmtDelete->execute();
            }
        }
    }

    // Thêm hình ảnh mới
    if (isset($_FILES['new_images']) && count($_FILES['new_images']['name']) > 0) {
        $fileCount = count($_FILES['new_images']['name']);
        for ($i = 0; $i < $fileCount; $i++) {
            $fileTmpPath = $_FILES['new_images']['tmp_name'][$i];
            $fileName = $_FILES['new_images']['name'][$i];
            $fileSize = $_FILES['new_images']['size'][$i];
            $fileType = $_FILES['new_images']['type'][$i];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $sqlInsert = "INSERT INTO product_images (product_id, image_url) VALUES (?, ?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param("is", $productId, $newFileName);
                $stmtInsert->execute();
            }
        }
    }

    // Cập nhật thông tin sản phẩm
    $sql = "UPDATE products SET name=?, price=?, description=?, category_id=?, count=?, thumbnail=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsiisi", $name, $price, $description, $category_id, $count, $thumbnail, $productId);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Sản phẩm đã được cập nhật thành công.</div>';
    } else {
        echo '<div class="alert alert-danger">Cập nhật sản phẩm thất bại. Vui lòng thử lại.</div>';
    }
}

// Lấy thông tin sản phẩm để hiển thị trong biểu mẫu
$sql = "SELECT * FROM products WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo '<div class="alert alert-danger">Sản phẩm không tồn tại.</div>';
    exit();
}

// Lấy danh sách các hình ảnh của sản phẩm
$sqlImages = "SELECT * FROM product_images WHERE product_id=?";
$stmtImages = $conn->prepare($sqlImages);
$stmtImages->bind_param("i", $productId);
$stmtImages->execute();
$resultImages = $stmtImages->get_result();
$images = $resultImages->fetch_all(MYSQLI_ASSOC);

// Lấy danh sách các danh mục
$sqlCategories = "SELECT * FROM categories";
$resultCategories = $conn->query($sqlCategories);
$categories = $resultCategories->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản phẩm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Sửa Sản phẩm</h1>

    <!-- Biểu mẫu sửa sản phẩm -->
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number"  id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="category">Danh mục:</label>
            <select id="category" name="category" class="form-control" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $product['category_id'] ? 'selected' : ''; ?>><?php echo htmlspecialchars($category['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="count">Số lượng tồn kho:</label>
            <input type="number" id="count" name="count" class="form-control" value="<?php echo htmlspecialchars($product['count']); ?>" required>
        </div>

        <div class="form-group">
            <label for="thumbnail">Ảnh đại diện:</label>
            <?php if (!empty($product['thumbnail'])): ?>
                <img src="<?php echo $uploadFileDir . htmlspecialchars($product['thumbnail']); ?>" alt="Thumbnail" width="100" height="100">
                <input type="hidden" name="current_thumbnail" value="<?php echo htmlspecialchars($product['thumbnail']); ?>">
            <?php else: ?>
                <?php if ($images): ?>
                    <p>Ảnh đại diện hiện tại (nếu có):</p>
                    <img src="<?php echo $uploadFileDir . htmlspecialchars($images[0]['image_url']); ?>" alt="Thumbnail" width="100" height="100">
                    <input type="hidden" name="current_thumbnail" value="<?php echo htmlspecialchars($images[0]['image_url']); ?>">
                <?php endif; ?>
            <?php endif; ?>
            <input type="file" id="thumbnail" name="thumbnail">
        </div>

        <div class="form-group">
            <label for="new_images">Thêm hình ảnh mới:</label>
            <input type="file" id="new_images" name="new_images[]" multiple>
        </div>

        <div class="form-group">
            <label>Chọn ảnh để xóa (nếu có):</label>
            <?php if ($images): ?>
                <?php foreach ($images as $img): ?>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="delete_images[]" value="<?php echo $img['id']; ?>">
                        <img src="<?php echo $uploadFileDir . htmlspecialchars($img['image_url']); ?>" alt="Image" width="100" height="100">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
    </form>
</div>
</body>
</html>

<?php
$conn->close();
?>
