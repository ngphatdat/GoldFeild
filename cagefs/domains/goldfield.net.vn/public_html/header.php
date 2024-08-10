<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="backend/vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="backend/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="backend/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/header.css">
    <!-- Swiper.js CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <style>
        #slideshow-container {
    position: relative;
    max-width: 100%;
    margin: auto;
}

.slide img {
    width: 100%;
    height: auto;
}

.navigation {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -22px;
    color: #fff;
    font-weight: bold;
    font-size: 18px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
}

#prev {
    left: 0;
}

#next {
    right: 0;
}

.navigation:hover {
    background-color: rgba(0,0,0,0.8);
}
.navbar {
    width: 100%; /* Điều chỉnh chiều rộng của navbar theo ý muốn */
    margin: 0 auto; /* Căn giữa navbar */
}

.navbar-collapse {
    width: 100%;
}

.navbar-nav {
    display: flex;
    flex-direction: row;
    justify-content: center; /* Căn giữa các mục trong navbar */
    width: 100%; /* Đảm bảo navbar-nav chiếm toàn bộ chiều rộng của navbar */
}

.nav-item {
    margin: 0 15px; /* Tạo khoảng cách giữa các mục */
}

.nav-link {
    text-align: center; /* Căn giữa nội dung liên kết */
}


    </style>
    <title>Document</title>
</head>
    <?php
        include_once('connectdb.php');
    ?>
    <!-- Swiper.js JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<body style="background-color: #dcdcdc;">
<div class="container-fluid" style="background-color: white;">
    <div class="row text-center align-items-center">
        <div class="col-md-3 d-flex justify-content-center">
            <a href="index.php">
                <img src="backend/assets/imgs/logosmall.png" alt="Logo" style="max-width: 100%; height: auto;">
            </a>
        </div>
         <div class="col-md-4""></div>
            <div class="col-md-4 d-flex justify-content-center">
            <a href="giohang.php" class="d-flex align-items-center">
                <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                <span class="ms-2">Giỏ hàng</span>
            </a>
        </div>
    </div>
</div>

    <div class="container-fluid">
        <div class="row">               
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">TRANG CHỦ<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="sanpham.php">SẢN PHẨM<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="chinhsach.php">CHÍNH SÁCH<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="baiviet.php">BÀI VIẾT<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="dichvu.php">DỊCH VỤ<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
        </div>
    </div>

</body>
</html>