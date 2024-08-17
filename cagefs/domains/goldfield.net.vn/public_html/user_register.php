<?php
include_once('connectdb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $fullname = $_POST['fullname'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $date_of_birth = $_POST['date_of_birth'];

    // Mã hóa mật khẩu bằng SHA-256
    $hashed_password = hash('sha256', $password);

    // Kiểm tra dữ liệu đầu vào
    if (empty($fullname) || empty($phone_number) || empty($address) || empty($password) || empty($confirm_password)) {
        $error_message = 'Vui lòng điền đầy đủ thông tin.';
    } elseif ($password !== $confirm_password) {
        $error_message = 'Mật khẩu xác nhận không khớp.';
    } elseif (!preg_match('/^\d{10,}$/', $phone_number)) {
        $error_message = 'Số điện thoại phải có ít nhất 10 chữ số.';
    } elseif (strlen($password) < 8) {
        $error_message = 'Mật khẩu phải có ít nhất 8 ký tự.';
    } else {
        // Kiểm tra xem số điện thoại đã tồn tại chưa
        $sql_check = "SELECT id FROM users WHERE phone_number = '$phone_number' LIMIT 1";
        $result_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result_check) > 0) {
            $error_message = 'Số điện thoại đã tồn tại.';
        } else {
            // Chèn dữ liệu vào cơ sở dữ liệu
            $sql_insert = "INSERT INTO users (fullname, phone_number, address, password, date_of_birth, created_at, role_id)
                           VALUES ('$fullname', '$phone_number', '$address', '$hashed_password', '$date_of_birth', NOW(), 1)";

            if (mysqli_query($conn, $sql_insert)) {
                $success_message = 'Đăng ký thành công. Bạn có thể đăng nhập ngay.';
            } else {
                $error_message = 'Có lỗi xảy ra. Vui lòng thử lại sau.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
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
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Đăng Ký</h2>
    <?php if (!empty($error_message)): ?>
        <div class="message error"><?= htmlspecialchars($error_message) ?></div>
    <?php elseif (!empty($success_message)): ?>
        <div class="message success"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>
    <form action="user_register.php" method="POST">
        <div class="form-group">
            <label for="fullname">Họ và tên:</label>
            <input type="text" name="fullname" id="fullname" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Số điện thoại:</label>
            <input type="text" name="phone_number" id="phone_number" required>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" id="address" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu:</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </div>
        <div class="form-group">
            <label for="date_of_birth">Ngày sinh:</label>
            <input type="date" name="date_of_birth" id="date_of_birth">
        </div>
        <div class="form-group">
            <input type="submit" value="Đăng Ký">
        </div>
    </form>
    <p>Đã có tài khoản? <a href="user_login.php">Đăng nhập ngay</a></p>
</div>
</body>
</html>
