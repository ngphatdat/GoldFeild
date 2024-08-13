<?php
include_once('connectdb.php'); // Kết nối cơ sở dữ liệu

// Lấy dữ liệu từ form tìm kiếm
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Số sản phẩm mỗi trang
$limit = 12;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Xây dựng câu truy vấn tìm kiếm
$sql = "SELECT p.id, p.name, p.price, i.image_url
        FROM products AS p
        LEFT JOIN product_images AS i ON p.id = i.product_id
        WHERE 1";

// Thêm điều kiện tìm kiếm theo từ khóa
if ($keyword) {
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $sql .= " AND p.name LIKE '%$keyword%'";
}

// Thêm điều kiện tìm kiếm theo danh mục
if ($category_id > 0) {
    $sql .= " AND p.category_id = $category_id";
}

// Tính tổng số sản phẩm phù hợp
$countSql = "SELECT COUNT(*) AS total
             FROM products AS p
             LEFT JOIN product_images AS i ON p.id = i.product_id
             WHERE 1";

if ($keyword) {
    $countSql .= " AND p.name LIKE '%$keyword%'";
}

if ($category_id > 0) {
    $countSql .= " AND p.category_id = $category_id";
}

$countResult = mysqli_query($conn, $countSql);
$totalRows = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRows / $limit);

// Thực hiện truy vấn để lấy sản phẩm với phân trang
$sql .= " GROUP BY p.id ORDER BY name LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
$sp = [];
while ($row = mysqli_fetch_array($result)) {
    $sp[] = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'price' => $row['price'],
        'image_url' => $row['image_url'], // Lấy URL hình ảnh từ bảng product_images
    );
}

// Đóng kết nối

// Lấy danh sách danh mục để hiển thị trong dropdown
$categoriesResult = mysqli_query($conn, "SELECT id, name FROM categories");
$categories = [];
while ($row = mysqli_fetch_assoc($categoriesResult)) {
    $categories[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLFFIELD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .card-product {
            margin: 0.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-product img {
            width: 100%;
            height: 200px; /* Cố định chiều cao hình ảnh */
            object-fit: cover
            /* Đảm bảo hình ảnh không bị biến dạng và lấp đầy khung */
        }
        .card-product .card-body {
            padding: 15px;
            text-align: center;
        }
        .card-title {
            margin: 0;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            color: red;
            font-size: 1rem;
            margin: 0.5rem 0;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #007bff;
        }
        .pagination a.active {
            background-color: #007bff;
            color: #fff;
        }
        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <?php include_once('header.php'); ?>
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">SẢN PHẨM CÔNG TY PHÂN PHỐI</h3>
                <hr>
                <div class="row">
                    <?php if (!empty($sp)): ?>
                        <?php foreach($sp as $product): ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <a href="product_detail.php?id=<?=$product['id']?>">
                                    <div class="card card-product">
                                        <img class="card-img-top img-fluid" src="backend/assets/uploads/products/<?=$product['image_url']?>" alt="<?=$product['name']?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?=$product['name']?></h5>
                                            <p class="card-text"><?=number_format($product['price'],'0','.',',')?> VND</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Không có sản phẩm nào phù hợp với tìm kiếm của bạn.</p>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?=($page - 1) . ($keyword ? '&keyword=' . urlencode($keyword) : '') . ($category_id ? '&category_id=' . $category_id : '') ?>">« Trang trước</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?=$i . ($keyword ? '&keyword=' . urlencode($keyword) : '') . ($category_id ? '&category_id=' . $category_id : '') ?>" class="<?=($i == $page) ? 'active' : ''?>"><?=$i?></a>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?=($page + 1) . ($keyword ? '&keyword=' . urlencode($keyword) : '') . ($category_id ? '&category_id=' . $category_id : '') ?>">Trang sau »</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <hr/>
    <div class="container-fluid">
        <?php include_once('footer.php') ?>
    </div>
</body>
</html>
