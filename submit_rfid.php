<?php
// Include file kết nối cơ sở dữ liệu
include 'db_connection.php';

// Kiểm tra xem có dữ liệu POST không
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rfid'])) {
    $rfid = $_POST['rfid'];

    // Kiểm tra xem thẻ RFID có tồn tại trong bảng card hay không
    $sql = "SELECT * FROM card WHERE id = '$rfid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kiểm tra trạng thái cuối cùng của thẻ trong bảng history
        $sql = "SELECT status FROM history WHERE rfid = '$rfid' ORDER BY time DESC LIMIT 1";
        $historyResult = $conn->query($sql);

        if ($historyResult->num_rows > 0) {
            $row = $historyResult->fetch_assoc();
            $newStatus = ($row['status'] == 'in') ? 'out' : 'in';
        } else {
            // Nếu không có lịch sử trước đó, giả định thẻ ở trạng thái 'out'
            $newStatus = 'in';
        }

        // Thêm bản ghi mới vào bảng history với trạng thái mới
        $sql = "INSERT INTO history (rfid, status, time) VALUES ('$rfid', '$newStatus', NOW())";
        if ($conn->query($sql) === TRUE) {
            echo $newStatus == 'in' ? "Vao" : "Ra"; // Trả về trạng thái mới
        } else {
            echo "Khong hop le"; // Lỗi khi thêm vào bảng history
        }
    } else {
        // Nếu thẻ không tồn tại, thêm trạng thái 'Không hợp lệ' vào bảng history
        $sql = "INSERT INTO history (rfid, status, time) VALUES ('$rfid', 'not_valid', NOW())";
        if ($conn->query($sql) === TRUE) {
            echo "Khong hop le"; // Trả về trạng thái không hợp lệ
        } else {
            echo "Loi khi them vao history"; // Lỗi khi thêm vào bảng history
        }
    }
} else {
    echo "Khong nhan duoc RFID";
}

// Đóng kết nối
$conn->close();
?>
