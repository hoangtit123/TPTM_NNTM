<?php
// send_signal.php

// Kiểm tra xem có tín hiệu được gửi đến không
if (isset($_GET['signal'])) {
    $signal = $_GET['signal'];

    // Ghi vào file log
    file_put_contents('log.txt', "Signal received: $signal\n", FILE_APPEND);

    // Địa chỉ IP của NodeMCU ESP32S
    $esp32_ip = '172.20.10.2'; // Thay đổi x.x bằng địa chỉ IP thực tế của NodeMCU

    // URL để gửi tín hiệu tới NodeMCU
    $url = "http://$esp32_ip/receive_signal?signal=$signal";

    // Gửi yêu cầu tới NodeMCU
    $response = file_get_contents($url);

    // Kiểm tra phản hồi từ NodeMCU
    if ($response === FALSE) {
        echo "Failed to send signal to NodeMCU.";
    } else {
        echo "Signal sent to NodeMCU: $response";
    }

    // Thực hiện các hành động cần thiết dựa trên tín hiệu
    // ...
} else {
    echo "No signal received.";
}
?>