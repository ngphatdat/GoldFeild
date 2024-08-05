<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Flower</title>
</head>
<body>
    <?php
        include_once('header.php');
    ?>
    <div class="container mt-0" style="background-color: white;">
        <div class="row">
            <div class="col-md-12" >
                <?php
                    $lh_ma=$_GET['lh_ma'];
                    $sqlLoaiHoa="select * from loaihoa where lh_ma=$lh_ma";
                    $resultLoaiHoa=mysqli_query($conn,$sqlLoaiHoa);
                    $row=mysqli_fetch_array($resultLoaiHoa);
                    $lh_ten=$row['lh_ten'];
                ?>
                <h3 style="text-align: center;"><?php echo $lh_ten?></h3>
                <hr>
                <?php
                    $sql = <<<EOT
                    select hoa.hoa_ten, hoa.hoa_gia, hoa.hoa_giacu, hsp.hsp_tentaptin ,hoa.hoa_ma,lh.lh_ten
                    from hoa 
                    JOIN hinhsanpham AS hsp ON hoa.hoa_ma=hsp.hoa_ma
                    JOIN loaihoa AS lh ON lh.lh_ma=hoa.lh_ma
                    WHERE hoa.lh_ma=$lh_ma
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
                    <div class="card ml-2 float-left mb-2" style="width: 13.2rem;">
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
</body>
</html>