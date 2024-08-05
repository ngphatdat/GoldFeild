<?php
    include_once('../../../connectdb.php');
    $ma=$_GET['ma_bv'];
    $sql="DELETE FROM baiviet WHERE ma_bv=$ma";
    $result=mysqli_query($conn,$sql);
    header('location: index.php');
?>