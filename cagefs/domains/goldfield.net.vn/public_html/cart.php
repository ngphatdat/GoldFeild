<?php
include_once('header.php');
session_start(); // Đảm bảo session bắt đầu ở đây

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Yêu cầu đăng nhập (Login Required)</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container mt-5">
      <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Bạn cần đăng nhập để tiếp tục!</h4>
        <p>Để xem giỏ hàng của bạn, vui lòng <a href="user_login.php">đăng nhập</a> hoặc <a href="user_register.php">đăng ký</a> nếu bạn chưa có tài khoản.</p>
        <hr>
        <p class="mb-0">Quay lại <a href="products.php">trang sản phẩm</a> để tiếp tục mua sắm.</p>
      </div>
    </div>
    <?php include('footer.php'); ?>
    </body>
    </html>
    <?php
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giỏ hàng của bạn (Your Shopping Cart)</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 1600px;
      margin: 0 auto;
    }
    .btn-custom {
      display: inline-block;
      padding: 10px 20px;
      margin: 5px;
      font-size: 16px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, box-shadow 0.3s;
    }
    .btn-custom-success {
      background-color: #28a745;
      color: #fff;
    }
    .btn-custom-success:hover {
      background-color: #218838;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-custom-primary {
      background-color: #007bff;
      color: #fff;
    }
    .btn-custom-primary:hover {
      background-color: #0056b3;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-custom-danger {
      background-color: #dc3545;
      color: #fff;
    }
    .btn-custom-danger:hover {
      background-color: #c82333;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .btn-container {
      text-align: center;
      margin-top: 20px;
    }
    .table-responsive {
      margin-top: 20px;
    }
    .table th, .table td {
      text-align: center;
      white-space: nowrap;
      font-size: 10px; /* Kích thước chữ trong bảng nhỏ hơn */
    }
    .table thead th {
      font-size: 12px; /* Kích thước chữ của tiêu đề lớn hơn một chút */
    }
    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: auto;
      }
      .table th, .table td {
        font-size: 12px; /* Kích thước chữ nhỏ hơn trên thiết bị di động */
      }
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <h2>Giỏ hàng của bạn</h2>
  <form action="cart_remove_selected.php" method="POST">
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Chọn</th>
            <th>Sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $total_price = 0;
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
              foreach ($_SESSION['cart'] as $product_id => $product):
                $item_total = $product['price'] * $product['quantity'];
                $total_price += $item_total;
                ?>
                <tr>
                  <td><input type="checkbox" name="product_ids[]" value="<?= htmlspecialchars($product_id) ?>"></td>
                  <td><?= htmlspecialchars($product['name']) ?></td>
                  <td><?= number_format($product['price'], 0, '.', ',') ?> VND</td>
                  <td><?= htmlspecialchars($product['quantity']) ?></td>
                  <td><?= number_format($item_total, 0, '.', ',') ?> VND</td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="4" class="text-right">
                  <strong>Tổng cộng (Total):</strong>
                </td>
                <td><?= number_format($total_price, 0, '.', ',') ?> VND</td>
              </tr>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center">Giỏ hàng của bạn trống (Your cart is empty)</td>
              </tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="btn-container">
      <button type="submit" class="btn btn-custom btn-custom-danger">Xóa đã chọn (Remove Selected)</button>
    </div>
  </form>

  <div class="container mt-5">
    <h1>Thông tin giao hàng</h1>
    <form action="cart_checkout.php" method="POST">
      <div class="form-group">
        <label for="fullname">Họ và tên</label>
        <input type="text" class="form-control" id="fullname" name="fullname" required>
      </div>
      <div class="form-group">
        <label for="address">Địa chỉ</label>
        <input type="text" class="form-control" id="address" name="address" required>
      </div>
      <div class="form-group">
        <label for="phone">Số điện thoại</label>
        <input type="tel" class="form-control" id="phone" name="phone" required pattern="[0-9]{10,11}">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="btn-container">
        <button type="submit" class="btn btn-custom btn-custom-success">Xác nhận đơn hàng</button>
        <a href="products.php" class="btn btn-custom btn-custom-primary">Tiếp tục mua sắm</a>
      </div>
    </form>
  </div>

  <?php include('footer.php'); ?>
</div>
</body>
</html>
