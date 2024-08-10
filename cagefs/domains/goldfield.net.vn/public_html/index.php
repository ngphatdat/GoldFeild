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
            justify-content: center; /* Căn giữa nội dung theo chiều ngang */
            align-items: center; /* Căn giữa nội dung theo chiều dọc */
        }
        }

        .swiper-slide img {
            width: 60%;
            height: auto;
        }
        .product-heading {
            font-size: 1.75rem; /* Kích thước chữ lớn hơn */
            font-weight: bold; /* Đậm */
            color: #333; /* Màu chữ tối */
            padding: 20px; /* Khoảng cách bên trong */
            background-color: #f8f9fa; /* Nền sáng */
            border-radius: 10px; /* Bo góc */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
            max-width: 90%; /* Giới hạn chiều rộng */
            margin: 0 auto; /* Căn giữa */
        }
        .product-description {
            font-size: 1.125rem; /* Kích thước chữ vừa phải */
            color: #666; /* Màu chữ xám nhẹ để dễ đọc */
            line-height: 1.6; /* Khoảng cách dòng */
            max-width: 80%; /* Giới hạn chiều rộng để dễ đọc */
            margin: 0 auto; /* Căn giữa */
            padding: 10px 15px; /* Khoảng cách bên trong */
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

    <div class="container mt-0" style="background-color: white;">
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
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

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