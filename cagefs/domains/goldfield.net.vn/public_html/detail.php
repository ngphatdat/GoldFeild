<?php
include_once('header.php');
include_once('connectdb.php');

$id = intval($_GET['id']);

// Lấy thông tin sản phẩm hiện tại
$sql = <<<EOT
SELECT p.id, p.name, p.price, p.thumbnail, p.description, p.category_id
FROM products AS p
LEFT JOIN product_images AS i ON p.id = i.product_id
WHERE p.id = $id
LIMIT 1;
EOT;

$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_array($result);

// Lấy các sản phẩm cùng danh mục
$category_id = intval($product['category_id']);
$sql_similar_products = <<<EOT
SELECT p.id, p.name, p.price, p.thumbnail
FROM products AS p
WHERE p.category_id = $category_id AND p.id != $id
ORDER BY RAND()
LIMIT 5;
EOT;

$similar_products_result = mysqli_query($conn, $sql_similar_products);
$similar_products = [];
while ($row = mysqli_fetch_array($similar_products_result)) {
    $similar_products[] = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'price' => $row['price'],
        'thumbnail' => $row['thumbnail'],
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>

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
        }

        .card-product {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .card-product:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .card-product img {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .card-text {
            color: red;
            font-weight: bold;
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
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .zoom {
            background-position: 50% 50%;
            position: relative;
            width: 100%;
            overflow: hidden;
            cursor: zoom-in;
            margin-bottom: 15px;
        }

        .zoom img {
            width: 100%;
            display: block;
            transition: opacity 0.5s ease;
        }

        .zoom:hover img {
            opacity: 0;
        }

        .product-detail {
            margin-top: 20px;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .product-title {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .product-price {
            color: red;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .product-description {
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .similar-products {
            margin-top: 40px;
        }

        .similar-products h4 {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="product-detail">
        <div class="row">
            <div class="col-md-6">
                <figure class="zoom" style="background:url('backend/assets/uploads/products/<?=$product['thumbnail']?>')" onmousemove="zoom(event)" ontouchmove="zoom(event)">
                    <img src="backend/assets/uploads/products/<?=$product['thumbnail']?>" alt="<?=$product['name']?>">
                </figure>
            </div>
            <div class="col-md-6">
                <h1 class="product-title"><?=$product['name']?></h1>
                <div class="product-price"><?=number_format($product['price'], 0, '.', ',')?> VND</div>
                <form action="giohang.php" method="POST" id="frmGiohang">
                    <div class="form-group">
                        <label for="soluong">Số lượng:</label>
                        <input type="number" name="soluong" id="soluong" min="1" max="10" value="1" class="form-control">
                    </div>
                    <input type="hidden" name="product_id" value="<?=$product['id']?>">
                    <button type="submit" name="them" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng</button>
                </form>
                <hr>
                <div class="product-description">
                    <strong>Mô tả sản phẩm:</strong> <?=$product['description']?>
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm tương tự -->
    <div class="similar-products">
        <h4>Sản phẩm tương tự</h4>
        <div class="row">
            <?php foreach ($similar_products as $product): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="detail.php?id=<?=$product['id']?>">
                        <div class="card card-product">
                            <img class="card-img-top img-fluid" src="backend/assets/uploads/products/<?=$product['thumbnail']?>" alt="<?=$product['name']?>">
                            <div class="card-body">
                                <h5 class="card-title"><?=$product['name']?></h5>
                                <p class="card-text" style="color: red;"><?=number_format($product['price'], '0', '.', ',')?> VND</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    function zoom(e) {
        var zoomer = e.currentTarget;
        e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX;
        e.offsetY ? offsetY = e.offsetY : offsetY = e.touches[0].pageY;
        x = (offsetX / zoomer.offsetWidth) * 100;
        y = (offsetY / zoomer.offsetHeight) * 100;
        zoomer.style.backgroundPosition = x + "% " + y + "%";
    }
</script>

</body>
</html>
