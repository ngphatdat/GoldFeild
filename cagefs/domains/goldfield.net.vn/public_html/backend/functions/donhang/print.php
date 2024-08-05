<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang In</title>
    <link href="../../assets/vendor/paper-css/paper.css" type="text/css" rel="stylesheet"/>
    <style>@page { size: A4 }</style>
</head>
<body class="A4">
<?php
                $dh_ma=$_GET['dh_ma'];
                include_once('../../../connectdb.php');
                $sql  = <<<EOT
                SELECT dh.dh_ma, kh.kh_tendangnhap, dh.dh_ngaylap, dh.dh_ngaygiao,
                dh.dh_noigiao, httt.httt_ten,dh.dh_trangthaithanhtoan,
                SUM(spddh.sp_dh_dongia*spddh.sp_dh_soluong) AS tongthanhtien
                FROM dondathang dh
                JOIN khachhang kh ON kh.kh_tendangnhap = dh.kh_tendangnhap
                JOIN sanpham_dondathang spddh ON spddh.dh_ma = dh.dh_ma
                JOIN hinhthucthanhtoan httt ON httt.httt_ma = dh.httt_ma
                WHERE dh.dh_ma=$dh_ma
                GROUP BY dh.dh_ma, kh.kh_tendangnhap, dh.dh_ngaylap, dh.dh_ngaygiao,
                dh.dh_noigiao, httt.httt_ten,dh.dh_trangthaithanhtoan    
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
                SELECT  sp.sp_ten, lsp.lsp_ten, nsx.nsx_ten, spddh.sp_dh_soluong, spddh.sp_dh_dongia,(spddh.sp_dh_soluong*spddh.sp_dh_dongia) thanhtien
                FROM sanpham_dondathang spddh
                JOIN sanpham sp ON spddh.sp_ma = sp.sp_ma
                JOIN nhasanxuat nsx ON sp.nsx_ma = nsx.nsx_ma
                JOIN loaisanpham lsp ON sp.lsp_ma = lsp.lsp_ma
                WHERE spddh.dh_ma = $dh_ma    
EOT;
                $resultChitiet = mysqli_query($conn,$sqlChitiet);
                $ct=[];
                while ($chitiet = mysqli_fetch_array($resultChitiet, MYSQLI_ASSOC)) {
                    $ct[] = array(
                        'sp_ten' => $chitiet['sp_ten'],
                        'lsp_ten' => $chitiet['lsp_ten'],
                        'nsx_ten' => $chitiet['nsx_ten'],
                        'sp_dh_soluong' => $chitiet['sp_dh_soluong'],
                        'sp_dh_dongia' => $chitiet['sp_dh_dongia'],
                        'thanhtien' => $chitiet['thanhtien'],
                        );
                }
            ?>
<section class="sheet padding-10mm">
 
 <!-- Write HTML just like a web page -->
 <article>
    <table>
        <tr>
            <td>
                <img src="../../assets/uploads/products/20210113115922_opporeno2.png" alt="" style="width:100px; height:100px">
            </td>
            <td style="text-align: center;"><h1 >Công ty Salomon</h1></td>
        </tr>
    </table>
    <i>Thông tin đơn hàng</i>
    <table>
        <tr>
            <td>Khách hàng:</td>
            <td><?= $row['kh_tendangnhap']?></td>
        </tr>
        <tr>
            <td>Ngày lập:</td>
            <td><?= $row['dh_ngaylap']?></td>
        </tr>
        <tr>
            <td>Hình thức thanh toán:</td>
            <td><?= $row['httt_ten']?></td>
        </tr>
        <tr>
            <td>Tổng thành tiền:</td>
            <td><?= $row['tongthanhtien']?></td>
        </tr>
    </table>
    <i>Chi tiết đơn hàng</i>
    <table>
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
                <td><?=$stt++?></td>   
                <td>
                    <?=$ctdh['sp_ten']?><br/>
                    <?=$ctdh['lsp_ten']?><br/>
                    <?=$ctdh['nsx_ten']?><br/>
                </td>
                <td></td>  
          </tr>          
          <?php endforeach;?>
    </table>
 </article>

</section>
</body>
</html>