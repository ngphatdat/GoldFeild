<?php
session_start();
include 'connectdb.php';

if (!isset($_SESSION['admin_id']) || $_SESSION['role_id'] != 99) {
    die('Bạn không có quyền truy cập vào trang này.');
}

// Lấy ID người dùng từ URL
$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy thông tin người dùng từ cơ sở dữ liệu
$sqlUser = "SELECT * FROM users WHERE id=?";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bind_param("i", $userId);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$user = $resultUser->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cập nhật thông tin người dùng
    $fullname = $_POST['fullname'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    
    // Cập nhật thông tin cơ bản
    $sqlUpdate = "UPDATE users SET fullname=?, phone_number=?, address=?, date_of_birth=? WHERE id=?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssssi", $fullname, $phone_number, $address, $date_of_birth, $userId);
    $stmtUpdate->execute();

    // Kiểm tra và cập nhật mật khẩu nếu có
    if (!empty($_POST['new_password']) && $_POST['new_password'] === $_POST['confirm_password']) {
        // Mã hóa mật khẩu bằng SHA-256
        $new_password = hash('sha256', $_POST['new_password']);
        $sqlPasswordUpdate = "UPDATE users SET password=? WHERE id=?";
        $stmtPasswordUpdate = $conn->prepare($sqlPasswordUpdate);
        $stmtPasswordUpdate->bind_param("si", $new_password, $userId);
        $stmtPasswordUpdate->execute();
    }

    if ($stmtUpdate->affected_rows > 0 || (isset($stmtPasswordUpdate) && $stmtPasswordUpdate->affected_rows > 0)) {
        // Thực hiện chuyển hướng và hiển thị thông báo
        echo '<script>
            alert("Cập nhật thành công!");
            window.location.href = "user.php";
        </script>';
        exit();
    } else {
        echo '<script>alert("Cập nhật không thành công. Vui lòng kiểm tra lại.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Người Dùng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-4">
    <h1>Sửa Người Dùng</h1>
    <?php if ($user): ?>
        <form method="post" action="">
            <div class="form-group">
                <label>Họ và Tên</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
            </div>
            <div class="form-group">
                <label>Số Điện Thoại</label>
                <input type="text" name="phone_number" class="form-control" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            </div>
            <div class="form-group">
                <label>Địa Chỉ</label>
                <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address']); ?>" required>
            </div>
            <div class="form-group">
                <label>Ngày Sinh</label>
                <input type="date" name="date_of_birth" class="form-control" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>" required>
            </div>
            <div class="form-group">
                <label>Mật Khẩu Mới</label>
                <input type="password" name="new_password" class="form-control" placeholder="Nhập mật khẩu mới (nếu muốn)" autocomplete="new-password">
            </div>
            <div class="form-group">
                <label>Xác Nhận Mật Khẩu</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu mới (nếu có)">
            </div>
            <button type="submit" class="btn btn-success">Cập Nhật</button>
        </form>
    <?php else: ?>
        <p>Không tìm thấy người dùng.</p>
    <?php endif; ?>
</div>
</body>
</html>

<?php
$conn->close();
?>
