<option value="">Xã / Phường / Thị trấn</option>
<?php
    $districtid=$_POST['districtId'];
    include_once('connectdb.php');
    $sql="select * from wards where district_id = '$districtid' ";
    // $sql="select * from district where provinceid = '04TTT' ";
      $result=mysqli_query($conn,$sql);
      $xa=[];
      while ($row=mysqli_fetch_array($result)){
        $xa[] = array(
          'wardid' => $row['ward_id'],
          'name' => $row['name'],
        );
      }
?>
        <?php foreach($xa as $xaphuong):?>
          <option value="<?=$xaphuong['wardid']?>"><?=$xaphuong['name']?></option>
        <?php endforeach;?>