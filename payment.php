<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Giá Tiền Gửi Xe</title>
    <link rel="shortcut icon" href="./img/DAINAM_Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./font.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { font-family: Arial, Helvetica, sans-serif; }

        #header {
            width: 100%; height: 100px; background-color: #223771;
            color: #fff; line-height: 100px; text-align: center;
            position: relative;
        }
        #header img {
            margin: 10px; height: 80px; float: left;
        }

        .taskbar {
            width: 10%; height: 639px; background-color: #223771; position: relative;
        }
        .taskbar > li {
            width: 100%; height: 50px;
        }
        .taskbar > li > a {
            display: block; height: 100%; text-decoration: none;
            color: #96aae0; padding: 15px 20px;
        }
        .taskbar li a:hover {
            color: orangered; background-color: #ccc;
        }

        #body { background-color: rgb(161, 161, 189); }

        #wapper {
            position: absolute; width: 88%; height: auto;
            background-color: #fff; top: 100px; right: 15px;
            border-radius: 20px; margin-top: 10px; padding: 20px;
        }

        h2 { text-align: center; margin-bottom: 20px; color: #223771; }

        .pricing-table, .history-table {
            width: 100%; border-collapse: collapse; margin-bottom: 20px;
        }
        .pricing-table th, .pricing-table td, .history-table th, .history-table td {
            border: 1px solid #ccc; padding: 10px; text-align: center;
        }
        .pricing-table th {
            background-color: #28a745; color: white;
        }
        .history-table th {
            background-color: #223771; color: white;
        }

        .btn {
            padding: 8px 12px; border: none; border-radius: 4px;
            color: #fff; cursor: pointer; font-size: 14px;
        }
        .btn-edit { background-color: #007bff; }
        .btn-save { background-color: #28a745; }
        .btn-cancel { background-color: #dc3545; }

        .btn-container {
            display: flex; justify-content: center; gap: 10px; margin-top: 20px;
        }
    </style>
</head>

<body>
<div id="main">
    <div id="header">
        <img src="./img/DAINAM_Logo.png" alt="">
        <h1>SMART PARKING MANAGER</h1>
    </div>
    <div id="body">
        <ul class="taskbar">
            <li><a href="index.php"><i class='fa-solid fa-house'></i> Home</a></li>
            <li><a href="card.php"><i class='fa-solid fa-credit-card'></i> Card</a></li>
            <li><a href="control.php"><i class="fa-solid fa-gauge"></i> Điều khiển</a></li>
            <li><a href="search.php"><i class='fa-solid fa-search'></i> Tìm kiếm</a></li>
            <li><a href="payment.php"><i class='fa fa-money-bill'></i> Tính tiền</a></li>
            <li><a href="info.php"><i class='fa fa-info-circle'></i> Thông Tin</a></li>
        </ul>

        <div id="wapper">
            <h2>Bảng Giá Tiền Gửi Xe</h2>
            <table class="pricing-table">
                <thead>
                    <tr>
                        <th>Thời gian</th>
                        <th>Giá tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Từ 7h – 17h</td><td>3.000 VND</td></tr>
                    <tr><td>Từ 17h – 23h</td><td>10.000 VND</td></tr>
                    <tr><td>Từ 23h – 7h</td><td>20.000 VND</td></tr>
                    <tr><td>Thẻ tháng</td><td>100.000 VND</td></tr>
                </tbody>
            </table>

            <form method="post" action="update_payment.php">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã thẻ</th>
                            <th>Thời gian vào</th>
                            <th>Thời gian ra</th>
                            <th>Mức phí</th>
                            <th>Phụ phí</th>
                            <th>Tổng tiền</th>
                            <th>Thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP đổ dữ liệu tại đây -->
                    </tbody>
                </table>
                <div class="btn-container">
                    <button type="button" class="btn btn-edit">Chỉnh sửa</button>
                    <button type="submit" class="btn btn-save">Lưu</button>
                    <button type="reset" class="btn btn-cancel">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
