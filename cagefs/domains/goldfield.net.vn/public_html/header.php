<?php
$current_page = basename($_SERVER['PHP_SELF']);
include_once('connectdb.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- jQuery (không cần tải hai lần) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="backend/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <style>
        .navigation {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: #fff; /* Màu chữ trắng để nổi bật trên nền xanh lá */
            font-weight: bold;
            font-size: 18px;
            transition: background-color 0.6s ease; /* Cải thiện transition */
            border-radius: 0 3px 3px 0;
            user-select: none;
            background-color: rgba(76,168,90,1); /* Màu nền xanh lá cây */
        }

        #prev {
            left: 0;
        }

        #next {
            right: 0;
        }

        .navigation:hover {
            background-color: rgba(76,168,90,1); /* Màu nền khi hover */
            color: #fff; /* Đảm bảo màu chữ vẫn dễ đọc */
        }

        .navbar {
            width: 100%; /* Điều chỉnh chiều rộng của navbar theo ý muốn */
            margin: 0 auto; /* Căn giữa navbar */
            background-color: rgba(76,168,90,1); /* Màu nền của navbar */
            font-family: 'Roboto', sans-serif; /* Áp dụng font chữ Roboto */
        }

        .navbar-collapse {
            width: 100%;
        }

        .navbar-nav {
            display: flex;
            flex-direction: row;
            justify-content: center; 
            width: 100%; 
        }

        .nav-item {
            margin: 0 20px; 
        }

        .nav-link {
            color: #fff; 
            text-align: center; 
            font-family: 'Roboto', sans-serif; 
            transition: background-color 0.3s ease; 
            font-weight: bold; 
        }

        .nav-link:hover {
            color: #d0e5d1; 
        }

        .nav-item.active .nav-link {
            color: #fff; 
            background-color: rgba(237,169,64,1); 
            border-radius: 10px; 
        }

        .navbar-toggler {
            border: none; /* Đảm bảo không có viền */
            background: #fff;
            color: #fff; 
             /* Đảm bảo không có nền tùy chỉnh */
        }

        .navbar-toggler-icon {
            background-image: none; 
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body>
<div class="container-fluid" style="background-color: white;">
        <div class="row text-center align-items-center">
            <div class="col-md-3 d-flex justify-content-center">
                <a href="index.php">
                    <img src="backend/assets/imgs/logosmall.png" alt="Logo" style="max-width: 100%; height: auto;">
                </a>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">MENU</span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item <?php if ($current_page == 'index.php') echo 'active'; ?>">
                            <a class="nav-link" href="index.php">TRANG CHỦ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'sanpham.php') echo 'active'; ?>">
                            <a class="nav-link" href="sanpham.php">SẢN PHẨM<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'chinhsach.php') echo 'active'; ?>">
                            <a class="nav-link" href="chinhsach.php">CHÍNH SÁCH<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'baiviet.php') echo 'active'; ?>">
                            <a class="nav-link" href="baiviet.php">LẮNG NGHE VÀ CHIA SẼ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'about.php') echo 'active'; ?>">
                            <a class="nav-link" href="about.php">VỀ CHÚNG TÔI<span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- Swiper.js JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>
