<?php
    $conn=mysqli_connect("localhost","root","","tfeqrnuy_goldfiel")
    or die ("Không kết nối được database vui lòng kết nối lại!!!");
    $conn->query("SET NAMES 'utf8mb4'"); 
    session_start();
?>