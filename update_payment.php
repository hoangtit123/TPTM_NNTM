<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $amount = (int)$_POST['amount'];
    $surcharge = (int)$_POST['surcharge'];
    $total = (int)$_POST['total'];
    $paid_status = $_POST['paid_status'];

    $sql = "UPDATE history SET amount = $amount, surcharge = $surcharge, total = $total, paid_status = '$paid_status' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid_request";
}

$conn->close();
?>
