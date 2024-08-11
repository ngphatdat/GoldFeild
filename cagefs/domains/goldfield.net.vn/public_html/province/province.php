<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery.min.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
    <?php
      include_once('../connectdb.php');
      $sql="select * from province";
      $result=mysqli_query($conn,$sql);
      $tinh=[];
      while ($row=mysqli_fetch_array($result)){
        $tinh[] = array(
          'provinceid' => $row['province_id'],
          'name' => $row['name'],
        );
      }
    ?>
    <select class="form-control" name="province" id="province" required="">
        <option value="">Tỉnh / Thành phố</option>
        <?php foreach($tinh as $tinhtp):?>
          <option value="<?=$tinhtp['provinceid']?>"><?=$tinhtp['name']?></option>
        <?php endforeach;?>
      </select>
      <select class="form-control" name="district" id="district" required="">
        <option value="">Quận / Huyện</option>
      </select>
      <select class="form-control" name="ward" id="ward" required="">
        <option value="">Xã / Phường / Thị trấn</option>
      </select>
  <script>
    jQuery(document).ready(function($){
      $("#province").change(function(event){
        provinceid =$("#province").val();
        $.post('province/district.php', {"provinceId":provinceid}, function(data){
          $("#district").html(data);
        });
      });
      $("#district").change(function(event){
        districtid =$("#district").val();
        $.post('province/ward.php', {"districtId":districtid}, function(data){
          $("#ward").html(data);
        });
      });
    });

  </script>

</body>
</html>