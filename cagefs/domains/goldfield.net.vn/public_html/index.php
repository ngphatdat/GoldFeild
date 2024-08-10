<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLDFIELD</title>
    <link rel="shortcut icon" type="image/png" href="backend/assets/imgs/logoGFnew.png"/>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
        .swiper-container {
            .swiper-slide {
            display: flex;
            justify-content: center; 
            align-items: center;
        }
        }
        .swiper-slide img {
            width: 100%;
            height: auto;
        }
        .product-heading {
            font-size: 1.75rem; 
            font-weight: bold; 
            color: #333; 
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            max-width: 90%; 
            margin: 0 auto; 
        }
        .product-description {
            font-size: 1.125rem; 
            color: #666; 
            line-height: 1.6; 
            max-width: 100%; 
            margin: 0 auto; 
            padding: 10px 15px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 10px;
        }

        .card-text {
            text-align: center;
            font-size: 1rem;
            color: #555;
            
        }

        .card-text[style="color: red;"] {
            font-size: 1.2rem;
            font-weight: bold;
            color: #e74c3c; 
        }
        .product-card { 
            margin-left: 0.5rem;
            margin-top: 0.5rem;
            float: left;
        }

        .price-text {
            color: #e74c3c;
            margin-top: auto;
        }
        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-img-top {
            width: 70%;
            /* height: 250px;  */
            border-bottom: 1px solid #ddd;
            border-radius: 8px 8px 0 0;
        }
    </style>
</head>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<body>
    <?php
        include_once('header.php');
    ?>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="backend/assets/imgs/bg1.jpg" alt="Slide 1">
        </div>
        <div class="swiper-slide">
            <img src="backend/assets/imgs/bg2.jpg" alt="Slide 2">
        </div>
        <div class="swiper-slide">
            <img src="backend/assets/imgs/bg3.jpg" alt="Slide 3">
        </div>
    </div>
</div>

    <div class="container ">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="text-center mt-4">
                    <h2 class="product-heading">SẢN PHẨM NHẬP KHẨU - TINH HOA TỪ NỀN NÔNG NGHIỆP HÀNG ĐẦU</h2>
                    <p class="product-description">
                        Chúng tôi tự hào mang đến cho bạn những sản phẩm nông nghiệp đỉnh cao từ các quốc gia nổi bật: Thổ Nhĩ Kỳ, Ý, Đức, Mỹ và Ba Lan. Mỗi sản phẩm đều được chọn lọc kỹ lưỡng để đáp ứng tiêu chuẩn chất lượng quốc tế và tối ưu hóa hiệu quả sản xuất.
                    </p>
                </div>     
            </div>
         <div class="col-md-1"></div>
        </div>
    </div>
    <div class="container ">
    <div class="row">
    <div class="col-md-4">
    <a href="detail.php?hoa_ma=1">
        <div class="card product-card">
            <img class="card-img-top" src="backend/assets/uploads/products/sp1.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Nutrifoli</h5>
                <p class="card-text price-text">Xem chi tiết</p>
                <p class="card-text detail-text">Cung cấp Photpho và Kali cho cây trồng, giúp cây phát triển mạnh mẽ, tăng cường khả năng ra hoa và đậu quả.</p>
            </div>
        </div>
        </a>
        </div>
        <div class="col-md-4">
    <a href="detail.php?hoa_ma=2">
        <div class="card product-card">
            <img class="card-img-top" src="backend/assets/uploads/products/sp2.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">CaCi-Bo</h5>
                <p class="card-text price-text">Xem chi tiết</p>
                <p class="card-text detail-text">Bổ sung Bo và Canxi, giúp cây trồng tăng cường sức đề kháng và phát triển mạnh mẽ.</p>
            </div>
        </div>
        </a>
        </div>
        <div class="col-md-4">
    <a href="detail.php?hoa_ma=3">
        <div class="card product-card">
            <img class="card-img-top" src="backend/assets/uploads/products/sp3.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Kamycinusa 75SL</h5>
                <p class="card-text price-text">Xem chi tiết</p>
                <p class="card-text detail-text">Diệt vi khuẩn gây bệnh cho cây.</p>
            </div>
        </div>
        </a>
        </div>
</div>
</div>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        loop: true, // Để vòng lặp slide
        autoplay: {
            delay: 7000, // Thay đổi slide mỗi 5 giây
        },
    });
</script>
    <?php include_once('footer.php')?>
</body>
</html>