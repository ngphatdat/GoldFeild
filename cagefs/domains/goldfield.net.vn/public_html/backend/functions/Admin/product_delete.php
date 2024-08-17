<?php
session_start(); // Khởi động phiên

// Kiểm tra xem người dùng đã đăng nhập chưa và có quyền truy cập không
if (!isset($_SESSION['admin_id']) || $_SESSION['role_id'] != 99) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu không có quyền
    exit();
}

include 'connectdb.php';

// Kiểm tra xem ID sản phẩm có được gửi không
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);

    // Truy vấn để lấy thông tin sản phẩm trước khi xóa
    $sqlSelect = "SELECT thumbnail FROM products WHERE id = ?";
    $stmtSelect = $conn->prepare($sqlSelect);
    $stmtSelect->bind_param("i", $productId);
    $stmtSelect->execute();
    $resultSelect = $stmtSelect->get_result();
    
    if ($resultSelect->num_rows > 0) {
        $row = $resultSelect->fetch_assoc();
        $thumbnail = $row['thumbnail'];

        // Xóa sản phẩm khỏi cơ sở dữ liệu
        $sqlDelete = "DELETE FROM products WHERE id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $productId);
        
        if ($stmtDelete->execute()) {
            // Xóa ảnh nếu có
            if ($thumbnail && file_exists('../../assets/uploads/products/' . $thumbnail)) {
                unlink('../../assets/uploads/products/' . $thumbnail);
            }
            
            $_SESSION['message'] = "Sản phẩm đã được xóa thành công.";
        } else {
            $_SESSION['message'] = "Có lỗi xảy ra khi xóa sản phẩm.";
        }
    } else {
        $_SESSION['message'] = "Sản phẩm không tồn tại.";
    }
    
    $stmtSelect->close();
    $stmtDelete->close();
} else {
    $_SESSION['message'] = "ID sản phẩm không hợp lệ.";
}

$conn->close();

// Chuyển hướng về trang danh sách sản phẩm
header("Location: product.php"); // Thay đổi 'product_list.php' nếu cần
exit();
?>
