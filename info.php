<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking Manager</title>
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
        background-color: #223771;
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
        background-color: #333d59;
        top: 100px;
        right: 15px;
        border-radius: 20px;
        margin-top: 10px;
        padding-top: 10px;
        padding-left: 20px;
        color: white;
    }

    #wapper h1 {
        text-transform: uppercase;
        padding-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table td {
        padding: 10px;
    }

    table td:first-child {
        font-weight: bold;
        width: 30%;
    }

    p {
        padding-top: 20px;
    }

    .wapper-header {
        text-align: center;
        padding-top: 40px;
    }

    .wapper-info {
        padding-left: 40%;
        padding-top: 50px;
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
                <li><a href="#" onclick="sendSignal('home'); window.location.href='index.php'; return false;"><i
                            class='fa-solid fa-house'></i> Home</a></li>
                <li><a href="#" onclick="sendSignal('card'); window.location.href='card.php'; return false;"><i
                            class='fa-solid fa-credit-card'></i> Card</a></li>
                <li><a href="control.php"><i class="fa-solid fa-gauge"></i> Điều khiển</a></li>
                <li><a href="search.php"><i class='fa-solid fa-search'></i> Tìm kiếm</a></li>
                <li><a href="info.php"><i class='fa fa-info-circle'></i> Thông Tin</a></li>
            </ul>
            <div id="wapper">
                <div class="wapper-header">
                    <h1>trường đại học Đại Nam</h1>
                    <h1>đề tài: bãi đỗ xe thông minh</h1>
                </div>
                <div class="wapper-info">
                    <h4>Thực hiện:</h4>
                    <p>Nguyễn Việt Hoàng (MSV 15721020108)</p>
                    <p>Lớp: CNTT1502</p>
                    <p>Năm học: 2025</p>
                </div>

            </div>
        </div>
    </div>
</body>

</html>