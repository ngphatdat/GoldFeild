<?php
    include_once('../../../connectdb.php');
    $ma=$_GET['hsp_ma'];
    $sql="DELETE FROM hinhsanpham WHERE hsp_ma=$ma";
    $result=mysqli_query($conn,$sql);
    header('location: index.php');
?>