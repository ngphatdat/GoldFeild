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
$sql = "SELECT p.id, p.name, p.price, COALESCE(p.thumbnail, i.image_url) AS image_url
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
$sql .= " GROUP BY p.id ORDER BY p.name LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
$sp = [];
while ($row = mysqli_fetch_array($result)) {
    $sp[] = array(
        'id' => $row['id'],
        'name' => $row['name'],
        'price' => $row['price'],
        'image_url' => $row['image_url'], // Sử dụng image_url đã được xử lý
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
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .search-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .search-form input[type="text"], 
        .search-form select {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            flex: 1;
            min-width: 150px;
        }
        .search-form input[type="submit"] {
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            min-width: 120px;
        }
        .search-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .card-product {
            margin: 5px;
            margin-bottom: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .col-12.col-sm-6.col-md-4.col-lg-3 {
            margin-bottom: 10px;
        }
        .card-product img {
              width: 100%; 
             height: 200px; 
            object-fit: contain; 
        }
        .card-product .card-body {
            padding: 15px;
            text-align: center;
        }
        .card-title {
            margin: 0;
            color: black;
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
            border: 3px;
            border-top: 1px solid red;
            margin: 20px 0;
        }
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
                align-items: center;
            }
            .search-form input[type="text"], 
            .search-form select {
                width: 100%;
                max-width: 400px;
            }
            .search-form input[type="submit"] {
                width: 100%;
                max-width: 200px;
            }
            .product-heading {
            text-align: center; /* Canh giữa tiêu đề */
            margin-top: 1.2rem; /* Khoảng cách trên */
            position: relative; /* Để đường viền có thể được đặt chính xác */
            font-size: 1.7rem; /* Kích thước chữ, có thể thay đổi */
        }

            .product-heading::after {
                content: ""; /* Nội dung rỗng cho pseudo-element */
                display: block; /* Hiển thị dưới dạng khối để chiếm toàn bộ chiều rộng */
                width: 60%; /* Độ rộng của đường viền, thay đổi theo nhu cầu */
                height: 3px; /* Độ dày của đường viền */
                background-color: #3498db; /* Màu của đường viền */
                margin: 0 auto; /* Canh giữa đường viền */
                margin-top: 0.5rem; 
            }
        }
    </style>
</head>
<body>
    <?php include_once('header.php'); ?>
    <div class="container mt-5 mb-3">
        <form method="GET" class="search-form">
            <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm" value="<?= htmlspecialchars($keyword) ?>">
            <select name="category_id">
                <option value="">Chọn danh mục</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category_id == $category['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Tìm kiếm">
        </form>
        
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center product-heading">SẢN PHẨM CÔNG TY PHÂN PHỐI</h3>
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
