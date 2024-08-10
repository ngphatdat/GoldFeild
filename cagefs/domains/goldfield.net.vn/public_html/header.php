<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="backend/vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="backend/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="backend/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/header.css">
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
<body style="background-color: #dcdcdc;">
    <div class="container-fluid" style="background-color: white;">
        <div class="row text-center" style="height: 120px;">
            <div class="col-md-1"></div>
            <div class="col-md-2 mt-1 text-center">
                <a href="index.php"><img src="backend/assets/imgs/logosmall.png"></a>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-4">
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
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
                <a class="nav-link" href="index.php">GIỚI THIỆU<span class="sr-only">(current)</span></a>
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

    <div class="container">
    <div class="row">
        <div class="col-12">
            <div id="slideshow-container">
                <div id="slide1" class="slide">
                    <img src="backend/assets/imgs/bg1.jpg" alt="Slide 1">
                </div>
                <div id="slide2" class="slide">
                    <img src="backend/assets/imgs/bg2.jpg" alt="Slide 2">
                </div>
                <div id="slide3" class="slide">
                    <img src="backend/assets/imgs/bg3.jpg" alt="Slide 3">
                </div>
                <a id="prev" class="navigation" onclick="plusSlides(-1)">&#10094;</a>
                <a id="next" class="navigation" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>
    </div>
</div>


    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.getElementsByClassName("slide");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }    
            if (slideIndex < 1) { slideIndex = slides.length }
            slides[slideIndex-1].style.display = "block";  
            setTimeout(showSlides, 5000); // Thay đổi slide mỗi 3 giây
        }

        function plusSlides(n) {
            slideIndex += n;
            if (slideIndex > document.getElementsByClassName("slide").length) {
                slideIndex = 1;
            } else if (slideIndex < 1) {
                slideIndex = document.getElementsByClassName("slide").length;
            }
            showSlides();
        }
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>