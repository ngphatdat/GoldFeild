<?php
    include_once('../../../connectdb.php');
    $ma=$_GET['nv_ma'];
    $sql="DELETE FROM nhanvien WHERE nv_ma=$ma";
    $result=mysqli_query($conn,$sql);
    header('location: index.php');
?>