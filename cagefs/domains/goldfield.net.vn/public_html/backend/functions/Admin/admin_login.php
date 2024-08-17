<?php
session_start();
include_once('connectdb.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone_number = trim($_POST['phone_number']);
    $password = $_POST['password'];
    // Kiểm tra định dạng số điện thoại
    if (!preg_match('/^\d{10}$/', $phone_number)) {
        $error_message = 'Số điện thoại không hợp lệ.';
    } else {
        // Mã hóa mật khẩu bằng SHA-256 để kiểm tra
        $hashed_password = hash('sha256', $password);

        // Sử dụng prepared statement để tránh SQL injection
        $stmt = $conn->prepare("SELECT id, fullname, role_id FROM users WHERE phone_number = ? AND password = ? LIMIT 1");
        $stmt->bind_param("ss", $phone_number, $hashed_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Kiểm tra role_id
            if ($user['role_id'] == 99) {
                // Đăng nhập thành công, lưu thông tin vào session
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_name'] = $user['fullname'];
                $_SESSION['role_id'] = $user['role_id'];
                
                header('Location: index.php'); // Điều hướng tới trang dashboard của admin
                exit();
            } else {
                $error_message = 'Bạn không có quyền truy cập trang quản trị.';
            }
        } else {
            $error_message = 'Số điện thoại hoặc mật khẩu không đúng.';
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: block;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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
    <h2>Admin Login</h2>
    <?php if (!empty($error_message)): ?>
        <div class="message error"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>
    <form action="admin_login.php" method="POST">
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
</div>
</body>
</html>
