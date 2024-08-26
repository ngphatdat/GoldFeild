<?php
include_once('header.php');
include_once('connectdb.php');

$id = intval($_GET['id']);

// Fetch product details
$sql = <<<EOT
SELECT p.id, p.name, p.price, p.thumbnail, p.description, p.category_id
FROM products AS p
WHERE p.id = $id
LIMIT 1;
EOT;

$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_array($result);

// Fetch all images of the product
$sql_images = <<<EOT
SELECT image_url
FROM product_images
WHERE product_id = $id;
EOT;

$images_result = mysqli_query($conn, $sql_images);
$images = [];
while ($image_row = mysqli_fetch_array($images_result)) {
    $images[] = $image_row['image_url'];
}

// Fetch similar products
$category_id = intval($product['category_id']);
$sql_similar_products = <<<EOT
SELECT p.id, p.name, p.price, 
       COALESCE(pi.image_url, p.thumbnail) AS thumbnail
FROM products AS p
LEFT JOIN product_images AS pi ON p.id = pi.product_id
WHERE p.category_id = $category_id AND p.id != $id
GROUP BY p.id
ORDER BY RAND()
LIMIT 4;
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
        <title><?= htmlspecialchars($product['name']) ?></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
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

        .product-detail {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
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

        .zoom {
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
            opacity: 0.7;
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

        .similar-products {
            margin-top: 40px;
        }

        .similar-products h4 {
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        .card-product {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-product img {
            width: 100%;
            height: 200px; /* Cố định chiều cao của hình ảnh */
            object-fit: contain;
            border-bottom: 1px solid #ddd;
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

        .card-product:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 576px) {
            .product-title {
                font-size: 1.5rem;
            }
            .product-price {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="product-detail">
        <div class="row">
            <div class="col-md-6">
                <!-- Slideshow -->
                <div id="productCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php if (empty($images)): ?>
                            <!-- If no images, use the thumbnail as the only image -->
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="backend/assets/uploads/products/<?=$product['thumbnail']?>" alt="Slide 1">
                            </div>
                        <?php else: ?>
                            <!-- Loop through the images array -->
                            <?php foreach ($images as $index => $image_url): ?>
                                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                    <img class="d-block w-100" src="backend/assets/uploads/products/<?=$image_url?>" alt="Slide <?= $index + 1 ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="product-title"><?=$product['name']?></h1>
                <div class="product-price" id="productPrice"><?=number_format($product['price'], 0, '.', ',')?> VND</div>
                <form action="cart_add.php" method="POST" id="frmGiohang">
                    <div class="form-group">
                        <label for="soluong">Số lượng:</label>
                        <input type="number" name="soluong" id="soluong" min="1" max="10" value="1" class="form-control">
                    </div>
                    <input type="hidden" name="product_id" value="<?=$product['id']?>">
                    <div class="form-group">
                        <label for="totalPrice">Thành tiền:</label>
                        <div id="totalPrice" class="form-control"><?=number_format($product['price'], 0, '.', ',')?> VND</div>
                    </div>
                    <button type="submit" name="them" class="btn-primary"><i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng</button>
                </form>
                <hr>
                <div class="product-description">
                    <strong>Mô tả sản phẩm:</strong> <?=$product['description']?>
                </div>
                <hr>
                <div class="alert alert-info promo-alert">
                    <strong>Khuyến mãi:</strong> Giao hàng miễn phí cho hóa đơn từ 1.000.000 VNĐ trở lên!
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
                    <a href="product_detail.php?id=<?=$product['id']?>">
                        <div class="card card-product">
                            <img class="card-img-top img-fluid" src="backend/assets/uploads/products/<?=$product['thumbnail']?>" alt="<?=$product['name']?>">
                            <div class="card-body">
                                <h5 class="card-title"><?=$product['name']?></h5>
                                <p class="card-text"><?=number_format($product['price'], '0', '.', ',')?> VND</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include_once('footer.php') ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Lấy giá gốc của sản phẩm
        var unitPrice = parseFloat($('#productPrice').text().replace(/[^0-9.,]/g, '').replace(',', '.'));
        
        $('#soluong').on('input', function() {
            var quantity = $(this).val();
            var totalPrice = unitPrice * quantity;
            $('#totalPrice').text(totalPrice.toLocaleString('en-US') + ' VND');
        });
    });
</script>

</body>
</html>
