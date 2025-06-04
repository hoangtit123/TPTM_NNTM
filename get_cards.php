<?php
// Include file kết nối cơ sở dữ liệu
include 'db_connection.php';

// Truy vấn dữ liệu từ bảng card
$sql = "SELECT id FROM card ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $stt = 1; // Biến số thứ tự
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $stt . "</td>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>
                <form action='' method='POST' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button type='submit' class='delete-btn' onclick='return confirmDelete();'>Xóa</button>
                </form>
              </td>";
        echo "</tr>";
        $stt++;
    }
} else {
    echo "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
}

?>
