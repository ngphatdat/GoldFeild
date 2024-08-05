<?php
    include_once('../../../connectdb.php');
    $ma=$_GET['lh_ma'];
    $sql="DELETE FROM loaihoa WHERE lh_ma=$ma";
    $result=mysqli_query($conn,$sql);
    header('location: index.php');
?>