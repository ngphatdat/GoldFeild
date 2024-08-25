<?php
session_start(); // Đảm bảo session bắt đầu ở đây

// Xóa tất cả các biến session
session_unset();

// Hủy bỏ session
session_destroy();

// Chuyển hướng về trang chính hoặc trang đăng nhập
header('Location: index.php'); // Hoặc bạn có thể chuyển hướng đến trang đăng nhập nếu muốn
exit();
?>
