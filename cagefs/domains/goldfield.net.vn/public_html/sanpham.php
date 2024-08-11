<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLFFIELD</title>
    <style>
        .gh {
            position: sticky;
            top: 0;
            right: 0;
            padding: 5px;
            width: 100px;
        }
        .card-product {
            margin: 0.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-product img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .card-product .card-body {
            text-align: center;
        }
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .card-title {
                font-size: 1rem;
            }
            .card-text {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <?php include_once('header.php'); ?>
    
    <div class="container mt-5 mb-3" style="background-color: white;">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">SẢN PHẨM CÔNG TY PHÂN PHỐI</h3>
                <hr>
                <div class="row">
                    <?php
                        $sql = <<<EOT
                        SELECT p.id, p.name, p.price, p.thumbnail, i.image_url
                            FROM products AS p
                            LEFT JOIN product_images AS i ON p.id = i.product_id
                            ORDER BY RAND();


EOT;
                        $result=mysqli_query($conn,$sql);
                        $sp = [];
                        while($row=mysqli_fetch_array($result)){
                            $sp[] = array(
                                'id'=>  $row['id'],
                                'name' => $row['name'],
                                'price' => $row['price'],
                                'thumbnail' => $row['thumbnail'],
                            );
                        }
                    ?>
                    <?php foreach($sp as $product): ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <a href="detail.php?id=<?=$product['id']?>">
                                <div class="card card-product">
                                    <img class="card-img-top img-fluid" src="backend/assets/uploads/products/<?=$product['thumbnail']?>" alt="<?=$product['thumbnail']?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$product['name']?></h5>
                                        <p class="card-text" style="color: red;"><?=number_format($product['price'],'0','.',',')?> VND</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
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
