<?php
session_start(); // Khởi tạo session
include_once('connectdb.php');

$current_page = basename($_SERVER['PHP_SELF']);
$is_logged_in = isset($_SESSION['user_name']);
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
        .navbar {
            width: 100%;
            margin: 0 auto;
            background-color: rgba(76,168,90,1);
            font-family: 'Roboto', sans-serif;
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
            border: none;
            background: #fff;
            color: #fff;
        }

        .navbar-toggler-icon {
            background-image: none; 
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        .dropdown-menu {
            background-color: rgba(76,168,90,1);
            border-radius: 10px;
            border: none;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            z-index: 1050;
        }

        .dropdown-item {
            color: #fff;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(237,169,64,1);
        }

        .auth-icons {
            display: flex;
            align-items: center;
        }

        .auth-icons a {
            color: rgba(76,168,90,1);
            margin-left: 10px;
            font-size: 18px;
            text-decoration: none; /* Bỏ gạch chân cho các liên kết */
        }

        .auth-icons a:hover {
            color: rgba(237,169,64,1);
        }

        .auth-icons span {
            margin-left: 10px;
            color: rgba(76,168,90,1);
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid" style="background-color: white;">
        <div class="row text-center align-items-center">
            <div class="col-md-3 col-6 d-flex justify-content-center">
                <a href="index.php">
                    <img src="backend/assets/imgs/logosmall.png" alt="Logo" style="max-width: 100%; height: auto;">
                </a>
            </div>
            <div class="col-md-6 col-6"></div>
            <div class="col-md-3 d-flex justify-content-end align-items-center auth-icons">
                <?php if ($is_logged_in): ?>
                    <span>Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="user_logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                <?php else: ?>
                    <a href="user_login.php"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                    <a href="user_register.php"><i class="fas fa-user-plus"></i> Đăng ký</a>
                <?php endif; ?>
            </div>
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
                        <li class="nav-item <?php if ($current_page == 'products.php') echo 'active'; ?>">
                            <a class="nav-link" href="products.php">SẢN PHẨM<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'solution.php') echo 'active'; ?>">
                            <a class="nav-link" href="solution.php">GIẢI PHÁP<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'baiviet.php') echo 'active'; ?>">
                            <a class="nav-link" href="baiviet.php">LẮNG NGHE VÀ CHIA SẺ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?php if ($current_page == 'about.php') echo 'active'; ?>">
                            <a class="nav-link" href="about.php">VỀ CHÚNG TÔI<span class="sr-only">(current)</span></a>
                        </li>
                        <?php if ($is_logged_in): ?>
                            <li class="nav-item <?php if ($current_page == 'cart.php') echo 'active'; ?>">
                                <a class="nav-link" href="cart.php">GIỎ HÀNG<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item <?php if ($current_page == 'order.php') echo 'active'; ?>">
                                <a class="nav-link" href="order.php">ĐƠN HÀNG<span class="sr-only">(current)</span></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <!-- Swiper.js JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</body>
</html>
