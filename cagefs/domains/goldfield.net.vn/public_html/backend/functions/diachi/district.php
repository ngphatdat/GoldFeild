<option value="">Quận / Huyện</option>
<?php
    $provinceid=$_POST['provinceId'];
    echo $provinceid;
    $conn=mysqli_connect("localhost","root","","diachi");
    $sql="select * from district where provinceid = '$provinceid' ";
      $result=mysqli_query($conn,$sql);
      $quan=[];
      while ($row=mysqli_fetch_array($result)){
        $quan[] = array(
          'districtid' => $row['districtid'],
          'name' => $row['name'],
        );
      }
?>
        <?php foreach($quan as $quanhuyen):?>
          <option value="<?=$quanhuyen['districtid']?>"><?=$quanhuyen['name']?></option>
        <?php endforeach;?>

