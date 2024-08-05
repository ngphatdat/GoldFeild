<?php
    include_once('../../../connectdb.php');
    $ma=$_GET['dh_ma'];
    $sql="DELETE FROM hoa_dondathang where dh_ma=$ma";
    $result=mysqli_query($conn,$sql);
    
    $sql2="DELETE FROM dondathang where dh_ma=$ma";
    $result2=mysqli_query($conn,$sql2);
    header('location: index.php');
?>