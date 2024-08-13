<?php
session_start();
include_once('header.php');

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
        <p>Để xem giỏ hàng của bạn, vui lòng <a href="login.php">đăng nhập</a> hoặc <a href="register.php">đăng ký</a> nếu bạn chưa có tài khoản.</p>
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
</head>
<body>
<div class="container mt-5">
  <h1>Giỏ hàng của bạn (Your Shopping Cart)</h1>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Sản phẩm (Product)</th>
        <th>Đơn giá (Price)</th>
        <th>Số lượng (Quantity)</th>
        <th>Thành tiền (Subtotal)</th>
        <th>Hành động (Action)</th>
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
              <td><?= $product['name'] ?></td>
              <td><?= number_format($product['price'], 0, '.', ',') ?> VND</td>
              <td><?= $product['quantity'] ?></td>
              <td><?= number_format($item_total, 0, '.', ',') ?> VND</td>
              <td>
                <a href="cart_remove.php?id=<?= $product_id ?>" class="btn btn-danger">Xóa (Remove)</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="3" class="text-right">
              <strong>Tổng cộng (Total):</strong>
            </td>
            <td colspan="2"><?= number_format($total_price, 0, '.', ',') ?> VND</td>
          </tr>
        <?php else: ?>
          <tr>
            <td colspan="5" class="text-center">Giỏ hàng của bạn trống (Your cart is empty)</td>
          </tr>
        <?php endif; ?>
    </tbody>
  </table>

  <div class="container mt-5">
    <h1>Thông tin giao hàng (Shipping Information)</h1>
    <form action="cart_checkout.php" method="POST">
      <div class="form-group">
        <label for="fullname">Họ và tên (Full Name)</label>
        <input type="text" class="form-control" id="fullname" name="fullname" required>
      </div>
      <div class="form-group">
        <label for="address">Địa chỉ (Address)</label>
        <input type="text" class="form-control" id="address" name="address" required>
      </div>
      <div class="form-group">
        <label for="phone">Số điện thoại (Phone Number)</label>
        <input type="tel" class="form-control" id="phone" name="phone" required pattern="[0-9]{10,11}">  
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <button type="submit" class="btn btn-success">Xác nhận đơn hàng (Confirm Order)</button>
    </form>

    <a href="products.php" class="btn btn-primary">Tiếp tục mua sắm (Continue Shopping)</a>
  </div>
  
  <?php include('footer.php'); ?>
</div>
</body>
</html>
