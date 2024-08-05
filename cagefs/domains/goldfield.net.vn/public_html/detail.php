<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        figure.zoom {
        background-position: 50% 50%;
        position: relative;
        width: 500px;
        overflow: hidden;
        cursor: zoom-in;
        }

        figure.zoom img:hover {
        opacity: 0;
        }

        figure.zoom img {
        transition: opacity 0.5s;
        display: block;
        width: 100%;
        }

    </style>
    <style>
        .gh{
            position: absolute;
            left: 1400px;
            top: 15px;
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            right:0;
            padding: 5px;
            width:100px;
        }
    </style>
</head>
<body>
    <?php
        include_once('headersmall.php');
        include_once('connectdb.php');
        $hoa_ma=$_GET['hoa_ma'];
        $sql= <<<EOT
        SELECT hoa.hoa_ten, hoa.hoa_mota, hoa.hoa_gia, hoa.hoa_giacu, hsp.hsp_tentaptin
        FROM hoa hoa
        JOIN hinhsanpham hsp ON hoa.hoa_ma=hsp.hoa_ma
        WHERE hoa.hoa_ma=$hoa_ma
EOT;
        $result=mysqli_query($conn,$sql);
        $hoa=mysqli_fetch_array($result);
    ?>
    <div class="gh"><a href="giohang.php"><i class="fa fa-shopping-cart fa-3x" aria-hidden="true" ></i><br>Giỏ hàng</a></div>
    <div class="container mt-3" style="background-color:white ;">
        <div class="row">
            <div class="col-md-6">
                <figure class="zoom" style="background:url(backend/assets/uploads/products/<?=$hoa['hsp_tentaptin']?>)" onmousemove="zoom(event)" ontouchmove="zoom(event)">
                </figure>
                <img src="backend/assets/uploads/products/<?=$hoa['hsp_tentaptin']?>" class="img-fluid" />
            </div>
            <div class="col-md-6">
                <h3><?=$hoa['hoa_ten']?></h3> <br/>
                Giá: <s><?=number_format($hoa['hoa_giacu'],'0','.',',')?> VND</s> <br/>
                Giá giảm:<div style="color: pink;font-size: 25px; font-weight:bold"><?=number_format($hoa['hoa_gia'],'0','.',',')?> VND</div>
                <hr>
                <form action="" method="POST" name="frmGiohang" id="frmGiohang">
                    <label for="soluong">Số lượng:</label>
                    <input type="number" name="soluong" id="soluong" min="1" max="10" value="1">
                    <hr>
                    <input type="hidden" name="hoa_ma" id="hoa_ma" value="<?=$hoa_ma?>">
                    <button name="them" id="them" class="btn btn-primary"><i class="fa fa-cart-plus fa-1x ml-0" aria-hidden="true"></i> Thêm vào giỏ hàng</button>
                </form>
                    <hr>
                    <h6>MIỄN PHÍ VẬN CHUYỂN cho những đơn hàng có giá trị trên 1.000.000đ và những đơn hàng có phí vận chuyển dưới 20.000đ tính theo chi phí của đơn vị vận chuyển.</h6>
                    <label for="">Mô tả: </label> <b><?=$hoa['hoa_mota']?></b> 
                    <hr>
            </div>
        </div>        
    </div>
    <div class="container mt-4" style="background-color:white ;">
        <div class="row">
            <div class="col-md-12 text-center">
                <h4>Các sản phẩm khác</h4>
                <hr>
                <?php
                    $sql = <<<EOT
                    select hoa.hoa_ten, hoa.hoa_gia, hoa.hoa_giacu, hsp.hsp_tentaptin ,hoa.hoa_ma
                    from hoa 
                    JOIN hinhsanpham AS hsp ON hoa.hoa_ma=hsp.hoa_ma
                    ORDER BY RAND()
                    LIMIT 5
EOT;
                    $result=mysqli_query($conn,$sql);
                    $sp = [];
                    while($row=mysqli_fetch_array($result)){
                        $sp[] = array(
                            'hoa_ten' => $row['hoa_ten'],
                            'hoa_ma' => $row['hoa_ma'],
                            'hoa_gia' => $row['hoa_gia'],
                            'hoa_giacu' => $row['hoa_giacu'],
                            'hsp_tentaptin' => $row['hsp_tentaptin'],
                        );
                    };
                ?>
                <?php foreach($sp as $hoa):?>
                <a href="detail.php?hoa_ma=<?=$hoa['hoa_ma']?>">
                    <div class="card ml-2 float-left" style="width: 13.2rem;">
                        <img class="card-img-top mx-auto" style="width: 124px; height= 100px;" src="backend/assets/uploads/products/<?=$hoa['hsp_tentaptin']?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?=$hoa['hoa_ten']?></h5>
                            <s class="card-text"><?=number_format($hoa['hoa_giacu'],'0','.',',')?> VND</s>
                            <p class="card-text" style="color: red;"><?=number_format($hoa['hoa_gia'],'0','.',',')?> VND</p>
                        </div>
                    </div>
                </a>
                <?php endforeach ;?>
            </div>
        </div>
    </div>
    <?php include_once('footer.php')?>

    <?php
        if(isset($_POST['them'])){
            $hoa_ma=$_POST['hoa_ma'];
            $soluong=$_POST['soluong'];
            $sqlCart=<<<EOT
            select hoa.hoa_ten, hoa.hoa_gia, hsp.hsp_tentaptin 
            from hoa 
            JOIN hinhsanpham AS hsp ON hoa.hoa_ma=hsp.hoa_ma
            where hoa.hoa_ma=$hoa_ma
EOT;
            $resultCart=mysqli_query($conn,$sqlCart);
            $rowCart=mysqli_fetch_array($resultCart);
            $ten=$rowCart['hoa_ten'];
            $gia=$rowCart['hoa_gia'];
            $hinh=$rowCart['hsp_tentaptin'];
            if(!isset($_SESSION['gioHang'][$hoa_ma])){
                $_SESSION['gioHang'][$hoa_ma]= array(
                    'hoa_ma' => $hoa_ma,
                    'hinh' => $hinh,
                    'ten' => $ten,
                    'soluong' => $soluong,
                    'gia' => $gia
                );
            }else{
                $_SESSION['gioHang'][$hoa_ma]['soluong'] += $soluong;
            }
            echo '
                <script>
                    alert("Thêm vào giỏ hàng thành công");
                </script>
                <script>window.location.href="javascript: history.go(-1)"</script>
            ';
        }
    ?>                 
    



    <script>
        function zoom(e) {
          var zoomer = e.currentTarget;
          e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
          e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
          x = (offsetX / zoomer.offsetWidth) * 100
          y = (offsetY / zoomer.offsetHeight) * 100
          zoomer.style.backgroundPosition = x + "% " + y + "%";
        }
        
      </script>
    
</body>
</html>