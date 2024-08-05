<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLDFIELD</title>
    <style>
        /* Tab Links */
        .tabs{
        display:flex;
        }
        .tablinks {
        border: none;
        outline: none;
        cursor: pointer;
        width: 100%;
        padding: 1rem;
        font-size: 13px;
        text-transform: uppercase;
        font-weight:600;
        transition: 0.2s ease;
        }
        .tablinks:hover{
        background:blue;
        color:#fff;
        }
        /* Tab active */
        .tablinks.active {
        background:blue;
        color:#fff;
        }

        /* tab content */
        .tabcontent {
        display: none;
        }
        /* Text*/
        .tabcontent p {
        color: #333;
        font-size: 16px;
        }
        /* tab content active */
        .tabcontent.active {
        display: block;
        }
    </style>
</head>
<body>
    <?php
        include_once('header.php');
    ?>
    <div class="container mt-0" style="background-color: white;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2 class="text-center mt-2">BÀI VIẾT</h2>
                <div class="tabs">
                    <button class="tablinks active" data-electronic="saurieng">Bài viết về Sầu riêng</button>
                    <button class="tablinks" data-electronic="xoai">Bài viết về Xoài</button>
                    <button class="tablinks" data-electronic="ot">Bài viết về Ớt</button>
                </div>

                <!-- Tab content -->
                <div class="wrapper_tabcontent">
                    <!-- Bài viết sầu riêng -->
                    <div id="saurieng" class="tabcontent active">
                        <!-- Lấy bài viết từ cơ sở dữ liệu -->
                            <?php
                            $sql = <<<EOT
                            select ten_bv, ma_lbv, diengiai, link_bv, hinh_bv from baiviet WHERE ma_lbv=1;
EOT;
                            $result=mysqli_query($conn,$sql);
                            $bv = [];
                            while($row=mysqli_fetch_array($result)){
                                $bv[] = array(
                                    'ten_bv' => $row['ten_bv'],
                                    'ma_lbv' => $row['ma_lbv'],
                                    'diengiai' => $row['diengiai'],
                                    'link_bv' => $row['link_bv'],
                                    'hinh_bv' => $row['hinh_bv'],
                                );
                            };
                        ?>
                        <?php foreach($bv as $baiviet):?>
                            <a href="<?=$baiviet['link_bv']?>">
                                <div class="media mt-2" style=" width:100%; max-width:800px;    ">
                                    <img class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;"  src="backend/assets/uploads/posts/<?=$baiviet['hinh_bv']?>"/>
                                    <div class="media-body">
                                        <h6 class="mt-0"><?=$baiviet['ten_bv']?></h6>
                                        <p><?=$baiviet['diengiai']?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach ;?>

                        <a href="https://www.facebook.com/goldfield.vn/posts/318707190379395">
                            <div class="media mt-2" style=" width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/unghongthoitrai.png" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">🚫🚫BỆNH THỐI TRÁI Ở SẦU RIÊNG🚫🚫</h6>
                                    <p>✳✳Bệnh thối trái do nấm Phytophthora  palmivora gây ra. Chúng gây hại trên nhiều bộ phận của cây như lá, thân, cành và trái...</p>
                                </div>
                            </div>
                        </a>
                        <a href="https://www.facebook.com/goldfield.vn/posts/312822554301192">
                            <div class="media mt-2" style=" width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/chaymui.png" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">🆘️🆘️HIỆN TƯỢNG CHÁY MÚI SẦU RIÊNG🆘️🆘️</h6>
                                    <p>🎯🎯Sầu riêng bị “sượng” là một trở ngại và là nổi băn khoăn rất lớn của nhà vườn trồng sầu riêng hiện nay...</p>
                                </div>
                            </div>
                        </a>
                        <a href="https://www.facebook.com/goldfield.vn/posts/304026271847487">
                            <div class="media mt-2" style=" width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/didot.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">🆘️🆘️HIỆN TƯỢNG ĐI ĐỌT TRƯỚC TRONG VÀ SAU XẢ NHỤY SẦU RIÊNG🆘️🆘️</h6>
                                    <p>🍀🍀Khi sầu riêng ra đọt lúc mang hoa và trái sẽ dễ gây ra rụng hoa và trái. Nguyên nhân là do cạnh tranh về dinh dưỡng...</p>
                                </div>
                            </div>
                        </a>
                        <a href="https://www.facebook.com/goldfield.vn/posts/328007162782731">
                            <div class="media mt-2" style=" width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/nutcuon.png" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">🎯🎯HIỆN TƯỢNG ĐỎ ĐẦU GAI, TÉT ĐẦU GAI Ở SẦU RIÊNG VÀ GIẢI PHÁP🎯🎯</h6>
                                    <p>⚠️⚠️Hiện tượng nứt cuống, đỏ đầu gai và tét gai Sầu riêng rất phổ biến tại vùng Miền Đông và Tây Nguyên...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <!-- Bài viết về xoài  -->
                    <div id="xoai" class="tabcontent">
                        <a href="https://www.facebook.com/goldfield.vn/posts/339759604940820">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/tianhanhxoai.png" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">🌿🌿KỸ THUẬT CẮT CÀNH VÀ TẠO TÁN XOÀI🌿🌿</h6>
                                    <p>✳✳Trong kỹ thuật cắt cành có hai dạng:  tuyển sâu và tuyển cạn...</p>
                                </div>
                            </div>
                        </a>
                        <a href="https://www.facebook.com/goldfield.vn/posts/343902194526561">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xulypaclo.png" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">🌎🌎QUY TRÌNH XỬ LÝ PACLOBUTRAZOLE ĐỐI VỚI XOÀI🌎🌎</h6>
                                    <p>🍀🍀Khi xoài ra cơi đọt đồng đều và chuyển từ mùa đỏ đồng sang màu xanh nhạt thì tiến hành hành xử lý Paclobutrazole...</p>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtu.be/CJHK6el3PMM">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xoai/xoai1.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">GOLDFIELD cách nhận biết chính xác giai đoạn đỗ gốc xử lý ra bông Xoài</h6>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtu.be/m3dAbBTYmng">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xoai/xoai2.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">Goldfield chăm sóc vườn xoài ra hoa trong mùa mưa dầm</h6>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtu.be/LpNICQSefCU">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xoai/xoai3.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">ADU-GOLIELD kỹ thuật cắt cành tạo tán Xoài</h6>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtu.be/9O7DCOg8pMY">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xoai/xoai4.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">GOLDFIELD XOÀI ĐI LỘC BÔNG, BÔNG LỘC. NHẬN BIẾT VÀ GIẢI PHÁP KHẮT PHỤC</h6>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtu.be/4M_I8sjtYd0">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xoai/xoai5.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">GOLDFIELD XOÀI ĐÃ ĐỔ GỐC TẠO MẦM VẪN ĐI ĐỌT-GIẢI PHÁP</h6>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtu.be/JiEzUoa6GHk">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xoai/xoai6.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">GOLDFIELD XOÀI CHẶN LỘC NUÔI BÔNG HIỆU QUẢ AN TOÀN</h6>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtu.be/LnAwsOqQbHY">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xoai/xoai7.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">ADU-GOLDFIELD QUY TÌNH SỬ LÝ HOA DƯỠNG BÔNG ĐẬU TRÁI XOÀI</h6>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtu.be/hjJ7-AbT2LQ">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xoai/xoai8.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">ADU-GOLDFIELD CÁC DỊCH HẠI TRÊN XOÀI VÀ GIẢI PHÁP TRƯỚC BAO TRÁI</h6>
                                </div>
                            </div>
                        </a>
                        <a href="https://youtu.be/UZhYhg-18vs">
                            <div class="media mt-2" style="  width:100%; max-width:800px;    ">
                                <img src="backend/assets/post/xoai/xoai9.jpg" class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;">
                                <div class="media-body">
                                    <h6 class="mt-0">ADU-GOLDFIELD các giai đoạn bông trái non trên Xoài và giải pháp hiệu quả</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                <!-- Bài viết về ớt -->
                    <div id="ot" class="tabcontent">
                        <!-- Lấy bài viết từ cơ sở dữ liệu -->
                        <?php
                            $sql = <<<EOT
                            select ten_bv, ma_lbv, diengiai, link_bv, hinh_bv from baiviet WHERE ma_lbv=3;
EOT;
                            $result=mysqli_query($conn,$sql);
                            $bv = [];
                            while($row=mysqli_fetch_array($result)){
                                $bv[] = array(
                                    'ten_bv' => $row['ten_bv'],
                                    'ma_lbv' => $row['ma_lbv'],
                                    'diengiai' => $row['diengiai'],
                                    'link_bv' => $row['link_bv'],
                                    'hinh_bv' => $row['hinh_bv'],
                                );
                            };
                        ?>
                        <?php foreach($bv as $baiviet):?>
                            <a href="<?=$baiviet['link_bv']?>">
                                <div class="media mt-2" style=" width:100%; max-width:800px;    ">
                                    <img class="mr-3 img-fluid" alt="..." style="width:100%; max-width:180px;"  src="backend/assets/uploads/posts/<?=$baiviet['hinh_bv']?>"/>
                                    <div class="media-body">
                                        <h6 class="mt-0"><?=$baiviet['ten_bv']?></h6>
                                        <p><?=$baiviet['diengiai']?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach ;?>
                    </div>
                </div>
                            
                        </div>
                        <div class="col-md-2"></div>
                    </div>
    </div>
    <?php include_once('footer.php')?>
    <script>
        var tabLinks = document.querySelectorAll(".tablinks");
        var tabContent =document.querySelectorAll(".tabcontent");

        tabLinks.forEach(function(el) {
        el.addEventListener("click", openTabs);
        });


        function openTabs(el) {
        var btn = el.currentTarget; // lắng nghe sự kiện và hiển thị các element
        var electronic = btn.dataset.electronic; // lấy giá trị trong data-electronic
        
        tabContent.forEach(function(el) {
            el.classList.remove("active");
        });

        tabLinks.forEach(function(el) {
            el.classList.remove("active");
        });

        document.querySelector("#" + electronic).classList.add("active");
        
        btn.classList.add("active");
        }
    </script>
</body>
</html>