<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="backend/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="backend/vendor/font-awesome/css/font-awesome.css">
    <title>Document</title>
    <style>
        a:hover{
            text-decoration: none;
            color:black;
        }
        ul{
            text-align: left;
            margin-left: 40px;
            padding: 0px;
            list-style-type: none;
        }
        ul li a{  
            text-decoration: none;
            color:black;
            font-size: 20px;
            display: block;
            
        }
        ul li{
            height: 33px;
        }
        ul li a:hover{
            color: black;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body style="background-color: #dcdcdc;">
    <div class="container-fluid" style="background-color: white;">
        <div class="row text-center" style="height: 120px;">
            <div class="col-md-1"></div>
            <div class="col-md-2 mt-1">
                <a href="index.php"><img src="backend/assets/imgs/logosmall.png"></a>
            </div>
            
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <?php include_once("script.php")?>
</body>
</html>