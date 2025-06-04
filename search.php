<?php
// Kết nối tới cơ sở dữ liệu
include 'db_connection.php';

// Lấy từ khóa tìm kiếm từ yêu cầu (nếu có)
$keyword = isset($_GET['keyword']) ? $conn->real_escape_string($_GET['keyword']) : '';

// Tạo câu truy vấn tìm kiếm
$sql = "SELECT rfid, status, time FROM history WHERE rfid LIKE '%$keyword%' OR status LIKE '%$keyword%' ORDER BY time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm</title>
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
            height: 500px;
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

        .search-container {
            width: 90%;
            margin: 0 auto;
            margin-bottom: 20px;
            text-align: center;
        }

        .search-container input {
            width: 300px;
            padding: 10px;
            font-size: 16px;
        }

        .search-container button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #223771;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-container button:hover {
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
                <!-- Thanh tìm kiếm -->
                <div class="search-container">
                    <form method="GET" action="search.php">
                        <input type="text" name="keyword" placeholder="Nhập mã thẻ hoặc trạng thái" value="<?php echo htmlspecialchars($keyword); ?>">
                        <button type="submit">Tìm kiếm</button>
                    </form>
                </div>

                <!-- Bảng dữ liệu -->
                <div id="table-container">
                    <table>
                        <thead class="sticky-thead">
                            <tr>
                                <th>STT</th>
                                <th>Mã thẻ</th>
                                <th>Trạng thái</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            <?php
                            if ($result->num_rows > 0) {
                                $stt = 1; // Biến số thứ tự ban đầu
                                while($row = $result->fetch_assoc()) {
                                    // Chuyển đổi trạng thái sang tiếng Việt
                                    if ($row["status"] == 'in') {
                                        $status = "Vào";
                                    } elseif ($row["status"] == 'out') {
                                        $status = "Ra";
                                    } elseif ($row["status"] == 'not_valid') {
                                        $status = "Không hợp lệ";
                                    } else {
                                        $status = $row["status"];
                                    }

                                    echo "<tr>";
                                    echo "<td>" . $stt . "</td>";
                                    echo "<td>" . $row["rfid"]. "</td>";
                                    echo "<td>" . $status . "</td>";
                                    echo "<td>" . $row["time"]. "</td>";
                                    echo "</tr>";
                                    $stt++;
                                }
                            } else {
                                echo "<tr><td colspan='4'>Không có dữ liệu phù hợp</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$conn->close();
?>
