<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking Manager</title>
    <link rel="shortcut icon" href="./img/DAINAM_Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./font.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { font-family: Arial, Helvetica, sans-serif; }

        #header {
            width: 100%;
            height: 100px;
            background-color: #223771;
            color: #fff;
            line-height: 100px;
            text-align: center;
            position: relative;
        }

        #header img {
            margin: 10px;
            height: 80px;
            float: left;
        }

        .taskbar {
            width: 10%;
            height: 639px;
            background-color: #223771;
            position: relative;
        }

        .taskbar > li {
            width: 100%;
            height: 50px;
        }

        .taskbar li a {
            display: block;
            height: 100%;
            text-decoration: none;
            color: #96aae0;
            padding: 15px 20px;
        }

        .taskbar li a:hover {
            color: orangered;
            background-color: #ccc;
        }

        #body {
            background-color: rgb(161, 161, 189);
        }

        #wapper {
            position: absolute;
            width: 88%;
            height: 600px;
            background-color: #fff;
            top: 100px;
            right: 15px;
            border-radius: 20px;
            margin-top: 10px;
            padding-top: 10px;
            display: flex;
            justify-content: space-between;
        }

        #table-container {
            overflow-y: auto;
            width: 100%;
            height: 580px;
            margin: 0 10px;
        }

        #table-container table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border: 1px solid #ccc;
            text-align: center;
        }

        #table-container th {
            background-color: rgba(85, 86, 107, 1);
            color: #fff;
            font-weight: bold;
            padding: 10px;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        #table-container td {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>

    <script src="jquery.min.js"></script>
    <script>
        function sendSignal(signal) {
            $.ajax({
                url: 'send_signal.php',
                type: 'GET',
                data: { signal: signal },
                success: function(response) {
                    console.log('Signal sent: ' + signal);
                },
                error: function(xhr, status, error) {
                    console.error('Error sending signal: ' + error);
                }
            });
        }

        $(document).ready(function() {
            setInterval(loadData, 1000);
        });

        function loadData() {
            $.ajax({
                url: 'get_data.php',
                type: 'POST',
                success: function(data) {
                    $('#data').html(data);
                }
            });
        }
    </script>
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
                <li><a href="#" onclick="sendSignal('card'); window.location.href='card.php'; return false;"><i class='fa-solid fa-credit-card'></i> Card</a></li>
                <li><a href="control.php"><i class="fa-solid fa-gauge"></i> Điều khiển</a></li>
                <li><a href="search.php"><i class='fa-solid fa-search'></i> Tìm kiếm</a></li>
                <li><a href="payment.php"><i class='fa fa-money-bill'></i> Tính tiền</a></li>
                <li><a href="info.php"><i class='fa fa-info-circle'></i> Thông Tin</a></li>
            </ul>

            <div id="wapper">
                <div id="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã thẻ</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            <!-- Dữ liệu được cập nhật qua Ajax -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
