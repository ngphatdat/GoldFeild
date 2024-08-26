<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOLFFIELD</title>
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
        include_once('header.php');
    ?>
        <div class="gh"><a href="giohang.php"><i class="fa fa-shopping-cart fa-3x" aria-hidden="true" ></i><br>Giỏ hàng</a></div>
    <div class="container mt-5 mb-3" style="background-color: white;">
        <div class="row">
            <div class="col-md-12">
                <h3 style="text-align: center;">SẢN PHẨM CÔNG TY PHÂN PHỐI</h3>
                <hr>
                <?php
                    $sql = <<<EOT
                    select hoa.hoa_ten, hoa.hoa_gia, hoa.hoa_giacu, hsp.hsp_tentaptin ,hoa.hoa_ma
                    from hoa 
                    JOIN hinhsanpham AS hsp ON hoa.hoa_ma=hsp.hoa_ma
                    ORDER BY RAND()
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
                    <div class="card ml-2 float-left mt-1" style="width: 13.2rem; height:17rem">
                        <img class="card-img-top mx-auto" style="width: 124px; height= 120px;" src="backend/assets/uploads/products/<?=$hoa['hsp_tentaptin']?>" alt="Card image cap">
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
    <hr/>
    <div class="container-fluid">
        <?php include_once('footer.php')?>
    </div>
</body>
</html>