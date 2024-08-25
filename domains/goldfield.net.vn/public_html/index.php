<?php include_once('header.php'); ?>
<?php session_start(); ?>

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
        /* Swiper Container */
        .swiper-container {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        /* Swiper Slide */
        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Swiper Slide Image */
        .swiper-slide img {
            width: 80%;
            height: 200px; /* Điều chỉnh chiều cao hình ảnh */
            object-fit: contain; /* Giữ tỷ lệ hình ảnh và phủ kín không gian */
        }

        /* Swiper Slide Video */
        .swiper-slide video {
            width: 80%;
            height: 80%; /* Điều chỉnh chiều cao để phù hợp với chiều cao của slide */
            object-fit: cover; /* Đảm bảo video không bị biến dạng và phủ kín không gian */
            border-radius: 8px; /* Bo góc cho video để tạo hiệu ứng mềm mại */
        }

        /* Product Heading */
        .product-heading {
            text-align: center; /* Canh giữa tiêu đề */
            margin-top: 1rem; /* Khoảng cách trên */
            position: relative; /* Để đường viền có thể được đặt chính xác */
            font-size: 1.5rem; /* Kích thước chữ, có thể thay đổi */
        }

        .product-heading::after {
            content: ""; /* Nội dung rỗng cho pseudo-element */
            display: block; /* Hiển thị dưới dạng khối để chiếm toàn bộ chiều rộng */
            width: 60%; /* Độ rộng của đường viền, thay đổi theo nhu cầu */
            height: 3px; /* Độ dày của đường viền */
            background-color: #3498db; /* Màu của đường viền */
            margin: 0 auto; /* Canh giữa đường viền */
            margin-top: 0.5rem; /* Khoảng cách giữa tiêu đề và đường viền */
        }

        /* Product Description */
        .product-description {
            font-size: 1.125rem;
            color: #666;
            line-height: 1.6;
            max-width: 100%;
            margin: 0 auto;
            padding: 10px 15px;
        }

        /* Card Style */
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Đảm bảo nội dung không bị tràn */
            border: 3px solid rgba(76,168,90,1);
            min-height: 500px; /* Đảm bảo chiều cao tối thiểu của card */
            cursor: pointer; /* Thay đổi con trỏ chuột để cho thấy đây là phần có thể nhấp vào */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border: 3px solid rgba(237, 169, 64, 1);
        }

        .card-img-top {
            width: 100%; 
            height: 300px; 
            object-fit: contain; 
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

        .price-text {
            color: #e74c3c;
            margin-top: auto;
        }

        /* Footer Swiper Container */
        .swiper-container.footer-swiper {
            width: 100%;
            height: 400px; 
            margin: 30px 0; 
            position: relative;

        }
        .news{
            border-radius: 15px; 
            border: 6px solid rgba(237,169,64,1); 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Swiper Slide Image for Footer */
        .swiper-slide img {
            width: 100%; /* Đảm bảo hình ảnh chiếm toàn bộ chiều rộng của slide */
            height: 100%; /* Thay đổi chiều cao để phù hợp với chiều cao của swiper */
            object-fit: cover; /* Đảm bảo hình ảnh không bị biến dạng và phủ kín không gian */
            border-radius: 8px; /* Bo góc cho hình ảnh để tạo hiệu ứng mềm mại */
        }

        /* Footer Swiper Pagination */
        .swiper-pagination {
            position: absolute;
            bottom: 10px; /* Khoảng cách từ dưới lên */
            left: 50%; /* Canh giữa theo chiều ngang */
            transform: translateX(-50%); /* Đưa phân trang vào giữa bằng cách dịch chuyển nửa chiều rộng */
            text-align: center;
        }

        /* Swiper Pagination Bullet */
        .swiper-pagination-bullet {
            background: #333; /* Màu nền của các chấm phân trang */
            opacity: 0.8; /* Độ mờ của các chấm phân trang */
        }

        /* Swiper Pagination Bullet Active */
        .swiper-pagination-bullet-active {
            background: #e74c3c; /* Màu nền của chấm phân trang đang hoạt động */
        }

        .news_text {
            text-align: center; /* Canh giữa tiêu đề */
            margin-top: 1rem; /* Khoảng cách trên */
            position: relative; /* Để đường viền có thể được đặt chính xác */
        }

        .news_text::after {
            content: ""; /* Nội dung rỗng cho pseudo-element */
            display: block; /* Hiển thị dưới dạng khối để chiếm toàn bộ chiều rộng */
            width: 50%; /* Độ rộng của đường viền, thay đổi theo nhu cầu */
            height: 2px; /* Độ dày của đường viền */
            background-color: #3498db; /* Màu của đường viền */
            margin: 0 auto; /* Canh giữa đường viền */
            margin-top: 0.5rem; /* Khoảng cách giữa tiêu đề và đường viền */
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Main Swiper -->
        <div class="swiper-container main-swiper">
            <div class="swiper-wrapper">               
                <div class="swiper-slide">
                    <img class="swiper-video" src="backend/assets/imgs/bg5.gif" alt="Animated GIF">
                </div>
                <!-- Các slide khác có thể được thêm vào đây -->
            </div>
            <!-- <div class="swiper-pagination"></div> -->
        </div>

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
    
    <!-- Product Cards -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="detail.php?id=21">
                    <div class="card product-card">
                        <img class="card-img-top" src="backend/assets/uploads/products/sp1.jpg" alt="Nutrifoli">
                        <div class="card-body">
                            <h5 class="card-title">Nutrifoli</h5>
                            <p class="card-text price-text">Xem chi tiết</p>
                            <p class="card-text">Cung cấp Photpho và Kali cho cây trồng, giúp cây phát triển mạnh mẽ, tăng cường khả năng ra hoa và đậu quả.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="product_detail.php?id=21">
                    <div class="card product-card">
                        <img class="card-img-top" src="backend/assets/uploads/products/sp2.jpg" alt="CaCi-Bo">
                        <div class="card-body">
                            <h5 class="card-title">CaCi-Bo</h5>
                            <p class="card-text price-text">Xem chi tiết</p>
                            <p class="card-text">Bổ sung Bo và Canxi, giúp cây trồng tăng cường sức đề kháng và phát triển mạnh mẽ.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="product_detail.php?id=21">
                    <div class="card product-card">
                        <img class="card-img-top" src="backend/assets/uploads/products/sp3.jpg" alt="Kamycinusa 75SL">
                        <div class="card-body">
                            <h5 class="card-title">Kamycinusa 75SL</h5>
                            <p class="card-text price-text">Xem chi tiết</p>
                            <p class="card-text">Diệt vi khuẩn gây bệnh cho cây.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container news">
        <h5 class="news_text text-center mt-4">TIN TỨC GOLDFIELD</h5>
        <div class="swiper-container footer-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="https://www.facebook.com/share/v/NNsM7aezLma8mvQe" target="_blank">
                        <img src="backend/assets/uploads/slide/chiasethucte.png" alt="Chia sẻ thực tế">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://youtu.be/6X4Z6YD1ASQ?si=HMqeTQduvY4bOib7" target="_blank">
                        <img src="backend/assets/uploads/slide/thieudinhduong.png" alt="Thiếu dinh dưỡng">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://youtu.be/CnEx2UkTLCs?si=k98_DkX9ax1qeHW3" target="_blank">
                        <img src="backend/assets/uploads/slide/laynhixoaidailoan.png" alt="Lấy nH xóa Đài Loan">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://youtu.be/9O7DCOg8pMY?si=V1E_j-xr9ji4O1F-" target="_blank">
                        <img src="backend/assets/uploads/slide/choihoava.png" alt="Chơi hoa và">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://www.facebook.com/share/v/taBNLny9KVSpsqsU/?mibextid=WC7FNe" target="_blank">
                        <img src="backend/assets/uploads/slide/chinhcoidot.png" alt="Chỉnh cơi đọt">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="https://youtu.be/Y_A6FCP--c8?si=eXzyfPU8TnzrB6kY" target="_blank">
                        <img src="backend/assets/uploads/slide/danhgiasanpham.png" alt="Đánh giá sản phẩm">
                    </a>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <?php include_once('footer.php'); ?>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        // Initialize Main Swiper
        var mainSwiper = new Swiper('.main-swiper', {
            slidesPerView: 1,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop: true,
            autoplay: {
                delay: 5000, // Thay đổi nếu cần thiết
                disableOnInteraction: false, // Cho phép autoplay tiếp tục sau khi người dùng tương tác
            },
        });

        function handleVideoSlides() {
            var slides = document.querySelectorAll('.main-swiper .swiper-slide');

            slides.forEach(function(slide) {
                var video = slide.querySelector('video');
                if (video) {
                    video.addEventListener('play', function() {
                        // Khi video bắt đầu phát, tạm dừng autoplay của Swiper
                        mainSwiper.autoplay.stop();
                    });

                    video.addEventListener('ended', function() {
                        // Khi video kết thúc, chuyển đến slide tiếp theo
                        mainSwiper.slideNext();
                        // Khôi phục autoplay của Swiper
                        mainSwiper.autoplay.start();
                    });

                    // Khi slide chuyển, dừng video nếu có
                    mainSwiper.on('slideChangeTransitionEnd', function() {
                        slides.forEach(function(s) {
                            var v = s.querySelector('video');
                            if (v && !v.paused) {
                                v.pause();
                            }
                        });
                    });
                }
            });
        }

        // Call the function to set up event listeners
        handleVideoSlides();

        // Initialize Footer Swiper
        var footerSwiper = new Swiper('.footer-swiper', {
            slidesPerView: 1, /* Số lượng slide hiển thị trên màn hình lớn */
            spaceBetween: 10, /* Khoảng cách giữa các slide */
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop: true,
            autoplay: {
                delay: 3000,
            },
            breakpoints: {
                992: {
                    slidesPerView: 3, /* Số lượng slide hiển thị trên màn hình lớn hơn 992px */
                },
                768: {
                    slidesPerView: 2, /* Số lượng slide hiển thị trên màn hình từ 768px đến 992px */
                },
                480: {
                    slidesPerView: 1, /* Số lượng slide hiển thị trên màn hình nhỏ hơn 480px */
                },
            },
        });
    </script>
</body>
</html>
