<?php
// Include file kết nối cơ sở dữ liệu
include 'db_connection.php';

// Xử lý yêu cầu xóa thẻ
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $idToDelete = $conn->real_escape_string($_POST['id']);
    $deleteSql = "DELETE FROM card WHERE id='$idToDelete'";
    if ($conn->query($deleteSql) === TRUE) {
    } else {
        echo "<div class='error'>Lỗi xóa thẻ: " . $conn->error . "</div>";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="vi">

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

        #wrapper {
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
            overflow-y: scroll;
            width: 65%;
            height: 580px;
            margin: 0 10px;
            float: left;
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
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        /* CSS cho phần thêm thẻ mới */
        .right-container {
            width: 35%;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 0 10px 10px;
        }

        .right-container h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .right-container label {
            font-size: 16px;
            display: block;
            margin-bottom: 10px;
        }

        .right-container textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            resize: none;
            font-size: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .right-container button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 auto;
            display: block;
        }

        .right-container button:hover {
            background-color: #218838;
        }

        /* CSS cho phần thông báo */
        #message {
            text-align: center;
            margin-top: 20px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
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

        // Hàm tải lại danh sách thẻ bằng AJAX
        function loadCardList() {
            $.ajax({
                url: 'get_cards.php',
                success: function(data) {
                    $('#data').html(data); // Cập nhật lại nội dung của bảng thẻ
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi tải danh sách thẻ: ' + error);
                }
            });
        }

        function hideMessageAfterTimeout() {
            setTimeout(function() {
                $('#message').fadeOut('slow', function() {
                    $(this).html('').show(); // Xóa nội dung và hiển thị lại vùng chứa
                });
            }, 1000); // 1 giây
        }

        $(document).ready(function() {
            $('#addCardForm').on('submit', function(e) {
                e.preventDefault(); // Ngăn chặn hành động mặc định của form

                $.ajax({
                    url: 'insertDB_card.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#message').html(response); // Hiển thị thông báo trong phần message

                        // Tải lại danh sách thẻ nếu thêm thành công
                        if (response.includes('Thêm thẻ thành công')) {
                            loadCardList();
                        }

                        hideMessageAfterTimeout(); // Ẩn thông báo sau 3 giây
                    },
                    error: function(xhr, status, error) {
                        $('#message').html('<div class="error">Lỗi: ' + error + '</div>');
                        hideMessageAfterTimeout(); // Ẩn thông báo sau 1 giây
                    }
                });
            });

            // Tải lần đầu khi trang được tải
            loadCardList();

            // Phần AJAX để lấy UID
            $("#getUID").load("UIDContainer.php");
            setInterval(function() {
                $("#getUID").load("UIDContainer.php");
            }, 500);
        });
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
                <li><a href="card.php"><i class='fa-solid fa-credit-card'></i> Card</a></li>
                <li><a href="control.php"><i class="fa-solid fa-gauge"></i> Điều khiển</a></li>
                <li><a href="search.php"><i class='fa-solid fa-search'></i> Tìm kiếm</a></li>
                <li><a href="info.php"><i class='fa fa-info-circle'></i> Thông Tin</a></li>
            </ul>
            <div id="wrapper">
                <!-- Phần hiển thị danh sách thẻ -->
                <div id="table-container">
                    <table>
                        <thead class="sticky-thead">
                            <tr>
                                <th>STT</th>
                                <th>Mã thẻ</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            <!-- Nội dung sẽ được load từ get_cards.php bằng AJAX -->
                        </tbody>
                    </table>
                </div>

                <!-- Phần thêm thẻ mới -->
                <div class="right-container">
                    <h1>Thêm Thẻ Mới</h1>
                    <form id="addCardForm">
                        <label for="id">Mã Thẻ:</label>
                        <div class="controls">
                            <textarea name="id" id="getUID" placeholder="Vui lòng quét để hiển thị mã thẻ" required readonly></textarea>
                        </div>
                        <button type="submit">Thêm Thẻ</button>
                    </form>
                    <div id="message"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Bạn có chắc chắn muốn xóa thẻ này?");
        }
    </script>
</body>

</html>