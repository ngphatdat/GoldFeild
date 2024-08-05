<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Don dat hang</title>
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <script src="../../vendor/jquery/jquery.min.js"></script>
</head>
<body>
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
                <input type="text" name="tenkhachhang" id="tenkhachhang"/><br/>
                <label for="sodienthoai">Số điện thoại</label>
                <input type="text" name="sodienthoai" id="sodienthoai"/>
        </div>
        <div class="from-group">
            <label for="dh_ngaylap">Ngày lập</label>
            <input type="text" name="dh_ngaylap" id="dh_ngaylap" class="form-control"/>
        </div>
        <div class="from-group">
            <label for="dh_ngaygiao">Ngày giao</label>
            <input type="text" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control"/>
        </div>
        <div class="from-group">
            <label for="dh_noigiao">Nơi giao</label>
            <input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control"/>
        </div>
        <div class="from-group">
            <label for="dh_noigiao">Trạng thái thanh toán</label> <br/>
            <input type="radio" id="dh_trangthaithanhtoan1" name="dh_trangthaithanhtoan" value="0" > Chưa thanh toán <br/>
            <input type="radio" id="dh_trangthaithanhtoan2" name="dh_trangthaithanhtoan" value="0"> Đã thanh toán <br/>
        </div>
        <div class="from-group">
            <label for="dh_noigiao">Trạng thái thanh toán</label>
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
            <h1>Chi tiet don hang</h1>
            <div class="form-group">
                <label for="">San pham</label>
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
    <button class="btn btn-primary" name="btnSave">Lưu</button>
    </form>
    <?php
                // Nếu người dùng có bấm nút Đăng ký thì thực thi câu lệnh
                if (isset($_POST['btnSave'])) {
                    // 1. Phân tách lấy dữ liệu người dùng gởi từ REQUEST POST
                    // Thông tin đơn hàng
                    $tenkhachhang = $_POST['tenkhachhang'];
                    $sodienthoai = $_POST['sodienthoai'];
                    $dh_ngaylap = $_POST['dh_ngaylap'];
                    $dh_ngaygiao = $_POST['dh_ngaygiao'];
                    $dh_noigiao = $_POST['dh_noigiao'];
                    $dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];
                    $httt_ma = $_POST['httt_ma'];

                    // Thông tin các dòng chi tiết đơn hàng
                    $arr_hoa_ma = $_POST['hoa_ma'];                   // mảng array do đặt tên name="hoa_ma[]"
                    $arr_hoa_dh_soluong = $_POST['hoa_dh_soluong'];   // mảng array do đặt tên name="hoa_dh_soluong[]"
                    $arr_hoa_dh_dongia = $_POST['hoa_dh_dongia'];     // mảng array do đặt tên name="hoa_dh_dongia[]"
                    // var_dump($hoa_ma);die;

                    // 2. Thực hiện câu lệnh Tạo mới (INSERT) Đơn hàng
                    // Câu lệnh INSERT
                    $sqlInsertDonHang = "INSERT INTO `dondathang` (`dh_ngaylap`, `dh_ngaygiao`, `dh_noigiao`, `dh_trangthaithanhtoan`, `httt_ma`, `tenkhachhang` , `sodienthoai`) VALUES ('$dh_ngaylap', '$dh_ngaygiao', N'$dh_noigiao', '$dh_trangthaithanhtoan', '$httt_ma', '$tenkhachhang', '$sodienthoai')";
                    // print_r($sql); die;

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
                        $sqlInsertSanPhamDonDatHang = "INSERT INTO `sanpham_dondathang` (`hoa_ma`, `dh_ma`, `hoa_dh_soluong`, `hoa_dh_dongia`) VALUES ($hoa_ma, $dh_ma, $hoa_dh_soluong, $hoa_dh_dongia)";

                        // 4.3. Thực thi INSERT
                        mysqli_query($conn, $sqlInsertSanPhamDonDatHang);
                    }

                    // 5. Thực thi hoàn tất, điều hướng về trang Danh sách
                    // echo '<script>location.href = "index.php";</script>';
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
</body>
</html> 