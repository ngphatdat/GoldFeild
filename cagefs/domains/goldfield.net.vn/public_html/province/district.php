<option value="">Quận / Huyện</option>
<?php
    $provinceid=$_POST['provinceId'];
    echo $provinceid;
    include_once('connectdb.php');
    $sql="select * from district where province_id = '$provinceid' ";
      $result=mysqli_query($conn,$sql);
      $quan=[];
      while ($row=mysqli_fetch_array($result)){
        $quan[] = array(
          'districtid' => $row['district_id'],
          'name' => $row['name'],
        );
      }
?>
        <?php foreach($quan as $quanhuyen):?>
          <option value="<?=$quanhuyen['districtid']?>"><?=$quanhuyen['name']?></option>
        <?php endforeach;?>

