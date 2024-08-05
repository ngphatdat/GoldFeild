<?php
    include_once('../../../connectdb.php');
    $ma=$_GET['hoa_ma'];
    $sql="DELETE FROM hoa WHERE hoa_ma=$ma";
    $result=mysqli_query($conn,$sql);
    header('location: index.php');
?>