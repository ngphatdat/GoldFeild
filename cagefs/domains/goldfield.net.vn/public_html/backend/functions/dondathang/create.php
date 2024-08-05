<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Loại Hoa</title>
</head>
<body>
    
    <div class="container-fluid">
        <div class="row">
        <?php include_once("../../layout/partials/header.php")?>
        <div class="col-md-3" style="padding: 0;">
            <?php include_once("../../layout/partials/menu.php")?>
        </div>
        <div class="col-md-9 ">
                    <?php
                            include_once('../../../connectdb.php');
                            $sqlHinhthucthanhtoan = <<<EOT
                            SELECT * from hinhthucthanhtoan   
EOT;
                            $resultHinhthucthanhtoan = mysqli_query($conn,$sqlHinhthucthanhtoan);
                            $hinhthucthanhtoan = [];
                            while ($row1 = mysqli_fetch_array($resultHinhthucthanhtoan, MYSQLI_ASSOC)) {
                                $hinhthucthanhtoan[] = array(
                                    'httt_ma' => $row1['httt_ma'],
                                    'httt_ten' => $row1['httt_ten'],
                                    );
                            }
                            $sqlhoa = <<<EOT
                            SELECT * from hoa  
EOT;
                            $resulthoa = mysqli_query($conn,$sqlhoa);
                            $hoa = [];
                            while ($row2 = mysqli_fetch_array($resulthoa, MYSQLI_ASSOC)) {
                                $hoa[] = array(
                                    'hoa_ma' => $row2['hoa_ma'],
                                    'hoa_ten' => $row2['hoa_ten'],
                                    'hoa_gia' => $row2['hoa_gia'],
                                    'hoa_soluong' => $row2['hoa_soluong'],
                                    );
                            }
                        ?>
            <div class="container">
                <form action="" method="POST" name="frmDonhang" id="frmDonhang">
                    <table>
                    <h1>Thông tin đơn hàng</h1>
                    <h3>Khách hàng</h3>
                    <div class="from-group">
                            <label for="tenkhachhang">Tên khách hàng</label>
                            <input type="text" name="tenkhachhang" id="tenkhachhang" class="form-control"/><br/>
                            <label for="sodienthoai">Số điện thoại</label>
                            <input type="text" name="sodienthoaimua" id="sodienthoaimua" class="form-control"/>
                    </div>
                    <!-- <div class="from-group">
                            <label for="tenkhachhang">Tên người nhận</label>
                            <input type="text" name="tennguoinhan" id="tennguoinhan" class="form-control"/><br/>
                            <label for="sodienthoai">Số điện thoại người nhận</label>
                            <input type="text" name="sodienthoainhan" id="sodienthoainhan" class="form-control"/>
                    </div> -->
                    <!-- <div class="from-group">
                        <label for="dh_ngaylap">Ngày lập</label>
                        <input type="text" name="dh_ngaylap" id="dh_ngaylap" class="form-control"/>
                    </div> -->
                    <!-- <div class="from-group">
                        <label for="dh_ngaygiao">Ngày giao</label>
                        <input type="text" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control"/>
                    </div> -->
                    <div class="from-group">
                        <label for="dh_noigiao">Nơi giao</label>
                        <input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control"/>
                    </div>
                    <div class="from-group">
                        <label for="dh_noigiao">Hình thức thanh toán</label>
                        <select name="httt_ma" class="form-control">
                        <?php foreach($hinhthucthanhtoan as $httt):?>
                            <option value="<?=$httt['httt_ma']?>">
                            <?=$httt['httt_ten']?>
                            </option>
                        <?php endforeach;?>
                        </select>
                    </div>  
                    </table>

                    <table>
                        <h1>Chi tiết đơn hàng</h1>
                        <div class="form-group">
                            <label for="">Sản phẩm</label>
                            <select name="hoa_ma" id="hoa_ma" class="form-control">
                                <?php foreach($hoa as $hoa):?>
                                    <option value="<?=$hoa['hoa_ma']?>" giahoa="<?=$hoa['hoa_gia']?>">
                                        <?=$hoa['hoa_ten']?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hoa_soluong">Số lượng</label>
                            <input type="number" name="hoa_soluong" id="hoa_soluong" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <button type="button" name="btnThem" id="btnThem" class="btn btn-primary">Thêm vào đơn hàng</button>
                        </div>
                    </table>

                    <table id="tblChiTietDonHang" class="table table-bordered">
                        <thead>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Hành động</th>
                        </thead>
                        <tbody>
                        </tbody>                
                    </table>
                    <button class="btn btn-primary" name="btnSave" id="btnSave">Lưu đơn hàng</button>
                </form>

                <?php
                // Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh
                if (isset($_POST['btnSave'])) {
                    // 1. Phân tách lấy dữ liệu người dùng gởi từ REQUEST POST
                    // Thông tin đơn hàng
                    $tenkhachhang = $_POST['tenkhachhang'];
                    $sodienthoaimua = $_POST['sodienthoaimua'];
                    //$tennguoinhan = $_POST['tennguoinhan'];
                    //$sodienthoainhan = $_POST['sodienthoainhan'];
                    //$dh_ngaylap = $_POST['dh_ngaylap'];
                    $dh_ngaylap = date("Y/m/d h:i:s");
                    //$dh_ngaygiao = $_POST['dh_ngaygiao'];
                    $dh_noigiao = $_POST['dh_noigiao'];
                    $httt_ma = $_POST['httt_ma'];

                    // Thông tin các dòng chi tiết đơn hàng
                    $arr_hoa_ma = $_POST['hoa_ma'];                   // mảng array do đặt tên name="hoa_ma[]"
                    $arr_hoa_dh_soluong = $_POST['hoa_dh_soluong'];   // mảng array do đặt tên name="hoa_dh_soluong[]"
                    $arr_hoa_dh_dongia = $_POST['hoa_dh_dongia'];     // mảng array do đặt tên name="hoa_dh_dongia[]"
                    
                    // 2. Thực hiện câu lệnh Tạo mới (INSERT) Đơn hàng
                    // Câu lệnh INSERT
                    $sqlInsertDonHang = "INSERT INTO `dondathang` (`dh_ngaylap`, `dh_noigiao`, `httt_ma`, `tenkhachhang` , `sodienthoaimua` ) VALUES ('$dh_ngaylap' , N'$dh_noigiao', '$httt_ma', '$tenkhachhang', '$sodienthoaimua')";
                    // print_r($sqlInsertDonHang); die;
                    // Thực thi INSERT Đơn hàng
                    mysqli_query($conn, $sqlInsertDonHang);
                    
                    // 3. Lấy ID Đơn hàng mới nhất vừa được thêm vào database
                    // Do ID là tự động tăng (PRIMARY KEY và AUTO INCREMENT), nên chúng ta không biết được ID đă tăng đến số bao nhiêu?
                    // Cần phải sử dụng biến `$conn->insert_id` để lấy về ID mới nhất
                    // Nếu thực thi câu lệnh INSERT thành công thì cần lấy ID mới nhất của Đơn hàng để làm khóa ngoại trong Chi tiết đơn hàng
                    $dh_ma = $conn->insert_id;
                    
                    // 4. Duyệt vòng lặp qua mảng các dòng Sản phẩm của chi tiết đơn hàng được gởi đến qua request POST
                    for($i = 0; $i < count($arr_hoa_ma); $i++) {
                        // 4.1. Chuẩn bị dữ liệu cho câu lệnh INSERT vào table `sanpham_dondathang`
                        $hoa_ma = $arr_hoa_ma[$i];
                        $hoa_dh_soluong = $arr_hoa_dh_soluong[$i];
                        $hoa_dh_dongia = $arr_hoa_dh_dongia[$i];
                        
                        // 4.2. Câu lệnh INSERT
                        $sqlInsertSanPhamDonDatHang = "INSERT INTO `hoa_dondathang` (`hoa_ma`, `dh_ma`, `hoa_dh_soluong`, `hoa_dh_dongia`) VALUES ($hoa_ma, $dh_ma, $hoa_dh_soluong, $hoa_dh_dongia)";
                        // var_dump($sqlInsertSanPhamDonDatHang);die;
                        
                        // 4.3. Thực thi INSERT
                        mysqli_query($conn, $sqlInsertSanPhamDonDatHang);
                    }

                    // 5. Thực thi hoàn tất, điều hướng về trang Danh sách
                    echo '<script>location.href = "index.php";</script>';
                }
                ?>

            </div>        
            <script>
                    // Đăng ký sự kiện Click nút Thêm Sản phẩm

                    $('#btnThem').click(function() {
                        debugger;
                        // Lấy thông tin Sản phẩm
                        var hoa_ma = $('#hoa_ma').val();
                        var hoa_gia = $('#hoa_ma option:selected').attr('giahoa');
                        var hoa_ten = $('#hoa_ma option:selected').text();
                        var soluong = $('#hoa_soluong').val();
                        var thanhtien = (soluong * hoa_gia);
                        
                        // Tạo mẫu giao diện HTML Table Row
                        var htmlTemplate = '<tr>'; 
                        htmlTemplate += '<td>' + hoa_ten + '<input type="hidden" name="hoa_ma[]" value="' + hoa_ma + '"/></td>';
                        htmlTemplate += '<td>' + soluong + '<input type="hidden" name="hoa_dh_soluong[]" value="' + soluong + '"/></td>';
                        htmlTemplate += '<td>' + hoa_gia + '<input type="hidden" name="hoa_dh_dongia[]" value="' + hoa_gia + '"/></td>';
                        htmlTemplate += '<td>' + thanhtien + '</td>';
                        htmlTemplate += '<td><button type="button" class="btn btn-danger btn-delete-row">Xóa</button></td>';
                        htmlTemplate += '</tr>';

                        // Thêm vào TABLE BODY
                        $('#tblChiTietDonHang tbody').append(htmlTemplate);

                        // Clear
                        // $('#hoa_ma').val('');
                        // $('#soluong').val('');
                    });

                    $('#tblChiTietDonHang').on('click', 'button', function(){
                        $(this).parent().parent()[0].remove();

                    });
            </script>
        </div>
    </div>    
    <?php include_once("../../layout/partials/footer.php")?>
</div>
<?php include_once("../../layout/partials/script.php")?>
</body>
</html>