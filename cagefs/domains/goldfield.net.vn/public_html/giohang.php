<?php
include_once('header.php');
include_once('connectdb.php');
// Kiểm tra nếu người dùng đã đăng nhập, nếu chưa thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
// Xử lý việc cập nhật giỏ hàng
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $product_id => $quantity) {
        if ($quantity > 0) {
            foreach ($_SESSION['gioHang'] as &$item) {
                if ($item['id'] == $product_id) {
                    $item['soluong'] = intval($quantity);
                    break;
                }
            }
        }
    }
}
// Xử lý việc xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    foreach ($_SESSION['gioHang'] as $key => $item) {
        if ($item['id'] == $product_id) {
            unset($_SESSION['gioHang'][$key]);
            break;
        }
    }
    $_SESSION['gioHang'] = array_values($_SESSION['gioHang']); // Re-index array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>
        /* CSS chung */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            margin-bottom: 20px;
            color: #333;
        }
        h1 {
            font-size: 2rem;
        }
        h2 {
            font-size: 1.5rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        td img {
            width: 100px;
            border-radius: 8px;
        }
        .table-actions {
            text-align: center;
        }
        .table-actions a {
            display: inline-block;
            margin-right: 10px;
            color: #fff;
            text-decoration: none;
        }
        .table-actions a:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Giỏ hàng</h1>

    <?php if (!empty($_SESSION['gioHang'])): ?>
        <form action="giohang.php" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['gioHang'] as $item):
                        $total += $item['soluong'] * $item['gia'];
                    ?>
                        <tr>
                            <td><img src="backend/assets/uploads/products/<?=$item['thumbnail']?>" alt="<?=$item['name']?>"></td>
                            <td><?=$item['name']?></td>
                            <td><?=number_format($item['price'], 0, '.', ',')?> VND</td>
                            <td>
                                <input type="number" name="quantities[<?=$item['id']?>]" value="<?=$item['soluong']?>" min="1" max="10" style="width: 80px;">
                            </td>
                            <td><?=number_format($item['soluong'] * $item['gia'], 0, '.', ',')?> VND</td>
                            <td class="table-actions">
                                <a href="giohang.php?action=remove&id=<?=$item['id']?>" class="btn-primary">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" name="update_cart" class="btn-primary">Cập nhật giỏ hàng</button>
        </form>
        <h2>Tổng tiền: <?=number_format($total, 0, '.', ',')?> VND</h2>
        <a href="order.php" class="btn-primary">Tiến hành thanh toán</a>
    <?php else: ?>
        <p>Giỏ hàng của bạn hiện đang trống.</p>
    <?php endif; ?>
</div>

</body>
</html>
