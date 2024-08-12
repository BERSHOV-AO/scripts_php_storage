<?php

$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name = "agv_db";
$table_name = "model";

$connect = new mysqli($server_name, $user_name, $password, $db_name);

if($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$data = json_decode(file_get_contents("php://input"), true);

$model = mysqli_real_escape_string($connect, $data['model']);

$sql = "INSERT INTO $table_name (model) VALUES ('$model')";

if ($connect->query($sql) === TRUE) {
    echo json_encode(array("message" => "model saved!"));
} else {
    echo json_encode(array("message" => "mode not saved! Get some error!"));
}
$connect->close();
?>