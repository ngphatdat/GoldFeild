<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="backend/vendor/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="backend/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="backend/vendor/font-awesome/css/font-awesome.css">
    <title>Document</title>
    <style>
        a:hover{
            text-decoration: none;
            color:black;
        }
        ul{
            text-align: left;
            margin-left: 38px;
            padding: 0px;
            list-style-type: none;
        }
        ul li a{  
            text-decoration: none;
            color:black;
            font-size: 20px;
            display: block;
            
        }
        ul li{
            height: 33px;
        }
        ul li a:hover{
            color: black;
            font-weight: bold;
            text-decoration: none;
        }
        b{
            font-size: 25px;
        }
    </style>
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
        

        <div class="row" style="background-color: #ffe6f2;">
            <div class="col-md-1"></div>
            
            <div class="col-md-10">
            <div id="demo" class="carousel slide" data-ride="carousel">
                
                
                <div class="carousel-inner">
                <div class="carousel-item active text-center">
                    <img src="backend/assets/imgs/bg.jpg" style="width : 100%; max : width 948px; ">
                </div>
                </div>
                </div>
            </div>   
    </div>
    <!-- <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-2"><b><a href="index.php">GIỚI THIỆU</a></b></div>
            <div class="col-md-2"><b><a href="sanpham.php">SẢN PHẨM</b></a></div>
            <div class="col-md-2"><b><a href="chinhsach.php">CHÍNH SÁCH</a></b></div>
            <div class="col-md-2"><b><a href="baiviet.php">BÀI VIẾT</a></b></div>
            <div class="col-md-2"><b><a href="dichvu.php">DỊCH VỤ</a></b></div>
            <div class="col-md-1"></div>
        </div>
    </div> -->
    <div class="container-fluid">
        <div class="row">
            
                <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 40px;">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <div class="col-md-01"></div>
                            <div class="col-md-02">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">GIỚI THIỆU<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                            <div class="col-md-02">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">GIỚI THIỆU<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                            <div class="col-md-02">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">GIỚI THIỆU<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                            <div class="col-md-02">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">GIỚI THIỆU<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                            <div class="col-md-02">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">GIỚI THIỆU<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                            <div class="col-md-01"></div>
                        </ul>
                    </div>
                </nav> -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light" style="">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width: 100%;">
                        <ul class="navbar-nav mr-auto">
                            <div style="width: 250px">     
                                <li class="nav-item active" >
                                    <a class="nav-link" href="index.php" style="width: 100%">GIỚI THIỆU<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                            <div style="width: 250px">     
                                <li class="nav-item active" >
                                    <a class="nav-link" href="sanpham.php"  style="width: 100%">SẢN PHẨM<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                            <div style="width: 250px">     
                                <li class="nav-item active" >
                                    <a class="nav-link" href="chinhsach.php"  style="width: 100%">CHÍNH SÁCH<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                            <div style="width: 250px">     
                                <li class="nav-item active" style="width: 250px">
                                    <a class="nav-link" href="baiviet.php"  style="width: 100%">BÀI VIẾT<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                            <div style="width: 250px">     
                                <li class="nav-item active" >
                                    <a class="nav-link" href="dichvu.php"  style="width: 100%">DỊCH VỤ<span class="sr-only">(current)</span></a>
                                </li>
                            </div>
                        
                        </ul>
                    </div>
                </nav>
        </div>
    </div>
    

    <?php include_once("script.php")?>
</body>
</html>