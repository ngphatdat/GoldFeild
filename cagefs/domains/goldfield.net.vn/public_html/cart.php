<?php
include_once('header.php');
session_start(); // Ensure session starts here

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
  <title>Giỏ hàng của bạn</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 1600px;
      margin: 0 auto;
    }

    .table-responsive {
      margin-top: 20px;
    }
    .table th, .table td {
      text-align: center;
      white-space: nowrap;
      font-size: 10px; /* Smaller font size for table */
    }
    .table thead th {
      font-size: 12px; /* Slightly larger font size for table headers */
    }
    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: auto;
      }
      .table th, .table td {
        font-size: 12px; /* Smaller font size on mobile devices */
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
                <td colspan="5" class="text-center">Giỏ hàng của bạn trống </td>
              </tr>
            <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="btn-container">
      <button type="submit" class="btn btn-danger">Xóa đã chọn </button>
    </div>
  </form>
  <div class="alert alert-info promo-alert">
    <strong>Khuyến mãi:</strong> Giao hàng miễn phí cho hóa đơn từ 100.000 VNĐ trở lên!
</div>

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
      <div class="btn-container">
        <button type="submit" class="btn btn-success">Xác nhận đơn hàng</button>
        <a href="products.php" class="btn btn-primary">Tiếp tục mua sắm</a>
      </div>
    </form>
    
  </div>
  <?php include('footer.php'); ?>
</div>
</body>
</html>
