<?php
session_start(); // Đảm bảo session bắt đầu ở đây
include_once('connectdb.php');
// Bật hiển thị lỗi
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Mã hóa mật khẩu
    $hashed_password = hash('sha256', $password);

    // Kiểm tra thông tin đăng nhập
    $sql = <<<EOT
    SELECT id, fullname FROM users
    WHERE phone_number = '$phone_number' AND password = '$hashed_password' AND is_active = 1
    LIMIT 1;
    EOT;

    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_array($result)) {
        // Đăng nhập thành công
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['fullname'];
        
        // Xóa đầu ra trước khi chuyển hướng
        ob_clean();
        
        header('Location: index.php'); // Chuyển hướng về trang chính
        exit();
    } else {
        $error_message = 'Số điện thoại hoặc mật khẩu không đúng.';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 400px;
            margin: 50px auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng Nhập</h2>
        <?php if (!empty($error_message)): ?>
            <div class="message error"><?= $error_message ?></div>
        <?php endif; ?>
        <form action="user_login.php" method="POST">
            <div class="form-group">
                <label for="phone_number">Số điện thoại:</label>
                <input type="text" name="phone_number" id="phone_number" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Đăng Nhập">
            </div>
        </form>
        <p>Chưa có tài khoản? <a href="user_register.php">Đăng ký ngay</a></p>
    </div>
</body>
<?php include_once('footer.php')?>
</html>
