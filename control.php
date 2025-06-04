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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-family: Arial, Helvetica, sans-serif;
        }

        #header {
            width: 100%;
            height: 100px;
            position: relative;
            background-color:rgb(34, 47, 113);
            text-align: center;
            color: #fff;
            line-height: 100px;
        }

        #header img {
            margin: 10px;
            height: 80px;
            width: auto;
            float: left;
        }

        .taskbar {
            width: 10%;
            position: relative;
            height: 639px;
            background-color: #223771;
        }

        .taskbar>li {
            width: 100%;
            height: 50px;

        }

        .taskbar li a:hover {
            color: orangered;
            background-color: #ccc;
        }

        .taskbar>li>a {
            display: block;
            height: 100%;
            text-decoration: none;
            color: #96aae0;
            padding-top: 15px;
            padding-left: 20px;
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
        }

        #table-container {
            overflow-y: scroll;
            width: 90%;
            height: 580px;
            margin: 0 auto;
        }

        #table-container table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border: 1px solid #ccc;
            text-align: center;
        }

        #table-container table th {
            background-color: rgba(85, 86, 107, 1);
            color: #fff;
            font-weight: bold;
            padding: 10px;
        }

        #table-container table tr {
            border: 1px solid #ccc;
        }

        #table-container table td {
            padding: 10px;
        }

        .sticky-thead {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .table-header {
            padding-left: 20px;
            padding-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #223771;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: orangered;
        }
    </style>
    <script src="jquery.min.js"></script>
    <script>
        function sendSignal(signal) {
            $.ajax({
                url: 'send_signal.php',
                type: 'GET',
                data: {
                    signal: signal
                },
                success: function(response) {
                    console.log('Signal sent: ' + signal);
                },
                error: function(xhr, status, error) {
                    console.error('Error sending signal: ' + error);
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
                <li><a href="#" onclick="sendSignal('home'); window.location.href='index.php'; return false;"><i class='fa-solid fa-house'></i> Home</a></li>
                <li><a href="#" onclick="sendSignal('card'); window.location.href='card.php'; return false;"><i class='fa-solid fa-credit-card'></i> Card</a></li>
                <li><a href="control.php"><i class="fa-solid fa-gauge"></i> Điều khiển</a></li>
                <li><a href="search.php"><i class='fa-solid fa-search'></i> Tìm kiếm</a></li>
                <li><a href="info.php"><i class='fa fa-info-circle'></i> Thông Tin</a></li>
            </ul>
            <div id="wapper">
                <button onclick="sendSignal('open1')">Mở 1</button>
                <button onclick="sendSignal('close1')">Đóng 1</button>
                <button onclick="sendSignal('open2')">Mở 2</button>
                <button onclick="sendSignal('close2')">Đóng 2</button>
            </div>
        </div>
    </div>
</body>

</html>