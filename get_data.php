<?php
// Kết nối tới cơ sở dữ liệu
include 'db_connection.php';

// Truy vấn dữ liệu từ bảng history
$sql = "SELECT rfid, status, time FROM history ORDER BY time DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $stt = 1;
    while ($row = $result->fetch_assoc()) {
        // Chuyển trạng thái tiếng Anh -> tiếng Việt
        $status = $row["status"];
        if ($status == 'in') $status = "Vào";
        elseif ($status == 'out') $status = "Ra";
        elseif ($status == 'not_valid') $status = "Không hợp lệ";

        echo "<tr>";
        echo "<td>$stt</td>";
        echo "<td>" . htmlspecialchars($row["rfid"]) . "</td>";
        echo "<td>$status</td>";
        echo "<td>" . $row["time"] . "</td>";
        echo "</tr>";

        $stt++;
    }
} else {
    echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
}

$conn->close();
?>
