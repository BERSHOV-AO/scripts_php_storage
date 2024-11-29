<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

$response = [];

if ($connect->connect_error) {
    $response['success'] = false;
    $response['message'] = "Connection failed: " . $connect->connect_error;
} else {
    $response['success'] = true;
    $response['message'] = "Connected successfully";
}

$connect->close();
echo json_encode($response);
?>
