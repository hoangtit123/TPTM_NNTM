<?php
header('Content-Type: application/json');

// Đường dẫn đến file Python
$pythonScript = 'detect_plate.py';

// Gọi file Python và thu thập đầu ra
exec("python detect_plate.py 2>&1", $output, $return_var);

// Gộp các dòng đầu ra từ Python
$result = implode("\n", $output);

// Lọc ra phần JSON từ kết quả
$json_start = strpos($result, '{');
$json_end = strrpos($result, '}');
if ($json_start !== false && $json_end !== false) {
    $json = substr($result, $json_start, $json_end - $json_start + 1);

    // Kiểm tra nếu JSON hợp lệ
    json_decode($json);
    if (json_last_error() === JSON_ERROR_NONE) {
        echo $json; // Trả về JSON hợp lệ
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "JSON không hợp lệ.",
            "raw_output" => $result
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Không tìm thấy JSON trong đầu ra.",
        "raw_output" => $result
    ]);
}
?>
