<option value="">Xã / Phường / Thị trấn</option>
<?php
    $districtid=$_POST['districtId'];
    $conn=mysqli_connect("localhost","root","","diachi");
    $sql="select * from ward where districtid = '$districtid' ";
    // $sql="select * from district where provinceid = '04TTT' ";
      $result=mysqli_query($conn,$sql);
      $xa=[];
      while ($row=mysqli_fetch_array($result)){
        $xa[] = array(
          'wardid' => $row['wardid'],
          'name' => $row['name'],
        );
      }
?>
        <?php foreach($xa as $xaphuong):?>
          <option value="<?=$xaphuong['wardid']?>"><?=$xaphuong['name']?></option>
        <?php endforeach;?>