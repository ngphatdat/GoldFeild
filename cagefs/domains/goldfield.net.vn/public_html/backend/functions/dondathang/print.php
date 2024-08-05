<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang In</title>
    <link href="../../vendor/paper-css/paper.css" type="text/css" rel="stylesheet"/>
    <style>@page { size: A4 }</style>
</head>
<body class="A4">
<?php
                $dh_ma=$_GET['dh_ma'];
                include_once('../../../connectdb.php');
                $sql  = <<<EOT
                        SELECT dh.dh_ma, dh.dh_ngaylap, dh.tenkhachhang,dh.sodienthoaimua,
                        dh.dh_noigiao, httt.httt_ten,
                        SUM(hddh.hoa_dh_dongia*hddh.hoa_dh_soluong) AS tongthanhtien
                        FROM dondathang dh
                        JOIN hoa_dondathang hddh ON hddh.dh_ma = dh.dh_ma
                        JOIN hinhthucthanhtoan httt ON httt.httt_ma = dh.httt_ma
                        WHERE dh.dh_ma = $dh_ma   
                        GROUP BY dh.dh_ma, dh.dh_ngaylap,
                        dh.dh_noigiao, httt.httt_ten
EOT;
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC)
                // while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                //     $ddh[] = array(
                //         'dh_ma' => $row['dh_ma'],
                //         'kh_tendangnhap' => $row['kh_tendangnhap'],
                //         'dh_ngaylap' => $row['dh_ngaylap'],
                //         'dh_ngaygiao' => $row['dh_ngaygiao'],
                //         'dh_noigiao' => $row['dh_noigiao'],
                //         'httt_ten' => $row['httt_ten'],
                //         'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
                //         'tongthanhtien' => $row['tongthanhtien'],
                //         );
                // }
            ?>
<?php
                $sqlChitiet  = <<<EOT
                SELECT hoa.hoa_ten,loai.lh_ten,hoa_dh_soluong,hoa_dh_dongia,(hoa_dh_soluong * hoa_dh_dongia) thanhtien
                FROM hoa_dondathang hdh
                JOIN hoa hoa ON hdh.hoa_ma=hoa.hoa_ma
                JOIN loaihoa loai ON hoa.lh_ma=loai.lh_ma
                WHERE dh_ma = $dh_ma    
EOT;
                $resultChitiet = mysqli_query($conn,$sqlChitiet);
                $ct=[];
                while ($chitiet = mysqli_fetch_array($resultChitiet, MYSQLI_ASSOC)) {
                    $ct[] = array(
                        'hoa_ten' => $chitiet['hoa_ten'],
                        'lh_ten' => $chitiet['lh_ten'],
                        'hoa_dh_soluong' => $chitiet['hoa_dh_soluong'],
                        'hoa_dh_dongia' => $chitiet['hoa_dh_dongia'],
                        'thanhtien' => $chitiet['thanhtien'],
                        );
                }
            ?>
<section class="sheet padding-10mm">
 
 <!-- Write HTML just like a web page -->
 <article>
    <table style="text-align: center;">
        <tr>
            <td>
                <img src="../../assets/imgs/logosmall.png" alt="" style="width:130px; height:100px">
            </td>
            <td style="text-align: center;"><b style="font-size: 30px">Công ty TNHH Hoa PT Flower</b></td>
        </tr>
    </table>
    <i>Thông tin đơn hàng</i>
    <table  border="0" width="100%" cellspacing="0">
        <tr>
            <td>Khách hàng:</td>
            <td><?= $row['tenkhachhang']?> (0<?=$row['sodienthoaimua']?>)</td>
        </tr>
        <tr>
            <td>Ngày lập:</td>
            <td><?= $row['dh_ngaylap']?></td>
        </tr>
        <tr>
            <td>Nơi giao:</td>
            <td><?= $row['dh_noigiao']?></td>
        </tr>
        <tr>
            <td>Hình thức thanh toán:</td>
            <td><?= $row['httt_ten']?></td>
        </tr>
        <tr>
            <td>Tổng thành tiền:</td>
            <td><?= number_format( $row['tongthanhtien'],'0','.',',')?></td>
        </tr>
    </table>
    <i>Chi tiết đơn hàng</i>
    <table border="1" width="100%" cellspacing="0" cellpadding="5">
          <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
          </tr>
          <?php $stt=1;?>
          <?php foreach($ct as $ctdh):?>
          <tr>
                <td align="center"><?=$stt++?></td>   
                <td>
                    <?=$ctdh['hoa_ten']?><br/>
                    <?=$ctdh['lh_ten']?><br/>
                </td>
                <td align="right"><?=$ctdh['hoa_dh_soluong']?></td>  
                <td align="right"><?=number_format( $ctdh['hoa_dh_dongia'],'0','.',',')?></td>
                <td align="right"><?=number_format( $ctdh['thanhtien'],'0','.',',')?></td>  
          </tr>          
          <?php endforeach;?>
          <tfoot>
                <tr>
                    <td colspan="4" align="right"><b>Tổng thành tiền</b></td>
                    <td align="right"><b><?= number_format( $row['tongthanhtien'],'0','.',',')?></b></td>
                </tr>
            </tfoot>
    </table>
    <table border="0" width="100%">
            <tbody>
                <tr>
                    <td align="center">
                        <small>Xin cám ơn Quý khách đã ủng hộ Cửa hàng, Chúc Quý khách An Khang, Thịnh Vượng!</small>
                    </td>
                </tr>
            </tbody>
        </table>
 </article>

</section>
</body>
</html>