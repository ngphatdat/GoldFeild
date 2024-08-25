<?php
session_start(); // Khởi động phiên

// Kiểm tra xem người dùng đã đăng nhập chưa và có quyền truy cập không
$showContent = true;
$message = '';
if (!isset($_SESSION['admin_id']) || $_SESSION['role_id'] != 99) {
    // Đặt biến để hiển thị thông báo nếu chưa đăng nhập hoặc không có quyền
    $showContent = false;
    $message = 'Bạn không có quyền truy cập vào trang này. Vui lòng đăng nhập với quyền truy cập phù hợp.';
}

include 'connectdb.php';
include 'header.php';
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GOLD-FIELD <3 </title>
</head>

<body>


</body>
</html>