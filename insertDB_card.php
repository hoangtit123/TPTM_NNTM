<?php
// Include file kết nối cơ sở dữ liệu
include 'db_connection.php';

// Kiểm tra xem có dữ liệu POST không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $cardID = $conn->real_escape_string($_POST['id']);

    // Kiểm tra xem mã thẻ đã tồn tại chưa
    $checkSql = "SELECT * FROM card WHERE id='$cardID'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        // Nếu mã thẻ đã tồn tại, trả về thông báo lỗi
        echo '<div class="error">Thẻ đã tồn tại trong hệ thống!</div>';
    } else {
        // Thêm thẻ mới vào cơ sở dữ liệu
        $insertSql = "INSERT INTO card (id, created_at) VALUES ('$cardID', NOW())";

        if ($conn->query($insertSql) === TRUE) {
            // Nếu thêm thành công, trả về thông báo thành công
            echo '<div class="success">Thêm thẻ thành công!</div>';
        } else {
            // Nếu có lỗi trong quá trình thêm, trả về thông báo lỗi
            echo '<div class="error">Lỗi khi thêm thẻ: ' . $conn->error . '</div>';
        }
    }
} else {
    // Nếu không nhận được dữ liệu, trả về thông báo lỗi
    echo '<div class="error">Dữ liệu không hợp lệ!</div>';
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
