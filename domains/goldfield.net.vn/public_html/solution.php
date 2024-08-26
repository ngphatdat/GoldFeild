<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LẮNG NGHE VÀ CHIA SẼ</title>
    <style>
        /* Tab Links */
        .tabs {
            display: flex;
        }
        .tablinks {
            border: none;
            outline: none;
            cursor: pointer;
            width: 25%; /* Điều chỉnh để các nút tab chia đều */
            padding: 1rem;
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 600;
            transition: 0.2s ease;
        }
        .tablinks:hover {
            background: blue;
            color: #fff;
        }
        /* Tab active */
        .tablinks.active {
            background: blue;
            color: #fff;
        }

        /* tab content */
        .tabcontent {
            display: none;
        }
        /* Text */
        .tabcontent p {
            color: #333;
            font-size: 16px;
        }
        /* tab content active */
        .tabcontent.active {
            display: block;
        }
    </style>
</head>
<body>
    <?php include_once('header.php'); ?>
    <div class="container mt-0" style="background-color: white;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2 class="text-center mt-2">GIẢI PHÁP</h2>
                <div class="tabs">
                    <button class="tablinks" data-electronic="solution_durian">SẦU RIÊNG</button>
                    <button class="tablinks" data-electronic="solution_mongo">XOÀI</button>
                    <button class="tablinks" data-electronic="solution_jackfruit">MÍT</button>
                    <button class="tablinks" data-electronic="solution_vegetables">LÚA Và RAU MÀU</button>
                </div>
                <div id="tab-content" class="container">
                    <!-- Nội dung sẽ được tải vào đây -->
                </div>
            </div>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadTab(file) {
                $('#tab-content').load('solution/' + file + '.php');
            }

            $('.tablinks').click(function() {
                // Xóa lớp 'active' khỏi tất cả các nút tab và thêm vào nút đã nhấn
                $('.tablinks').removeClass('active');
                $(this).addClass('active');
                // Lấy giá trị data-electronic và tải nội dung tương ứng
                var file = $(this).data('electronic');
                loadTab(file);
            });

            // Tải nội dung của tab mặc định khi trang được tải
            $('.tablinks').first().addClass('active');
            loadTab($('.tablinks').first().data('electronic'));
        });
    </script>
</body>
</html>
