<?php
    include_once('../../../connectdb.php');
    $ma=$_GET['cv_ma'];
    $sql="DELETE FROM chucvu WHERE cv_ma=$ma";
    $result=mysqli_query($conn,$sql);
    header('location: index.php');
?>