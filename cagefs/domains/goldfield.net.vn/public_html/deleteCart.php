<?php
    session_start();
    $hoa_ma=$_GET['hoa_ma'];
    if(isset($_SESSION['gioHang'])){
        unset($_SESSION['gioHang'][$hoa_ma]);
        header('location: giohang.php');
    }
?>